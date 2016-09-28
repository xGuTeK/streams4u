<?php
require ('../config.php');

if (isset($_POST['method']) === true && empty($_POST['method']) === false){

	
	$method 	= trim($_POST['method']);
	
	if($method === 'fetch'){
		$chat 		= new chat();
		$messages = $chat->fetchMessages();
		
		if(empty($messages) === true)
		{
?>			
			<div class="message">
				<p>Obecnie nie ma ¿adnych wiadomoœ¶ci na czacie!</p>
			</div>
<?php
		} else {
			//<p><b><?php echo $m["login"];</b>: 
			//echo '<pre>', print_r($messages), '</pre>';
			while($m = db::fetch($messages)){
		?>
			<div class="message" style="white-space: nowrap; max-width:265">
				<p><b><a href="index.php?act=profile&user=<?php echo $m["login"]; ?>"><?php echo $m["login"];?></a></b>: 
				<?php echo $chat->insertEmots(nl2br($m["message"]));?></p>
			</div>		
		<?php
			}
		}
	} elseif ($method === 'throw' && isset($_POST['message']) === true){
		$message = trim($_POST['message']);
		if(empty($message) === false){
			$chat->throwMessage($register->fieldFilter($_SESSION['id']),$message);
		}
	}

}

?>

