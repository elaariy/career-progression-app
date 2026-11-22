<?php

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'CareerPath API',
    description: 'Career development REST API for IT companies and employees.',
    version: '1.0.0'
)]
#[OA\Server(url: API_BASE_URL, description: 'CareerPath backend')]
#[OA\Schema(
    schema: 'Error',
    required: ['error'],
    properties: [
        new OA\Property(property: 'error', type: 'string', example: 'Invalid input.')
    ],
    type: 'object'
)]
#[OA\Schema(
    schema: 'Message',
    required: ['message'],
    properties: [
        new OA\Property(property: 'message', type: 'string', example: 'Record deleted.')
    ],
    type: 'object'
)]
#[OA\Schema(schema: 'RoleInput', required: ['name'], properties: [
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 50),
    new OA\Property(property: 'description', type: 'string', maxLength: 255, nullable: true)
])]
#[OA\Schema(schema: 'Role', allOf: [new OA\Schema(ref: '#/components/schemas/RoleInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'CareerTypeInput', required: ['name'], properties: [
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 100),
    new OA\Property(property: 'description', type: 'string', nullable: true)
])]
#[OA\Schema(schema: 'CareerType', allOf: [new OA\Schema(ref: '#/components/schemas/CareerTypeInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'LevelInput', required: ['name', 'level_code'], properties: [
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 50),
    new OA\Property(property: 'level_code', type: 'string', minLength: 1, maxLength: 10),
    new OA\Property(property: 'description', type: 'string', nullable: true)
])]
#[OA\Schema(schema: 'Level', allOf: [new OA\Schema(ref: '#/components/schemas/LevelInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'PositionInput', required: ['career_type_id', 'name'], properties: [
    new OA\Property(property: 'career_type_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 100),
    new OA\Property(property: 'description', type: 'string', nullable: true)
])]
#[OA\Schema(schema: 'Position', allOf: [new OA\Schema(ref: '#/components/schemas/PositionInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'LevelPositionInput', required: ['level_id', 'position_id'], properties: [
    new OA\Property(property: 'level_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'position_id', type: 'integer', minimum: 1)
])]
#[OA\Schema(schema: 'LevelPosition', allOf: [new OA\Schema(ref: '#/components/schemas/LevelPositionInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'SkillInput', required: ['name'], properties: [
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 150),
    new OA\Property(property: 'description', type: 'string', nullable: true)
])]
#[OA\Schema(schema: 'Skill', allOf: [new OA\Schema(ref: '#/components/schemas/SkillInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'LevelSkillInput', required: ['level_id', 'skill_id'], properties: [
    new OA\Property(property: 'level_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'skill_id', type: 'integer', minimum: 1)
])]
#[OA\Schema(schema: 'LevelSkill', allOf: [new OA\Schema(ref: '#/components/schemas/LevelSkillInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'ResourceInput', required: ['title'], properties: [
    new OA\Property(property: 'title', type: 'string', minLength: 1, maxLength: 200),
    new OA\Property(property: 'description', type: 'string', nullable: true),
    new OA\Property(property: 'url', type: 'string', format: 'uri', maxLength: 500, nullable: true)
])]
#[OA\Schema(schema: 'Resource', allOf: [new OA\Schema(ref: '#/components/schemas/ResourceInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'UserInput', required: ['role_id', 'first_name', 'last_name', 'email', 'password'], properties: [
    new OA\Property(property: 'role_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'career_type_id', type: 'integer', nullable: true, minimum: 1),
    new OA\Property(property: 'current_level_position_id', type: 'integer', nullable: true, minimum: 1),
    new OA\Property(property: 'first_name', type: 'string', minLength: 1, maxLength: 100),
    new OA\Property(property: 'last_name', type: 'string', minLength: 1, maxLength: 100),
    new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255),
    new OA\Property(property: 'password', type: 'string', format: 'password', description: 'Required on create; optional on update'),
    new OA\Property(property: 'experience_years', type: 'integer', nullable: true, minimum: 0),
    new OA\Property(property: 'is_active', type: 'boolean', nullable: true)
])]
#[OA\Schema(schema: 'User', properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'role_id', type: 'integer'),
    new OA\Property(property: 'career_type_id', type: 'integer', nullable: true),
    new OA\Property(property: 'current_level_position_id', type: 'integer', nullable: true),
    new OA\Property(property: 'first_name', type: 'string'),
    new OA\Property(property: 'last_name', type: 'string'),
    new OA\Property(property: 'email', type: 'string', format: 'email'),
    new OA\Property(property: 'experience_years', type: 'integer'),
    new OA\Property(property: 'is_active', type: 'boolean'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'UserSkillInput', required: ['user_id', 'skill_id'], properties: [
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'skill_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'progress_percent', type: 'integer', minimum: 0, maximum: 100, nullable: true),
    new OA\Property(property: 'is_completed', type: 'boolean', nullable: true)
])]
#[OA\Schema(schema: 'UserSkill', allOf: [new OA\Schema(ref: '#/components/schemas/UserSkillInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'last_updated_at', type: 'string', format: 'date-time', nullable: true),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'ProjectInput', required: ['name'], properties: [
    new OA\Property(property: 'name', type: 'string', minLength: 1, maxLength: 200),
    new OA\Property(property: 'description', type: 'string', nullable: true),
    new OA\Property(property: 'start_date', type: 'string', format: 'date', nullable: true),
    new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true),
    new OA\Property(property: 'status', type: 'string', maxLength: 30)
])]
#[OA\Schema(schema: 'Project', allOf: [new OA\Schema(ref: '#/components/schemas/ProjectInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'ProjectUserInput', required: ['project_id', 'user_id'], properties: [
    new OA\Property(property: 'project_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1)
])]
#[OA\Schema(schema: 'ProjectUser', allOf: [new OA\Schema(ref: '#/components/schemas/ProjectUserInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'joined_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'UserResourceInput', required: ['user_id', 'resource_id'], properties: [
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'resource_id', type: 'integer', minimum: 1)
])]
#[OA\Schema(schema: 'UserResource', allOf: [new OA\Schema(ref: '#/components/schemas/UserResourceInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'saved_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'CareerProgressionInput', required: ['user_id', 'level_position_id', 'start_date'], properties: [
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'level_position_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'start_date', type: 'string', format: 'date'),
    new OA\Property(property: 'end_date', type: 'string', format: 'date', nullable: true),
    new OA\Property(property: 'notes', type: 'string', nullable: true)
])]
#[OA\Schema(schema: 'CareerProgression', allOf: [new OA\Schema(ref: '#/components/schemas/CareerProgressionInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'ProgressionRequestInput', required: ['user_id', 'from_level_position_id', 'to_level_position_id'], properties: [
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'from_level_position_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'to_level_position_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'status', type: 'string', maxLength: 20, nullable: true),
    new OA\Property(property: 'reason', type: 'string', nullable: true),
    new OA\Property(property: 'reviewed_by', type: 'integer', nullable: true, minimum: 1),
    new OA\Property(property: 'requested_at', type: 'string', format: 'date-time', nullable: true),
    new OA\Property(property: 'reviewed_at', type: 'string', format: 'date-time', nullable: true)
])]
#[OA\Schema(schema: 'ProgressionRequest', allOf: [new OA\Schema(ref: '#/components/schemas/ProgressionRequestInput')], properties: [
    new OA\Property(property: 'id', type: 'integer')
])]
#[OA\Schema(schema: 'ProgressionCommentInput', required: ['progression_request_id', 'user_id', 'comment'], properties: [
    new OA\Property(property: 'progression_request_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'user_id', type: 'integer', minimum: 1),
    new OA\Property(property: 'comment', type: 'string', minLength: 1)
])]
#[OA\Schema(schema: 'ProgressionComment', allOf: [new OA\Schema(ref: '#/components/schemas/ProgressionCommentInput')], properties: [
    new OA\Property(property: 'id', type: 'integer'),
    new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
    new OA\Property(property: 'updated_at', type: 'string', format: 'date-time')
])]
#[OA\Schema(schema: 'LearningVideo', required: ['title', 'channel', 'url'], properties: [
    new OA\Property(property: 'title', type: 'string'),
    new OA\Property(property: 'channel', type: 'string'),
    new OA\Property(property: 'url', type: 'string', format: 'uri')
])]
class ApiDocumentation
{
}
