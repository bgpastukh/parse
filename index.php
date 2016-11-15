<?php

require_once('simple_html_dom.php');

function count_elements($string)
{
    $array = explode(" ", $string);
    $array = array_count_values($array);
    arsort($array);
    foreach ($array as $key => $value)
    {
    	if (is_int($key) || mb_strlen($key) < 2) {
    		continue;
    	}
        echo $key . " = " . $value . "<br>";
    }
}

function format_string($string)
{
	$deleteWords = ["із", "до", "та", "на", "резюме", "отправить", "отрасль", "рубрика", "по", "com", "www", "http", "mail", "знання", "зняння"];
	$string = preg_replace("/\r\n/", " ", $string);
	$string = strip_tags(mb_strtolower($string));
	$string = preg_replace("/[\;,\/,\,,!,\.,:,-]/", " ", trim($string));
	foreach ($deleteWords as $value) {
		if (strpos($string, $value)) {
			$string = str_replace(" ". $value . " ", " ", $string);		
		}
	}
	$string = preg_replace("/  +/", " ", trim($string));
	$file = fopen('file.txt', 'w+');
	fwrite($file, $string);
	return $string;
}


$parseSite = "http://rabota.ua/";
// $vacanciesPage = "http://rabota.ua/zapros/php-developer";
$vacanciesPage = 'page.php';
$vacanciesLinks = [];
$data = "";

// Parsing query page
$parsedPage = file_get_contents($vacanciesPage);
preg_match_all("/company[0-9]+\/vacancy[0-9]+/", $parsedPage, $vacanciesLinks);

// Creating string with all data
foreach ($vacanciesLinks as $link) {

	//Parsing vacancy page
	$html = file_get_html('vacancy.php');
	// $html = file_get_html($parseSite . $link);
	$div = $html->find(".d_content", 0);
	$text =  $div->innertext;
	$data .= format_string($text);
	
}




count_elements($data);


// echo "<pre>";
// var_dump($text);
// echo "</pre>";
