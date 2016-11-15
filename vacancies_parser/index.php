<?php

$parseSite = "http://rabota.ua/";
//$vacanciesPage = "http://rabota.ua/zapros/php-developer";
$vacanciesPage = 'page.php';
$vacanciesLinks = [];

$parsedPage = file_get_contents($vacanciesPage);

preg_match_all("/company[0-9]+\/vacancy[0-9]+/", $parsedPage, $vacanciesLinks);

$parsedVacancy = file_get_contents('vacancy.php');


echo "<pre>";
var_dump($parsedVacancy);
echo "</pre>";