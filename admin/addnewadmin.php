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
$admin_form = new form();
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
        
       <h2>My Menu - Add new admin</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       NOTE: all admins have full priviledges including add and deleting of other admins.<br/><br/>
       <?php
	   
	   
	   if (isset($_POST['addnewadmin']))
	   {
		    $adminname = $admin_form->test_input($_POST['nadminname']);
			$nw = $admin_form->test_input($_POST['nadminpass']);
			$c_nw = $admin_form->test_input($_POST['cadminpass']);
            $new = md5($nw);
            $c_new = md5($c_nw);

			if(!($new == $c_new))
			{
				echo "<p>&nbsp;</p>";
				echo "passwords do not match";
			}
			else if(($adminname == false) || ($new == false) || ($c_new == false))
			{
				echo "<p>&nbsp;</p>";
				echo "one or more field left blank";
			}
			else
			{
			
			$q = mysqli_query($connect->connection, "INSERT INTO `admin`"."(`adminname`, `adminpass`)". "VALUES ('$adminname','$new')");
		    if ($q)
			{
				?>
                 <legend><b>ADD NEW ADMIN</b></legend><br/><br/>
                 
                 <?php echo "admin successfully added"; ?>
                 
  
      <form id='atc-form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       
       
       <table cellpadding="10" cellspacing="5">
       <tr>
       <td>
       <label for='nadminname' >new admin name: </label><br/>
       </td>
       <td>
       <input type="text" name='nadminname'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='nadminpass' >new password: </label><br/>
       </td>
       <td>
       <input type='password' name='nadminpass'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='cadminpass' >confirm password: </label><br/>
       </td>
       <td>
       <input type='password' name='cadminpass'  size="20" /><br/>
       </td>
       </tr>
       </table>
        <input type='submit' name='addnewadmin' value='ADD ADMIN' />
        </form>
                <?php
			} 
			else { echo "cannot save new admin";}
			
			}
			
	   }
	   else
	   {
	   
	   ?>
       
       <legend><b>ADD NEW ADMIN</b></legend>
  
      <form id='atc-form' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       
       
       <table cellpadding="10" cellspacing="5">
       <tr>
       <td>
       <label for='nadminname' >new admin name: </label><br/>
       </td>
       <td>
       <input type="text" name='nadminname'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='nadminpass' >new password: </label><br/>
       </td>
       <td>
       <input type='password' name='nadminpass'  size="20" /><br/>
       </td>
       </tr>
       <tr>
       <td>
       <label for='cadminpass' >confirm password: </label><br/>
       </td>
       <td>
       <input type='password' name='cadminpass'  size="20" /><br/>
       </td>
       </tr>
       </table>
        <input type='submit' name='addnewadmin' value='ADD ADMIN' />
        </form>
        <?php } ?>
<p>&nbsp;</p>
<p>&nbsp;</p>  
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