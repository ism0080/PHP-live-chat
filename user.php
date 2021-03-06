<?php

class User
{
	protected $userID;
	protected $password;
	protected $email;
	protected $username;

	public function __construct($userID, $username, $password, $email)
	{
		$this->userID = $userID;
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}

	public function getUserID($db, $username, $password)
   {
	    $sql = "select userID from user where userId = '$username' and password = '$password'";
		$result = $db->query($sql);
	    $row = $result->fetch();
	    return $row;
	}

	public static function getPassword($db, $username)
	{
	    $sql = "SELECT password FROM user WHERE userId = '$username'";
	    $result = $db->query($sql);
	    $row = $result->fetch();
	    return $row['password'];
	}

	public static function checkUserID($db, $username)
	{
	    $sql = "SELECT userID FROM user WHERE userId = '$username'";
	    $result = $db->query($sql);
	    $row = $result->fetch();
	    return $row;
	}

	public static function checkUsername($db, $username)
	{
	    $sql = "SELECT username FROM user WHERE username = '$username'";
	    $result = $db->query($sql);
	    $row = $result->fetch();
	    return $row;
	}

	public static function getUsername($db, $userId)
	{
		$sql = "SELECT username FROM user WHERE userId = '$userId'";
		$result = $db->query($sql);
	    $row = $result->fetch();
	    return $row;
	}

	public function addUser($db)
	{
	    $sql = "INSERT INTO user (userId, username, password, email) VALUES ('$this->userID', '$this->username', '$this->password', '$this->email')";
	    $result = $db->query($sql);
	    return $result;
	}

	public static function getTriggered($db, $newUsername, $userId)
	{
		$sql="UPDATE user SET username='$newUsername' WHERE userId = '$userId'";
		$result = $db->query($sql);
		//return $result;
		$sql=
			"delimiter$$

			drop trigger UsernameUpdade$$

			CREATE TRIGGER UsernameUpdade
			AFTER UPDATE ON user
			FOR EACH ROW
			BEGIN
	  		 IF (Old.username != New.username) THEN
	  		 INSERT INTO message (username)
	  		 VALUES (New.username);
	  		END IF;
			END;
			$$";
	}


}