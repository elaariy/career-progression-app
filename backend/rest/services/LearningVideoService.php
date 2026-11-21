<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../utils/exceptions.php';

class LearningVideoService
{
    public function search($query)
    {
        if (!is_string($query) || !preg_match('/\A.{2,80}\z/u', trim($query))) {
            throw new ValidationException('Enter a search term between 2 and 80 characters.');
        }

        $params = http_build_query([
            'part' => 'snippet',
            'type' => 'video',
            'maxResults' => 6,
            'q' => trim($query) . ' tutorial',
            'key' => Config::YOUTUBE_API_KEY(),
        ], '', '&', PHP_QUERY_RFC3986);

        $request = curl_init('https://www.googleapis.com/youtube/v3/search?' . $params);

        curl_setopt_array($request, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 6,
        ]);

        $body = curl_exec($request);
        $status = curl_getinfo($request, CURLINFO_HTTP_CODE);
        $curlError = curl_errno($request);
        curl_close($request);

        if ($body === false || $status !== 200) {
            $this->unavailable("YouTube HTTP $status, cURL error $curlError");
        }

        $response = json_decode($body, true);
        if (!isset($response['items']) || !is_array($response['items'])) {
            $this->unavailable('Invalid response from YouTube');
        }

        $videos = [];
        foreach ($response['items'] as $item) {
            $videos[] = [
                'title' => html_entity_decode($item['snippet']['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'channel' => $item['snippet']['channelTitle'],
                'url' => 'https://www.youtube.com/watch?v=' . $item['id']['videoId'],
            ];
        }

        return $videos;
    }

    private function unavailable($reason)
    {
        $entry = '[' . date('c') . '] ERROR LearningVideoService: ' . $reason . PHP_EOL;
        error_log($entry, 3, __DIR__ . '/../../logs/error.log');

        throw new ExternalServiceException('Video search is temporarily unavailable. Please try again later.');
    }
}