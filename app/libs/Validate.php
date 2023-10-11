<?php

class Validate
{
    public static function number($string)
    {
        $search = [' ', '€', '$', ','];
        $replace = ['', '', '', ''];
        $number = str_replace($search, $replace, $string);

        return $number;
    }
}