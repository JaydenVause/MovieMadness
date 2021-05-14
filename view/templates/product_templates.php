<?php 
					// populate with products into container
					function echo_products($array_of_products){
						
						$array = '<ul class="container--ibox__ul">';
						foreach ($array_of_products as $product) {
							if(isset($_SESSION['user'])){
							$string =
								
								 '<a href="view/update_product.php?product_id='.$product['productID'].'" class="button">Update</a>'.
								 
								 '<form action="controller/delete_product_controller.php" method="POST">'.
								 '<input type="hidden" value="'. $product['productID'] . '" name="productID" />'.
								 '<input class="button" type="submit" value="Delete" />'.
				
								 '</form>';
						}else{
							$string = '';
						}
						
						$array .= "<li class='ul__li--ibox'>" .
								 
								 '<div class="container--item">' .
								 '<img alt="product image" src="'.substr($product['img'], 3).'">'.
								 '</div>' .
								 '<div style="display: flex; justify-content: space-around;">'.
								 $string.
								 '</div>'.

								 '</li>';
						}
						$array .= '</ul>';
						return $array;
					}

					// echo container for products scroll
					function echo_products_container($array_of_products, $title){
						$array = echo_products($array_of_products);
						$html = <<<EOT
								<div  class="container--idisplay">
									<h2 class="h2 h2--light">$title</h2>
									<div class="container container--ibox">
										<i class="fas fa-caret-left next-arrow next-arrow--left"></i>			
										<i class="fas fa-caret-right next-arrow next-arrow--right"></i>
										$array	
									</div>
								</div>
						EOT;
						echo $html;
					}


					

					
					
?>