<?php

class LiveTvRu {

	public function Download_Match_Link()
	{
		
		//$url = "http://cdn.livetvstatic.ru/rss/upcoming_en.xml";
		//$html = file_get_html($url);
		$xml=simplexml_load_file("http://cdn.livetvstatic.ru/rss/upcoming_en.xml");
		
		$mecz = array();
		//echo '<pre>', print_r($xml), '</pre>';
		$i=1;
		foreach ($xml->channel->item as $foo) 
		{
			if(strpos($foo->description, 'Football') >0){
				$mecz[$i]["title"] = $foo->title;
				$mecz[$i]["link"]  = $foo->link;
				$mecz[$i]["desc"]  = $foo->description;
				$mecz[$i]["data"]  = $foo->pubDate;
				$i++;
			}
		}
		echo '<pre>', print_r($mecz), '</pre>';
		
		/*
		$xml=simplexml_load_file("https://www.bet-at-home.com/en/feed/sport");
		
		$mecz = array();
		$i=1;
		
		foreach ($xml->OddsObject as $foo){
			if($foo->Sport == "Football"){
				$mecz[$i]["Sport"] = $foo->Sport;
				$mecz[$i]["Country"] = $foo->Category;
				$mecz[$i]["Tournament"] = $foo->Tournament;
				$mecz[$i]["Date"] = substr($foo->Date, 0, -9);
				$mecz[$i]["Time"] = substr($foo->Date, 11);
				$mecz[$i]["HomeTeam"] = $foo->OddsData->HomeTeam;
				$mecz[$i]["AwayTeam"] = $foo->OddsData->AwayTeam;
				
				$downloadcount = db::query("SELECT Liga FROM football_fixtures WHERE Data='".$mecz[$i]["Date"]."' AND Time='".$mecz[$i]["Time"]."' AND HomeTeam='".$mecz[$i]["HomeTeam"]."' AND AwayTeam='".$mecz[$i]["AwayTeam"]."'");
				if(mysql_num_rows($downloadcount) <=0) {
					db::query("INSERT INTO football_fixtures VALUES('".$i."','".$mecz[$i]["Country"]."','".$mecz[$i]["Tournament"]."','".$mecz[$i]["Date"]."','".$mecz[$i]["Time"]."','".$mecz[$i]["HomeTeam"]."','".$mecz[$i]["AwayTeam"]."');");
				}
				$i++;
			}
		}*/
		//echo '<pre>', print_r($mecz), '</pre>';
	}

}
?>