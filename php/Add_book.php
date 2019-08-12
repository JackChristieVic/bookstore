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
        $file_directory = '../images/';

        // after the explode() of the file name, check to see if the file type is allowed
        if(in_array($file_actual_extension, $allowed_file_type)){
            if($file_error === 0){
                if($file_size < 5000000){
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
            $upload_message = "Error uploading the file. Please make sure file is of type .jpg.";
            echo "<h1 style='color: red;'>$upload_message</h1>";
        }

        // $genre = $_POST['genre'];
        // echo "<h3>56 - genre: $genre</h3>";
		// Validate the form data:

		if ((!empty($_POST['book_price'])) && (!empty($_POST['book_name'])) && (!empty($_POST['genre'])) && (!empty($file_name))) {
                $book_price = mysqli_real_escape_string($dbc, $_POST['book_price']);
                $book_name = mysqli_real_escape_string($dbc, $_POST['book_name']);
                $img_dir = $file_directory;
                $category = mysqli_real_escape_string($dbc, $_POST['genre']);
                //print '<p style="color: red;">You are good to to</p>';
                if((is_numeric($book_price)) && (file_exists($img_dir))){ 
                    echo "68 - book price: $book_price";
                    # Define the query:
                    $query = "INSERT INTO products(price, product_name, category, product_img_dir)
                        VALUES ('$book_price', '$book_name', '$category','$file_destination')";
                    mysqli_query($dbc, $query);
                    header("Location: index.php"); 
			} else {
				print '<p style="color: red;">Please fill out all fields</p>';
            }
        }
    }
?>

<div class="bookform">
    <h1>Add a book to the website</h1>
        <form action="add_book.php" method="post" enctype="multipart/form-data">
            <p>Book Price:</p>
            <input type="text" name="book_price" >
            
            <p>Book Name:</p>
		    <input type="text" name="book_name">
            
            <!-- <p>Book Img Directory:</p> -->
            <input type="hidden" name="img_dir">

            <p>Select A File</p>
            <input type="file" name="file">
        
            
            <p>Select Book Genre:</p>  
            <div class="custom-select" >
                <select name="genre">
                    <option value="None">Click here to select</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Kids">Kids</option>
                    <option value="Romance">Romance</option>
                    <option value="Comedy">Comedy</option>
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
