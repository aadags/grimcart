<?php  session_start();
require ("includes/connection.php");
require ("includes/class.library.php");
require_once("source/include/membersite_config.php");

$title = "Order Tracker";

$pageurl = $_SERVER['PHP_SELF'];

$track_order = new form();

$track_order->GetConnection($connect->connection);

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

if($fgmembersite->CheckLogin())
{
	include("Templates/product_header_login.php");
}
else
{
	  include("Templates/product_header_default.php");
}

?>
 <link rel="STYLESHEET" type="text/css" href="source/style/fg_membersite.css" />
 <link id="main-css" href="css/main.css" rel="stylesheet" />
<!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">			</div>


<?php

if($track_order->trackOrder())
     {
        $do = mysqli_query($connect->connection, "SELECT * FROM orders WHERE cust_email='$cust_email' AND ordernumber='$order_id'");
        $dorow = mysqli_fetch_assoc($do);
?>


            <label class="heading">Billing Details</label><br/><br/>
<table border="0" style="background:#666; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF;" width="642" align="center" cellpadding="5px" cellspacing="1px">
<tr>
<td><strong>ORDER NO</strong></td>
<td><strong>NAME</strong></td>
<td><strong>ADDRESS</strong></td>
<td><strong>CONTACT</strong></td>
<td><strong>DATE ORDERED</strong></td>
</tr>
<tr bgcolor="#FFFFFF" style="color:#000">
<td ><?php echo $dorow['ordernumber']; ?></td>
<td height="60"><?php echo $dorow['cust_fullname']; ?></td>
<td>
address: <?php echo $dorow['cust_address']; ?><br/>
city: <?php echo $dorow['cust_city']; ?><br/>
state: <?php echo $dorow['cust_state']; ?><br/>
zip: <?php echo $dorow['cust_zip']; ?><br/>
country: <?php echo $dorow['cust_country']; ?><br/>
</td>
<td><?php echo $dorow['cust_phone']; ?></td>
<td><?php echo $dorow['order_time']; ?></td>
</tr>
</table>
<br/><br/>
<label class="heading">Order Status</label><br/><br/>
<font style="color:#F00; margin-left:40px; font-size:25px;"><?php echo $dorow['status']; ?></font> <br/>
<?php if($dorow['status'] == "product shipped"){
?>
  <br/><br/>
<label class="heading">Tracking Number</label><br/><br/>
<font style="color:#F00; margin-left:40px; font-size:25px;"><?php echo $dorow['track_no']; ?></font> <br/>
  <?php
  }
  }
else
{

?>
    <!-- Form Code Start -->
 <p>&nbsp;</p>

 <span class="error"><?php echo $track_order->showError(); ?></span>
<div id="atc-form" class="multi-form">
<form name="p_order" action="<?php echo $fgmembersite->GetSelfScript(); ?>" method="get" >
<fieldset>
<legend><strong>TRACK YOUR ORDERS...</strong></legend>
<table cellspacing="10px">
<h5 style="color:#F00">*all fields required</h5>
<tr>
<div class="container">
<td>Email<font style="color:#F00">*</font> :</td>
<td><input type="text" name="email"><br/></td>
</div>
</tr>
<tr>
<div class="container">
<td>Order Number<font style="color:#F00">*</font> :</td>
<td><input type="text" name="ordernumber"><br/></td>

</div>
</tr>
</table>
<div class="container">
<input class="button" type="submit" name="getorder" value="ENQUIRE" >
</div>
</fieldset>
</form>
</div>

 <p>&nbsp;</p>
  <p>&nbsp;</p>

  <?php } ?>

<p>&nbsp;</p>
  <p>&nbsp;</p><p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
<?php include("Templates/footer.php"); ?>