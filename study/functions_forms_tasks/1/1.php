<?php

$firstFieldWords = explode(" ", $_POST['first_field']);
$secondFieldWords = explode(" ", $_POST['second_field']);


function getCommonWords($firstArray, $secondArray)
{
    return array_intersect($firstArray, $secondArray);
}

    var_dump(getCommonWords($firstFieldWords, $secondFieldWords));