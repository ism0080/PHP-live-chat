<?php
include_once('MyView.php');
include_once ('user.php');
include_once('MYSQLDB.php');
require('db.php');
session_save_path("./");
session_start();
$t = new MyView('./');
$t->ini_array = parse_ini_file('language.ini', true);
$t->userId = $_SESSION[ 'userID' ];
$t->username = $_SESSION[ 'username' ];
$t->community= $_SESSION[ 'community' ];

if (isset($_POST['changeUsername']))
{
	$username = $_POST['changeUsername'];
	$userCheck = User::checkUsername($db, $username);
	if ($userCheck)
	{
		echo '<script language="javascript">';
		echo 'alert("Username in use! Choose another")';
		echo '</script>';
	}
	else
	{
		User::getTriggered($db, $username, $t->userId);
		$holder = user::getUsername($db, $t->userId);
		$_SESSION[ 'username' ] = implode('', $holder);
		$t->username = implode('', $holder);
		//$t->username = $_POST['changeUsername'];
	}
	
}

if (isset($_POST['kiwi'])) 
{
    $t->locale = 'kiwi';
}
else if (isset($_POST['mao'])) 
{
	$t->locale = 'mao';
}
else if (isset($_GET['en'])) 
{
	$t->locale = 'en';
}
else
{
	$t->locale = 'en';
}

if ($t->community == 'english')
{
	$t->render('MyChatEn.php');
}
else if ($t->community == 'maori')
{
	$t->render('MyChatMao.php');
}
?>
