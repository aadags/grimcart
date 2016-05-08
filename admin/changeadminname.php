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
echo "<a href='login sessions/adminlogout.php'>Logout</a>";

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
        
       <h2>My Menu - change admin name</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <?php
	   $admin = $_SESSION['admin'];

	   if (isset($_POST['name']))
	   {
		    $initial = $adfunc->test_input($_POST['ini_name']);
			$new = $adfunc->test_input($_POST['new_name']);
			$c_new = $adfunc->test_input($_POST['c_new_name']);

			$q = mysqli_query($connect->connection, "SELECT * FROM `admin` WHERE `adminname`='$c_new'");
		    $qrw = mysqli_fetch_assoc($q);
		    $pass = $qrw['adminname'];
            $qry = mysqli_query($connect->connection, "SELECT * FROM `admin` WHERE `adminname`='$admin'");
            $qryrw = mysqli_fetch_assoc($qry);
		    $conf = $qryrw['adminname'];
				
			if(!($new == $c_new))
			{
				echo "names do not match!";
			}
			else if(($initial == false) || ($new == false) || ($c_new == false))
			{
				echo "<p>&nbsp;</p>";
				echo "one or more field left blank!";
			}
			else if($new == $pass)
			{
				echo "<p>&nbsp;</p>";
				echo "name already taken!";
			}
            else if(!($initial == $conf))
			{
				echo "<p>&nbsp;</p>";
				echo "wrong username!";
			}
			else
			{
				$sql= mysqli_query($connect->connection, "UPDATE `admin` SET `adminname`='$new' WHERE `adminname`='$admin'");

		    	$query = mysqli_query($connect->connection, "SELECT * FROM `admin` WHERE `adminname`='$admin'");
		        $qrow = mysqli_fetch_assoc($query);

				$dbname = $qrow['adminname'];

				if($dbname == $new){
				echo "<p>&nbsp;</p>";
				echo "name changed successfully"; }
                unset($_SESSION['admin']);
                $_SESSION['admin'] = $new;
			}
			
	   }
	   else
	   {
	   
	   ?>
       
       <legend><b>CHANGE ADMIN NAME</b></legend>
  
      <form id='atc-form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>

       
       <table cellpadding="10" cellspacing="5">
       <tr>
       <td>
       <label for='ini_name' >current name: </label><br/>
       </td>
       <td>
       <input type="text" name='ini_name'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='new_name' >new name: </label><br/>
       </td>
       <td>
       <input type='text' name='new_name'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='c_new_name' >confirm new name: </label><br/>
       </td>
       <td>
       <input type='text' name='c_new_name'  size="20" /><br/>
       </td>
       </tr>
       </table>
        <input type='submit' name='name' value='CHANGE' />
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