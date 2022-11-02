<?php
if (!function_exists('getShorterString')) {
    function getShorterString($text, $length=null, $ucwords=false)
    {
        if ($ucwords == true) {
            $formatedString = ucwords($text);
        } else {
            $formatedString = ucfirst($text);
        }

        if ($length != null) {
            if (strlen($formatedString) <= $length) {
                return $formatedString;
            } else {
                $y=substr($formatedString, 0, $length) . '...';
                return $y;
            }
        } else {
            return $formatedString;
        }
    }
}