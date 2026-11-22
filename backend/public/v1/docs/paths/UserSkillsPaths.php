<?php

use OpenApi\Attributes as OA;

class UserSkillsPaths
{
    #[OA\Get(
        path: '/user-skills',
        tags: ['user-skills'],
        summary: 'List user-skills',
        responses: [
            new OA\Response(response: 200, description: 'List of user-skills', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/UserSkill'))),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getUserSkills() {}

    #[OA\Get(
        path: '/user-skills/{id}',
        tags: ['user-skills'],
        summary: 'Get one user-skill',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'The requested record', content: new OA\JsonContent(ref: '#/components/schemas/UserSkill')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function getUserSkillsById() {}

    #[OA\Post(
        path: '/user-skills',
        tags: ['user-skills'],
        summary: 'Create a UserSkill',
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/UserSkillInput')),
        responses: [
            new OA\Response(response: 201, description: 'Created record', content: new OA\JsonContent(ref: '#/components/schemas/UserSkill')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function postUserSkills() {}

    #[OA\Put(
        path: '/user-skills/{id}',
        tags: ['user-skills'],
        summary: 'Update a UserSkill',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/UserSkillInput')),
        responses: [
            new OA\Response(response: 200, description: 'Updated record', content: new OA\JsonContent(ref: '#/components/schemas/UserSkill')),
            new OA\Response(response: 400, description: 'Invalid input or constraint violation', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function putUserSkillsById() {}

    #[OA\Delete(
        path: '/user-skills/{id}',
        tags: ['user-skills'],
        summary: 'Delete a UserSkill',
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, example: 1, schema: new OA\Schema(type: 'integer', minimum: 1))],
        responses: [
            new OA\Response(response: 200, description: 'Deleted record', content: new OA\JsonContent(ref: '#/components/schemas/Message')),
            new OA\Response(response: 400, description: 'Constraint prevents deletion', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 404, description: 'Record not found', content: new OA\JsonContent(ref: '#/components/schemas/Error')),
            new OA\Response(response: 500, description: 'Unexpected server error', content: new OA\JsonContent(ref: '#/components/schemas/Error'))
        ]
    )]
    public function deleteUserSkillsById() {}
}
