<?php
class Wiziwig {
	private $match = array();

	static function download_matchs($discipline = "football", $page = 1){

		if($page == 1){
			db::query("TRUNCATE TABLE ".$discipline."_matchs");
		}
	
		$url = "http://www.wiziwig.tv/competition.php?part=sports&discipline=".$discipline."&allowedDays=1,2,3,4,5,6,7&p=".$page;
		$html = file_get_html($url);
		
	// Match ID
		$i=1;
		foreach($html->find('a.broadcast')as $noscript)
		{
			$matchidfilter = substr($noscript->href, strpos($noscript->href, "=")+1);
			$matchidfilter = substr($matchidfilter, 0, strpos($matchidfilter, "&"));
			if(($matchidfilter <> "") or ($matchidfilter > 0))
			{
				$match["id"][$i] = $matchidfilter;
				$i++;
			}
		}

	//Match Competition
		$i=1;
		foreach($html->find('a')as $noscript)
		{
			if(strpos($noscript->href, "competition.php?part=sports&amp;competitionid=") <> "")
			{
				$match["competition"][$i] = $noscript->innertext;
				$i++;
			}
		}

	//Match Date
		$i=1;
		foreach($html->find('div.date')as $noscript)
		{
			if($noscript->innertext <> "")
			{
				$Month["start"] = strpos($noscript->innertext, ',')+2;
				$match["date"]["month"][$i] = substr($noscript->innertext,$Month["start"], -3);
				$match["date"]["day"][$i]   = substr($noscript->innertext, -2);
				$i++;
			}
		}

	//Match Time
		$i=1;
		$s=1;
		$e=1;
		foreach($html->find('span.time')as $noscript)
		{
			if($i%2 == 0)
			{
				$match["end"][$e] = $noscript->innertext;
				$e++;
			} else {
				$match["start"][$s] = $noscript->innertext;
				$s++;
			}
			$i++;
		}

		$teamfilter = array("2.","Konferenz","Liga","liga","Draw","draw","League","league", "Ligue", "ligue", "International", "international",
				"FIFA", "fifa", "Championship", "championship", "Cup", "cup", "Qualifying", "qualifying", "Division", "division", "Supplement", 
				"Sunday", "Monday", "Magazine", "Simulcast", "Studio", "Canal", "Primera", "canal", "primera", "Abha", "abha", "Bundesliga", 
				"Special", "special", "Soccer", "soccer", "Ukrainian", "ukrainian", "Liha", "liha", "Persha", "persha", "Tournament", "tournament",
				"Series", "series", "English", "english", "Ekstraklasa", "Day", "BBC", "Equipe", "Service", "Eurogoals", "Copa ", "copa ");		
		
			
	//Match Home Team
		$i=1;
		foreach($html->find('td.home')as $noscript)
		{
			$teamhomefilter = str_replace("fav icon", "", $noscript->innertext);
			$teamhomefilter = substr($teamhomefilter, strpos($noscript->innertext, ">")+1);
			$teamhomefilter = substr($teamhomefilter, 0, strpos($teamhomefilter, "<"));
			
			if($teamhomefilter <> "")
			{
				$match["team"]["home"][$i] = $teamhomefilter;
				$i++;
			}
		}

	//Match Home Team Flag
		$i=1;
		foreach($html->find('td.home img.flag')as $noscript)
		{
			$match["team"]["home"]["flag"][$i] = $noscript->alt;
			$i++;
		}

	//Match Away Team
		$i=0;

				
		foreach($html->find('td.away')as $noscript)
		{
			$teamawayfilter = substr($noscript->innertext, strpos($noscript->innertext, ">")+1);
			$teamawayfilter = substr($teamawayfilter, 0, strpos($teamawayfilter ,"<"));
			
			
			while(strposb($match["team"]["home"][$i], $teamfilter) >= 0){
				$i++;
			}
			$match["team"]["away"][$i] = $teamawayfilter;
			$i++;
		}
		
		//Match Away Team Flag
		$i=1;
		foreach($html->find('td.away img.flag')as $noscript)
		{

			while(strposb($match["team"]["home"][$i], $teamfilter) >= 0){
				$i++;
			}
			$match["team"]["away"]["flag"][$i] = $noscript->alt;
			$i++;
		}
		
		//Match Insert to database
		for($i=1;$i<count($match["team"]["home"]);$i++)
		{
			$downloadcount = db::query("SELECT Id FROM ".$discipline."_matchs WHERE StreamID='".$match["id"][$i]."'");
			if(mysql_num_rows($downloadcount) <=0) {
				if($match["team"]["away"][$i] <> ''){
					//$insert = "INSERT INTO ".$discipline."_matchs VALUES ('','".$match["id"][$i]."', '".$match["competition"][$i]."', '".$match["date"]["day"][$i]." ".$match["date"]["month"][$i]."', '".$match["start"][$i]."', '".$match["end"][$i]."', '".$match["team"]["home"][$i]."',  '".$match["team"]["home"]["flag"][$i]."', '".$match["team"]["away"][$i]."', '".$match["team"]["away"]["flag"][$i]."', 'true');";
				} else {
					//$insert = "INSERT INTO ".$discipline."_matchs VALUES ('','".$match["id"][$i]."', '".$match["competition"][$i]."', '".$match["date"]["day"][$i]." ".$match["date"]["month"][$i]."', '".$match["start"][$i]."', '".$match["end"][$i]."', '".$match["team"]["home"][$i]."',  '".$match["team"]["home"]["flag"][$i]."', '', '', 'true');";
				}
				//echo "INSERT INTO ".$discipline."_matchs VALUES ('','".$match["id"][$i]."', '".$match["competition"][$i]."', '".$match["date"]["day"][$i]." ".$match["date"]["month"][$i]."', '".$match["start"][$i]."', '".$match["end"][$i]."', '".$match["team"]["home"][$i]."',  '".$match["team"]["home"]["flag"][$i]."', '".$match["team"]["away"][$i]."', '".$match["team"]["away"]["flag"][$i]."'</br>";
				//db::query("DELETE FROM ".$discipline_matchs." WHERE Data <");
				db::query("INSERT INTO ".$discipline."_matchs VALUES ('','".$match["id"][$i]."', '".$match["competition"][$i]."', '".$match["date"]["day"][$i]." ".$match["date"]["month"][$i]."', '".$match["start"][$i]."', '".$match["end"][$i]."', '".$match["team"]["home"][$i]."',  '".$match["team"]["home"]["flag"][$i]."', '".$match["team"]["away"][$i]."', '".$match["team"]["away"]["flag"][$i]."', 'True');");
			}
		}
	}

