<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - delete product</title>
<script src="../Templates/includes/ice/ice.js" type="text/javascript"></script> 
<link href="../css/main.css" rel="stylesheet" type="text/css" />
</head>
<body class="products_results">	
<div id="user-menu-wrapper">
<div id="user-menu" class="content">
<ul id="header-menu">

</ul></div>
</div>
<div id="header-wrapper">
<div id="header" class="content">
<div class="logo">
<img src="../images/nyrahlogoreal.png" alt="My Store" width="227" height="110" id="header-logo" />
</div>
</div>
</div>
<div id="content-wrapper" >
  
  <div id="content" class="content">



<?php
require('../includes/connection.php');
require_once("../source/include/membersite_config.php");
session_start();

if ($_SESSION['admin'])
    {
?>

<!-- content -->
<div align="center" id="content">
<h1>ADMIN PAGE</h1>
<?php 
echo "<h2>".$_SESSION['admin']."!</h2><a href='login sessions/adminlogout.php'>Logout</a>";}
else
    
$fgmembersite->RedirectToURL('login sessions/adminlogin.php');


?>
	<p>&nbsp;</p>
     <!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">
<p>&nbsp;</p>
<li class="first"><a href="adminhome.php">My Menu</a></li>
<li class="first"><a href="myproducts.php">My Products</a></li>
<li class="first"><a href="myorders.php">My Orders</a></li>
<li class="first"><a href="private_order.php">My Private Orders</a></li>
<li class="first"><a href="adminpass.php">My Password</a></li>
</ul>			</div>
		<hr align="center" noshade="noshade" size="2" width="100%">
        
       <h2>My Menu - edit product</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <?php
 if (isset($_POST['delproduct']))
{
	$prod_id = $_POST['prodname'];
	$sql = mysqli_query($connect->connection, "DELETE FROM `products` WHERE `productID`='$prod_id'");
	if($sql)
	echo "successfully deleted";
}
?>

    
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
</div>
<!-- footer -->
<div id="footer-wrapper">
<div id="footer" class="content">

<p align="center"> © 2014 <?php echo $sitename; ?>. All Rights Reserved. </p>
</div>
</div>
</body>
</html>