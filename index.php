<?php 

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['login'])) {
			header("location: login.php");
		} elseif (isset($_POST['signup'])) {
			header("location: signup.php");
		}

	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<input type="submit" name="login" value="Login"/>
	<input type="submit" name="signup" value="Sign up"/>
</form>

</body>
</html>