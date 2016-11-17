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
    $deleteWords = ["із", "до", "та", "на", "резюме", "отправить", "отрасль",
        "работа", "работодателю", "по", "rabota", "соискателю", "ua",
        "рубрика", "по", "com", "www", "mail", "знання",
        "and", "of", "we", "in", "the", "to", "for", "is", "are", "with",
        "on", "you", "be", "our", "as", "your", "such", "will", "more", "good", "it", "or",
        "company", "developer", "development", "an", "foreign", "all", "working", "at", "com", "etc",
        "that", "other", "вы", "вас", "из", "для", "мы", "от"
    ];

    foreach ($deleteWords as $value)
    {
        $word = " " . $value . " ";
        if (strpos($string, $word))
        {
            $string = str_replace($word, " ", $string);
        }
    }
    $string = preg_replace("/  +/", " ", $string);
    $array = explode(" ", $string);
    $array = array_count_values($array);
    arsort($array);
    foreach ($array as $key => $value)
    {
    	if (is_int($key) || mb_strlen($key) < 2 || $value < 3) {
    		continue;
    	}
        echo $key . " = " . $value . "<br>";
    }
    return implode(" ", $array);
}

function format_string($string)
{
    $string = strip_tags(mb_strtolower($string));
    $string = preg_replace("/[;,\/,,,!,.,:,-,(,)]/", " ", trim($string));
//    $string = preg_replace("/[^a-zA-ZА-Яа-я0-9\s]/", " ", trim($string));
    $string = preg_replace("/nbsp/", " ", $string);
	return $string;
}

$parseSite = "http://rabota.ua/";
$vacanciesPage = "http://rabota.ua/jobsearch/vacancy_list?keyWords=php";
$vacanciesLinks = [];
$data = "";

// Parsing query pages
for ($i = 1; $i <= 5; $i++)
{
    $links = [];
    $parsedPage = curl($vacanciesPage . "&pg=" . $i);
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
        $text = "";

        if (!empty($html->find('div.d_content')))
        {
            foreach ($html->find('div.d_content') as $item) {
                foreach ($item->find('li') as $element)
                {
                    $text .= " " . $element->innertext;
                }

                foreach ($item->find('p') as $element)
                {
                    $text .= " " . $element->innertext;
                }
            }
        } elseif (!empty($html->find('div.jqKeywordHighlight')))
        {
            foreach ($html->find('div.jqKeywordHighlight') as $item) {
                foreach ($item->find('li') as $element)
                {
                    $text .= " " . $element->innertext;
                }

                foreach ($item->find('p') as $element)
                {
                    $text .= " " . $element->innertext;
                }
            }
        }

//        var_dump($text);
//        echo "<br>";
        $data .= format_string($text);
    }

}



//$f = fopen('file.txt', 'w+');
//fwrite($f, count_elements($data));
//var_dump($data);
count_elements($data);

//echo "<pre>";
//var_dump($vacanciesLinks);
//echo "</pre>";



