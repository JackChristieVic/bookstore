$dyn_table = '<table>';
		
			if ($result){
				//$row_count = mysqli_num_rows($result);
				
				while ($row = mysqli_fetch_array($result)) {
					//print_r($row);
					$book_name = $row['product_name'];
					$book_id = $row['product_id'];
					$book_price = $row['price'];
					$book_cover = $row['product_img_dir'];
					?>
					<form method="post" align="center" style="text-align:center" action="index.php?action=add&id=<?php echo $book_id; ?>" >
					
					<?php
					if ($i % 4 == 0) { // if $i is divisible by our target number (in this case "3")
						$dyn_table .= '<tr><td>' . 
												'<div>' . $book_id . '</div>' .
												'<div>' . $book_name . '</div>' .
												'<div>'. '<img src=' . $book_cover. '>' . '</img>' . '</div>' .
												'<div>' . '$' . $book_price . '</div>' .
												'<input type="text" name="quantity" id="quantity" value="1" />' .
												
												'<input type="submit" name="add_to_cart" value="add to cart" />' .
											'</td>';
					} else {
						$dyn_table .= '<td>' . 
											'<div>' . $book_id . '</div>' .
											'<div class="book_name">' . $book_name . '</div>' .
											'<div>'. '<img src=' . $book_cover. '>' . '</img>' . '</div>' .
											'<div>' . '$' . $book_price . '</div>' .
											'<input type="text" name="quantity" id="quantity" value="1" />' .
											'<input type="submit" name="add_to_cart" value="add to cart" >' .
										'</td>';
					}

					$i++;

					}
					$dyn_table .= '</tr></table>';

					<form method="post" style="text-align:center" action="index-2.php?action=add&id=<?php echo $book_id; ?>" >
                    <div class="products">
                        <img src="<?php echo $book_cover; ?>" class="img-responsive" />
                        <h4 class="text-info"><?php echo  $book_id; ?></h4> 
                        <h4><?php echo  $book_name; ?></h4> 
						<h4><?php echo  $book_price; ?></h4> 
										
                        <input type="text" name="quantity" value="1" />
                        <input type="hidden" name="book_name" value="<?php echo  $book_name; ?>" />
                        <input type="hidden" name="book_price" value="<?php echo  $book_price; ?>" />
                        <input class="btn btn-success" type="submit" name="add_to_cart" value="add to cart" />
                    </div>
                    </form>
                    </div>
