
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
                    <td colspan="8" style="text-align: right;"><input type="submit" name="check_out" value="<?php echo $action; ?>" ><a href="cart.php"></td>
                </tr>
                </tbody>
            </table>  