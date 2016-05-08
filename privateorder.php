
<?php  session_start();
require ("includes/connection.php");
require ("includes/class.library.php");
require_once("source/include/membersite_config.php");

$private_order = new form();

$private_order->GetConnection($connect->connection);

$private_order->GetPrivateOrder();

$title = "Private Order";
$pageurl = $_SERVER['PHP_SELF'];
if($fgmembersite->CheckLogin())
{
	include("Templates/product_header_login.php");  
}
else
{
	  include("Templates/product_header_default.php");
}

?>
 <link rel="STYLESHEET" type="text/css" href="source/style/fg_membersite.css" />
 <link id="main-css" href="css/main.css" rel="stylesheet" />
<!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">			</div>



  <p>
    <?php 
  

   if(!$fgmembersite->CheckLogin())
{
	echo "<center>";
   echo"<p>you must be logged in to make this order!</p>";
	echo"<p><a href='source/login.php?redirectpage=".$pageurl."'>LOGIN NOW</a> if you have already have an account</p>";
	echo"<p>Or you can <a href='source/register.php'>REGISTER NOW</a> if you are a new customer</p>";
echo "</center>"; ?>
 <p>&nbsp;</p>
  <p>&nbsp;</p>
   <p>&nbsp;</p>
    <p>&nbsp;</p>
     <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>

      <?php
  }
else
{


?>
    <!-- Form Code Start -->
 <p>&nbsp;</p>
  <font style="color:#F00"><?php echo $private_order->showError(); ?></font>
<div id="atc-form" class="multi-form">
<form name="p_order" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
<fieldset>
<legend><strong>Private Order Form</strong></legend>

<table>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='username' value='<?php echo $fgmembersite->UserFullName(); ?>'/>
<h5 style="color:#F00">*all fields required</h5>
<tr>
<div class="container">
<td>Product Name* :</td>
<td><input type="text" name="ordername"><br/></td>
</div>
</tr>
<tr>
<div class="container">
<td>Product Specifications* :</td>
<td><textarea  name="orderspec" rows="4" cols="33"></textarea></td>

</div>
</tr>
</table>
<div class="container">
<input class="button" type="submit" name="Submit" value="Submit" >
</div>
</fieldset>
</form>
</div>

 <p>&nbsp;</p>
  <p>&nbsp;</p>
  <?php }
?>
  </div>
<?php include("Templates/footer.php"); ?>