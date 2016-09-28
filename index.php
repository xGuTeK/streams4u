<?php
session_start(); 
session_regenerate_id(true);
require("config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3c.org/1999/xhtml" xml:lang="pl" lang="pl">
<meta name="keywords" content="streamy, piłka, pilka, nożna, nozna, mecze na żwywo, mecze na zywo, darmo, mecz">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />

	<title>
	<?php
	//if($_GET["watch"] <> '' && $_GET["id"] <> ''){
	if(isset($_GET["watch"]) && isset($_GET["id"])){
		if(isset($_GET["act"])){
			title($_GET["act"]);
		} else {
			title();
		}
	} else {
		if(isset($_GET["act"])){	
			title($_GET["act"],"gfdgdfgd");
		}
	}
	?></title>


<link href="css/stylesheet.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>
<script type="text/javascript" src="js/__jquery.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js" defer="defer">
<script type="text/javascript" id="js">
$(document).ready(function() {
	$("table").tablesorter();
	$("#trigger-link").click(function() {
		// set sorting column and direction, this will sort on the first and third column the column index starts at zero
		var sorting = [[0,0],[2,0]];
		// sort on the first column
		$("table").trigger("sorton",[sorting]);
		// return false to stop default link action
		return false;
	});
});
</script>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "fbc89943-4786-4fc5-8e54-7aab4c26e96c", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=637419776271896";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="topimg">
  <div id="maincontent">
    <div id="header" class="clearfix">
      <div id="Logo">
        <h1><a href="index.php"></a></h1>
      </div>
      <div id="selSubHeader" class="clsFloatRight">
        <ul class="clsClearFixSub">
<?php 
	if(empty($_SESSION['login']) === true){ 

		if(isset($_GET["act"]) && $_GET['act'] == 'register'){
			echo '<li class="clsActive"><a href="index.php?act=register">Rejestracja</a></li>';
		} else {
			echo '<li><a href="index.php?act=register">Rejestracja</a></li></li>';
		}
	}
	if(isset($_GET['act']) && $_GET['act'] == 'football' or !isset($_GET['act'])){
		echo '<li class="clsActive"><a href="index.php?act=football">Piłka nożna</a></li>';
	} else {
			echo '<li><a href="index.php?act=football">Piłka nożna</a></li>';
	} 
	if(isset($_GET["act"]) && $_GET['act'] == 'scores'){
		echo '<li class="clsActive"><a href="index.php?act=scores">Wyniki</a></li>';
	} else {
		echo '<li><a href="index.php?act=scores">Wyniki</a></li>';
	}
	if(isset($_GET["act"]) && $_GET['act'] == 'highlights'){
		echo '<li class="clsActive"><a href="index.php?act=highlights">Skróty meczów</a></li>';
	} else {
		echo '<li><a href="index.php?act=highlights">Skróty meczów</a></li>';
	}
	if(isset($_GET["act"]) && $_GET['act'] == 'other'){
		echo '<li class="clsActive"><a href="index.php?act=other">Inne streamy</a></li>';
	} else {
		echo '<li><a href="index.php?act=other">Inne streamy</a></li>';
	}	
?>
        </ul>
      </div>
    </div>
      <div id="cbox">
        <div id="right" class="clearfix">
          <div id="news">
            <!--<h2>Piłka nożna - streamy</h2> -->
            <div id="news_c"> 
				<?php include("includes/concent.php"); ?>
				
				<br />
			</div>
          </div>

        </div>
		<div id="left" class="clsFloatLeft">	
<?php 
	if(empty($_SESSION['login']) === true){ 
?>	
        
		  <div class="logowanie">
            <h2>Logowanie</h2>
            <div class="time_box">
				<form enctype="application/x-www-form-urlencoded" method="post" action="index.php?act=login">
					Login:<br /><input type="text" name="login" />
					<br />
					Hasło: <br /><input type="password" name="pass" />
					<br />
					<input type="submit" value="Zaloguj" />
					<a href="<?php echo $loginUrl;?>" class="facebook_login" style=""><img src="images/f.png"></a>
					<br />
					<a href="index.php?act=passwordreset" style="font-weight:bold;">Nie pamiętasz hasła?</a>
				</form>				
            </div>
		</div>	
<?php
	} else {
	}

?>		
		<?php include("includes/chat_show.php"); ?>
		 <div class="fblike">
            <div class="time_box">
				<center><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FStreams4u&amp;send=false&amp;layout=standard&amp;width=300&amp;show_faces=true&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=80&amp;appId=637419776271896" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:80px;" allowTransparency="true"></iframe></center>
            </div>
		</div>				
        </div>
        <div class="clearboth"></div>
      </div>
    </div>
    <div id="footer"> 
		<div class="txtf">
			<!-- Google ads-->
			<!-- Google ads-->
			
			<p style="font-weight:bold; background-color: #000000; color: #FFA500;"> &copy; Streams4u.pl by GuTeK 2013 Wersja: 0.2b.  Wszystkie prawa zastrzezone.<br>
			<?php  
				$end = gen_www();
				$run = $end - $start;
				echo goscieOnline()." | ".db::queriescounter()." | <font color=white>Strona wygenerowana w</font> <font color=yellow>" . substr($run, 0, 5) . " sec.</font>";			
			?></p>
		</div>
	</div>
	
  </div>
</div>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40083936-1']);
  _gaq.push(['_setDomainName', 'streams4u.pl']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script src="js/whcookies.js" type="text/javascript"></script>
</body>
</html>
