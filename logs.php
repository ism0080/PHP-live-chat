<?php

include_once 'MYSQLDB.php';
include_once 'message.php';
require 'db.php';


session_save_path("./");
session_start();
$community = $_SESSION['community'];

$theMessage = Message::getMessages($db, $community);
Message::displayMessages($theMessage);


?>