<?php
include_once('MYSQLDB.php');
require('db.php');

?>

<html>
<head>
	<title>
		<?php echo $this->output('LivCha') ?> 
	</title>

<script src="http://code.jquery.com/jquery-1.9.0.js"></script>

<script type="text/javascript">

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
		if(form1.msg.value == '' )
		{
			alert('ALL FIELDS ARE MANDATORY!!!');
			return;
		}
		var msg = form1.msg.value;
		var xmlhttp, xxx;
		xmlhttp = new XMLHttpRequest();
		
		/*xmlhttp.onreadystatechange = function () 
		{/*
			if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
			{
				xxx = xmlhttp.responseText;
				//document.getElementById('chatlogs') = xxx;
			}
		} */
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

</script>

<link rel="stylesheet" type="text/css" href="styles.css">

</head>


<body>
	<h1><?php echo $this->output('SokCom') ?> </h1>
	<div id="wrapper">
		<br>
		<?php $this->picture(); ?>
		<aside>
			<div class="chat">
				<div class="chatlogs">
					<?php echo $this->output('LoadChat') ?>
				</div>
				<div class="chatForm">
				<form name="form1">
					<?php echo $this->output('Welcome') ?> : <?php 	echo $this->username; ?> <br />
					<textarea name="msg" id="enterChat" onkeypress="onTestChange()" placeholder="<?php echo $this->output('EntMess') ?>" ></textarea><br />
					<!-- <a href="#" onclick="submitChat()" id="send">Send</a> !-->
					<br /><br />
				</form>

				</div>
			</div>
		</aside>
	</div>
	<footer>
		
		<form action="MyIndex.php" method="POST">
		<a href="MyLogin.php"><?php echo $this->output('Logout') ?> </a>
		<input name ='changeUsername' type ='text' size='15'/>
		<input type='Submit' value="<?php echo $this->output('ChanUser') ?>">
		</form>
	</footer>

</body>