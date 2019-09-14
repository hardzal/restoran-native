<?php

namespace app\config;

class Validation {
    
    public function __construct()
    {
        
    }

    public function checkField(array $string) {
        $num = 0;
        if(is_array($string)) {
        foreach($string as $value) {
            if(!isset($value) && empty($value)) {
                $num = $num + 1;
            }

            if(strlen($value) < 6 || strlen($value) > 100) {
                $num = $num + 1;
            }
        }
            if($num >= 1) {
                return false;
            }

            return true;
        }

        return false;
    }

    public function filterField() {

    }

    public function changeField() {
        
    }

}