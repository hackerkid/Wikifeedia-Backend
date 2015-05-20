<?php

if(!isset($_GET["category"])) {
	exit();
}

$category = $_GET["category"];
//$category = "Chemistry";


$url = 'http://en.wikipedia.org/wiki/Special:RandomInCategory/'.$category;	

$page = 'Category';

while (strpos($page, 'Category') !== false or strpos($page, 'Portal') !== false) {
	//	print $page."\n";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:21.0) Gecko/20100101 Firefox/21.0"); // Necessary. The server checks for a valid User-Agent.


	curl_exec($ch);

	$response = curl_exec($ch);
	preg_match_all('/^Location:(.*)$/mi', $response, $matches);
	curl_close($ch);

	if (!empty($matches[1])) {
		$temp = trim($matches[1][0]);
		$page = str_replace("http://en.wikipedia.org/wiki/", "", $temp);
	//	echo $page;

	}

	else {
		break;
	}


	

}

if (!empty($matches[1])) {
		$temp = trim($matches[1][0]);
		$page = str_replace("http://en.wikipedia.org/wiki/", "", $temp);
		$arr = array('category' => $page);
		$json = json_encode($arr);
		print $json;

	}

