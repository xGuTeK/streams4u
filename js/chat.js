
var chat = {}

chat.fetchMessages = function () {
	$.ajax({
		url: 'includes/chat.php',
		type: 'post',
		data: { method: 'fetch' },
		success: function(data){
			$('.chat .messages').html(data);
		}
	});
}


chat.throwMessage = function (message, x){
	var f1 = message.indexOf('http')
	var f2 = message.indexOf('.pl');
	var f3 = message.indexOf('.com');
	var f4 = message.indexOf('.eu');
	if (document.cookie.indexOf("chat") <= 0) {
		if($.trim(message).length != 0){
			if(f1 == -1 && f2 == -1 && f3 == -1 && f4 == -1){
				$.ajax({
					url: 'includes/chat.php',
					type: 'post',
					data: { method: 'throw', message: message },
					success: function(data){
						chat.fetchMessages();
						chat.entry.val('');
						createCookie('chat',1, x);
					}
			
				});
			} else {
				chat.messages.html("<div class=\"message\" style=\"color: red;\"><p><b>Zakaz podawania linków!</b></p></div>");	
			}
		}
	} else {
		chat.messages.html("<div class=\"message\" style=\"color: red;\"><p><b>Mo¿esz pisaæ co "+x+" sekundy!</b></p></div>");
	}
}


function createCookie(name, value, x) {
   var date = new Date();
   date.setTime(date.getTime()+(x*1000));
   var expires = "; expires="+date.toGMTString();

   document.cookie = name+"="+value+expires+"; path=/";
}
chat.messages = $('.chat .messages');
chat.entry = $('.chat .entry');
chat.entry.bind('keydown', function(e) {
	if(e.keyCode === 13 && e.shiftKey === false){
		chat.throwMessage($(this).val(), 2); //Zmiana ilosci sekund
		e.preventDefault();
	}
});

chat.interval = setInterval(chat.fetchMessages, 2000);
chat.fetchMessages();




