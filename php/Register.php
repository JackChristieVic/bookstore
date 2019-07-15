<!doctype html>
<html lang="en">
	<meta charset="utf-8">
	<head>
		<title>Registration Page</title>
		<link rel="stylesheet" type="text/css" href="../css/register.css">
	</head>

<body>
	<?php 
	require_once('Header.php'); 
	
	require_once('mysqli_connect.php');

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST['submit'])){
			$email = $_POST['email'];
			$user_name = $_POST['user_name'];
			$password_1 = $_POST['password_1'];
			$password_2 = $_POST['password_2'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$msg = "";
			if(!empty($email) || !empty($user_name) || !empty($password_1) ||  !empty($password_2) ||  !empty($first_name) || !empty($last_name) ){
				if($password_1 == $password_2){
					$query = "INSERT INTO `customer` (email, user_name, password_1, password_2, first_name, last_name) 
					  			VALUES ('$email', '$user_name', '$password_1', '$password_2', '$first_name', '$last_name') ";
					$result = mysqli_query($dbc, $query);
				}else{
					$msg = "Passwords don't match, please try again.";
				}
			}else{
				$msg = "Not all fields are fill, please double check and fill out all fields.";
			}
		}
	}
	 ?>

	

	<div class="register_container">
		<form name="registerform" action="Register.php" method="post">
		<div class="row">
			<div class="col-25">
				<label for="email">Email Address</label>
			</div>
			<div class="col-75">
				<input type="email" name="email" placeholder="example@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="email">User Name</label>
			</div>
			<div class="col-75">
				<input type="text" name="user_name" placeholder="enter user name" required>
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="password">Password</label>
			</div>
			<div class="col-75">
				<input type="password" name="password_1" placeholder="Password" minlength=8 maxlength=8 required>
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="password">Confirm Password</label>
			</div>
			<div class="col-75">
				<input type="password" name="password_2" placeholder="Enter password again" minlength=8 maxlength=8 required>
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="first_name">First Name</label>
			</div>
			<div class="col-75">
				<input type="text" name="first_name" placeholder="First Name" required>
			</div>
		</div>

		<div class="row">
			<div class="col-25">
				<label for="last_name">Last Name</label>
			</div>
			<div class="col-75">
				<input type="text" name="last_name" placeholder="Last Name" required>
			</div>
		</div>	

			<div class="row">
				<input type="submit" name="submit" value="Register">
			</div>
		</div>
  	</form>
	</div>
</body>

 <div id="empty_space">
</div>
 <?php include('Footer.php'); ?>
</html>
