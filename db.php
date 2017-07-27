<?php
$host = 'localhost' ;
$dbUser ='root';
$dbPass ='';
$dbName ='chatbox';
 
$db = new MySQL( $host, $dbUser, $dbPass, $dbName ) ;
$db->selectDatabase();
?>
