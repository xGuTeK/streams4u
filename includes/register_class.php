<?php
class register extends db {
	
	public function fieldFilter($field){
		$field = strip_tags($field);
		$banlist = array ("'", ";", "%", "$", "-", ">", "drop", "\"", "<", "\\", "|", "/", 
		"=", "echo", "insert", "select", "update", "delete", "distinct", "having", "truncate", 
		"replace", "handler", "like", "procedure", "limit", "order by", "group by", "asc", "desc", 
		"union", "include", "userdata", "tb_user", "account_char");
		$field = str_replace($banlist, " ", $field);
		$field = trim($field);
		return $field;
	}
	
	public function checkfb($id){
		if($id == 0){
			return false;
		}
		$checkFbID 	  = db::query("SELECT user_id FROM users WHERE fb_id='".$this->fieldFilter($id)."'");
		if(mysql_num_rows($checkFbID)>0){
			return true;
		} else 
			return false;
	}
	public function getLogin($id){
		$getLogin = db::query("SELECT login FROM users WHERE fb_id='".$this->fieldFilter($id)."'");
		while($log = db::fetch($getLogin)){
			return $log['login'];
		}
	}

	public function getID($id){
		$getid2 = db::query("SELECT user_id FROM users WHERE fb_id='".$this->fieldFilter($id)."'");
		while($log2 = db::fetch($getid2)){
			return $log2['user_id'];
		}
	}	
	public function reg($login, $password, $repassword, $email, $fbID){

		if(empty($login) === false && empty($password) === false && empty($repassword) === false && empty($email) === false)
		{
				$checkLogin   = db::query("SELECT user_id FROM users WHERE login='".$login."'");
				$checkEmail   = db::query("SELECT user_id FROM users WHERE email='".$email."'");
				
				
				if($this->checkfb($fbID) === true){
					echo '<p align=center><font size=2 color=red>Ju¿ rejestrowa³eœ konto z facebooka!</font></p>';
				} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
					echo '<p align=center><font size=2 color=red>Twój login nie mo¿e zawieraæ znaków specialnych!</font></p>';	
				} elseif(strlen($login) <4){
					echo '<p align=center><font size=2 color=red>Twój login musi mieæ wiêcej ni¿ 4 znaki.</font></p>';	
				} elseif(strlen($login) >12){
					echo '<p align=center><font size=2 color=red>Twój login nie mo¿e byæ d³u¿szy ni¿ 12 znaków.</font></p>';	
				} elseif(mysql_num_rows($checkLogin)>0){
					echo '<p align=center><font size=2 color=red>Ten login jest u¿ywany!</font></p>';	
				} elseif($password <> $repassword) {
					echo '<p align=center><font size=2 color=red>Podane has³a nie pasuj¹ do siebie.</font></p>';	
				} elseif(!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
					echo '<p align=center><font size=2 color=red>Twoje has³o nie mo¿e zawieraæ znaków specialnych.</font></p>';	
				} elseif(strlen($password) <4){
					echo '<p align=center><font size=2 color=red>Twoje has³o musi mieæ wiêcej ni¿ 4 znaki.</font></p>';	
				} elseif(strlen($password) >12){
					echo '<p align=center><font size=2 color=red>Twoje has³o nie mo¿e byæ d³u¿sze ni¿ 12 znaków.</font></p>';	
				} elseif(!preg_match("/^[a-zA-Z0-9]+([_\\.-][a-zA-Z0-9]+)*@([a-zA-Z0-9]+([\.-][a-zA-Z0-9]+)*)+\\.[a-zA-Z]{2,}$/i", $email)){
					echo '<p align=center><font size=2 color=red>Poda³eœ nieprawid³owy adres e-mail.</font></p>';	
				} elseif(mysql_num_rows($checkEmail)>0){
					echo '<p align=center><font size=2 color=red>Ten E-mail jest u¿ywany!</font></p>';
				} else {
					db::query("INSERT INTO users VALUES('','".$login."','".md5($password)."', '".$email."', '".$fbID."')");
					echo '<p align=center><font size=2 color=red>Konto zosta³o za³o¿one :)</font></p>';
				}
		} else {
			echo '<p align=center><font size=2 color=red>Wype³nij wszystkie pola!</font></p>';
		}
		
	}
	

}

?>