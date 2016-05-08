<?php
require('../includes/connection.php');
require_once("../source/include/membersite_config.php");
require_once("../source/include/class.phpmailer.php");
if (isset($_GET['oid']) && isset($_GET['action'])){
	
	if( $_GET['action'] == "confirm%order")
	{
		$oid = $_GET['oid'];
		$h = "order received";
		$result=mysqli_query($connect->connection, "UPDATE `orders` SET `status`='$h' WHERE ordernumber='$oid'");
		if($result){
		$cd = mysqli_query($connect->connection, "SELECT * FROM orders WHERE ordernumber='$oid'");
		$cdr = mysqli_fetch_assoc($cd);
		$custname = $cdr['cust_fullname'];
		$custemail = $cdr['cust_email'];
		
		
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		$mbody = "dear ".$custname.", <br/><p>Your order of order number ".$oid." has been successfully received. Your order is under process. Thank you for shopping with us at ".$sitename."<br/></p>";
        $body             = $mbody;
        $body             = eregi_replace("[\]",'',$body);

        //$mail->AddReplyTo("root@localhost.com","root");

		$mail->SetFrom(CONF_GENERAL_EMAIL);

		//$mail->AddReplyTo("root@localhost.com","root");

		$address = $custemail;
		$mail->AddAddress($address, $custname);

		$mail->Subject    = "Order Successfully Received";

		$mail->MsgHTML($body);
		
		if($mail->Send()) {
		$fgmembersite->RedirectToURL('vieworder.php?id='.$oid);
		}

	}else{
		$fgmembersite->RedirectToURL('myorders.php');}

		
	}
	else if( $_GET['action'] == "confirm%shippment")
	{
		
		if (isset($_POST['confirm']))
	   {
		   
		   
	    $subject = $_POST['sub'];
	    $mbody = $_POST['body'];
	    $track = $_POST['track'];
		$oid = $_GET['oid'];
		$h = "product shipped";
         if($track == "") {
            $o_error = "invalid_tracking_number";
            $fgmembersite->RedirectToURL('vieworder.php?id='.$oid.'&error='.$o_error);
        }

		$result=mysqli_query($connect->connection, "UPDATE `orders` SET `status`='$h',`track_no`='$track' WHERE ordernumber='$oid'");

			if($result)
			{

		   
				$cd = mysqli_query($connect->connection, "SELECT * FROM orders WHERE ordernumber='$oid'");
				$cdr = mysqli_fetch_assoc($cd);
				$custname = $cdr['cust_fullname'];
				$custemail = $cdr['cust_email'];
				
				$mail             = new PHPMailer(); // defaults to using php "mail()"
		
				$body             = $mbody;
				$body             = eregi_replace("[\]",'',$body);

				//$mail->AddReplyTo("root@localhost.com","root");

				$mail->SetFrom(CONF_GENERAL_EMAIL);

				//$mail->AddReplyTo("root@localhost.com","root");

				$address = $custemail;
				$mail->AddAddress($address, $custname);

				$mail->Subject    = $subject;

				$mail->MsgHTML($body);


				if($mail->Send()) {
 				 $fgmembersite->RedirectToURL('vieworder.php?id='.$oid);
				}
		
			}
	   
			
	   }else{
		$fgmembersite->RedirectToURL('myorders.php');}
		
		
	}else {$fgmembersite->RedirectToURL('myorders.php');}
	
	

}else {$fgmembersite->RedirectToURL('myorders.php');}

?>