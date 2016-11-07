<?php
	include "mysql_config.php";

	function clean_input($string) {
	    $string = trim($string);
	    $string = stripslashes($string);
	    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	    return $string;
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="text" name="username" placeholder="Username" />
	<input type="password" name="newpassword" placeholder="New Password" autocomplete="off" />
	<input type="password" name="retypepassword" placeholder="Retype Password" autocomplete="off" />
	<input type="submit" name="signup" value="Sign Up" />
</form>

<?php 
    if($success){
        echo "<script>if (confirm(\"You created an account successfully, please login.\")) { window.location = \"login.php\"; };</script>";
    }else{
        echo "<div class=\"e\">".$error."</div>";
    }
?>

</body>
</html>