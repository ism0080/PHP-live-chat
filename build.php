<?php
include_once 'MySQLDB.php';
require 'db.php';

//  create the database again
$db->createDatabase();
// select the database
$db->selectDatabase();

// drop the tables
$sql = "drop table if exists message";
$result = $db->query($sql);

$sql = "drop table if exists user";
$result = $db->query($sql);


// create the tables
$sql = "CREATE TABLE user (userId varchar(30) NOT NULL,
                           username varchar(30) NOT NULL UNIQUE,
                           password varchar(255) NOT NULL,
                           email varchar(320) NOT NULL,
                           time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                           PRIMARY KEY(userId)    
                          ) ENGINE=InnoDB";
               
//  execute the sql query
$result = $db->query($sql);
if ( $result )
{
   echo 'the user table was added<br>';
}
else
{
   echo 'the user table was not added<br>';
}

$sql =
  "CREATE TABLE message ( chatId integer NOT NULL AUTO_INCREMENT,
                          msg text NOT NULL,
                          time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          locale varchar(10) NOT NULL,
                          username varchar(30) NOT NULL,
                          PRIMARY KEY(chatId),
                          FOREIGN KEY(username) REFERENCES user(username) ON DELETE CASCADE ON UPDATE CASCADE
                        ) ENGINE=InnoDB";
// execute the sql query
$result = $db->query($sql);
if ( $result )
{
    echo 'the message table was added<br>';
}
else
{
    echo 'the message table was not added<br>';
}
// data insertion




?>
<html>
<body>
<br /><br />
<a href="./">Return To Directory</a>
</body>
</html>
