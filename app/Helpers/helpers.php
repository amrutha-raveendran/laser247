<?php
 
namespace App\Helpers;
use Illuminate\Support\Number;
 
Class CustomHelper{
 
    public static function format_number($number) {
        if ($number >= 1000) {
            return number_format($number / 1000, 0) . 'k';
        }
        return $number;
    }
   
}
 
?>