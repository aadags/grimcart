<?php

$child = array();
$childname = array();
$parent = array();
$urlp = array();
$childcat = array();
$parentname = array();
$c_result = mysqli_query($connect->connection, "SELECT * FROM categories WHERE !parentID=0 ORDER BY categoryID");
while($c_row = mysqli_fetch_assoc($c_result))
{
	$child[] = $c_row['parentID'];
	$childname[] = $c_row['cat_name'];
	$childcat[] = $c_row['categoryID'];
}
$p_result = mysqli_query($connect->connection, "SELECT * FROM categories WHERE parentID=0 ORDER BY categoryID");
while($p_row = mysqli_fetch_assoc($p_result))
{
	$parent[] = $p_row['categoryID'];
	$parentname[] = $p_row['cat_name'];
	$urlp[] = $p_row['urlname'];
}


?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link id="main-css" href="../css/main.css" rel="stylesheet" />
<link rel="STYLESHEET" type="text/css" href="../source/style/fg_membersite.css">
<script src="../Templates/includes/ice/ice.js" type="text/javascript"></script>
<link rel="STYLESHEET" type="text/css" href="../source/style/fg_membersite.css" />
<script type='text/javascript' src='../source/scripts/gen_validatorv31.js'></script>

<!-- TemplateBeginEditable name="head" -->
<meta http-equiv="description" content="">
<meta http-equiv="keywords" content="">
<!-- TemplateEndEditable -->
</head>
<body class="products_results">
<div id="user-menu-wrapper">
<div id="user-menu" class="content">
<ul id="header-menu">
<?PHP
if ($fgmembersite->CheckLogin())

{?>
   <li class="first">Hi,<a id="header-signin" href="index.php"><?php echo $username1; ?></a></li>
   <li class="first"><a id="header-signin" href="index.php">My Account</a></li>
   <li class="first"><a id="header-signin" href="../source/logout.php?redirect_to=<?=$pageurl?>">Logout</a></li>
<?php } ?>
<li class="last"><a id="header-register" href="../cart.php">View Cart</a>
<span class="cartspan">
 <?php
    echo "<b>SHOPPING CART</b><br/>";
 	if(isset($_SESSION['cart'])){
 	  $max=count($_SESSION['cart']); if($max>1) {
      echo $max.' products added<br/>Total: '.CONF_CURRENCY_ID.'&nbsp;'.get_order_total(); }else { echo $max.' product added<br/>Total: '.CONF_CURRENCY_ID.'&nbsp;'.get_order_total(); }
    } else { echo "***Your Cart is Empty***"; }

   ?>
 </span>  </li>
</ul></div>
</div>
<div id="header-wrapper">
<div id="header" class="content">
<div class="logo">
<a href="../home.php"><img src="../images/nyrahbannertop.png" alt="My Store" width="763" height="127" id="header-logo" /></a>
</div>
</div>
</div>
<!-- main menu -->
<div id="top-wrapper">
<div id="top" class="content">
<div id="top-search">
<form id="top-search-form" method="get" action="../search.php" >
<input name="Search" type="submit" value="Search" id="top-search-submit" alt="Search" class="button" />
<input type="text" name="S_ProductName" id="top-search-query" value="" placeholder="Search..." />
</form>
</div>
<ul id="top-menu">
<li><a rel="" target=""><strong>Products</strong></a>
<ul>

<?php
for($e=0; $e< count($parentname);$e++){

?>
<li class="first"><a href="../products.php?index=<?=$urlp[$e]?>&result=<?=$parent[$e]?>" rel="" target=""><strong><?php print $parentname[$e]; ?></strong></a>


<span class="catwrp">
<?php
	for($s=0; $s< count($child);$s++ ){
        if($child[$s]==$parent[$e]){ ?>
<a href="product.php?index=<?=$urlp[$e]?>&result=<?=$childcat[$s]?>" rel="" target=""><strong><?php echo $childname[$s]; ?></strong></a>

<?php }} ?>
</span>
</li>
<?php } ?>

</ul>
</li>
<li class="first"><a href="../topselling.php" rel="" target=""><strong>Top Sellers</strong></a></li>
<li class="first"><a href="../newarrivals.php" rel="" target=""><strong>New Arrivals</strong></a></li>
<li class="first"><a href="../ordertracker.php" rel="" target=""><strong>Order Tracking</strong></a></li>
<li class="first"><a href="../privateorder.php" rel="" target=""><strong>Private Order</strong></a></li>
</li>
</ul>
</div>
</div>
<div id="content-wrapper">
<div id="content" class="content">
<!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">
<p>&nbsp;</p>
<li class="users_profile"><strong>MY ACCOUNT</strong></li>
<ul id="sidebar">
<li class="first"><a href="index.php">My Profile</a></li>
<li class=""><a href="myorders.php">My Orders</a></li>
<li class=""><a href="myprivateorder.php" >My private Orders</a></li>
<li class=""><a href="myreviews.php">My Reviews</a></li>
<li class=""><a href="../cart.php">Shopping Cart</a></li>
<li class="last"><a target="_blank" href="../source/change-pwd.php">Change Password</a></li>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</ul>			</div>
<!-- TemplateBeginEditable name="Content" -->
<div id="page">
<!-- pagination -->
<div class="pagination top">

</div>
</div>