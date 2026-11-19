<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ResourceDao.php';

class ResourceService extends BaseService
{
    protected $entity_name = 'Resource';

    public function __construct()
    {
        parent::__construct(new ResourceDao());
    }

    public function add($entity)
    {
        return parent::add($this->prepare($entity));
    }

    public function update($entity, $id)
    {
        return parent::update($this->prepare($entity), $id);
    }

    protected function validate($entity, $id = null)
    {
        if (isset($entity['title']) && !is_string($entity['title'])) {
            throw new ValidationException('Resource title must be text.');
        }

        Validator::required($entity, ['title']);
        Validator::length($entity['title'], 'title', 1, 200);

        if (
            array_key_exists('description', $entity) &&
            $entity['description'] !== null &&
            !is_string($entity['description'])
        ) {
            throw new ValidationException(
                'Description must be text or null.'
            );
        }

        if (
            array_key_exists('url', $entity) &&
            $entity['url'] !== null
        ) {
            if (!is_string($entity['url'])) {
                throw new ValidationException('URL must be text or null.');
            }

            Validator::length($entity['url'], 'url', 1, 500);

            $scheme = parse_url($entity['url'], PHP_URL_SCHEME);
            if (
                filter_var($entity['url'], FILTER_VALIDATE_URL) === false ||
                !in_array(strtolower((string) $scheme), ['http', 'https'], true)
            ) {
                throw new ValidationException(
                    'URL must be a valid HTTP or HTTPS address.'
                );
            }
        }
    }

    private function prepare($entity)
    {
        foreach (['title', 'description', 'url'] as $field) {
            if (isset($entity[$field]) && is_string($entity[$field])) {
                $entity[$field] = trim($entity[$field]);
            }
        }

        return $entity;
    }
}
