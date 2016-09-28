<?php 

if(strpos($con = ini_get("disable_functions"), "fsockopen") === false) {
	if(is_resource($fs = fsockopen("www.livescore.in", 80, $errno, $errstr, 3)) && !($stop = $write = !fwrite($fs, "GET /pl/free/lsapi HTTP/1.1\r\nHost: www.livescore.in\r\nConnection: Close\r\nlsfid: 636102\r\n\r\n"))) {
		$content = "";
		while (!$stop && !feof($fs)) {
			$line = fgets($fs, 128);
			($write || $write = $line == "\r\n") && ($content .= $line);
		}
		fclose($fs);
		$c = explode("\n", $content);
		foreach($c as &$r) {
			$r = preg_replace("/^[0-9A-Fa-f]+\r/", "", $r);
		}
		$content = implode("", $c);
	} else 
		$content .= $errstr."(".$errno.")<br />\n";
		
} elseif(strpos($con, "file_get_contents") === false && ini_get("allow_url_fopen")) {

	$content = file_get_contents("http://www.livescore.in/pl/free/lsapi", 0, stream_context_create(array("http" => array("timeout" => 3, "header" => "lsfid: 636102 "))));
	
} elseif(extension_loaded("curl") && strpos($con, "curl_") === false) {

	curl_setopt_array($curl = curl_init("http://www.livescore.in/pl/free/lsapi"), array(CURLOPT_RETURNTRANSFER => true, CURLOPT_HTTPHEADER => array("lsfid: 636102 ")));
	$content = curl_exec($curl);curl_close($curl);
	
} else {
	$content = "PHP inScore nie mog¹ zostaæ za³adowane. Zapytaj providera czy dostêpne œa funkcje `file_get_contents` wraz z dyrektyw¹ `allow_url_fopen` lub funkcje `fsockopen`.";
}
echo $content;  
	?>
	