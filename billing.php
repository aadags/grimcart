<?php session_start();

require ("includes/connection.php");
require ("includes/class.library.php");
require("source/include/membersite_config.php");

$title = "Check-Out Order Form";
$pageurl = $_SERVER['PHP_SELF'];
$billing = new form();

if($billing->GetBilling())
{
  $billing->RedirectToURL('checkout.php');
}


  if(isset($_SESSION['cart']))
    {
        if($fgmembersite->CheckLogin())
        {
        	include("Templates/billing_cart_header_login.php");
        }
        else
        {
	         $fgmembersite->RedirectToURL("source/login.php?redirectpage=".$pageurl);
        }
    }
    else
    {
    	 $fgmembersite->RedirectToURL("cart.php");
    }


?>

<script language="javascript">
	function validate(){
		var f=document.form1;
		if(f.name.value==''){
			alert('Recipient name is required');
			f.name.focus();
			return false;
		}
		else if(f.address.value==''){
			alert('Recipient address is required');
			f.address.focus();
			return false;
		}
		else if(f.zip.value==''){
			alert('Recipient zip is required');
			f.email.focus();
			return false;
		}
		else if(f.city.value==''){
			alert('Recipient city is required');
			f.phone.focus();
			return false;
		}
		else if(f.state.value==''){
			alert('Recipient state is required');
			f.phone.focus();
			return false;
		}
		else if(f.country.value==''){
			alert('Recipient country is required');
			f.phone.focus();
			return false;
		}
		else if(f.phone.value==''){
			alert('Recipient phone number is required');
			f.phone.focus();
			return false;
		}
		f.command.value='update';
		f.submit();
	}
</script>
<link href="css/main.css" rel="stylesheet" type="text/css" />


<form name="form1" id="atc-form" onsubmit="return validate()">
    <input type="hidden" name="command" />
	<div align="left">
        <h1 align="center">Delivery Info</h1>
        <p>&nbsp;</p>
        <p><b>Provide your receiving personel/party details and address.</b></p>
        <p><b>Please provide accurate details in the below form so as to ensure delivery of your goods</b></p>
        <p>&nbsp;</p>
        <?php if(isset($_SESSION['order'])){  ?>
        <table border="0" cellpadding="10px" style="background-color:#B7E0EE">
            <tr><td><b>Recipient's Fullname:</b></td><td><input type="text" name="name" value="<?php echo $_SESSION['order'][0]['custname']; ?>" /></td></tr>
            <tr><td><b>Address:</b></td><td><textarea type="text" name="address"><?php echo $_SESSION['order'][0]['custaddress']; ?></textarea></td></tr>
            <tr><td><b>Postal Code/Zip:</b></td><td><input type="text" name="zip" value="<?php echo $_SESSION['order'][0]['custzip']; ?>" /></td></tr>
            <tr><td><b>City:</b></td><td><input type="text" name="city" value="<?php echo $_SESSION['order'][0]['custcity']; ?>" /></td></tr>
            <tr><td><b>State/Region:</b></td><td><input type="text" name="state" value="<?php echo $_SESSION['order'][0]['custstate']; ?>" /></td></tr>
            <tr><td><b>Country:</b></td><td><input type="text" name="country" value="<?php echo $_SESSION['order'][0]['custcountry']; ?>" /></td></tr>
            <tr><td><b>Phone number:</b></td><td><input type="text" name="phone" value="<?php echo $_SESSION['order'][0]['custphone']; ?>" /></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" class="cart-checkout" value="Check Out" /></td></tr>
        </table>
        <?php } else {  ?>
        <table border="0" cellpadding="10px" style="background-color:#B7E0EE">
            <tr><td><b>Recipient's Fullname:</b></td><td><input type="text" name="name" /></td></tr>
            <tr><td><b>Address:</b></td><td><textarea type="text" name="address"></textarea></td></tr>
            <tr><td><b>Postal Code/Zip:</b></td><td><input type="text" name="zip" /></td></tr>
            <tr><td><b>City:</b></td><td><input type="text" name="city" /></td></tr>
            <tr><td><b>State/Region:</b></td><td><input type="text" name="state" /></td></tr>
            <tr><td><b>Country:</b></td><td><input type="text" name="country" /></td></tr>
            <tr><td><b>Phone number:</b></td><td><input type="text" name="phone" /></td></tr>
            <tr><td>&nbsp;</td><td><input type="submit" class="cart-checkout" value="Check Out" /></td></tr>
        </table>
        <?php } ?>
	</div>
</form>
		 
<p>&nbsp;</p>


</div>
<?php include("Templates/footer.php"); ?>
