<?php

use OpenApi\Attributes as OA;

class RootPaths
{
    #[OA\Get(
        path: '/',
        tags: ['api'],
        summary: 'API status',
        responses: [
            new OA\Response(
                response: 200,
                description: 'CareerPath API is running',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'app', type: 'string', example: 'CareerPath API'),
                        new OA\Property(property: 'message', type: 'string', example: 'The backend is running.')
                    ],
                    type: 'object'
                )
            )
        ]
    )]
    public function getRoot() {}
}
