<!doctype html>
<html lang="en">
<head>
<head>
	<meta charset="utf-8">
	<?php include('Header.php'); ?>
	<title>Login</title>
</head>

<body>
	<div class="login_container">
	<label for="login_form" ><strong>log in: </strong></label>
	<form name="login_form" action="login.php" method="POST">
		<label for="email">Email Address</label>
			<input type="email" name="email" placeholder="enter email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
		<label for="password">Password</label>
			<input type="password" name="password" placeholder="endter password" minlength=8 maxlength=15 required>
			<input type="submit" name="submit" id="submit" value="Login">
	</form>
	</div>

	<?php
		require('mysqli_connect.php');
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			if( !empty($email) || !empty($password) ){
				$input_email = trim($_POST['email']);
				$input_password = trim($_POST['password']);

				$query = "SELECT email, password FROM customer WHERE email='$email' AND password_1='$input_password' OR password='$input_password'";
				$result = mysqli_query($dbc, $query);

				$row = mysqli_fetch_array($result);
				$db_password = $row['password_1'];
				$db_email = $row['email'];
				
				if($input_email == $db_email && $input_password == $db_password){
					header('Location:Category.php');
				}else{
					header('Location:login.php');
				}  
			}else{
				echo "<h1>enter e-mai and password</h1>";

			}
		}
	?>
	</body>
</html>

<footer>
<div id="empty_space">
</div>
<?php include('Footer.php');?>
</footer>
