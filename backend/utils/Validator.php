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

    public static function integer($value, $field, $min = null, $max = null)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new ValidationException(
                "Field '$field' must be a whole number."
            );
        }

        if ($min !== null && $value < $min) {
            throw new ValidationException(
                "Field '$field' must be at least $min."
            );
        }

        if ($max !== null && $value > $max) {
            throw new ValidationException(
                "Field '$field' must be at most $max."
            );
        }
    }
}