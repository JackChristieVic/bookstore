<?php
session_start();
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
                if($_SESSION["shopping_cart"][$key]["quantity"] <= 1){
                    unset($_SESSION['shopping_cart'][$key]); 
                }else{
                    $_SESSION["shopping_cart"][$key]["quantity"] -= 1;
                }
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
<?php include ('Header.php'); include ('mysqli_connect.php');?>
<body>
    
    <?php
                
    if(!empty($_SESSION['shopping_cart'])){
        $total_cost = 0;
        $total_items = 0;
        foreach($_SESSION['shopping_cart'] as $key => $book){
        $total_items += $book['quantity'];
        }
    } 
    ?>
            </h4>
            <table>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th colspan="3">Adjust Quantity</th> 
                    <th>Total Cost</th>
                </tr>
           
                <?php
                
                if(!empty($_SESSION['shopping_cart'])){
                    $total_cost = 0;
                    $total_items = 0;
                    foreach($_SESSION['shopping_cart'] as $key => $book){
                    ?>
                        <tr>
                            <td><?php echo  $book['id']; ?></td> 
                            <td><?php echo  $book['name']; ?></td> 
                            <td><?php echo  $book['price']; ?></td> 
                            <td><?php echo  $book['quantity']; ?></td>
                            <td><a href="cart.php?action=decrease&id=<?php echo $book['id']; ?>">-</a></td> 
                            <td><a href="cart.php?action=delete&id=<?php echo $book['id']; ?>">x</a></td>
                            <td><a href="cart.php?action=increase&id=<?php echo $book['id']; ?>">+</a></td>
                            <td><?php echo  $book['quantity'] * $book['price']; ?></td>
                        </tr>
                    <?php
                    $total_items += $book['quantity'];
                    $total_cost += ($book['quantity'] * $book['price']);
                    }
                } 
                ?> 
                
                <tr>
                    <td colspan="7" style="text-align: right">Total Cost</td>
                    <td><?php 
                            if(isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0){
                                echo "$" . $total_cost; 
                            }else{
                                $total_cost = 0;
                                echo "$" . $total_cost; 
                            }
                            ?>
                    </td>
                </tr>

                <tr>
                    <?php
                        $action = "";
                        if(isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0){
                            $action = "Check Out";
                        }else{
                            $action = "Nothing to check out";
                        }
                    ?>
                    <td></td>
                    <td colspan="7" style="text-align: right;"><input type="submit" name="check_out" value="<?php echo $action; ?>" ><a href="cart.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                   
                </tr>
                </tbody>
            </table>
           
</body>
<?php include ('Footer.php'); ?>
</html>
