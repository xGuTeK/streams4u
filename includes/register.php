<?php
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
				<td><input type=text name=email size="32"></td>
			</tr>
			<tr align=center>
				<input type="hidden" name="fbid"">
				<td><input type=submit value="Zarejestruj"></td>
				<td><a href="'.$loginUrl.'"><img src="images/facebook_zaloguj.png"></a></td>
			</tr>
		</table>	
		</form>
	</center>';
?>