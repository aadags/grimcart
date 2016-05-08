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
require_once("../source/include/membersite_config.php");
require ("../includes/functions.php");
$pageurl = $_SERVER['PHP_SELF'];


if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
    exit;
}
$username1 = $fgmembersite->UserFullName();

$title = "My Orders -".$fgmembersite->UserName();

include("header.php");

?>

<!-- content -->
<h2>Welcome, <?php  echo $username1;?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My Orders ...</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">

<table border="0" style="background:#666; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF;" width="642" align="center" cellpadding="5px" cellspacing="1px">
<tr>
<td><strong>ORDER NO</strong></td>
<td><strong>PRODUCT(S) NAMES</strong></td>
<td><strong>TOTAL PRICE</strong></td>
<td><strong>DATE ORDERED</strong></td>
<td><strong>OPTION</strong></td>
</tr>
<?php
$q = mysqli_query($connect->connection, "SELECT * FROM orders WHERE id_user='$username1'");
while($row_p = mysqli_fetch_assoc($q)){
$oid = $row_p['ordernumber']; ?>
<tr bgcolor="#FFFFFF" style="color:#000">
<td ><?php echo $row_p['ordernumber']; ?></td>
<?php
$o_det = mysqli_query($connect->connection, "SELECT * FROM order_details WHERE orderidno='$oid'");
?>

<td height="60"><?php while($o_detpn = mysqli_fetch_assoc($o_det)){ echo $o_detpn['productid'].",&nbsp;";} echo ".....";?></td>
<td><?php echo CONF_CURRENCY_ID."&nbsp;".$row_p['orderprice']; ?></td>
<td><?php echo $row_p['order_time']; ?></td>
<td><a href="myorderdetail.php?orderid=<?php echo $oid; ?>">view details</a></td>
</tr>
<?php } ?>
</table>

</div>
    </div>
    
  
<!-- footer -->
<?php include("footer.php");  ?>