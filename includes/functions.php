<?php

function title($title){
	switch($title){
		default:
			echo "Streams4u.pl - Strona G³ówna";
		break;
		case "register":
			echo "Streams4u.pl - Rejestracja";
		break;
		case "watch":
			echo "Streams4u.pl - Mecz ".Wiziwig_Streams::getTeams(db::fieldFilter($_GET["id"]), "football")." na ¿ywo.";
		break;
		case "scores":
			echo "Streams4u.pl - Wyniki meczów";
		break;		
	}
}


function gen_www()
{
 $time = explode(" ", microtime());
 $usec = (double)$time[0];
 $sec = (double)$time[1];
 return $sec + $usec;
}
$start = gen_www();

function strposa($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}
function strposb($haystack, $needles=array(), $offset=0) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return "-1";
        return min($chr);
}

function TranslateDate($date) {
    $date = str_replace('Monday', 'Poniedzia³ek', $date);
    $date = str_replace('Tuesday', 'Wtorek', $date);
    $date = str_replace('Wednesday', 'Œroda', $date);
    $date = str_replace('Thursday', 'Czwartek', $date);
    $date = str_replace('Monday', 'Pi¹tek', $date);
    $date = str_replace('Saturday', 'Sobota', $date);
    $date = str_replace('Sunday', 'Niedziela', $date);
 
    $date = str_replace('January', 'Stycznia', $date);
    $date = str_replace('February', 'Lutego', $date);
    $date = str_replace('March', 'Marca', $date);
    $date = str_replace('April', 'Kwietnia', $date);
    $date = str_replace('May', 'Maja', $date);
    $date = str_replace('June', 'Czerwca', $date);
    $date = str_replace('July', 'Lipca', $date);
    $date = str_replace('August', 'Sierpnia', $date);
    $date = str_replace('September', 'Wrzeœnia', $date);
    $date = str_replace('October', 'PaŸdziernika', $date);
    $date = str_replace('November', 'Listopada', $date);
    $date = str_replace('December', 'Grudnia', $date);
	
    return $date;
}

function MonthInt($date){
	$Adata = array ("January","February","March","April","May","June","July","August","September","October","November","December");
	$Rdata = array ("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");

	$converted = str_replace($Adata, $Rdata, $date);
	
	
	return $converted;

}

function goscieOnline(){
	$bylo = date('Y-m-d H:i:s', time()-5*60); // 5 min
	$teraz = date('Y-m-d H:i:s', time()); // 5 min
	$ip = $_SERVER['REMOTE_ADDR'];

	$sql = "DELETE FROM `users_online` WHERE `datetime`<'$bylo'";
	db::query($sql);
	
	$sql = "INSERT INTO `users_online` (ip,datetime) VALUES('$ip','$teraz') ON DUPLICATE KEY UPDATE ip=VALUES(ip), datetime='$teraz'";
	db::query($sql);

	$sql = "SELECT COUNT(*) FROM `users_online` WHERE `datetime`>'$bylo'";
	$odp = db::query($sql);
	$row = mysql_fetch_array($odp);
	
	$rekordsql = db::query("SELECT `Rekord` FROM `users_online_record`");
	$row2 = mysql_fetch_array($rekordsql);
	
	if($row[0] > $row2[0]){
		db::query("UPDATE `users_online_record` SET `Rekord`='".$row[0]."' WHERE `Id`=1");
	}
	return '<font color=white>Osób online:</font> <font color=yellow>'.$row[0].'</font>';
} 
function ocena($value){
	switch($value){
		case 0:
		  return '<img src="images/star_off.gif"><img src="images/star_off.gif"><img src="images/star_off.gif"><img src="images/star_off.gif">';
		break;
		case 25:
			return '<img src="images/star_on.gif"><img src="images/star_off.gif"><img src="images/star_off.gif"><img src="images/star_off.gif">';
		break;
		case 50:
			return '<img src="images/star_on.gif"><img src="images/star_on.gif"><img src="images/star_off.gif"><img src="images/star_off.gif">';
		break;		
		case 75:
			return '<img src="images/star_on.gif"><img src="images/star_on.gif"><img src="images/star_on.gif"><img src="images/star_off.gif">';
		break;
		case 100:
			return '<img src="images/star_on.gif"><img src="images/star_on.gif"><img src="images/star_on.gif"><img src="images/star_on.gif">';
		break;		
	}
}

?>