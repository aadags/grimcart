<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>admin - mypassword</title>
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
echo "<h2>".$_SESSION['admin']."!</h2><a href='login sessions/adminlogout.php'>Logout</a>";

}
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
        
       <h2>My Menu - change password</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <?php
	   $admin = $_SESSION['admin'];
	   
	   if (isset($_POST['password']))
	   {
		    $ini = $adfunc->test_input($_POST['ini_pass']);
			$nw = $adfunc->test_input($_POST['new_pass']);
			$c_nw = $adfunc->test_input($_POST['c_new_pass']);
            $initial = md5($ini);
            $new = md5($nw);
            $c_new = md5($c_nw);
			$q = mysqli_query($connect->connection, "SELECT * FROM `admin` WHERE `adminname`='$admin'");
		    	while($qrw = mysqli_fetch_assoc($q))
			    {
				   $pass = $qrw['adminpass'];
			    }

				
			if(!($new == $c_new))
			{
				echo "passwords do not match!";
			}
			else if(($initial == false) || ($new == false) || ($c_new == false))
			{
				echo "<p>&nbsp;</p>";
				echo "one or more field left blank!";
			}
			else if(!($initial == $pass))
			{
				echo "<p>&nbsp;</p>";
				echo "wrong user password!";
			}
			else
			{
				$sql= mysqli_query($connect->connection, "UPDATE `admin` SET `adminpass`='$new' WHERE `adminname`='$admin'");

		    	$query = mysqli_query($connect->connection, "SELECT * FROM `admin` WHERE `adminname`='$admin'");
		    	while($qrow = mysqli_fetch_assoc($query))
			    {
				   $dbpass = $qrow['adminpass'];
			    }
				if($dbpass == $new)
				echo "<p>&nbsp;</p>";
				echo "password changed successfully";
								
			}
			
	   }
	   else
	   {
	   
	   ?>
       
       <legend><b>CHANGE ADMIN PASSWORD</b></legend>
  
      <form id='atc-form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       
       
       <table cellpadding="10" cellspacing="5">
       <tr>
       <td>
       <label for='ini_pass' >current password: </label><br/>
       </td>
       <td>
       <input type="password" name='ini_pass'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='new_pass' >new password: </label><br/>
       </td>
       <td>
       <input type='password' name='new_pass'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='c_new_pass' >confirm new password: </label><br/>
       </td>
       <td>
       <input type='password' name='c_new_pass'  size="20" /><br/>
       </td>
       </tr>
       </table>
        <input type='submit' name='password' value='CHANGE' />
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