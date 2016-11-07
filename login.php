<?php

	include "mysql_config.php";
	session_start();
   	$error = "";
   	$user = "";

	function clean_input($string) {
	    $string = trim($string);
	    $string = stripslashes($string);
	    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	    return $string;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

      if (!isset($_POST['username'])) {
         die();
      }

      $sql = "SELECT * FROM cmm_member";
      $result = mysqli_query($con, $sql);
      $u_exist = false;
      $p_exist = false;
      $username = clean_input($_POST["username"]);
      $password = md5(clean_input($_POST['password']));
      if(mysqli_num_rows($result) > 0){
         while($row = mysqli_fetch_array($result)){
            if ($row['username'] == $username){
               $u_exist = true;
               $user = $row['username'];
            }
            if ($row['password'] == $password){
               $p_exist = true;
            }
         }
      }
      if(!$u_exist){
         $error = "This username doesn't exist. <br><span style=\"color:#000\">please go to <a href=\"signup.php\">Sign up</a> page to create a new account.</span>";
      }else{
         if(!$p_exist){
            $error = "Password invalid. Please try again.";
         }else{
            setcookie('UID', md5($user), time()+(60*60*24*1), '/', NULL, NULL, true);
            $_SESSION['username'] = $user;
            header("location: shopping.php");
         }
      }
  }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type = "text" name = "username" placeholder="Username" />
	<input type = "password" name = "password" placeholder="Password" AUTOCOMPLETE='OFF'/>
	<input type="submit" name="submit" value="Submit" />
</form>
<div><?php echo $error; ?></div>
</body>
</html>