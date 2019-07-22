<?php

//https://www.youtube.com/watch?v=jrSFQ195L-I
//https://www.youtube.com/watch?v=YvXaKDnHKVk
session_start();
$product_ids = array();
//session_destroy();
if(isset($_POST['add_to_cart'])){
	
	if(isset($_SESSION['shopping_cart'])){
		//echo "<h2>8 - SESSION[shopping_cart] is set</h2>";
		
		// track how many products in cart
		$count = count($_SESSION['shopping_cart']);

		// matching product_id in cart and in product_id array
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        //pre_r($product_ids);
        
        //if the id is not the the SESSION variable shopping cart, we add them to the cart
        if(!in_array($_GET['id'], $product_ids)){
            $_SESSION['shopping_cart'][$count] = array(
                'id' => $_GET['id'],
                'name' => $_POST['book_name'],
                'price' => $_POST['book_price'],
                'quantity' => $_POST['quantity']
            );
        }else{
            for($i = 0; $i < count($product_ids); $i++){
                // if the product is in cart, update quantity
                if($product_ids[$i] == $_GET['id']){
                    $_SESSION['shopping_cart'][$i]['quantity'] += $_POST['quantity'];
                }
            }
        }
	}else{
		//if shopping cart doesn't exists yet, creeate SESSION named shopping cart
		//echo "<h3>33 - creating session variable shoppting cart</h3>";
		$_SESSION['shopping_cart'][0] = array(
			'id' => $_GET['id'],
			'name' => $_POST['book_name'],
			'price' => $_POST['book_price'],
			'quantity' => $_POST['quantity']
	
		);
	}
}
//pre_r($_SESSION);

function pre_r($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    
	<title>View by Genre</title>
	
	<?php include ('Header.php'); ?>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <style>
        thead {
            position: relative;
        }
        table, td {
            border-collapse: collapse;
            background-color: white;
            text-align: center;
            background-color:none;
            border-bottom: 1px solid #3697F1 ;
            padding: 8px;
			font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            height: 20px;
        }
        
        tr{
            height: 50px;
        }
        table {
            width: 75%;
        }
        input[type=submit] {
            background-color: grey ;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        input[type=text] {
            border: 2px solid grey;
            text-align: center;
            width: 40%;
            padding: 10px;
            margin: 15px 0;
            box-sizing: border-box;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        h3 {
            font-size: 25px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }
        button {
            position: left;
            width: 138%;
            font-size: 15px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            background-color: lightblue;
        }
    </style>
</head>

<body>
  
    <h3>Books That Are Currently Popular</h3>	
    <table width="75%">
     
                <tr>
                    <th width="5%">Book ID Number</th>
                    <th width="25%">Book Cover</th>
                    <th width="20%">Book Name</th>
                    <th width="10%">Price</th>
                    <th width="10%">Quantity</th>
                    <th>Action</th>
                </tr>
   
    </table>    
    <?php
    include ('mysqli_connect.php');
    $query = 'SELECT * FROM products WHERE product_id < 5';

    $result = mysqli_query($dbc,$query);
    $row_count = mysqli_num_rows($result);
    if ($result){
        if($row_count > 0){
            while ($row = mysqli_fetch_assoc($result)) {
                $book_name = $row['product_name'];
                $book_id = $row['product_id'];
                $book_price = $row['price'];
                $book_cover = $row['product_img_dir'];
                ?>
                <form width="60%" method="post" style="text-align:center" action="index.php?action=add&id=<?php echo $book_id; ?>" >
                
                <table width="75%">

                
                    <tr>
                        <td width="5%"><?php echo  $book_id; ?></td> 
                        <td width="25%"><img style="width:100px" src="<?php echo $book_cover; ?>" /></td>
                        <td width="20%" style="text-align: left"><?php echo  $book_name; ?></td> 
                        <td width="10%"><?php echo  $book_price; ?></td> 
                        <td width="10%"><input width="5%" type="text" name="quantity" value="1" /><td>
                        <input type="submit" name="add_to_cart" value="Purchase" />
                        <input type="hidden" name="book_name" value="<?php echo  $book_name; ?>" />
                        <input type="hidden" name="book_price" value="<?php echo  $book_price; ?>" />	
                    </tr>	
                    	
                </table>
            </form>
                <?php
                }
            }
            
            ?>
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Price</th>
                  
                    <th>Quantity</th>
                   
                    <th>Total</th>
                    <th>Action</th>
                    
                </tr>
           
                <?php
                if(!empty($_SESSION['shopping_cart'])){
                    $total = 0;
                    foreach($_SESSION['shopping_cart'] as $key => $book){
                    ?>
                        <tr>
                            <td><?php echo  $book['name']; ?></td> 
                            <td><?php echo  $book['price']; ?></td> 
                            <td><?php echo  $book['quantity']; ?></td>
                            <td> <?php echo  $book['quantity'] * $book['price']; ?></td>
                            <td><a href="index.php?action=delete&id=".<?php echo  $book['id']; ?>>Delete</td>
                        </tr>
                    <?php
                    }
                    $total = $total + ($book['quantity'] * $book['price']);
                } 
                ?>

                <tr>
                    <td colspan="3" style="text-align: right">Total</td>
                    <td ><?php echo "$" .$total; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3" ></td>
                    <?php
                        if(isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0){
                    ?>
                    <td><button><a href="#">Check Out All Books</button></td>
                    <td></td>
                    <?php
                    }
                    ?>

                </tr>
                </tbody>
            </table>  
            
    <?php
        }
    ?>

</body>
<?php include ('Footer.php'); ?>
</html>
