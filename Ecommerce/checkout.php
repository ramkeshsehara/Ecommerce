<?php
session_start();
include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
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
		                                      <style>
												.form-group
												{
												float:left;
												width:50%;
												}
												
												</style>
		
		                                     <script>
											 function check()
											 {
											 if(document.getElementById("reg").checked)
											 {
											      //alert(10);
												  window.location="login/index.php";
											 }
											 else
											 {
											   $(document).ready(function(){
                                               $('#user_detail').trigger('click');
                                                   });
											 }
											 }
											 </script>
		
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>		
		
		<div id="wrapper" class="container">
						
			
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
				{   //$count=$count++;
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

</li>
						
							
							<li><a href="view_cart.php">View Cart</a></li>					
							<li><a id="login" href="login/index.php">Login</a></li>		
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.html" class="logo pull-left"><img src="themes/images/logo.png" class="site_logo" alt=""></a>
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="index.php">Home</a>					
								<ul>
									<li><a href="./products.html">Lacinia nibh</a></li>									
									<li><a href="./products.html">Eget molestie</a></li>
									<li><a href="./products.html">Varius purus</a></li>									
								</ul>
							</li>															
							<li><a href="./products.html">Man</a></li>			
							<li><a href="./products.html">Sport</a>
								<ul>									
									<li><a href="./products.html">Gifts and Tech</a></li>
									<li><a href="./products.html">Ties and Hats</a></li>
									<li><a href="./products.html">Cold Weather</a></li>
								</ul>
							</li>							
							<li><a href="./products.html">Hangbag</a></li>
							<li><a href="./products.html">Best Seller</a></li>
							<li><a href="./products.html">Top Seller</a></li>
						</ul>
					</nav>
				</div>
			</section>	
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Checkout Options</a>
								</div>
								<div id="collapseOne" class="accordion-body in collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span6">
												<h4>New Customer</h4>
												<p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
												<form action="#" method="post">
													<fieldset>
														<label class="radio" for="register">
															<input type="radio" name="account" value="register" id="reg" checked="checked">Register Account
														</label>
														<label class="radio" for="guest">
															<input type="radio" name="account" value="guest" id="guest">Guest Checkout
														</label>
														<br>
														<button class="btn btn-inverse" onclick="javascript:check()" data-toggle="collapse" data-parent="#collapse2">Continue</button>
													</fieldset>
												</form>
											 </div>
											
											 <div class="span6">
												<h4>Returning Customer</h4>
												<p>I am a returning customer</p>
												<form action="#" method="post">
													<fieldset>
														<div class="control-group">
															<label class="control-label">Username</label>
															<div class="controls">
																<input type="text" placeholder="Enter your username" id="username" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Password</label>
															<div class="controls">
															<input type="password" placeholder="Enter your password" id="password" class="input-xlarge">
															</div>
														</div>
														<button class="btn btn-inverse">Continue</button>
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" id="user_detail" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Account &amp; Billing Details</a>
								</div>
								<div id="collapseTwo" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span12">
												<h4 style="text-align:center">Address and Personal Details</h4>
												
												<form class="form" action="info.php" method="post" id="registrationForm">
												
													  <div class="form-group" style="float"> 
														  <div class="col-xs-6">
															  <label for="first_name"><h4>First name</h4></label>
															  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any." required>
														  </div>
													  </div>
													  <div class="form-group">
														  
														  <div class="col-xs-6">
															<label for="last_name"><h4>Last name</h4></label>
															  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
														  </div>
													  </div>
										    
													  <div class="form-group">
														  <div class="col-xs-6">
															 <label for="mobile"><h4>Mobile *</h4></label>
															  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any." required>
														  </div>
													  </div>
													  
													  <div class="form-group">
														  <div class="col-xs-6">
															 <label for="email"><h4>Email *</h4></label>
															  <input type="email" class="form-control" name="email" id="email" placeholder="enter your email" title="enter your mobile number if any." required>
														  </div>
													  </div>
													  
													  <div class="form-group">
														  
														  <div class="col-xs-6">
															  <label for="location"><h4>Location/City *</h4></label>
															  <input type="text" class="form-control" name="location" placeholder="somewhere" title="enter your location" required>
														  </div>
													  </div>
													  <div class="form-group">
														  
														  <div class="col-xs-6">
															  <label for="state_name"><h4>State *</h4></label>
															  <input type="text" class="form-control" name="state_name" id="state_name" placeholder="enter your state name" title="enter your state name" required>
														  </div>
													  </div>
													  <div class="form-group">
														  
														  <div class="col-xs-6">
															<label for="country"><h4>Country *</h4></label>
															  <input type="text" class="form-control" name="country" id="country" placeholder="Enter Your country" title="Enter Your State" required>
														  </div>
													  </div>
													  
													  <div class="form-group">
														  
														  <div class="col-xs-6">
															<label for="country"><h4>Pin code *</h4></label>
															  <input type="text" class="form-control" name="pincode" id="country" placeholder="Enter Your pin code" title="Enter Your State" required>
														  </div>
													  </div>
													  
													   <div class="form-group">
														  
														  <div class="col-xs-6">
															<label for="country"><h4>Address 1 *</h4></label>
															  <input type="text" class="form-control" name="address1" id="country" placeholder="Enter Your permanent address" title="Enter Your State" required>
														  </div>
													  </div>
													  
													   <div class="form-group">
														  
														  <div class="col-xs-6">
															<label for="country"><h4>Address 2 </h4></label>
															  <input type="text" class="form-control" name="address2" id="country" placeholder="Enter Your address" title="Enter Your State" >
														  </div>
													  </div>
													  
											           <div class="form-group">
														   <div class="col-xs-12" style="padding-bottom:10%;">
																<br>
																<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
																<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
															</div>
													  </div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Confirm Order</a>
								</div>
								<div id="collapseThree" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="control-group">
												<label for="textarea" class="control-label">Comments</label>
												<div class="controls">
													<textarea rows="3" id="textarea" class="span12"></textarea>
												</div>
											</div>									
											<button class="btn btn-inverse pull-right">Confirm order</button>
										</div>
									</div>
								</div>
							</div>
						</div>				
					</div>
				</div>
			</section>			
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.html">Homepage</a></li>  
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>							
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
						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
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
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>