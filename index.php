<?php

$url = 'http://en.wikipedia.org/wiki/Special:RandomInCategory/Chemistry';	

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:21.0) Gecko/20100101 Firefox/21.0"); // Necessary. The server checks for a valid User-Agent.
curl_exec($ch);

$response = curl_exec($ch);
preg_match_all('/^Location:(.*)$/mi', $response, $matches);
curl_close($ch);

echo !empty($matches[1]) ? trim($matches[1][0]) : 'No redirect found';
?>