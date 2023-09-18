<?php

if (! function_exists('remove_non_digit_chars')) {
    function remove_non_digit_chars($value): array|string|null
    {
        return preg_replace('/[^0-9.]/', '', $value);
    }
}

if(! function_exists('make_phone_beautiful')) {
    function make_phone_beautiful($value)
    {
        if(preg_match('/^(\d)(\d{3})(\d{3})(\d{2})(\d{2})$/', $value, $matches)) {
            return "+{$matches[1]} ({$matches[2]}) {$matches[3]}-{$matches[4]}-{$matches[5]}";
        }
        return $value;
    }
}

