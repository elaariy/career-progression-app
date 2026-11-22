<?php

use OpenApi\Attributes as OA;

class PositionsPaths
{
    #[OA\Get(
        path: '/positions',
        tags: ['positions'],
        summary: 'List positions',
        responses: [
            new OA\Response(response: 200, description: 'List of positions', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Position'))),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getPositions() {}

    #[OA\Get(
        path: '/positions/{id}',
        tags: ['positions'],
        summary: 'Get one position',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'The requested record', content: new OA\JsonContent(ref: '#/components/schemas/Position')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getPositionsById() {}

    #[OA\Post(
        path: '/positions',
        tags: ['positions'],
        summary: 'Create a Position',
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/PositionInput')),
        responses: [
            new OA\Response(response: 201, description: 'Created record', content: new OA\JsonContent(ref: '#/components/schemas/Position')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function postPositions() {}

    #[OA\Put(
        path: '/positions/{id}',
        tags: ['positions'],
        summary: 'Update a Position',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/PositionInput')),
        responses: [
            new OA\Response(response: 200, description: 'Updated record', content: new OA\JsonContent(ref: '#/components/schemas/Position')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function putPositionsById() {}

    #[OA\Delete(
        path: '/positions/{id}',
        tags: ['positions'],
        summary: 'Delete a Position',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'Deleted record', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
            new OA\Response(response: 400, description: 'Constraint prevents deletion', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function deletePositionsById() {}
}