	static function show_matchs($discipline = 'football'){
		//$selectmatchs = db::query("SELECT * FROM (SELECT * FROM ".$discipline."_matchs ORDER BY id DESC LIMIT 82) sub ORDER BY id ASC");
		$Gdate = date('d F');
		$Gdate2 = date('d/m/Y 20:i');
		$Gdate3 = date('H:00');
		$Gdate4 = date('d F', strtotime(' -1 day'));

		/*
		if(time() > strtotime($Gdate2)){
			$selectmatchs = db::query("SELECT * FROM ".$discipline."_matchs WHERE Data='".$Gdate."' ORDER BY id ASC");
		} else {
			$selectmatchs = db::query("SELECT * FROM ".$discipline."_matchs WHERE Data='".$Gdate."' AND MatchEnd>='".$Gdate3."' ORDER BY id ASC");
		}*/
		
		db::query("UPDATE ".$discipline."_matchs SET Visible='False' WHERE Data = '".$Gdate4."' AND (`MatchStart` NOT LIKE '22%' OR `MatchStart` NOT LIKE '23%')");
		$selectmatchs = db::query("SELECT * FROM ".$discipline."_matchs WHERE Data<='".$Gdate."' AND MatchEnd>='".$Gdate3."' AND Visible='True' ORDER BY id ASC");
		$i=1;
		echo '<table class="tablesorter" style="border-collapse:collapse; text-align: center;" width=100%>';
		echo '<thead>';
		echo '<tr style="background:url(\'images/tabelka.jpg\') top center no-repeat; width:648px; color: #FFFFFF; font-style: bold; text-align: center; -webkit-border-top-left-radius: 15px;-webkit-border-top-right-radius: 15px;-moz-border-radius-topleft: 15px;-moz-border-radius-topright: 15px;border-top-left-radius: 15px;border-top-right-radius: 15px;" height=40>
				<th class="header">Turniej / Liga</th>
				<th class="header">Data</th>
				<th class="header">Godz.</th>
				<th class="header">&nbsp;&nbsp;&nbsp;</th>
				<th class="header">Gospodarz</th>
				<th></td>
				<th class="header">Go¶cie</th>
				<th class="header">&nbsp;&nbsp;&nbsp;</th>
			  </tr>';
		echo '</thead><tbody>';
		while ($row = db::fetch($selectmatchs)) 
		{
			if($i%2 == 0) {
				echo '<tr title="Kliknij aby zobaczyæ liste streamów." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#DDDDDD\'" onclick="document.location = \'index.php?act=watch&id='.$row["StreamID"].'\';" style="background-color: #DDDDDD;">'; //#FAFAFA;
			} else {
				echo '<tr title="Kliknij aby zobaczyæ liste streamów." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#FFFFFF\'" onclick="document.location = \'index.php?act=watch&id='.$row["StreamID"].'\';" style="background-color: #FFFFFF;">';
			}
			$Flag["Home"] = '<img src="images/flags/'.$row["TeamHomeFlag"].'.gif">';
			$Flag["Away"] = '<img src="images/flags/'.$row["TeamAwayFlag"].'.gif" align=center>';			
			if($row["TeamAway"] <> ''){
				echo '<td>'.$row["Competition"].'</td><td>'.TranslateDate($row["Data"]).' </td><td>'.$row["MatchStart"].'</td><td>'.$Flag["Home"].'</td><td>'.$row["TeamHome"].'</td><td>vs.</td><td>'.$row["TeamAway"].'</td><td>'.$Flag["Away"].'</td>';
			} else {
				echo '<td>'.$row["Competition"].'</td><td>'.TranslateDate($row["Data"]).'</td><td>'.$row["MatchStart"].'</td><td>'.$Flag["Home"].'</td><td colspan=4>'.$row["TeamHome"].'</td>';			
			}
			echo '</tr>';
			$i++;
		}
		//echo '<tr style="background-color: #000000;"><td colspan=7>&nbsp; </td></tr>';
		echo '</tbody></table>';
	}
}

