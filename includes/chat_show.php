          <div class="left_header">
            <h2>Czat</h2>
			
			<p align=center> 
			<div style="-webkit-border-radius: 10px; border-radius: 10px; background-color: #33FF66; width: 90%;  margin: 0 auto 0 auto; text-align: center;">
			<?php 
				if(empty($_SESSION['login']) === false){
					echo '<font size=3>Witaj <font color=red><b>'.$_SESSION['login'].'</font></font> [<a href="index.php?act=logout">Wyloguj</a>]</b><br><br>';
					
					if(isset($_SESSION['Type']) && $_SESSION['Type'] <> '255') { // User
						echo '<center>';
					//	echo '<font size=3 color=green><b>U¿ytkownik</b></font><br>';
						echo '<a href="index.php?act=user&do=editprofile"><b>[Edytuj profil]</b></a><br>';
						echo '<hr>';
						echo '<a href="index.php?act=user&do=mystreamlist"><b>[Moja lista streamów]</b></a><br>'; 
						echo '<hr>';
						echo '</center>';
					} 
					if($_SESSION['Type'] == '1') { // Admin
						echo '<center>';
					//	echo '<font size=3 color=green><b>Admin</b></font><br>';
						echo '<a href="index.php?act=adm&do=ban"><b>[Przydzielanie rang]</b></a><br>';
						echo '<hr>';
						echo '<a href="index.php?act=download_w&do=football_1"><b>[Pobierz streamy]</b></a> <a href="index.php?act=adm&do=download_h"><b>[Pobierz skróty meczów]</b></a><br>';
						echo '<hr>';
						echo '<a href="index.php?act=adm&do=addplayer"><b>[Dodaj Player]</b></a> <a href="index.php?act=adm&do=editplayer"><b>[Edytuj Player]</b></a><br>';
						echo '<hr>';
						echo '</center>';						
					}
					if(($_SESSION['Type'] == '2') or ($_SESSION['Type'] == '1')) { // Moderator
						echo '<center>';
					//	echo '<font size=3 color=green><b>Moderator</b></font><br>';
						echo '<a href="index.php?act=adm&do=ban"><b>[Banowanie]</b></a> <a href="index.php?act=adm&do=ban"><b>[Mutowanie]</b></a><br>';
					//	echo '<hr>';
						//echo '<br>';
						echo '</center><br>';											
					}
					/*
					if(($_SESSION['Type'] == '3') or ($_SESSION['Type'] == '1')) { // Link Adder
						echo '<center>';
						echo '<font size=3 color=green><b>Uploader</b></font><br>';
						echo '<a href="index.php?act=adm&do=ban"><b>[Dodaj link]</b></a><br>';
						echo '<a href="index.php?act=adm&do=ban"><b>[Dodaj mecz]</b></a><br>';
						echo '</center><br>';						
					}*/
					if($_SESSION['Type'] == '255') { // Banned
						if(isset($_GET['act']) && $_GET['act'] <> 'banned'){
							header("Location: index.php?act=banned");
						}
					}
				}
			?> 
			</div>
			</p>	
				<div class="chat" style="margin-left: 15px;"> 
					<div class="messages"></div>
					<?php if(empty($_SESSION['login']) === true){ ?>
								<textarea class="entry" placeholder="Aby pisaæ na czacie musisz byæ zalogowany!" readonly></textarea>
					<?php } else { ?>		
					<textarea class="entry" placeholder="Wpisz tutaj wiadomo¶æ i wciœnij Enter. Shift + Enter przej¶æie do nowej linii."></textarea> 
					<?php } ?>
				</div>
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script> 
				<script type="text/javascript" src="js/chat.js"></script>	

          </div>