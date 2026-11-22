<?php

use OpenApi\Attributes as OA;

class RolesPaths
{
    #[OA\Get(
        path: '/roles',
        tags: ['roles'],
        summary: 'List roles',
        responses: [
            new OA\Response(response: 200, description: 'List of roles', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Role'))),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getRoles() {}

    #[OA\Get(
        path: '/roles/{id}',
        tags: ['roles'],
        summary: 'Get one role',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'The requested record', content: new OA\JsonContent(ref: '#/components/schemas/Role')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getRolesById() {}

    #[OA\Post(
        path: '/roles',
        tags: ['roles'],
        summary: 'Create a Role',
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/RoleInput')),
        responses: [
            new OA\Response(response: 201, description: 'Created record', content: new OA\JsonContent(ref: '#/components/schemas/Role')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function postRoles() {}

    #[OA\Put(
        path: '/roles/{id}',
        tags: ['roles'],
        summary: 'Update a Role',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/RoleInput')),
        responses: [
            new OA\Response(response: 200, description: 'Updated record', content: new OA\JsonContent(ref: '#/components/schemas/Role')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function putRolesById() {}

    #[OA\Delete(
        path: '/roles/{id}',
        tags: ['roles'],
        summary: 'Delete a Role',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'Deleted record', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
            new OA\Response(response: 400, description: 'Constraint prevents deletion', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function deleteRolesById() {}
}
