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
<script src="script.js"></script>
<link rel="stylesheet" type="text/css" href="styles.css">

</head>


<body>
	<h1><?php echo $this->output('MaoCom') ?> </h1>
	<form action="MyIndex.php" method="POST">
		<?php echo $this->output('Lang') ?>:
		<input type="submit" name="mao" id="mao" value="Māori" />
		<input type="submit" name="en" id="en" value="English"  />
		<input type="submit" name="kiwi" id="kiwi" value="Kiwi" />
	<form>
	<div id="wrapper">
		<br>
		<img src="images/mao.jpg" alt="sokoban" class="gameImg">
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