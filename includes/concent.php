<?php	switch ((isset($_GET['act']) ? $_GET['act'] : '')) {		default:				$matchs->show_matchs("football");		break;		case "register":			if(isset($_GET['do']) && $_GET['do'] == 'send'){				$register->reg($register->fieldFilter($_POST["login"]),$register->fieldFilter($_POST["pass"]),$register->fieldFilter($_POST["repass"]),$register->fieldFilter($_POST["email"]),$register->fieldFilter($_POST["fbid"]));			} else {				include("includes/register.php");			}		break;		case "login":			include("includes/login.php");		break;		case "watch":			if($_GET['id'] <> ''){				if($Stream->CheckStreamID(db::fieldFilter($_GET["id"]), "football") === true){					echo $Stream->showStreams(db::fieldFilter($_GET["id"]));									} else {					echo '<p align=center><font size=2 color=red>Stream o takim ID nie istnieje!</font></p>';				}			} else {				header("Location: index.php");			}		break;		case "fbregister":			include("includes/register_fb.php");		break;		case "logout":			session_destroy();			header("Location: index.php");		break;		case "football":			$matchs->show_matchs("football");				break;		case "download_w":			switch($_GET['do']){				case "football_1":					$matchs->download_matchs("football");					$matchs->download_matchs("football", 2);					echo 'Streamy pobrane.';				break;				default:					header("Location: index.php");				break;			}		break;		case "adm":			switch($_GET['do']){				case "download_h":					$Highlights->Download_Highlights_List();					echo 'Skr�ty mecz�w pobrane.';				break;				default:					header("Location: index.php");				break;			}		break;				case "player":			include("includes/player.php");		break;		case "highlights":			$Highlights->Show_Highlights_List();		break;		case "highlightwatch":			if($_GET['id'] <> ''){						Eurorivals::Download_Hightlights_Video(db::fieldFilter($_GET['id']));			} else {				header("Location: index.php");			}		break;				case "stats":			echo '<p align=center style="font-weight:bold; color:red"><font size=4>Ta funkcja jest jeszcze niedost�pna! Zapraszamy wkr�tce :)</font></p>';		break;			case "other":			echo '<p align=center style="font-weight:bold; color:red"><font size=4>Ta funkcja jest jeszcze niedost�pna! Zapraszamy wkr�tce :)</font></p>';		break;		case "scores":			//include("includes/scores.php");			echo '<iframe class="iframe" scrolling="no" style="width:575px; height:2210px; border:none;" src="http://www.livexscores.com/free.php?p=0&sport=&style=xfff,x006699,x000,xaaa,xc00,x006699,xfff,xddd,xc00,verdana,11,xeee,xfff,x000,468,xc00&timezone="></iframe>';		break;		case "test":			$Highlights->Download_Highlights_List();		break;		case "banned":			echo '<p align=center style="font-weight:bold; color:red"><font size=4>Jeste� zbanowany. :)</font></p>';		break;		case "profile":			if(isset($_GET['user'])){				echo '<p align=center style="font-weight:bold; color:red"><font size=4>Ta funkcja jest jeszcze niedost�pna! Zapraszamy wkr�tce :)</font></p>';			}		break;		case "test2":			$LiveTvRu->Download_Match_Link();			echo 'test';		break;			}?>