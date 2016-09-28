<?php

class Eurorivals {


	static function Download_Highlights_List(){
		
		$url = "http://eurorivals.net/football-highlights/1.html";
		$html = file_get_html($url);
		
		foreach($html->find('a.tiptip')as $noscript)
		{
			if(strpos($noscript->href, '.html') <= 0){
				$Pagelink = $noscript->href;
				
				$Data = substr($noscript->href, -10); 
				$Title = substr($noscript->innertext, 0, strpos($noscript->innertext, '<span'));
				
				$check = db::query("SELECT id FROM football_highlights WHERE url='".$Pagelink."'");
				if(mysql_num_rows($check) <=0){
					db::query("INSERT INTO football_highlights VALUES('', '".$Data."', '".$Title."', '".$Pagelink."')");
				}
			}
		}
	}
	
	public function Show_Highlights_List(){
		echo '<table class="tablesorter" style="border-collapse:collapse; text-align: center;" width=100%>';
		echo '<thead>';
		echo '<tr style="background:url(\'images/tabelka.jpg\') top center no-repeat; width:648px; color: #FFFFFF; font-style: bold; text-align: center; -webkit-border-top-left-radius: 15px;-webkit-border-top-right-radius: 15px;-moz-border-radius-topleft: 15px;-moz-border-radius-topright: 15px;border-top-left-radius: 15px;border-top-right-radius: 15px;" height=40>
				<th class="header">Data</th>
				<!-- <th class="header">Turniej / Liga</th> --!>
				<th class="header">Powtórka</th>
			  </tr>';
		echo '</thead><tbody>';	

		//$selecthighligts = db::query("SELECT * FROM (SELECT * FROM football_highlights ORDER BY id DESC LIMIT 40) sub ORDER BY id ASC");
		
		$i=0;
		/*
		while ($row = db::fetch($selecthighligts)) 
		{
			if($i%2 == 0) {
				echo '<tr title="Kliknij aby obejrzeæ powtórke." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#DDDDDD\'" onclick="document.location = \'index.php?act=highlightwatch&id='.$row["id"].'\';" style="background-color: #DDDDDD; font-size:125%">'; //#FAFAFA;
			} else {
				echo '<tr title="Kliknij aby obejrzeæ powtórke." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#FFFFFF\'" onclick="document.location = \'index.php?act=highlightwatch&id='.$row["id"].'\';" style="background-color: #FFFFFF; font-size:125%">';
			}		
			echo '<td>'.$row["data"].'</td><td>'.$row["teams"].'</td>';

			echo '</tr>';
			$i++;
		}
		echo '</tbody></table>'; */

		$countData = db::query("SELECT id FROM football_highlights");
		$fetchData = db::fetch($countData);
		
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$results = 40;
		
		$pages = ceil(mysql_num_rows($countData)/$results)-1;
		
		$next = $page + 1;
        $back = $page - 1;	

		
		$start = mysql_num_rows($countData) - $page*$results;
		
		
		$getData = db::query("SELECT * FROM football_highlights LIMIT ".$start.", ".$results);
		
		
		while($row = db::fetch($getData)){
			if($i%2 == 0) {
				echo '<tr title="Kliknij aby obejrzeæ powtórke." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#DDDDDD\'" onclick="document.location = \'index.php?act=highlightwatch&id='.$row["id"].'\';" style="background-color: #DDDDDD; font-size:125%">'; //#FAFAFA;
			} else {
				echo '<tr title="Kliknij aby obejrzeæ powtórke." onMouseOver="this.style.background=\'#00CC33\'" onMouseOut="this.style.background=\'#FFFFFF\'" onclick="document.location = \'index.php?act=highlightwatch&id='.$row["id"].'\';" style="background-color: #FFFFFF; font-size:125%">';
			}		
			echo '<td>'.$row["data"].'</td><td>'.$row["teams"].'</td>';

			echo '</tr>';
			$i++;		
		}
		echo '</tbody></table>';
		echo '<br><br><center>';
		if($page > 1) {
			echo '<a href="index.php?act=highlights&page=' . $back . '"><b>Poprzednia</b></a>';
		}
		if($page == 1){
			echo ' Strona '.$_GET['page'].' | ';
		} else if((isset($_GET['page']) && $page>1) and ( $page<$pages)){
			echo ' | Strona '.$_GET['page'].' | ';
		} else if($page == $pages){
			echo ' | Strona '.$_GET['page'].' ';
		} else if($page > $pages){
			header("Location: index.php?act=highlights&page=1");
		}
		if($page < $pages) {
			echo '<a href="index.php?act=highlights&page=' . $next . '"><b>Nastêpna</b></a>';
		}
		echo '</center>';
		
	}
	
	public function Download_Hightlights_Video($id){
		$checkHighlight = db::query("SELECT Link FROM football_highlights_videos WHERE id='".$id."'");
		
		if(mysql_num_rows($checkHighlight) <=0) {
			$checkHighlight2 = db::query("SELECT url FROM football_highlights WHERE id='".$id."'");
			$row = db::fetch($checkHighlight2);
			
			$url = $row["url"];
			
			$url2 = "http://eurorivals.net/".$url;
			$html = file_get_html($url2);
		
			// Video Link
			foreach($html->find('div.singlevideo iframe')as $noscript)
			{
				db::query("INSERT INTO football_highlights_videos VALUES('".$id."','".$noscript->src."', 'test')");
			}	
			echo '<meta http-equiv="Refresh" content="0">';
		} else {
			Eurorivals::Show_Highlights_Video($id);
		}
	}
	public function Show_Highlights_Video($id){
			$Hightlight = db::query("SELECT Link FROM football_highlights_videos WHERE id='".$id."'");
			$checkHighlight3 = db::query("SELECT teams FROM football_highlights WHERE id='".$id."'");
			$row2 = db::fetch($checkHighlight3);
			
			
			echo '<center>';
			echo '<h2 style="color: green;">'.$row2["teams"].'</h2>';
			while ($row = db::fetch($Hightlight)) {
				echo '<iframe src="'.$row["Link"].'" scrolling="no" width="480" height="320" style="border:none;">Twoja przegl±…darka nie obs³uguje ramek p³ywaj±cych!</iframe><br>';
			}
			echo '<div class="fb-comments" data-href="http://127.0.0.1/" data-width="480"></div>';
			
			echo '</center>';	
	}
	
}

?>