<?php

use OpenApi\Attributes as OA;

class ProjectsPaths
{
    #[OA\Get(
        path: '/projects',
        tags: ['projects'],
        summary: 'List projects',
        responses: [
            new OA\Response(response: 200, description: 'List of projects', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/Project'))),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getProjects() {}

    #[OA\Get(
        path: '/projects/{id}',
        tags: ['projects'],
        summary: 'Get one project',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'The requested record', content: new OA\JsonContent(ref: '#/components/schemas/Project')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getProjectsById() {}

    #[OA\Post(
        path: '/projects',
        tags: ['projects'],
        summary: 'Create a Project',
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/ProjectInput')),
        responses: [
            new OA\Response(response: 201, description: 'Created record', content: new OA\JsonContent(ref: '#/components/schemas/Project')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function postProjects() {}

    #[OA\Put(
        path: '/projects/{id}',
        tags: ['projects'],
        summary: 'Update a Project',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/ProjectInput')),
        responses: [
            new OA\Response(response: 200, description: 'Updated record', content: new OA\JsonContent(ref: '#/components/schemas/Project')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function putProjectsById() {}

    #[OA\Delete(
        path: '/projects/{id}',
        tags: ['projects'],
        summary: 'Delete a Project',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'Deleted record', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
            new OA\Response(response: 400, description: 'Constraint prevents deletion', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function deleteProjectsById() {}
}
