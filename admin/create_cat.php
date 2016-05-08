<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - create category</title>
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
require('../includes/class.library.php');
require_once("../source/include/membersite_config.php");
session_start();

$adfunc = new functions();

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
$cat = mysqli_query($connect->connection, "SELECT `categoryID`, `cat_name` FROM categories WHERE parentID=0");
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

       <h2>My Menu - create category</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
        <?php

		if(isset($_POST['maincat']))
        {
			$mcat = $adfunc->test_input($_POST['mcategoryname']);
			$url = $adfunc->test_input($_POST['urlname']);
			$idparent = 0;
			if ($url == false)
			{
				echo "url cannot be null....remember to use a related word to the categoryname without spacing..example: Books,Pencil----books&pencil.";
			}
			else if ($mcat == false)
			{
				echo "please supply a category  name";
			}
			else{
			 $urln = strtolower($url);
			 $sql = mysqli_query($connect->connection, "INSERT INTO `categories`"."(`cat_name`, `parentID`, `urlname`)". "VALUES ('$mcat','$idparent','$urln')");
			 if($sql)
			 {
				 echo "category created successfully";
			 }

			}

		}



		if(isset($_POST['subcat']))
        {
			$catid = $adfunc->test_input($_POST['category']);
			$subcat = $adfunc->test_input($_POST['subcategoryname']);


			if ($subcat == false)
			{
				echo "please supply a subcategory  name";
			}
			else{
			 $sql = mysqli_query($connect->connection, "INSERT INTO `categories`"."(`cat_name`, `parentID`)". "VALUES ('$subcat','$catid')");
			 if($sql)
			 {
				 echo "subcategory created successfully";
			 }

			}
		}




       if(isset($_POST['Submit']))
{
	$cattype = $_POST['categorytype'];

	if ($cattype == "main category")
	{


	?>
        <form enctype="multipart/form-data" id='atc-form' action='<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       <b style="color:#03F">hint--(urlname) the codename for the category name..but with no spaces and slashes. e.g Videos/Audio---videos&audio</b><br/>
       <b style="color:#F00">required field*</b>
       <input type='hidden' name='submitted' id='submitted' value='1'/>

       <table cellpadding="10" cellspacing="5">

       <tr>
       <td>
       <label for='categorytype' >Category Type:</label><br/>
       </td>
       <td>
       <input disabled="disabled" type='text' name='categorytype' value="<?php echo $cattype; ?>" id='categorytype'  /><br/>
       </td>
       </tr>
         <tr>
         <td>

       <label for='mcategoryname' >Main Category Name<b style="color:#F00">*</b>: </label><br/>
       </td>
       <td>
       <input type='text' name='mcategoryname' id='mcategoryname' maxlength="50" /><br/>
       </td>
       </tr>
         <tr>
         <td>

       <label for='urlname' >Url Name<b style="color:#F00">*</b>: </label><br/>
       </td>
       <td>
       <input type='text' name='urlname' id='mcategoryname' maxlength="50" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <input type='submit' name="maincat"  value='CREATE' />
       </td>
       <td></td>
       </tr>
       </table>
       </form>
      <?php

	  }if ($cattype == "sub-category")
     	{

		?>


      <form enctype="multipart/form-data" id='atc-form' action='<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>

       <input type='hidden' name='submitted' id='submitted' value='1'/>

       <table cellpadding="10" cellspacing="5">

       <tr>
       <td>
       <label for='categorytype' >Category Type:</label><br/>
       </td>
       <td>
       <input disabled="disabled" type='text' name='categorytype' value="<?php echo $cattype; ?>" id='categorytype'  /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='category' >Category:</label><br/>
       </td>
       <td>
       <select name="category">
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

       <label for='subcategoryname' >Sub-category Name: </label><br/>
       </td>
       <td>
       <input type='text' name='subcategoryname' id='subcategoryname' maxlength="50" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <input type='submit' name="subcat"  value='CREATE' />
       </td>
       <td></td>
       </tr>
       </table>
       </form>


		<?php }}else{ ?>

       <form enctype="multipart/form-data" id='atc-form' action='<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>

       <input type='hidden' name='submitted' id='submitted' value='1'/>

       <table cellpadding="10" cellspacing="5">

       <tr>
       <td>
       <label for='categorytype' >Category Type:</label><br/>
       </td>
       <td>
       <select name="categorytype">

       <option value="main category">main category</option>
       <option value="sub-category">sub-category</option>

       </select>
       </td>
       </tr>

       <tr>
       <td>
       <input type='submit' name="Submit"  value='CREATE' />
       </td>
       <td></td>
       </tr>
       </table>
     </form>
   <?php } ?>
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