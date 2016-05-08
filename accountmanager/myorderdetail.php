<?php session_start();
/*
  -------------------------------------------------------------------------
      DR webtech's  GRIMCART
              Version 0.1
    This program is free software published under the
    terms of the GNU Lesser General Public License.

    This program is distributed in the hope that it will
    be useful - WITHOUT ANY WARRANTY; without even the
    implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.


	Questions & comments please send to damahrefeay@gmail.com
  -------------------------------------------------------------------------
*/
include ("../includes/connection.php");
require ("../includes/class.library.php");
require_once("../source/include/membersite_config.php");
if(isset($_GET['orderid']))
{

$oid = $_GET['orderid'];
$pageurl = $_SERVER['PHP_SELF'];
$username1 = $fgmembersite->UserFullName();

if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
    exit;
}
$username1 = $fgmembersite->UserFullName();



$title = "My Order(details) -".$fgmembersite->UserName();

include("header.php");


?>

<!-- content -->
<h2>Welcome, <?php  echo $username1;?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My Order details...</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <label class="heading">Ordered Products</label><br/><br/>
       <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#666" width="100%">
            <?php
			$o_det = mysqli_query($connect->connection, "SELECT * FROM order_details WHERE orderidno='$oid'");
            	echo '<tr style="font-weight:bold; color: #fff;"><td>S/N</td><td>Sku</td><td>Name</td><td>Unit Price</td><td>Qty</td><td>Line Total</td></tr>';
	
				$i=0;
				
				while($o_detpn = mysqli_fetch_assoc($o_det)){
			?>
            		<tr bgcolor="#fff">
                    <td><?php echo $i+1 ; $i++ ?></td>
                    <td><?php echo $o_detpn['product_sku']; ?></td>
                    <td><?php echo $o_detpn['productid']; ?></td></td>
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".$o_detpn['unitprice']; ?></td>
                    <td><?php echo $o_detpn['quantity']; ?></td>                    
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".$o_detpn['total_unit_price']; ?></td>
                    </tr>
            <?php } ?>
            </table>
            <?php $q = mysqli_query($connect->connection, "SELECT * FROM orders WHERE ordernumber='$oid'"); ?>
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; color: #fff; font-size:11px; background-color:#666" width="100%">
				<tr><td><b>Order Total:  <?php while($ro = mysqli_fetch_assoc($q)){ echo CONF_CURRENCY_ID."&nbsp;".$ro['orderprice'];} ?></b></td><td colspan="5" align="right"></td></tr></table><br/><br/><br/>
      <label class="heading">Billing Details</label><br/><br/>
<table border="0" style="background:#666; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF;" width="642" align="center" cellpadding="5px" cellspacing="1px">
<tr>
<td><strong>ORDER NO</strong></td>
<td><strong>NAME</strong></td>
<td><strong>ADDRESS</strong></td>
<td><strong>CONTACT</strong></td>
<td><strong>DATE ORDERED</strong></td>
</tr>
<?php
$qd = mysqli_query($connect->connection, "SELECT * FROM orders WHERE ordernumber='$oid'");
while($row_po = mysqli_fetch_assoc($qd)){  ?>
<tr bgcolor="#FFFFFF" style="color:#000">
<td ><?php echo $row_po['ordernumber']; ?></td>
<td height="60"><?php echo $row_po['cust_fullname']; ?></td>
<td>
address: <?php echo $row_po['cust_address']; ?><br/>
city: <?php echo $row_po['cust_city']; ?><br/>
state: <?php echo $row_po['cust_state']; ?><br/>
zip: <?php echo $row_po['cust_zip']; ?><br/>
country: <?php echo $row_po['cust_country']; ?><br/>
</td>
<td><?php echo $row_po['cust_phone']; ?></td>
<td><?php echo $row_po['order_time']; ?></td>
</tr>
<?php } ?>
</table>
<br/><br/>
<label class="heading">Order Status</label><br/><br/>
<?php $bn = mysqli_query($connect->connection, "SELECT status FROM orders WHERE ordernumber='$oid'"); ?>
<font style="color:#F00; margin-left:40px; font-size:25px;"><?php while($w_po = mysqli_fetch_assoc($bn)){ echo $w_po['status'];}?></font>
</div>
    </div>


<!-- footer -->

<?php include("footer.php");

} else {$fgmembersite->RedirectToURL("myorders.php");}

