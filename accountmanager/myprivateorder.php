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
include ("../includes/class.library.php");

require_once("../source/include/membersite_config.php");
$pageurl = $_SERVER['PHP_SELF'];
$username1 = $fgmembersite->UserFullName();

if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
    exit;
}


$title = "My Private Orders -".$fgmembersite->UserName();

include("header.php");
?>

<!-- content -->
<h2>Welcome, <?php  echo $username1;?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My private order list...</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">

<table border="0" style="background:#666; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF;" width="642" height="112" align="center" cellpadding="5px" cellspacing="1px">
<tr>
<td><strong>ORDER NO</strong></td>
<td><strong>PRODUCT NAME</strong></td>
<td><strong>PRODUCT SPECIFICATIONS</strong></td>
<td><strong>DATE ORDERED</strong></td>

</tr>
<?php
$q = mysqli_query($connect->connection, "SELECT * FROM private_order WHERE username='$username1' ORDER BY p_orderID ASC");
while($row_p = mysqli_fetch_assoc($q)){ ?>
<tr bgcolor="#FFFFFF" style="color:#000">
<td><?php echo $row_p['p_ordernumber']; ?></td>
<td height="60"><strong><?php echo $row_p['ordername']; ?></strong></td>
<td><?php echo $row_p['orderspec']; ?></td>
<td><?php echo $row_p['orderdate']; ?></td>
</tr>
<?php } ?>
</table>

</div>
    </div>


<!-- footer -->
<?php include("footer.php"); ?>