<?php

class Message
{
	protected $username;
	protected $message;
	protected $community;

	public function __construct($username, $message, $community)
	{
		$this->username = $username;
		$this->message = $message;
		$this->community = $community;
	}

	public function insertMessages($db)
	{
	    $sql = "INSERT INTO message (username, msg, locale) VALUES ( '$this->username', '$this->message', '$this->community')";
	    $result = $db->query($sql);
	    return $result;
	}

	public static function getMessages($db, $locale)
	{
	    $sql = "SELECT username, msg, time(time) as 'time', date(time) as 'date' FROM message WHERE locale = '$locale' ORDER BY chatId ";
	    $result = $db->query($sql);
	    return $result;
	}

	public static function displayMessages($theMessage)
	{
		$today = '2016-01-01';	    
	    while ( $row =  $theMessage->fetch() )
	    {
	        $username = $row['username'];
	        $msg = $row['msg'];
	        $time = $row['time'];
	        $date = $row['date'];

	        if ($date != $today)
	        {
	        	echo "<br>($date)";
	        	$today = $date;
	        }

	        if ($msg != null)
	        {
	            echo "<br>[$time] - $username: $msg";
	        }
	    }
	}
}