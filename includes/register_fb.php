<?php

$user = $facebook->getUser();
$loginUrl = $facebook->getLoginUrl();
$logoutUrl = $facebook->getLogoutUrl();

if($user) {
	$fb = $facebook->api('/me','GET');
	$fbEmail = $fb['email'];
	$fbID = $fb['id'];
	if($register->checkfb($fbID) === false){
	echo '<center>
		<form action="index.php?act=register&do=send" method=POST>
		
		<table>
			<tr>
				<td>Login:</td>
				<td><input type=text size="32" name=login></td>
			</tr>
			<tr>
				<td>Has³o:</td>
				<td><input type=password size="32" name=pass></td>
			</tr>
			<tr>
				<td>Powtórz has³o:</td>
				<td><input type=password size="32" name=repass></td>
			</tr>			
			<tr>
				<td>E-mail:</td>
				<td><input type=text name=email size="32" value="'.$fbEmail.'"></td>
			</tr>
			<tr align=center>
				<input type="hidden" name="fbid" value="'.$fbID.'">
				<td colspan=2><input type=submit value="Zarejestruj"></td>
			</tr>
		</table>	
		</form>
	</center>';
	} else {
		$_SESSION['login'] = $register->getLogin($fbID);
		$_SESSION['id']    = $register->getID($fbID);
		//echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		header("Location: index.php");
		//echo $login['login'][1];
	}

} else {

	echo 'Error';
	
}


?>