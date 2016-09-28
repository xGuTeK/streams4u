<?php
	if(empty($_GET['id']) === false){
		$getPlayer = db::query("SELECT PlayerLink, Typ FROM player WHERE PlayerID='".db::fieldFilter($_GET["id"])."'");
		if(mysql_num_rows($getPlayer)>0){
			$row = db::fetch($getPlayer);
			$playerlink = $row["PlayerLink"];
			$typ = $row["Typ"];
			
			if($typ == 0){
				echo '<center><iframe src="'.$playerlink.'" width=640 height=480 scrolling=no frameborder=0 scrolling=no allowtransparency=true ></iframe></center>';
			} elseif($typ == 2) {
				echo '<center><script type="text/javascript"> fid="max2a63"; v_width="640"; v_height="480";</script>
						<script type="text/javascript" src="http://veemi.com/javascript/embedPlayer.js"></script></center>';
			} elseif($typ == 3) {
				echo '<center><embed type="application/x-shockwave-flash" src="http://www.onstream.in/player/player.swf" style="undefined" id="mpl" name="mpl" quality="high" allowfullscreen="true" allowscriptaccess="always" wmode="opaque" flashvars="autostart=true&amp;mute=false&amp;stretching=exactfit&amp;repeat=always&amp;skin=player/skin/skin.xml&amp;logo.hide=false&amp;logo.position=top-right&amp;logo.link=http://www.reyhq.com/video.php?live=poiqwpodjas&amp;abouttext=Rey HQ Player&amp;aboutlink=http://www.reyhq.com&amp;file=poiqwpodjas.flv&amp;streamer=rtmp://cdn.reyhq.com/redirect" width="640" height="480"></center>';
			} elseif($typ == 4) {
				echo '<center><embed type="application/x-shockwave-flash" src="http://www.onstream.in/player/player.swf" id="ply" name="ply" quality="high" allowfullscreen="true" allowscriptaccess="always" wmode="opaque" flashvars="controlbar=bottom&amp;screencolor=000000&amp;file=2W9XAcBsfJb1ZAGgo2oc&amp;streamer=rtmpe://live.onstream.in:443/app&amp;autostart=true&amp;provider=rtmp&amp;rtmp.fallback=false&amp;rtmp.tunneling=false&amp;logo.hide=false&amp;logo.position=top-right&amp;logo.link=&amp;logo.file=/images/small_logo.png&amp;abouttext=ONSTREAM.IN&amp;aboutlink=http://www.onstream.in&amp;token=CPCTOKENCHANOIMAY#ed%h0#w@1&amp;skin=/player/Snel.swf" width="640" height="480"></center>';
			}
		} else {
			header("Location: index.php");
		}
	} else {
		header("Location: index.php");
	}

?>



