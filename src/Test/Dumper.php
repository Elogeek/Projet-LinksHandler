<?php

class Dumper {

    /** test
     * @param $var
     * @param $die
     */
    public static function dieAndDump($var, $die = false) {
         echo "<pre>";
        print_r($var);
        echo "</pre>";
        if($die) {
            die();
        }
    }
}