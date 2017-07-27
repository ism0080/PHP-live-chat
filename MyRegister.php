<?php

session_save_path("./");
session_start();

include_once('MyView.php');
$t = new MyView('./');
$t->ini_array = parse_ini_file("language.ini", true);

if (isset($_GET['en'])) 
{
        $t->locale = 'en';
}
else if (isset($_GET['mao'])) 
{
	$t->locale = 'mao';
}
else if (isset($_GET['kiwi'])) 
{
	$t->locale = 'kiwi';
}
else
{
	$t->locale = 'en';
}

$t->render('register.php');
