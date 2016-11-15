<?php

require_once('simple_html_dom.php');

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36');
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $return         = curl_exec($ch);
    $curl_info      = curl_getinfo($ch);
    $header_size    = $curl_info['header_size'];
    $headers        = mb_substr($return, 0, $header_size);
    $headers        = explode("\r\n", $headers);
    $headers        = array_filter($headers);
    $body           = mb_substr($return, $header_size);
    curl_close($ch);
    return array(
        'headers'   => $headers,
        'body'      => $body,
    );
}

function count_elements($string)
{
    $string = preg_replace("/  +/", " ", $string);
    $array = explode(" ", $string);
    $array = array_count_values($array);
    arsort($array);
    foreach ($array as $key => $value)
    {
    	if (is_int($key) || mb_strlen($key) < 2 || $value == 1) {
    		continue;
    	}
        echo $key . " = " . $value . "<br>";
    }
    return implode(" ", $array);
}

function format_string($string)
{
	$deleteWords = ["із", "до", "та", "на", "резюме", "отправить", "отрасль",
        "рубрика", "по", "com", "www", "http", "mail", "знання", "зняння",
        "and", "of", "we", "in", "the", "to", "for", "is", "are", "with",
        "on", "you", "be", "our", "as", "your", "such", "will", "more", "good", "it", "or",
        "company", "developer", "development"
    ];
	$string = preg_replace("/\r\n/", " ", $string);
    $string = strip_tags(mb_strtolower($string));
    $string = preg_replace("/[;,\/,,,!,.,:,-,(,)]/", " ", trim($string));
    $string = preg_replace("/  +/", " ", trim($string));
    foreach ($deleteWords as $value)
    {
        if (strpos($string, $value))
        {
            $string = str_replace($value . " ", " ", $string);
        }
    }
	return $string;
}


$parseSite = "http://rabota.ua/";
$vacanciesPage = "http://rabota.ua/zapros/php-developer";
$vacanciesLinks = [];
$data = "";

// Parsing query pages
for ($i = 1; $i <= 1; $i++)
{
    $links = [];
    $parsedPage = curl($vacanciesPage . "/pg" . $i);
    preg_match_all("/company[0-9]+\/vacancy[0-9]+/", $parsedPage['body'], $links);
    $vacanciesLinks = array_merge($vacanciesLinks, $links);
}

// Creating string with all data
foreach ($vacanciesLinks as $arr)
{
    foreach ($arr as $link)
    {
        // Parsing vacancy page
        $vacancy = curl($parseSite . $link);
        $html = str_get_html($vacancy['body']);
    //    if ($html->find(".d_content", 0))
    //    {
    //	    $div = $html->find(".d_content", 0);
    //    } else
    //    {
    //        $div = $html->find(".jqKeywordHighlight", 0);
    //    }
        $div = $html->find(".d_content", 0);
        if (gettype($div) == null){
            $div = $html->find(".jqKeywordHighlight", 0);
        }
        $text =  $div->innertext;
        $data .= format_string($text);
    }

}




$f = fopen('file.txt', 'w+');
fwrite($f, count_elements($data));

//echo "<pre>";
//var_dump($vacanciesLinks);
//echo "</pre>";


//$response = curl("http://rabota.ua/zapros/php-developer");

