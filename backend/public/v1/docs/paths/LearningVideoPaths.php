<?php

use OpenApi\Attributes as OA;

class LearningVideoPaths
{
    #[OA\Get(
        path: '/learning-videos',
        tags: ['learning-videos'],
        summary: 'Search learning videos',
        parameters: [
            new OA\Parameter(
                name: 'q',
                in: 'query',
                required: true,
                description: 'Search term after trimming: 2 to 80 Unicode characters.',
                example: 'PHP Flight',
                schema: new OA\Schema(type: 'string', minLength: 2, maxLength: 80)
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Successful YouTube video array', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/LearningVideo'))),
            new OA\Response(response: 400, description: 'Search term is missing or not between 2 and 80 characters', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 503, description: 'YouTube service is unavailable', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getLearningVideos() {}
}
