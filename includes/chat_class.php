<?php

class Chat extends db {
	public function fetchMessages(){
		$query=db::query("
				SELECT  	`chat`.`message`,
						`users`.`login`,
						`users`.`user_id`
				FROM		`chat`
				JOIN		`users`
				ON			`chat`.`user_id` = `users`.`user_id`
				ORDER BY	`chat`.`timestamp`
				DESC
			");
			
		return $query;
	}
	public function throwMessage($user_id, $message){
		db::query("INSERT INTO `chat` (`message_id`,`user_id`, `message`, `timestamp`) VALUES ('', ". (int)$user_id .", '".$message."', UNIX_TIMESTAMP())") or die('1');
	}
	public function insertEmots($message){
		$ftext = array(
		':)',
		':(',
		';(',
		':d', ';d',
		'gool', 'gol',
		'wow',':o',';o',
		':p', ';p',
		':/', ';/',
		'omg',
		'lol',
		':|', ';|',
		'zzz',
		);
		
		$rtext = array(
		'<img src="images/emots/usmiech.gif">',
		'<img src="images/emots/smutny.gif">',
		'<img src="images/emots/cry.gif">',
		'<img src="images/emots/zeby.gif">', '<img src="images/emots/zeby.gif">',
		'<img src="images/emots/gool.gif">', '<img src="images/emots/gool.gif">',
		'<img src="images/emots/wow.gif">', '<img src="images/emots/wow.gif">', '<img src="images/emots/wow.gif">',
		'<img src="images/emots/jezyk1.gif">', '<img src="images/emots/jezyk1.gif">',
		'<img src="images/emots/kwasny.gif">', '<img src="images/emots/kwasny.gif">',
		'<img src="images/emots/omg.png">',
		'<img src="images/emots/lol.gif">',
		'<img src="images/emots/ysz.gif">', '<img src="images/emots/ysz.gif">',
		'<img src="images/emots/zzz.gif">'
		);
		$message = str_ireplace($ftext, $rtext, $message);
	
		return $message;
		
	}

}

?>