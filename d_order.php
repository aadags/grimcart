<?php session_start();

if($_GET['do']=='save'){

	 save_order();
     unset($_SESSION['order']);
     unset($_SESSION['cart']);
}


function save_order(){

require ("includes/connection.php");
require("source/include/membersite_config.php");
require ("includes/class.library.php");

$cart = new cart();

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

        $name = $_SESSION['order'][0]['custname'];
		$address = $_SESSION['order'][0]['custaddress'];
		$zip = $_SESSION['order'][0]['custzip'];
		$city = $_SESSION['order'][0]['custcity'];
		$state = $_SESSION['order'][0]['custstate'];
		$country = $_SESSION['order'][0]['custcountry'];
		$phone = $_SESSION['order'][0]['custphone'];
		$date = $_SESSION['order'][0]['custdate'];
        $orderno = $_SESSION['order'][0]['c_orderid'];
        $user = $fgmembersite->UserFullName();
        $u_email = $fgmembersite->UserEmail();
        $totalprice = $cart_function->get_order_total();
        $status = "order not yet received";

        $result=mysqli_query($connect->connection, "insert into orders (`order_time`, `id_user`, `cust_fullname`, `cust_email`, `cust_zip`, `cust_state`, `cust_country`, `cust_city`, `cust_address`, `cust_phone`, `ordernumber`, `orderprice`, `status`) values('$date','$user','$name','$u_email','$zip','$state','$country','$city','$address','$phone','$orderno','$totalprice','$status')");


		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$p=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$pid = $cart_function->get_product_name($p);
			$price = $cart_function->get_price($p);
			$psku = $cart_function->get_sku($p);
			$t_price = round(($cart_function->get_price($p))*$q,2);
           	$shipping = round(($cart_function->get_shipment($p))*$q,2);
			$do = mysqli_query($connect->connection, "insert into order_details (`orderidno`, `productid`, `product_sku`, `quantity`, `unitprice`, `total_unit_price`, `shipment`) values ('$orderno','$pid','$psku','$q','$price','$t_price','$shipping')");
            if($do){
               $cart_function->update_stock($p,$q);
            }
        }


         require_once("source/include/class.phpmailer.php");

        $mail             = new PHPMailer(); // defaults to using php "mail()"
		$mbody = "dear ".$fgmembersite->UserFullName().", <br/><p>You order ".$_SESSION['order'][0]['c_orderid']." has been successfully submitted. Your order is under process. Thank you for shopping with us at ".$sitename."<br/></p>";
        $body             = $mbody;
        $body             = eregi_replace("[\]",'',$body);

        //$mail->AddReplyTo("root@localhost.com","root");

		$mail->SetFrom(CONF_GENERAL_EMAIL);

		//$mail->AddReplyTo("root@localhost.com","root");

		$address = $fgmembersite->UserEmail();
		$mail->AddAddress($address, $fgmembersite->UserFullName());

		$mail->Subject    = "Order Successfully Sent";

		$mail->MsgHTML($body);

		 if(!$mail->Send())
        {
            echo "user email not sent!";
        }

         require_once("source/include/class.phpmailer.php");
        $mail1             = new PHPMailer(); // defaults to using php "mail()"

        $mail1->CharSet = 'utf-8';

        $mail1->AddAddress(CONF_NOTIFICATION_EMAIL);

        $mail1->Subject = "New Order: ".$_SESSION['order'][0]['c_orderid'];

        $mail1->SetFrom(CONF_GENERAL_EMAIL);

        $mail1->Body ="A user ordered at ".$sitename."\r\n".
                     "Order number: ".$_SESSION['order'][0]['c_orderid'];

        if(!$mail1->Send())
        {
           echo "admin email not sent!";
        }



       }



?>