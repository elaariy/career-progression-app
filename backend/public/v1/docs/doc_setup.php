<?php

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'CareerPath API'
)]
#[OA\Server(
    url: '../../../',
    description: 'CareerPath backend'
)]
#[OA\Schema(
    schema: 'Error',
    required: ['error'],
    properties: [
        new OA\Property(property: 'error', type: 'string')
    ],
    type: 'object'
)]
class ApiDocumentation
{
}