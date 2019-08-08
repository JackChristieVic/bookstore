<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Add a book to the website</title>
    <link rel="stylesheet" type="text/css" href="../css/add.css">
</head>

<body>
    <?php
    include('Header.php');
    include('mysqli_connect.php');
	//session_start();
    if (isset($_POST['submit'])) { // Handle the form.
        $file = $_FILES['file'];
        $file_name = $_FILES['file']['name'];
        $file_tmp_name = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_type = $_FILES['file']['type'];

        // split file extension from full file name by .
        // after the explode(), we get an array
        $file_extension = explode('.', $file_name);

        // get the file extension and convert it to lower case
        $file_actual_extension = strtolower(end($file_extension));
        
        // only allow these file types
        $allowed_file_type = array('jpg', 'jpeg','png');
        $upload_message = '';
        $file_directory = '/Applications/XAMPP/xamppfiles/htdocs/bookstore/images/';

        if(in_array($file_actual_extension, $allowed_file_type)){
            if($file_error === 0){
                if($file_size < 5000000){
                    //$file_new_name = uniqid('', true) . "." . $file_actual_extension;
                    $file_destination = $file_directory . $file_name;
                    move_uploaded_file($file_tmp_name, $file_destination);
                    $upload_message = 'File is successfully loaded';
                    echo "<h1 style='color: red;'>$upload_message</h1>"; 
                }else{
                    $upload_message = 'File is too big to upload.';
                    echo "<h1 style='color: red;'>$upload_message</h1>"; 
                }
            }else{
                $upload_message = "There was an error uploading your file.";
                echo "<h1 style='color: red;'>$upload_message</h1>"; 
            }
        }else{
            $upload_message = "You cannot upload the file of this type.";
            echo "<h1 style='color: red;'>$upload_message</h1>";
        }

		// Validate the form data:
		$problem = FALSE;

		if ((!empty($_POST['price'])) && (!empty($_POST['name'])) && (!$file_error === 0)) {
                $book_price = mysqli_real_escape_string($dbc, $_POST['book_price']);
                $book_name = mysqli_real_escape_string($dbc, $_POST['book_name']);
				$img_dir = $file_directory;
			} else {
				print '<p style="color: red;">Please Fill out all fields</p>';
				$problem = TRUE;
			}
        //         if((is_numeric($price)) && (file_exists($img_dir))){ 
        //             if (!$problem) {
        //                     # Define the query:
        //                     $query = "INSERT INTO products(price, product_name, product_img_dir)
		// 						VALUES ('$price', '$name', '$img_dir')";
        //                     if (mysqli_query($dbc, $query)){
        //                         $IDquery = "SELECT product_id FROM products WHERE product_name='$name'";
		// 						#fetch the query result from the database
        //                         $result = mysqli_query($dbc, $IDquery);
								
		// 						#get the content of array "result" from the database
        //                         $row = mysqli_fetch_array($result);
								
        //                         $prodID = $row['product_id'];
        //                         print '<p>Book added successfully</p>';
        //                             }
        //                             else {
        //                                 print '<p style="color: red;">Could not add the book because:<br>' .
        //                                     mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
        //                                     print ' mysqli_error($dbc)';
        //                             }
        //                     foreach($_POST['check_list'] as $selected){
        //                         $catID = mysqli_real_escape_string($dbc, $selected);
        //                         $query2 = "INSERT INTO prod_cat VALUES ($prodID, $catID)";
        //                         if (mysqli_query($dbc, $query2)){
        //                             print '<p>Category added successfully</p>';
        //                             }
        //                             else {
        //                                     print '<p style="color: red;">Could not add the book because:<br>' .
        //                                     mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query2 . '</p>';
        //                                     print ' mysqli_error($dbc)';
        //                             }
        //                     }
        //                     mysqli_close($dbc);
        //                     }
        //         }
        //         else {
        //             if (!is_numeric($price)){
        //                 print '<p style="color: red;">Price field must be a number</p>';
        //             }
        //             if (!file_exists($img_dir)){
        //                 print '<p style ="color: red;">Directory must point to an existing file</p>';
        //             }
        //         }
		}
?>

<div class="bookform">
    <h1>Add a book to the website</h1>
        <form action="Add_book.php" method="post" enctype="multipart/form-data">
            <p>Book Price:</p>
            <input type="text" name="book_price">
            
            <p>Book Name:</p>
		    <input type="text" name="book_name">
            
            <!-- <p>Book Img Directory:</p> -->
            <input type="hidden" name="img_dir">

            <p>Select A File</p>
            <input type="file" name="file">
            
            <p>Select Book Genre:</p>  
            <div class="custom-select" >
                <select>
                    <option value="0">Click here to select</option>
                    <option value="1">Non-Fiction</option>
                    <option value="2">Fiction</option>
                    <option value="3">Sci-Fi</option>
                    <option value="4">Kids</option>
                    <option value="5">Romance</option>
                    <option value="6">Comedy</option>
                </select>
            </div>
            
		<input type="submit" name="submit" value="Submit">
	</form>
</div>
</body>
<?php
 include('Footer.php');
?>
</html>
