<?php
session_start();
$product_ids = array();
//session_destroy();
if(isset($_POST['add_to_cart'])){
	if(isset($_SESSION['shopping_cart'])){
		// track how many products in cart
		$count = count($_SESSION['shopping_cart']);

		// matching product_id in cart and in product_id array
		$product_ids = array_column($_SESSION['shopping_cart'], 'id');

		if(!in_array($_GET['id'])){
			$_SESSION['shopping_cart'][$count] = array(
				'id' => $_GET['id'],
				'name' => $_GET['name'],
				'price' => $_GET['price'],
				'quantity' => $_GET['quantity']
			);
		}else{
			// match array key to id of products being added to the cart
			for($i = 0; $i < count($php_errormsg); $i++){
				if($product_ids[$i] == $_GET['ID']){
					// add item quantity to the existing products in the array
					$_SESSION['shopping_cart'][$i]['quantity'] += $_GET['quantity'];
				}
			}
		}
	}else{
		//if shopping cart doesn't exists yet, creeate SESSION named shopping cart
		$_SESSION['shopping_cart'][0] = array(
			'id' => $_GET['id'],
			'id' => $_GET['name'],
			'id' => $_GET['price'],
			'id' => $_GET['quantity']
		);
	}
}
print_r($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>View by Genre</title>
	
	<?php include ('Header.php'); ?>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>

<body>
<h1 align="center">View by Genre</h1>
	<form action="index.php?action=add&id=<?php echo $ID;  ?>" method="post" align="center">
		<select align="center" name="select_genre" >		
			<p align="center">Select a genre: </p>
      		<option name="All" value="All">All</option>
			<option name="Fiction" value="Fiction">Fiction</option>
			<option name="Non-Fiction" value="Non-Fiction">Non-Fiction</option>
			<option name="Sci-Fi" value="Sci-Fi">Sci-Fi</option>
			<option name="Romance" value="Romance">Romance</option>
      		<option name="Kids" value="Kids">Kids</option>
      		<option name="Comedy" value="Comedy">Comedy</option>
		</select>
		<input align="center" type="submit" name="submit" value="Select Genre">
		<br>
	</form>

	<table>
		<tr>
			<th width="5%"><strong>Book ID</strong></th>
			<th width="30%"><strong>Book Name</strong></th>
			<th width="10%"><strong>Price</strong></th>
			<th width="10%"><strong>Book Cover</strong></th>
			<th width="10%"></strong>Actions<strong></th>
		</tr>

		<?php
		
		include ('mysqli_connect.php');
		if(isset($_POST['submit'])){
			$category = $_POST['select_genre'];  // Storing Selected Value In Variable
			
			if ($category == "All" || $category == ""){
				$query = 'SELECT * FROM products';
			}else{
				$query = "SELECT product_id, product_name, product_img_dir, price
						FROM products
						WHERE category LIKE '$category'";
			}

			$result = mysqli_query($dbc,$query);
		
			if ($result){
				$row_count = mysqli_num_rows($result);
				
				while ($row = mysqli_fetch_array($result)) {
					$name = $row['product_name'];
					$ID = $row['product_id'];
					$price = $row['price'];
					$img_dir = $row['product_img_dir'];
					print "<tr style=\"text-align:center\">";
					print "<td>$ID</td>";
					print "<td >$name</td>";
					print "<td>&dollar;$price</td>";
					print "<td><img src=\"$img_dir\" height=150 width=100></img></td>";
					print "<td><input type=\"submit\" name='add_to_cart' value='add to cart' >";
					print "</tr>";
					}
				}
			}
		mysqli_close($dbc);
	?>
	</table>
<br>
<br>
<?php include ('Footer.php'); ?>
</body>
</html>
