<?php 
	session_start();

	if (isset($_COOKIE['UID']) && isset($_SESSION['username'])) {
		$_SESSION['UID'] = $_COOKIE['UID'];
		echo $_SESSION['UID']."<br>";
		echo "Hello ".$_SESSION['username']."!";
	} else {
		echo "<script>if (confirm(\"You didn't login. Please login first.\")) { window.location = \"login.php\"; };</script>";
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
		setcookie('UID', '', time()-(60*60*24*7), '/', NULL, NULL, true);
		session_destroy();
		echo "<script>if (confirm(\"You've already logged out.\")) { window.location = \"index.php\"; };</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping</title>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
	<input type="submit" name="logout" value="Logout" />
</form>

</body>
</html>

