<?php

namespace chegamos\util;

class Inflector
{

    protected static function my_ucwords($string)
    {

        $invalid_characters = array('"', '\(', '\[', '\/', '<.*?>', '<\/.*?>', '-'); 

        foreach ($invalid_characters as $regex) {
            $string = preg_replace('/('.$regex.')/', '$1 ', $string); 
        }

        $string=ucwords(mb_convert_case($string, MB_CASE_LOWER, "UTF-8"));

        foreach ($invalid_characters as $regex) {
            $string = preg_replace('/('.$regex.') /', '$1', $string); 
        }

        return $string; 
    }

    public static function formatTitle($title)
    {
        $smallwordsarray = array(
            'de', 'do', 'da', 'dos', 'das', 'e', 'o', 'a'
        );

        $words = explode(' ', $title);
        foreach ($words as $key => $word) {
            if ($key == 0 or !in_array($word, $smallwordsarray)) {
                $words[$key] = self::my_ucwords(strtolower($word));
            }
        }

        $newtitle = implode(' ', $words);
        return $newtitle;
    }
}
