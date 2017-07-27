	function onTestChange() 
	{
	    var key = window.event.keyCode;

	    // If the user has pressed enter
	    if (key == 13) {
	        submitChat();
	        document.getElementById("enterChat").value = '';
	    }
	    else {
	        return false;
	    }
	}

	function putAtBottom()
	{
		$('.chatlogs').stop().animate(
		{
			scrollTop: $('.chatlogs')[0].scrollHeight
		}, 800)
	}

	function checkAtBottom()
	{
		var scrollheight;
		var scrollpos;
		var scrollzero;
		scrollheight = $('.chatlogs')[0].scrollHeight;
		scrollpos = $('.chatlogs').scrollTop();
		scrollzero = scrollheight - scrollpos - 350;
		//console.log("scrollheight = " + scrollheight);
		//console.log("scrollpos  = " + scrollpos);
		//console.log("scrollzero = " + scrollzero);
		if (scrollzero < 100)
		{
			putAtBottom();
		}
	}

	function submitChat()
	{
		if(document.getElementById("enterChat").value == '' )
		{
			alert('ALL FIELDS ARE MANDATORY!!!');
			return;
		}
		var msg = document.getElementById("enterChat").value;
		var xmlhttp, xxx;
		xmlhttp = new XMLHttpRequest();
	
		xmlhttp.open( "GET", 'insert.php?&msg=' + msg, true );
		xmlhttp.send();
	}

	$(document).ready(function(e) {
		$.ajaxSetup({cache:false});
		setInterval(function(){$('.chatlogs').load('logs.php');}, 2000);

		//putAtBottom();
		setTimeout(putAtBottom, 2050);

		setInterval(checkAtBottom, 1000);
	});