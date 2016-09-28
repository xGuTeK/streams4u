
$(document).ready(function() {
			/*
				Tips:
				
				event.target is DOM Element
				this is DOM element
				$(this) is jQuery Element
				timer is interval for countdown
				
				If a countdown should end early you could do:
				
				clearInterval( timer );
				$(this).trigger('complete');
			*/	
			

	$("#time").countdown({
		date: "june 1, 2011", //Counting TO a date
		//htmlTemplate: "%{h} <span class=\"cd-time\">hours</span> %{m} <span class=\"cd-time\">mins</span> %{s} <span class=\"cd-time\">sec</span>",
		//date: "july 1, 2011 19:24", //Counting TO a date
		onChange: function( event, timer ){
		


		},
		onComplete: function( event ){
		
			$(this).html("Completed");
		},
		leadingZero: true,
		direction: "up"
	});
	
	//$("#time").countdown();
	



	
	$("#time2").countdown({
		date: "july 31, 2011",
		//htmlTemplate: "%{h} <span class=\"cd-time\">hours</span> %{m} <span class=\"cd-time\">mins</span> %{s} <span class=\"cd-time\">sec</span>",
		offset: 1,
		onChange: function( event, timer ){
		


		},
		onComplete: function( event ){
		
			$(this).html("Completed");
		},
		onPause: function( event, timer ){

			$(this).html("Pause");
		},
		onResume: function( event ){
		
			$(this).html("Resumed");
		},
		leadingZero: true
	});
	
	//$("#time2").countdown('pause');
	
	//$("#time2").countdown('resume');
	
	
	/*
	$("#time2").countdown({
		date: "may 1, 2011",
		direction: 'up', //Counting FROM a date
		leadingZero: true
	});
	*/

});
