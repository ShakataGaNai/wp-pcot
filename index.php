<?php

print curlIt("http://www.google.com/robots.txt");

function curlIt($url){
	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$out = curl_exec($ch);
	curl_close($ch);
	return $out;
}

?>
