<?php

require_once __DIR__ . '/exceptions.php';

class Validator
{
    public static function required($data, $fields)
    {
        foreach ($fields as $field) {
            if (!isset($data[$field]) || trim((string) $data[$field]) === '') {
                throw new ValidationException("Field '$field' is required.");
            }
        }
    }

    public static function length($value, $field, $min, $max)
    {
        $length = mb_strlen(trim((string) $value));

        if ($length < $min || $length > $max) {
            throw new ValidationException(
                "Field '$field' must be between $min and $max characters long."
            );
        }
    }
}