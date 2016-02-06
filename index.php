<?php
if(!isset($_GET["category"])) {
	exit();
}

//$category = $_GET["category"];


function getRedirectUrl ($url) {
    stream_context_set_default(array(
        'http' => array(
            'method' => 'HEAD'
        )
    ));
    $headers = get_headers($url, 1);
    if ($headers !== false && isset($headers['Location'])) {
        return $headers['Location'];
    }
    return false;
}



$url = 'http://en.wikipedia.org/wiki/Special:RandomInCategory/'.$category;	

$page = 'Category';

while (strpos($page, 'Category') !== false or strpos($page, 'Portal') !== false) {
	
	$temp = getRedirectUrl($url);
	
	if($temp != false) {
		$page = $temp[1];
		$page = trim($page);
		$page = str_replace("https://en.wikipedia.org/wiki/", "", $page);
		$page = str_replace("http://en.wikipedia.org/wiki/", "", $page);
	}

	else {
		$page = false;
		break;
	}

}



if ($page != false) {
		$temp2 = trim($page);
		$page2 = str_replace("https://en.wikipedia.org/wiki/", "", $temp2);
		$page2 = str_replace("http://en.wikipedia.org/wiki/", "", $page2);
		echo $_GET['callback'] . '(' . "{'category' : '$page2' }" . ')';

	}

