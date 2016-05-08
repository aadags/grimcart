<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - edit  product</title>
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
$sku = $_GET['sku'];
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
      
       <h2>My Menu - create product - product gallery upload</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       
	   
	   <?php
 if(isset($_GET['sku'])){
$sku = $_GET['sku'];

if(!empty($_FILES['files'])){
	
    
	$file_name = array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name[$key] = $_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        if($file_size > 2097152){
			$errors='File size must be less than 2 MB';
        }		
        
        $desired_dir="../images/products";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name[$key])==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name[$key]);
            }
			if(is_dir("$desired_dir/".$file_name[$key])==true && !$file_tmp == false){									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name[$key].time();
                 rename($file_tmp,$new_dir) ;		
            }
		 		
	        	
		 
        }else{
                print_r($errors);
        }
    }
	
	if(empty($errors)){
		echo "Successfully uploaded to directory!<br/>";
		$query="UPDATE `products` SET `picture1`='$file_name[0]',`picture2`='$file_name[1]',`picture3`='$file_name[2]',`picture4`='$file_name[3]',`picture5`='$file_name[4]' WHERE `prod_sku`='$sku'; ";
		$sql= mysql_query($query);
				  if($sql)
		           echo "update success!";
		          else
		           echo mysql_error();
		
	}
}
	
else {
echo "file upload size exceeded";}

	   }else {$fgmembersite->RedirectToURL("updateproduct.php");}
?>
<br/><br/><a href="updateproduct.php"><< Edit Product</a>
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