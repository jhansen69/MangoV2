<?php

namespace App\Mango;


class Form
{
    private static $names = array (
            "bob",
            "tom",
            "sally"
    );

    public static function names()
    {
        $output="<ul>";
        foreach(static::$names as $name)
        {
           $output.="<li>$name</li>";
        }
        $output.= "</ul>";
        return $output;
    }
}