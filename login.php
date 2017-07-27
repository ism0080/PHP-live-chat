<?php
include_once 'MYSQLDB.php';
include_once 'user.php';
require 'db.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST')
{
  try 
  {
    //validate username
    $userId = filter_input(INPUT_POST, 'theUsername', FILTER_SANITIZE_SPECIAL_CHARS);
    if( !$userId )
    {
      throw new Exception('A username must be entered<br>');
    }

    //validate password
    $password = filter_input(INPUT_POST, 'thePassword', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$password)
    {
      throw new Exception('A password must be entered<br>');
    }

    $user = User::getPassword($db, $userId);
    if(password_verify($password, $user) == false)
    {
      throw new Exception('Not a valid username, password combination<br>'); 
    }

    // specify where to save the session variables
    session_save_path("./");
    session_start();
    // register the session variables and load the next page
    $community = $_POST['community'];
    $_SESSION['community'] = $community;
    $username = User::getUsername($db, $userId);
    $usernameHolder = implode("", $username);
    $_SESSION[ 'username' ] = $usernameHolder ;
    $_SESSION[ 'userID' ] = $userId ;  
    header('HTTP/1.1 302 Redirect');   
    header( 'Location:MyIndex.php' ) ;
    die();
  }
  catch (Exception $e) 
  {
    // Report error
    header('HTTP/1.1 400 Bad request');
    echo $e->getMessage();
  }
}

?>

<html>
<head>
  <script src="http://code.jquery.com/jquery-1.9.0.js"></script>

  <script type="text/javascript">
  </script>

<link rel="stylesheet" type="text/css" href="log_reg.css">
</head>
<div id="logRegWrapper">
  <form action="MyLogin.php" method="POST">
    <h1><?php echo $this->output('Login') ?> </h1>

    <?php echo $this->output('EntUser') ?> <input name ='theUsername' type ='text' size='15'/>
    <br><br> 
    <?php echo $this->output('EntPass') ?> <input name ='thePassword' type ='password' size='15'/>
    <br><br>
    <input type="radio" name="community" value="english" required /><?php echo $this->output('SokCom') ?>
    <br>
    <input type="radio" name="community" value="maori" required /><?php echo $this->output('MaoCom') ?>
    <br><br>
    <input type='Submit' value=<?php echo $this->output('Login') ?>>
    <a href="MyRegister.php" id="register"><?php echo $this->output('Register') ?></a> 
  </form>
  
  <form action="MyLogin.php" method="GET">
    <?php echo $this->output('Lang') ?>:
    <input type="submit" name="mao" id="mao" value="Māori" />
    <input type="submit" name="en" id="en" value="English"  />
    <input type="submit" name="kiwi" id="kiwi" value="Kiwi"  />
  <form>
  </br>
</div>
<!-- <a href="./">Return To Directory</a> !-->
</html>