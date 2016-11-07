<?php
	include "mysql_config.php";

	session_start();

	if (isset($_COOKIE['UID']) && isset($_SESSION['UID'])) {
      	echo "<script>if (confirm(\"You've already logged in.\")) { window.location = \"shopping.php\"; };</script>";
   	}

	$error = "";
	$success = false;

	function clean_input($string) {
	    $string = trim($string);
	    $string = stripslashes($string);
	    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	    return $string;
	}

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {

      if (!isset($_POST['newusername']) && !isset($_POST['newpassword']) && !isset($_POST['repassword'])) {
         die();
      }

      	$sql = "SELECT * FROM cmm_member";
		$result = mysqli_query($con, $sql);
		$exist = false;
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				if ($row['username'] == clean_input($_POST["newusername"])){
					$exist = true;
				}
			}
		}
		if($exist){
			$error = "This username has already existed. Please change another one.";
			$success = false;
		}else{
			$user = clean_input($_POST['newusername']);
			if (!preg_match("/^[a-zA-Z0-9]{6,}$/", $user)) {
				$error = "The username doesn't meet the requests, please try again.";
				$success = false;
			}else{
				if($_POST['newpassword'] != $_POST['repassword']){
	      			$error = "Password doesn't match, try again!";
	      			$success = false;
	      		}else{
	      			$submittedPassword = clean_input($_POST['newpassword']);
	      			if (!preg_match("/(?=[a-zA-Z0-9]*?[A-Z])(?=[a-zA-Z0-9]*?[a-z])(?=[a-zA-Z0-9]*?[0-9])[a-zA-Z0-9]{6,}$/", $submittedPassword)) {
	      				$error = "Your password is not allowed. Please follow the requests.";
	      				$success = false;
	      			}else{
	      				$submittedPassword = md5($submittedPassword);
		        		$sql = "INSERT INTO cmm_member (username, password) VALUES "."('$user','$submittedPassword')";
		        		mysqli_query($con,$sql);
		        		$success = true;
		        		// $sql1 = "CREATE TABLE ".$user." ( pid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, lat VARCHAR(255) NOT NULL, lon VARCHAR(255) NOT NULL, de VARCHAR(255) NOT NULL, t VARCHAR(255) NOT NULL )";
		        		// mysqli_query($con, $sql1);
	      			}
	      		}
			}
		}
   	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="text" name="newusername" placeholder="New Username" />
	<input type="password" name="newpassword" placeholder="New Password" autocomplete="off" />
	<input type="password" name="repassword" placeholder="Retype Password" autocomplete="off" />
	<input type="submit" name="signup" value="Sign Up" />
</form>

<?php 
    if($success){
        echo "<script>if (confirm(\"You created an account successfully, please login.\")) { window.location = \"login.php\"; };</script>";
    }else{
        echo "<div style=\"color:red;\">".$error."</div>";
    }
?>

<div>
	<br>
	*Username: At least 6 characters with A-Z, a-z, 0-9.
	<br>
	*Password: At least 6 characters with A-Z, a-z, 0-9, at least 1 upper letter, 1 lower letter, and 1 number.
	<br>
	If you already have an account, please <a href="login.php">Login</a>.
</div>

</body>
</html>