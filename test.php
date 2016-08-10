<?php
//====
$array = array();
$myFile = $_SERVER['DOCUMENT_ROOT'] . "/text/codes.txt";
foreach (file($myFile) as $line)
{
    list($key, $value) = explode(' ', $line, 2) + array(NULL, NULL);

    if ($value !== NULL)
    {
        $array[$key] = $value;
    }
}
var_dump($array);
//=====