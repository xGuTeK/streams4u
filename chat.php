<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
<title>Soccer Field</title>
<link href="css/stylesheet.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-easing-1.3.pack.js"></script>
<script type="text/javascript" src="js/jquery-easing-compatibility.1.2.pack.js"></script>

</head>
<body>


<?php
require("config.php");

$chat = new chat();

echo '<div style="background-color: white;">';

//$chat->throwMessages(1, "Gowno dziala 2");
//echo '<pre>', print_r($chat->fetchMessages(), true), '</pre>';

echo '</div>';


?>

            <h2>Czat</h2>
				<div class="chat" style="margin-left: 15px;"> 
					<div class="messages"></div>
					<textarea class="entry" placeholder="Aby pisać na czacie musisz być zalogowany!"></textarea>
		
			    </div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="js/chat.js"></script>				
</body>