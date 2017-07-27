<?php

include_once 'MYSQLDB.php';
include_once 'message.php';
require 'db.php';

    session_save_path("./");
    session_start();
    // register the session variables and load the next page
	$username = $_SESSION[ 'username' ];   
	$community = $_SESSION['community'];
	$msg = $_GET['msg']; 

//classy
$insert = new Message($username, $msg, $community);
$insert->insertMessages($db);
$theMessage = $insert->getMessages($db, $community);
$insert->displayMessages($theMessage);
?>