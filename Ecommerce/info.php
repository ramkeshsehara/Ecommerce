<?php
 $fname=$_POST['first_name'];
 $lname=$_POST['last_name'];
 $contact=$_POST['mobile'];
 $email=$_POST['email']; 
 $location=$_POST['location'];
 $state_name=$_POST['state_name']; 
 $country=$_POST['country'];
 $pincode=$_POST['pincode'];
 $address1=$_POST['address1'];
 $address2=$_POST['address2'];
 
$admin_email='ug201310026@iitj.ac.in';


session_start();
include_once("config.php");

//$sql = "INSERT INTO customer (FirstName, LastName,Email,Phone_Number,Location,StateName,Country,Pincode,Permanent-Address,Taddress)
//VALUES ('$fname', '$lname', '$email','$contact','$state_name','$country','$pincode','$address1','$address2')";
/*
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/

	 $Body="";
	 if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
			{
				$total =0;
				
				$subtotal = 0;
				foreach ($_SESSION["cart_products"] as $cart_itm)
				{   //$count=$count++;
				    $product_name = $cart_itm["product_name"];
					$product_qty = $cart_itm["product_qty"];
					$product_price = $cart_itm["product_price"];
					$product_code = $cart_itm["product_code"];
					
					$Body .= $product_name."\n";
					$Body .= $product_qty."\n";
					$Body .= $product_price."\n";
					$Body .= $product_code."\n";
					
					$Body .= ($product_price * $product_qty)."\n";
					$Body .= ($total + $subtotal)."\n";
				}	

			}
		

$to_customer = $email; 
	$email_subject = "Info-Tech item order receipt ";
	$email_body = "Thank you ! Dear $fname for trust on us ".
	" Here are the details of your item:".
	"$Body".
		
"Thanks \n".
" Regards\n".
"info tech Team \n".
"IIT Jodhpur \n".

	$admin_email_body = " Here are the details of item:".
	"$Body".
		
"Thanks \n".
" Regards\n".
"info tech Team \n".
"IIT Jodhpur \n".

	
	$headers = "From: $admin_email\n"; 
	$headers .= "Reply-To: $admin_email";
	
	mail($to_customer,$email_subject,$email_body,$headers);
	
	mail($admin_email,$email_subject,$admin_email_body);
	
	echo "Thanku You sir for trust on us ";
	
	$_SESSION = array();

header("Location: register_thanks.html");

 ?> 