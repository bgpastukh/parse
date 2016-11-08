<?php

$textArray = explode(" ", $_POST['text']);

function compare_length($a, $b)
{
    if ($a == $b)
        return 0;
    return ($a < $b) ? 1 : -1;
}

function show_longest_words($array, $value_compare_func)
{
    usort($array, $value_compare_func);
    for ($i = 0; $i < 3; $i++)
    {
        echo $array[$i]."<br>";
    }
}

show_longest_words($textArray, "compare_length");