class Wiziwig_Streams {
	
	public function CheckStreamID($id, $discipline = "football"){
		$checkID = db::query("SELECT StreamID FROM ".$discipline."_matchs WHERE StreamID='".$id."'");
		if(mysql_num_rows($checkID)>0){
			return true;
		} else {
			return false;
		}
	}

	public function GetDateStream($id, $discipline = "football"){
	
		$time = db::query("SELECT Competition, Data, MatchStart, MatchEnd FROM ".$discipline."_matchs WHERE StreamID='".$id."'");
		$Info2 = db::fetch($time);
		
		$czas     = $Info2['MatchStart'];
		$DayMonth = $Info2['Data'];
		$czasend = $Info2['MatchEnd'];
		$Competition = $Info2['Competition'];
		
		$Day["End2"] = strpos($DayMonth, ' ', 1);
		
		$match["date"]["day"]   = substr($DayMonth,0,$Day["End2"]);
		$match["date"]["month"] = substr($DayMonth, $Day["End2"]+1, strlen($DayMonth));	
		$match["date"]["month"] = MonthInt($match["date"]["month"]);
		
		$month = Date("n");
		
		
		if($match["date"]["month"] == 12){
			if($month > $match["date"]["month"]){
				$year = date("Y")+1;
			} else {
				$year = date("Y");
			}
		} else {
			$year = date("Y");
		}
		if($match["date"]["month"] < 10){
			$match["date"]["month"] = '0'.$match["date"]["month"];
		}
		if($match["date"]["day"] < 10){
			$match["date"]["day"] = '0'.$match["date"]["day"];
		}		
		
		$czas2["h"] = substr($czas,0,2)-1;
		$czas2["m"] = substr($czas ,-2)+8;
		
		$MatchEnd["h"] = substr($czasend,0,2);
		$MatchEnd["m"] = substr($czasend ,-2);
		
		
		
		$date = $year.'-'.$match["date"]["month"].'-'.$match["date"]["day"].' '.$czas2["h"].':'.$czas2["m"].':00';
		$exp_date = strtotime($date);
		$now = time();
		
		echo "<center><span class='st_facebook_hcount' displayText='Facebook'><span class='st_googleplus_hcount' displayText='Google +'></span></span><span class='st_twitter_hcount' displayText='Tweet'></span></center>";
		if($now < $exp_date) {
			
			echo '<script>
					var server_end = '.$exp_date.' * 1000;
					var server_now = '.$now.' * 1000;
					var client_now = new Date().getTime();
					var end = server_end - server_now + client_now; // this is the real end time

					var _second = 1000;
					var _minute = _second * 60;
					var _hour = _minute * 60;
					var _day = _hour *24
					var timer;
					function showRemaining(){
						var now = new Date();
						var distance = end - now;
						if (distance < 0 ) {
							clearInterval( timer );
							document.getElementById("countdown").innerHTML = "<meta http-equiv=Refresh content=1>";
							window.location.reload(true);
							return;
						}
						var days = Math.floor(distance / _day);
						var hours = Math.floor( (distance % _day ) / _hour );
						var minutes = Math.floor( (distance % _hour) / _minute );
						var seconds = Math.floor( (distance % _minute) / _second );

						var countdown = document.getElementById("countdown");
						countdown.innerHTML = "";
						if (days >=1) {
							countdown.innerHTML += days + " dzieñ ";
						}
						
						countdown.innerHTML +=  hours+ "h ";
						countdown.innerHTML += minutes+ "m ";
						countdown.innerHTML += seconds+ "s<br />";
					}						
					timer = setInterval(showRemaining, 1000);
				</script>';
				$InfoQuery2 = db::query("SELECT TeamHome, TeamHomeFlag, TeamAway, TeamAwayFlag, Data, MatchStart FROM ".$discipline."_matchs WHERE StreamID='".$id."'");
				$Info2 = db::fetch($InfoQuery2);

				if($Info2["TeamAway"] <> ''){
					echo '<center><table style="margin-top: 15px; margin-bottom: 10px; background-color: #ececec; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; border: 1px solid black;" width=80%>
							<tr align=center>
								<td colspan=6 style="font-size: 160%; font-style: bold; color: blue;">'.$Competition.'</td>
							</tr>
							<tr>
								<td style="font-size: 160%;"><img src="images/flags/'.$Info2["TeamHomeFlag"].'.gif" height="20" width="25"></td><td style="font-size: 160%;">'.$Info2["TeamHome"].'</td>
								<td colspan=2 style="font-size: 140%;" width=15%> vs. </td>
								<td style="font-size: 160%;"><img src="images/flags/'.$Info2["TeamAwayFlag"].'.gif" height="20" width="25"></td><td style="font-size: 160%;">'.$Info2["TeamAway"].'</td>
							</tr>
							</table></center>';
				} else {
					echo '<center><table style="margin-top: 15px; margin-bottom: 10px; background-color: #ececec; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; border: 1px solid black;" width=80%>
						<tr align=center>
								<td style="font-size: 160%; font-style: bold; color: blue;">'.$Competition.'</td>
						</tr>					
						<tr align=center>		
							<td style="font-size: 160%;"><center><img src="images/flags/'.$Info2["TeamHomeFlag"].'.gif" height="20" width="25"></center>'.$Info2["TeamHome"].'</td>	
						</tr>
						</table></center>';				 
				}
				
				echo '<p align="center" style="font-weight: bold; color: red; font-size: 20px; margin-top: 20px;">Linki do meczu bêd± dostêpne za</p>';
				
				echo '<center><div id="countdown" style="font-size: 20px;"></div></center>';				
		} else {
		
			
			$this->getStreamInfo($id);
			$selectStream = db::query("SELECT Name, Type, Link, Quality, Raiting FROM ".$discipline."_streams WHERE StreamID='".$id."'");
			if(mysql_num_rows($selectStream)>0){
				echo '<table class="tablesorter" style="border-collapse:collapse; text-align: center;" width=100%>';
				echo '<thead>';
				echo '<tr style="background:url(\'images/tabelka.jpg\') top center no-repeat; width:648px; color: #FFFFFF; font-style: bold; text-align: center; -webkit-border-top-left-radius: 15px;-webkit-border-top-right-radius: 15px;-moz-border-radius-topleft: 15px;-moz-border-radius-topright: 15px;border-top-left-radius: 15px;border-top-right-radius: 15px;" height=40>
						<th class="header">Nazwa</th>
						<th class="header">Typ</th>
						<th class="header">Jako¶æ</th>
						<th class="header" width=100 align=left>Ocena</th>
					</tr>';
				echo '</thead><tbody>';
				$i=1;
				while ($streamRow = db::fetch($selectStream)) {

					if($i%2 == 0) {
						echo '<tr title="Kliknij aby obejrzeæ stream." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#DDDDDD\'" onclick="document.location = \''.$streamRow["Link"].'\';" style="background-color: #DDDDDD;">'; //#FAFAFA;
					} else {
						echo '<tr title="Kliknij aby obejrzeæ stream." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#FFFFFF\'" onclick="document.location = \''.$streamRow["Link"].'\';" style="background-color: #FFFFFF;">';
					}

					echo '
							<td>'.$streamRow["Name"].'</td>
							<td>'.$streamRow["Type"].'</td>
							<td>'.$streamRow["Quality"].'</td>
							<td width=70>'.ocena($streamRow["Raiting"]).'</td>
					</tr>';
					$i++;
				}
		
				echo '</table>';		
			} else {	
				
				$date2 = $year.'-'.$match["date"]["month"].'-'.$match["date"]["day"].' '.$MatchEnd["h"].':'.$MatchEnd["m"].':00';
				$exp_date2 = strtotime($date2);	
				$now = time();
				
				if($now > $exp_date2){
					echo '<p align="center" style="font-weight: bold; color: red; font-size: 20px; margin-top: 20px;">Mecz ju¿ siê skoñczy³ za chwile nast±pi przekierowanie na strone g³ówna.</p>';
					echo '<meta http-equiv="Refresh" content="3; url=index.php">';
				} else {
					$this->download_streams($id);
					echo '<meta http-equiv="Refresh" content="0">';
					echo 'abc';
				}
					//$Stream->download_streams($id);
					//echo '<meta http-equiv="Refresh" content="0">';	
					
			}
	
		}
	}
	public function getTeams($id,  $discipline = "football"){
		$Query = db::query("SELECT TeamHome, TeamAway FROM ".$discipline."_matchs WHERE StreamID='".$id."'");
		$GetQuery = db::fetch($Query);
		
		return $GetQuery['TeamHome'].' vs. '.$GetQuery["TeamAway"];
	}
	public function getStreamInfo($id, $discipline = "football"){
		$InfoQuery = db::query("SELECT Competition, TeamHome, TeamHomeFlag, TeamAway, TeamAwayFlag, Data, MatchStart FROM ".$discipline."_matchs WHERE StreamID='".$id."'");
		$Info3 = db::fetch($InfoQuery);
		
		$Day["end"] = strpos($Info3['Data'], ' ',1);
		
		$match["date"]["day"]   = substr($Info3['Data'],0,$Day["end"]);
		$match["date"]["month"] = substr($Info3['Data'], $Day["end"]+1, strlen($Info3['Data']));	
		$match["date"]["month"] = MonthInt($match["date"]["month"]);		
		
		$czas2["h3"] = substr($Info3['MatchStart'],0,2);
		$czas2["m3"] = substr($Info3['MatchStart'] ,-2);
		
		if($match["date"]["month"] == 12){
			if($month > $match["date"]["month"]){
				$year = date("Y")+1;
			} else {
				$year = date("Y");
			}
		} else {
			$year = date("Y");
		}
		
		if($match["date"]["month"] < 10){
			$match["date"]["month"] = '0'.$match["date"]["month"];
		}
		if($match["date"]["day"] < 10){
			$match["date"]["day"] = '0'.$match["date"]["day"];
		}
		
		$Date3 = $year.'-'.$match["date"]["month"].'-'.$match["date"]["day"].' '.$czas2["h3"].':'.$czas2["m3"].':00';
		$exp_date3 = strtotime($Date3);
		

		$now = time();
		
		//Match stars in
		
		if($now < $exp_date3) {
			
			echo '<script>
					var server_end = '.$exp_date3.' * 1000;
					var server_now = '.$now.' * 1000;
					var client_now = new Date().getTime();
					var end = server_end - server_now + client_now; // this is the real end time

					var _second = 1000;
					var _minute = _second * 60;
					var _hour = _minute * 60;
					var _day = _hour *24
					var timer;
					function showRemaining(){
						var now = new Date();
						var distance = end - now;
						if (distance < 0 ) {
							clearInterval( timer );
							document.getElementById("countdownt").style.display = "none";
							document.getElementById("countdown").style.display = "none";
							return;
						}
						var days = Math.floor(distance / _day);
						var hours = Math.floor( (distance % _day ) / _hour );
						var minutes = Math.floor( (distance % _hour) / _minute );
						var seconds = Math.floor( (distance % _minute) / _second );

						var countdown = document.getElementById("countdown");
						countdown.innerHTML = "";
						if (days >=1) {
							countdown.innerHTML += days + " dzieñ ";
						}
						
						countdown.innerHTML +=  hours+ "h ";
						countdown.innerHTML += minutes+ "m ";
						countdown.innerHTML += seconds+ "s<br />";
					}						
					timer = setInterval(showRemaining, 1000);
				</script>';
				
				echo '<div align="center" style="font-weight: bold; color: red; font-size: 20px; margin-top: 20px;" id="countdownt">Mecz rozpocznie siê za</div>';
				
				echo '<center><div id="countdown" style="font-size: 20px; margin-bottom: 5px;"></div></center>';	
		}
		if($Info3["TeamAway"] <> ''){
			echo '<center><table style="margin-top: 15px; margin-bottom: 10px; background-color: #ececec; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; border: 1px solid black;" width=80%>
				 <tr align=center>
					<td colspan=6 style="font-size: 160%; font-style: bold; color: blue;">'.$Info3['Competition'].'</td>
				</tr>			     
				 <tr style="margin-left: 10px;">
					<td style="font-size: 160%;" align=left><img src="images/flags/'.$Info3["TeamHomeFlag"].'.gif" height="20" width="25"></td><td style="font-size: 160%;" align=left>'.$Info3["TeamHome"].'</td>
			  		<td colspan=2 algin=center style="font-size: 140%;" width=15%> vs. </td>
						   <td style="font-size: 160%;"><img src="images/flags/'.$Info3["TeamAwayFlag"].'.gif" height="20" width="25"></td><td style="font-size: 160%;">'.$Info3["TeamAway"].'</td>
				</tr>
				</table></center>';
		} else {
			echo '<center><table style="margin-top: 15px; margin-bottom: 10px; background-color: #ececec; -webkit-border-radius: 8px; -moz-border-radius: 8px; border-radius: 8px; border: 1px solid black;" width=80%>
				 <tr align=center>
					<td style="font-size: 160%; font-style: bold; color: blue;">'.$Info3['Competition'].'</td>
				</tr>				     
				 <tr align=center>		
					<td style="font-size: 160%;"><center><img src="images/flags/'.$Info3["TeamHomeFlag"].'.gif" height="20" width="25"></center>'.$Info3["TeamHome"].'</td>	
				 </tr>
				</table></center>';				 
		}
	}
	static function download_streams($id, $discipline = "football"){
		$url = "http://www.wiziwig.tv/broadcast.php?matchid=".$id."&part=sports";
		$html = file_get_html($url);
	/*
	//Stream Logo
		$i=1;
		foreach($html->find('td.logo')as $noscript)
		{
			if($noscript->innertext <> "")
			{
				$stream["logo"][$i] = $noscript->innertext;
				$i++;
			}
		}
	*/
	//Stream Name
		$i=1;
		foreach($html->find('td.stationname')as $noscript)
		{
			if($noscript->innertext <> "")
			{
				$stream["name"][$i] = $noscript->innertext;
				$i++;
			}
		}

	//Stream Link
		$i=1;
		$b=0;
		$DeleteItems = array();
		foreach($html->find('a[class="broadcast go"]')as $noscript)
		{
			$filter = array("wiziwig.eu", "wiziwig", "forum");
			if(strposb($noscript->href, $filter) >= 0){
				$b++;
				$DeleteItems[$b] = $i;
			} else {
				if($noscript->href <> "")
				{
					$link = $noscript->href;
					$getPlayerID = db::query("SELECT PlayerID FROM player WHERE Link='".$link."'");
					if(mysql_num_rows($getPlayerID)<=0) {
						$stream["link"][$i] = $noscript->href;
					} else {
						$newlink = db::fetch($getPlayerID);
						$stream["link"][$i] = "http://streams4u.pl/index.php?act=player&id=".$newlink["PlayerID"];
					}
					$i++;
				}
			}
		}		
		
	//Stream Type
		$i=1;
		foreach($html->find('tr[class="streamrow even"] td, tr[class="streamrow odd"] td')as $noscript)
		{
			if($noscript->innertext <> "")
			{
					$StreamTypeFilter =  array("Flash","flash","Sopcast","sopcast", "TorrentStream", "torrentstream", "Torrentstream", "AceStream", "StreamTorrent");
					if(strposb(strip_tags($noscript->innertext), $StreamTypeFilter) >=0)
					{
						$Filter = str_replace(" ", "", $noscript->innertext);
						$stream["type"][$i] = $Filter;
						$i++;
					}
			}	
		}

	//Stream Quality
		$i=1;
		foreach($html->find('tr[class="streamrow even"] td, tr[class="streamrow odd"] td')as $noscript)
		{
			$StreamQualityFilter =  array(" Kbps", " kbps");
			if(strposa($noscript->innertext, $StreamQualityFilter,1) >0)
			{
				$stream["quality"][$i] = $noscript->innertext;
				$i++;
			}

		}

	//Stream Raitng
		$i=1;
		foreach($html->find('tr[class="streamrow even"] div.rating, tr[class="streamrow odd"] div.rating')as $noscript)
		{
			if($noscript->rel <> '')
			{
				$stream["raiting"][$i] = $noscript->rel;
				$i++;
			}
		}
		foreach ($DeleteItems as $DelID) {
			unset($stream["type"][$DelID]);
			unset($stream["quality"][$DelID]);
			unset($stream["type"][$DelID]);
			unset($stream["raiting"][$DelID]);
		}		
		//Stream Insert to database
		$d=0;
		while(empty($stream["type"][$d]) === true){
			$d++;
		}		
		for($i=1;$i<count($stream["name"])+1;$i++)
		{
				$insert = "INSERT INTO ".$discipline."_streams VALUES ('".db::fieldFilter($id)."', '".$stream["name"][$i]."', '".$stream["type"][$d]."', '".$stream["link"][$i]."', '".$stream["quality"][$d]."', '".$stream["raiting"][$d]."');";
				db::query($insert);
				$d++;
		}	
	}  
	
	
	public function showStreams($id, $discipline = "football"){
	
		echo $this->GetDateStream(db::fieldFilter($_GET["id"]));
		
	}
 
}

?>