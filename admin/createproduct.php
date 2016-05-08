<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - create product</title>
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
$cat = mysqli_query($connect->connection, "SELECT `categoryID`, `cat_name` FROM categories WHERE !parentID=0");
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
        
       <h2>My Menu - create product</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
 
       <form enctype="multipart/form-data" id='atc-form' action='upload.php' method='post' accept-charset='UTF-8'>
       
       <input type='hidden' name='submitted' id='submitted' value='1'/>
       
       <table cellpadding="10" cellspacing="5">
       <tr>
       <td>
       <label for='productname' >Product name: </label><br/>
       </td>
       <td>
       <textarea type='text' name='productname' id='productname' cols="20" rows="2"></textarea><br/>
       
       </td>
       </tr>
       <tr>
       <td>
       <label for='prod_desc' >Product description:</label><br/>
       </td>
       <td>
       <textarea type='text' name='prod_desc' id='prod_desc' ma rows="3" cols="20"></textarea><br/>**Important! not more than 5 words.
      
       </td>
       </tr>
       <tr>
       <td>
       <label for='prod_spec' >product specfication:</label><br/>
       </td>
       <td>
       <textarea type='text' name='prod_spec' id='prod_spec' rows="3" cols="20"></textarea><br/>
       
       </td>
       </tr>
       <tr>
       <td>
       <label for='price' >Price:</label><br/>
       </td>
       <td>
       <?php echo CONF_CURRENCY_ID; ?><input type='text' value="0.00" name='price' id='price' size="4" /><br/>

       </td>
       </tr>
       <tr>
       <td>
       <label for='listprice' >List Price:</label><br/>
       </td>
       <td>
       <?php echo CONF_CURRENCY_ID; ?><input type='text' value="0.00" name='listprice' id='listprice' size="4" /><br/>
       
       </td>
       </tr>
       <tr>
       <td>
       <label for='shipprice' >Shipping Fee/Product:</label><br/>
       </td>
       <td>
       <?php echo CONF_CURRENCY_ID; ?><input type='text' value="0.00" name='shipprice' id='price' size="4" /><br/>

       </td>
       </tr>
        <tr>
       <td>
       <label for='stock' >Amount in Stock:</label><br/>
       </td>
       <td>
       <input type='text' name='stock' id='stock' size="3" /><br/>
       
       </td>
       </tr>
        <tr>
       <td>
       <label for='prod_sku' >Prod_sku:</label><br/>
       </td>
       <td>
       <input type='text' name='prod_sku' id='prod_sku' maxlength="50" /><br/>
       
       </td>
       </tr>
        <tr>
       <td>
       <label for='categoryid' >Category:</label><br/>
       </td>
       <td>
       <select name="categoryid">
       <?php 
	   while($catshow = mysqli_fetch_assoc($cat)){
	   ?>
       <option value="<?php echo $catshow['categoryID']; ?>"><?php echo $catshow['cat_name']; ?></option>
       <?php } ?>
       </select>
       </td>
       </tr>
        <tr>
       <td>
       <label for='thumbnail' >Thumbnail:</label><br/>
       </td>
       <td>
       <input type="file" name='thumbnail' /><br/>
       
       </td>
       </tr>
        
       <tr>
       <td>
       <input type='submit'  value='CREATE' />
       </td>
       <td></td>
       </tr>
       </table>
     </form>
   
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