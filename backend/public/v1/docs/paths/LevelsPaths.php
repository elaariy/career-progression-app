<?php

use OpenApi\Attributes as OA;

class LevelsPaths
{
    #[OA\Get(
        path: '/levels',
        tags: ['levels'],
        summary: 'List levels',
        responses: [
            new OA\Response(response: 200, description: 'List of levels', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Level'))),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getLevels() {}

    #[OA\Get(
        path: '/levels/{id}',
        tags: ['levels'],
        summary: 'Get one level',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'The requested record', content: new OA\JsonContent(ref: '#/components/schemas/Level')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getLevelsById() {}

    #[OA\Post(
        path: '/levels',
        tags: ['levels'],
        summary: 'Create a Level',
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/LevelInput')),
        responses: [
            new OA\Response(response: 201, description: 'Created record', content: new OA\JsonContent(ref: '#/components/schemas/Level')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function postLevels() {}

    #[OA\Put(
        path: '/levels/{id}',
        tags: ['levels'],
        summary: 'Update a Level',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/LevelInput')),
        responses: [
            new OA\Response(response: 200, description: 'Updated record', content: new OA\JsonContent(ref: '#/components/schemas/Level')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function putLevelsById() {}

    #[OA\Delete(
        path: '/levels/{id}',
        tags: ['levels'],
        summary: 'Delete a Level',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'Deleted record', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
            new OA\Response(response: 400, description: 'Constraint prevents deletion', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function deleteLevelsById() {}
}
