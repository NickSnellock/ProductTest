<?php


namespace App\Sanitisers;


class StringSanitiser
{
    public static function sanitise(string $string): string
    {
        $string = trim($string);
        $string = strip_tags($string);
        $string = html_entity_decode(htmlentities($string, ENT_DISALLOWED));

        return $string;
    }
}