<?php

function flash($title=null, $message=null)
{
    $flash=app('App\Http\Flash');

    if(func_num_args()==0)
    {
        return $flash;
    }
    return $flash->message($title, $message);
}


function arrayToString($array)
{
    /* covert array into a string */
    $string='';
    foreach($array as $key=>$value)
    {
        if($value=='1'){$value='True';}
        if($value=='0'){$value='False';}
        $key=ucfirst($key);
        $string.="$key is $value, ";
    }
    $string=rtrim($string,", ");
    return $string;
}

function settings($key = null)
{
    $settings = app('App\Settings');
    return $key ? $settings->get($key) : $settings;
}