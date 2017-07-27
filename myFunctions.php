<?php
/*
function getUserID($db, $theUsername, $hashed)
   {
        $sql = "select userID from user where userId = '$theUsername' and password = '$hashed'";
		$result = $db->query($sql);
        $row = $result->fetch();
        return $row;
   }

function getPassword($db, $theUsername)
{
    $sql = "SELECT password FROM user WHERE userId = '$theUsername'";
    $result = $db->query($sql);
    $row = $result->fetch();
    return $row;
}

function checkUserID($db, $uname)
{
    $sql = "SELECT userID FROM user WHERE userId = '$uname'";
    $result = $db->query($sql);
    $row = $result->fetch();
    return $row;
}

function addUser($db, $uname, $pass, $email)
{
    $sql = "INSERT INTO user (userId, password, email) VALUES ('$uname', '$pass', '$email')";
    $result = $db->query($sql);
    return $result;
}

//MESSAGES

/*
function insertMessages($db, $userID, $msg)
{
    $sql = "INSERT INTO message (userId, msg) VALUES ('$userID', '$msg')";
    $result = $db->query($sql);
    return $result;
}

function getMessages($db)
{
    $sql = "SELECT * FROM message ORDER BY chatId";
    $result = $db->query( $sql );
    return $result;
}

function displayMessages($theMessage)
{
    while ( $row =  $theMessage->fetch() )
    {
        $username = $row['userId'];
        $msg = $row['msg'];
        $time = $row['time'];

        if ($msg != null)
        {
            echo "<br>$username: $msg <br> ($time)";
        }
    }
}*/

?>