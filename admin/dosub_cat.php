<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - manage category</title>
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

?>
	<p>&nbsp;</p>
     <!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">
<p>&nbsp;</p>
<li class="first"><a href="adminhome.php">My Menu</a></li>
<li class="first"><a href="myaccount.php">My Products</a></li>
<li class="first"><a href="myaccount.php">My Orders</a></li>
<li class="first"><a href="myaccount.php">My Private Orders</a></li>
<li class="first"><a href="myaccount.php">My Password</a></li>
</ul>			</div>
		<hr align="center" noshade="noshade" size="2" width="100%">
        
       <h2>My Menu - edit categories</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <?php 
	   if(isset($_POST['subcat1']))
        {
			$catname = $adfunc->test_input($_POST['categoryname']);
			$idcat = $adfunc->test_input($_POST['catid']);
			if($catname == false)
                    {
                       echo "<p style='color:#F00'><strong>category name empty!</strong></p>";
                    }
					else 
                    {
                     $sql = mysqli_query($connect->connection, "UPDATE `categories` SET `cat_name`='$catname' WHERE `categoryID`=$idcat");
	  			
			             if ($sql)
			                 {				
			                     echo "<p style='color:#F00'><strong>Category successfully saved!</strong><p>";				
			                 }
				         else
				             {				
				              	die("Not saved!");
				             }
					}
		}
		else
		{
	   
      if(isset($_POST['subcat']))
        {
			$catid = $adfunc->test_input($_POST['scategory']);
			$getm = mysqli_query($connect->connection, "SELECT * FROM categories WHERE categoryID='$catid'");
			while ($getmcat = mysqli_fetch_assoc($getm))
            {
			$mcatname = $getmcat['cat_name'];
			}
				?>
                	
			   <form enctype="multipart/form-data" id='atc-form' action='<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       
       <b style="color:#F00">required field*</b>
       <input type='hidden' name='submitted' id='submitted' value='1'/>
       
       <table cellpadding="10" cellspacing="5">
        
         <tr>
         <td>
      
       <label for='categoryname' >Main Category Name<b style="color:#F00">*</b>: </label><br/>
       </td>
       <td>
       <input value="<?php echo $mcatname; ?>" type='text' name='categoryname' id='categoryname' maxlength="50" /><br/>    
       </td>
       </tr>
        
       <tr>
       <td>
       <input type="hidden" name="catid" value="<?php echo $catid; ?>"  />
       <input type='submit' name="subcat1"  value='SAVE' />
       </td>
      
       </tr>
       </table>
       </form>
            
            <?php
		}
      
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