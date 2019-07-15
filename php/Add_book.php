<!doctype html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="default.css">
<?php
	include('Header.php');
?>
<head>
	<meta charset="utf-8">
	<title>Add a book to the database</title>
</head>
<body>

<?php
	//session_start();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Handle the form.

		// Validate the form data:
		$problem = FALSE;
		// connect to the database
		include('mysqli_connect');
                

		if ((!empty($_POST['price'])) && (!empty($_POST['name'])) && (!empty($_POST['img_dir'])) && (!empty($_POST['check_list']))) {
                $price = mysqli_real_escape_string($dbc, $_POST['price']);
                $name = mysqli_real_escape_string($dbc, $_POST['name']);
				$img_dir = mysqli_real_escape_string($dbc, $_POST['img_dir']);
			} else {
				print '<p style="color: red;">Please Fill out all fields</p>';
				$problem = TRUE;
			}
                if((is_numeric($price)) && (file_exists($img_dir))){ 
                    if (!$problem) {
                            # Define the query:
                            $query = "INSERT INTO products(price, product_name, product_img_dir)
								VALUES ('$price', '$name', '$img_dir')";
                            if (mysqli_query($dbc, $query)){
                                $IDquery = "SELECT product_id FROM products WHERE product_name='$name'";
								#fetch the query result from the database
                                $result = mysqli_query($dbc, $IDquery);
								
								#get the content of array "result" from the database
                                $row = mysqli_fetch_array($result);
								
                                $prodID = $row['product_id'];
                                print '<p>Book added successfully</p>';
                                    }
                                    else {
                                        print '<p style="color: red;">Could not add the book because:<br>' .
                                            mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
                                            print ' mysqli_error($dbc)';
                                    }
                            foreach($_POST['check_list'] as $selected){
                                $catID = mysqli_real_escape_string($dbc, $selected);
                                $query2 = "INSERT INTO prod_cat VALUES ($prodID, $catID)";
                                if (mysqli_query($dbc, $query2)){
                                    print '<p>Category added successfully</p>';
                                    }
                                    else {
                                            print '<p style="color: red;">Could not add the book because:<br>' .
                                            mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query2 . '</p>';
                                            print ' mysqli_error($dbc)';
                                    }
                            }
                            mysqli_close($dbc);
                            }
                }
                else {
                    if (!is_numeric($price)){
                        print '<p style="color: red;">Price field must be a number</p>';
                    }
                    if (!file_exists($img_dir)){
                        print '<p style ="color: red;">Directory must point to an existing file</p>';
                    }
                }
		}
?>
<style>
	h1{
		text-align: left;
		padding: 10px 0px 0px 100px;
		/*padding: 10px 20px 5px 20px;*/
		font-family: Arial, Consolas, "Courier New", monospace;
	}
	
	/*p{
		font-size: 20px;
		padding: 0px 0px 0px 100px;
		font-family: Arial, Consolas, "Courier New", monospace;
	}
	*/
	
	
	#bookform, #checkarea{
		text-align: left;
		padding: 0px 0px 0px 100px;
		/*padding: 10px 20px 5px 20px;*/
		font-size: 15px;
		font-family: Arial, Consolas, "Courier New", monospace;
	}
</style>
<h1>Add a book to the database</h1>
<div id="bookform">
        <form action="Add_book.php" method="post">
                <p>Book price:</p>
                <input type="text" name="price">
                <p>Book name:</p>
		<input type="text" name="name">
                <p>Book Img Directory:</p>
		<input type="text" name="img_dir">
                <p>Book genre:</p>
                <div id="checkarea">
                   Fiction: <input type="checkbox" name="check_list[]" value="1">
                   Non-Fiction: <input type="checkbox" name="check_list[]"  value="2">
                   Sci-Fi: <input type="checkbox" name="check_list[]" value="3">
                   Romance: <input type="checkbox" name="check_list[]" value="4">
                   Kids: <input type="checkbox" name="check_list[]" value="5">
                   Comedy: <input type="checkbox" name="check_list[]" value="6">
                </div> 
				<br>
		<input type="submit" name="submit" value="Add book">
	</form>
</div>
</body>
<?php
 include('Footer.php');
?>
</html>
