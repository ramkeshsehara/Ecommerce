<?php
session_start();
include_once("config.php");
$count=0;

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">

<script>
$(function() {
  // Setup drop down menu
  $('.dropdown-toggle').dropdown();
 
  // Fix input element click problem
  $('.dropdown input, .dropdown label').click(function(e) {
    e.stopPropagation();
  });
});
</script>
</head>
<body style="background-color:#FCFCFC">

	   <div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">				
							<li><a href="index.php">Home</a></li>
							<li class="dropdown">
							<!-- Single button -->
  
  <a class="dropdown-toggle" href="#" data-toggle="dropdown">Cart <strong class="caret"></strong></a>
  <ul class="dropdown-menu">
  
     <!-- View Cart Box Start -->
  
				  <?php
				 
				if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
				{
					echo '<div class="cart-view-table-front" id="view-cart">';
					echo '<h3>Your Shopping Cart</h3>';
					echo '<form method="post" action="cart_update.php">';
					echo '<table width="100%"  cellpadding="6" cellspacing="0">';
					echo '<tbody>';

					$total =0;
					$b = 0;
					foreach ($_SESSION["cart_products"] as $cart_itm)
					{   $count=$count++;
						$product_name = $cart_itm["product_name"];
						$product_qty = $cart_itm["product_qty"];
						$product_price = $cart_itm["product_price"];
						$product_code = $cart_itm["product_code"];
						//$product_color = $cart_itm["product_color"];
						$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
						echo '<tr class="'.$bg_color.'">';
						echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
						echo '<td>'.$product_name.'</td>';
						echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
						echo '</tr>';
						$subtotal = ($product_price * $product_qty);
						$total = ($total + $subtotal);
					}
					echo '<td colspan="4">';
					echo '<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>';
					echo '</td>';
					echo '</tbody>';
					echo '</table>';
					
					$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
					echo '</form>';
					echo '</div>';

				}
				?>

					
  </ul>
                    <!-- View Cart Box End -->
</li>
						
							
							<li><a href="view_cart.php">Checkout</a></li>					
							<li><a href="login/index.php">Login</a></li>		
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Home</a>					
								<ul>
									<li><a href="#">about us</a></li>									
									<li><a href="#">carrer</a></li>
									<li><a href="#">services</a></li>									
								</ul>
							</li>															
							<li><a href="#">Vagetable</a></li>			
							<li><a href="#">Fruits</a>
								<ul>									
									<li><a href="#">Apple</a></li>
									<li><a href="#">Grapes</a></li>
									<li><a href="#">Banana</a></li>
								</ul>
							</li>							
							<li><a href="#">Cloths</a></li>
							<li><a href="#">Best Seller</a></li>
							<li><a href="#">Top Seller</a></li>
						</ul>
					</nav>
				</div>
			</section>
			<section  class="homepage-slider" id="home-slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
							<img src="themes/images/carousel/banner-1.jpg" alt="" />
						</li>
						<li>
							<img src="themes/images/carousel/banner-2.jpg" alt="" />
							<div class="intro">
								<h1>Mid season sale</h1>
								<p><span>Up to 50% Off</span></p>
								<p><span>On selected items online and in stores</span></p>
							</div>
						</li>
					</ul>
				</div>			
			</section>
		</div>	
<h1 align="center">Products </h1>





<!-- Products List Start -->
<?php
$results = $mysqli->query("SELECT product_code, product_name, product_desc, product_img_name, price FROM products ORDER BY id ASC");
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="cart_update.php">
	<div class="product-content"><h3 style="color:azure;">{$obj->product_name}</h3>
	<div class="product-thumb"><img style="width:100px; height:100px;"src="images/{$obj->product_img_name}"></div>
	<div class="product-desc">{$obj->product_desc}</div>
	<div class="product-info">
	Price {$currency}{$obj->price} 
	
	<fieldset>
	
    
	
	<label>
		<span>Quantity</span>
		<input type="text" size="2" style="padding:0px;"maxlength="2" name="product_qty" value="1" />
	</label>
	
	</fieldset>
	<input type="hidden" name="product_code" value="{$obj->product_code}" />
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />
	<div align="center"><button type="submit" class="add_to_cart">Add To Cart</button></div>
	</div></div>
	</form>
	</li>
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>

<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="index.php">Homepage</a></li>  
							<li><a href="#">About Us</a></li>
							<li><a href="#">Contac Us</a></li>
							<li><a href="#">Your Cart</a></li>
							<li><a href="#">Login</a></li>							
						</ul>					
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
					<div class="span5">
						<p class="logo"><img src="themes/images/logo.png" class="site_logo" alt=""></p>
						
						<br/>
						<span class="social_icons">
							<a class="facebook" href="#">Facebook</a>
							<a class="twitter" href="#">Twitter</a>
							<a class="skype" href="#">Skype</a>
							<a class="vimeo" href="#">Vimeo</a>
						</span>
					</div>					
				</div>	
			</section>
			<section id="copyright">
				<span>Copyright 2013 shopper internship.</span>
			</section>    
<!-- Products List End -->


<script src="themes/js/common.js"></script>
		<script src="themes/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(document).ready(function() {
					$('.flexslider').flexslider({
						animation: "fade",
						slideshowSpeed: 4000,
						animationSpeed: 600,
						controlNav: false,
						directionNav: true,
						controlsContainer: ".flex-container" // the container that holds the flexslider
					});
				});
			});
		</script>
</body>
</html>
