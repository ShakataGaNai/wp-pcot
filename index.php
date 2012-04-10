<?php

//###### Required Info
$baseURL = "http://www.snowulf.com/";	// Base URL with trailing slash
$startDate = "2005-01-01";		// YYYY-MM-DD - Earliest date to start at
$endDate = "2012-04-01";		// YYYY-MM-DD - Most recent date to stop at
$sleep = "100"; 			// Miliseconds
$file = "some.csv";			// CSV file to write out to
//###### ############


$now = strtotime($startDate);
$stop = strtotime($endDate);
$f = fopen($file, "w");
do {
	$dayURL = urlFormat($baseURL, $now);
	$page = curlIt($dayURL);
	$num = preg_match_all("/\"bookmark\"/", $page, $matches);
	print date("Y-m-d", $now) . " - $num\n";
	fwrite($f, date("Y-m-d", $now) . ",$num\n");
	$now = $now + (60*60*24);
	usleep($sleep);
} while ($now < $stop);
fclose($f);
print "DONE\n";
exit;



function urlFormat($base, $time){
	$year = date("Y", $time);
	$month = date("m", $time);
	$day = date("d", $time);
	return $base."{$year}/{$month}/{$day}/";
}

function curlIt($url){
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$out = curl_exec($ch);
	curl_close($ch);
	return $out;
}

?>
