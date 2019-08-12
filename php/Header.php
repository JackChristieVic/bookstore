<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>
		<?php // Print the page title.
			if (defined('TITLE')) { // Is the title defined?
				print TITLE;
			} else { // The title is not defined.
			print 'Fake Book Store';
			}
		?>
	</title>
	
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<style> 	
	
	</style>
</head>

	<div class="header-text">
		<h2>Fake Book Store</h2>
		<p>This is a project created by Jack Christie, Information and Computer System Technology program graduate from Camosun College</p>
	</div>
	<nav>
		<ul>
			<li><a href="Index.php">Category Home</a></li>
			<li><a href="Add_book.php">Add Book</a></li>
			<li><a href="cart.php">View Cart</a></li>
			<li><a href="#">Order History</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><a href="About_us.php">About Us</a></li>
			<li><a href="Login.php">Login </a></li>
			<?php // Print the page title.
			//session_start();
			if (isset($_SESSION["user_id"])) { // Is the title defined?
				print "<li><a href=\"Logged_out.php\">Logout</a></li>";
			}
			?>
		</ul>
	</nav>


