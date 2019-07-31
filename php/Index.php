<?php
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
        
        //if the id is not the the SESSION variable shopping cart, we add them to the cart
        if(!in_array($_GET['id'], $product_ids)){
            // variable name is 'shopping_cart', data type is array, size is the same as count
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
if (isset($_GET["action"])){
    //echo "48 - $_GET[action]";
    if($_GET['action'] == 'delete'){
        // loop thru shopping cart till it match the id
        foreach($_SESSION['shopping_cart'] as $key => $book){
      
            // $book['id'] is from SESSION variable - shopping_cart, 
            // $_GET['id'] is from the Remove from Cart link the user clicks(this line- href="index.php?action=delete&id=<?php echo $book['id'];)
            if( $book['id'] == $_GET['id']){
                //remove book from shopping cart when matches the GET['id']
                unset($_SESSION['shopping_cart'][$key]); 
            }
        }
        // reset session array keys so that they match with $product_ids keys
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
  
    elseif($_GET['action'] == 'decrease'){
        foreach($_SESSION['shopping_cart'] as $key => $book){
            if( $book['id'] == $_GET['id']){
                // when user clicks "-" sign, decrease quantity in the SESSION by 1
                $_SESSION["shopping_cart"][$key]["quantity"] -= 1;
            }
        }
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
    }
    elseif($_GET['action'] == 'increase'){
        foreach($_SESSION['shopping_cart'] as $key => $book){
            if( $book['id'] == $_GET['id']){
                // when user clicks "+" sign, INCREASE quantity in the SESSION by 1
                $_SESSION["shopping_cart"][$key]["quantity"] += 1;
            }
        }
        $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
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
	
    <link rel="stylesheet" type="text/css" href="../css/cart.css">
</head>

<body>
<?php include ('Header.php'); ?>
    <h3>Books That Are Currently Popular</h3>
    <?php
    $total_cost = 0;
    $total_items = 0;         
    if(!empty($_SESSION['shopping_cart'])){
        foreach($_SESSION['shopping_cart'] as $key => $book){
        $total_items += $book['quantity'];
        }
    }
    ?>
    <table width="75%">
                <tr>
                    <th class="total_item" colspan="6" style="text-align: right; ">
                        <a href="cart.php"><span style="font-size: 25px; color: red;"><?php echo $total_items; ?></span> items in cart</a> 
                    </th>
                </tr>
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
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $num_per_page = 4;
    $start_page = ($page - 1) * 4;
    $query = "SELECT * FROM products limit $start_page, $num_per_page";

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
                    <td width="25%"><?php echo  $book_name; ?></td> 
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
        }
    ?>
    <h4 class="page">
        <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($dbc,$query);
            $row_count = mysqli_num_rows($result);
            $total_pages = ceil($row_count/$num_per_page);
            if($page > 1){
                echo "<button><a href='index.php?page=".($page - 1). "'> << </a></button>";
            }

            for($i = 1; $i < $total_pages; $i++){
                echo "<button><a href='index.php?page=".$i. "'>Page $i</a></button>";
            }

            if($i > $page){
                echo "<button><a href='index.php?page=".($page + 1). "'> >> </a></button>";
            }
        ?>
    </h4>
</body>
<?php include ('Footer.php'); ?>
</html>
