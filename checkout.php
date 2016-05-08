<?php session_start();
require ("includes/connection.php");
require ("includes/class.library.php");
require("source/include/membersite_config.php");

$cart = new cart();

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=cart.php");
    exit;
}

$title = "Checkout";

$pageurl = $_SERVER['PHP_SELF'];
$username1 = $fgmembersite->UserFullName();
$oid = $_SESSION['order'][0]['c_orderid'];


    if( isset($_SESSION['order']))
    {
        if($fgmembersite->CheckLogin())
        {
        	include("Templates/billing_cart_header_login.php");
        }
        else
        {
	         $fgmembersite->RedirectToURL("source/login.php?redirectpage=".$pageurl);
        }
    }
    else
    {
    	 $fgmembersite->RedirectToURL("cart.php");
    }


?>
<script type="text/javascript" src="rating/jquery.min.js"></script>
<script type="text/javascript" src="js/order.js"></script>
<!-- content -->
<h1 align="center">Order Info</h1>
        <p>&nbsp;</p>
	<div align="center" id="content">

       <label class="heading">Ordered Products</label><br/><br/>
       <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#666" width="100%">
            <?php
            $ot = $cart_function->get_order_total();
            $st = $cart_function->get_shipping_total();
            $totalorder = $ot+$st;
            	echo '<tr style="font-weight:bold; color: #fff;"><td>S/N</td><td>Sku</td><td>Name</td><td>Unit Price</td><td>Qty</td><td>Line Total</td><td>Shipping Fees</td></tr>';
			   $max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$p=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$pid = $cart_function->get_product_name($p);
			$price = $cart_function->get_price($p);
			$psku = $cart_function->get_sku($p);
			$t_price = round(($cart_function->get_price($p))*$q,2);
           	$shipping = round(($cart_function->get_shipment($p))*$q,2);
			?>
            		<tr bgcolor="#fff">
                    <td><?php echo $i+1 ; ?></td>
                    <td><?php echo $psku ?></td>
                    <td><?php echo $pid; ?></td></td>
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".$price; ?></td>
                    <td><?php echo $q; ?></td>
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".$t_price; ?></td>
                     <td><?php echo CONF_CURRENCY_ID."&nbsp;".$shipping; ?></td>
                    </tr>
            <?php } ?>
            </table>
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; color: #fff; font-size:11px; background-color:#666" width="100%">
				<tr><td><b>Order Total: <?php echo CONF_CURRENCY_ID."&nbsp;".$cart_function->get_order_total(); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Shipping Fees: <?php echo CONF_CURRENCY_ID."&nbsp;".$cart_function->get_shipping_total(); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Grand Total: <?php echo CONF_CURRENCY_ID."&nbsp;".$totalorder; ?></b></td><td colspan="5" align="right"></td></tr></table><br/><br/><br/>
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
<td ><?php echo $_SESSION['order'][0]['c_orderid']; ?></td>
<td height="60"><?php echo $_SESSION['order'][0]['custname']; ?></td>
<td>
address: <?php echo $_SESSION['order'][0]['custaddress']; ?><br/>
city: <?php echo $_SESSION['order'][0]['custcity']; ?><br/>
state: <?php echo $_SESSION['order'][0]['custstate']; ?><br/>
zip: <?php echo $_SESSION['order'][0]['custzip']; ?><br/>
country: <?php echo $_SESSION['order'][0]['custcountry']; ?><br/>
</td>
<td><?php echo $_SESSION['order'][0]['custphone']; ?></td>
<td><?php echo $_SESSION['order'][0]['custdate']; ?></td>
</tr>
</table>
<br/><br/>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="<?php echo CONF_PAYPAL_EMAIL; ?>">
<?php
 $max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$p=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$pid = $cart_function->get_product_name($p);
			$t_price = round(($cart_function->get_price($p))*$q,2);
           	$shipping = round(($cart_function->get_shipment($p))*$q,2);
            $v = $i+1;
?>
<input type="hidden" name="item_name_<?php echo $v; ?>" value="<?php echo $pid; ?>">
<input type="hidden" name="amount_<?php echo $v; ?>" value="<?php echo $t_price; ?>">
<input type="hidden" name="shipping_<?php echo $v; ?>" value="<?php echo $shipping; ?>">
<?php } ?>
<table>
<tr>
<td><input id="paypal" class="button" type="submit" value="Checkout with Paypal"></td>
<td><a class="button" href="cancelorder.php">Cancel Order</a></td>
</tr>
</table>
</form>

</div>
    </div>
    
  
<!-- footer -->
<div id="footer-wrapper">
<div id="footer" class="content">
<ul><table width="760" height="100" align="center">
  <tr>
    <td align="center" width="253">Policy & Info</a></td>
    <td align="center" width="253">Customer Service</td>
    <td align="center" width="253">Best Buys</td>
    <td align="center" width="234">Help & Assitance</a></td>
  </tr>
  <tr>
    <td align="center"><a rel="" target="_blank" href="#">About Us</a></td>
    <td align="center"><a rel="" target="_blank" href="../privateorder.php">Private Order</a></td>
    <td align="center"><a rel="" target="_blank" href="#">Deals</a></td>
    <td align="center"><a rel="" target="_blank" href="#">Contact Us</a></td> 
  </tr>
  <tr>
    <td align="center"><a rel="" target="_blank" href="../privacy.html">Privacy Statement</a></td>
    <td align="center"><a rel="" target="_blank" href="#">Shipping</a></td>
    <td align="center"><a rel="" target="_blank" href="#">Prices</a></td>
    <td align="center"><a rel="" target="_blank" href="#">Site Map</a></td>
  </tr>
  <tr>
    <td align="center"><a rel="" target="_blank" href="../FAQ.php">FAQ</a></td>
    <td></td>
    <td></td>
    <td align="center"><a rel="" target="_blank" href="#">Term of Use</a></td>
    </tr>
</table>
</ul>
<ul>
<p> © 2013 <a href="../home.php"><?php echo $sitename; ?></a>. All Rights Reserved. </p>
</ul>
</div>
</div>
<!-- TemplateBeginEditable name="end" --><!-- TemplateEndEditable -->
</body>
</html>

