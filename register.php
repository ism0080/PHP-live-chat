<?php
include_once 'MYSQLDB.php';
include_once 'user.php';
require 'db.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
	try {
		// Validate username
		$userId = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_SPECIAL_CHARS);
		$usernameCheck = User::checkUserID($db, $userId);
		if (!$userId)
		{
			throw new Exception('Enter a Username');
		}
		if ($usernameCheck)
		{
			throw new Exception("Username '$userId' already exists! Choose a different username");
		}

	     // Validate email
	     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	     if (!$email) 
	     {
	         throw new Exception('Invalid email');
	     }

	     // Validate password
	     $password = filter_input(INPUT_POST, 'pword', FILTER_SANITIZE_SPECIAL_CHARS);
	     if (!$password || strlen($password) < 4) 
	     {
	         throw new Exception("Password must contain 4+ characters");
	     }

	     // Create password hash
	     $passwordHash = password_hash(
	        $password,
	        PASSWORD_DEFAULT,
	        ['cost' => 12]
	     );
	     if ($passwordHash === false) 
	     {
	         throw new Exception('Password hash failed');
	     }

	     $user = new User($userId, $userId, $passwordHash, $email);
	     $user->addUser($db);


		// specify where to save the session variables
		session_save_path("./");
		session_start();
		// register the session variables and load the next page
		$username = User::getUsername($db, $userId);
		$usernameHolder = implode("", $username);
		$_SESSION[ 'username' ] = $usernameHolder ;  
		$_SESSION[ 'userID' ] = $userId ;  
		$community = $_POST['community'];
    	$_SESSION['community'] = $community;

	     // Redirect to login page
	     header('HTTP/1.1 302 Redirect');
	     header('Location: MyIndex.php');
    } 
	catch (Exception $e) 
	     {
	     // Report error
	     header('HTTP/1.1 401 Unauthorized');
	     echo $e->getMessage();
	 }	
}
	


	
?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="log_reg.css">
	</head>

	<body>
		<div id="logRegWrapper">
			<form action="MyRegister.php" method="POST">
				<h1><?php echo $this->output('Register') ?></h1>
				
				<?php echo $this->output('Username') ?>: <input type="text" name="uname" size="15"></input>
				<br><br>
				<?php echo $this->output('Password') ?>: <input type="password" name="pword" size="15"></input>
				<br><br>
				<?php echo $this->output('Email') ?>: <input type="email" name="email" size="15"></input>
				<br><br>
				<input type="radio" name="community" value="english" required/><?php echo $this->output('SokCom') ?>
				<br>
				<input type="radio" name="community" value="maori" required/><?php echo $this->output('MaoCom') ?>
				<br><br>
				<input type="submit" value=<?php echo $this->output('Register') ?> />
				<a href="MyLogin.php" id="register"><?php echo $this->output('Login') ?></a> 
			</form>

			<form action="MyRegister.php" method="GET">
				<?php echo $this->output('Lang') ?>:
				<input type="submit" name="mao" id="mao" value="Māori" />
				<input type="submit" name="en" id="en" value="English" />
				<input type="submit" name="kiwi" id="kiwi" value="Kiwi" />
			<form>
			</br>
		</div>
	</body>
</html>