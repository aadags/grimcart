<?php session_start();
require ("includes/connection.php");
require ("includes/class.library.php");
require_once("source/include/membersite_config.php");

$title = "Shopping Cart";


if($fgmembersite->CheckLogin())
{
	include("Templates/cart_header_login.php");
}
else
{
	  include("Templates/cart_header_default.php");
}

 $cart = new cart();


 if(!$cart->assign_cart())
 {
   echo $cart->viewError();
 }

 $cart_function = new functions();
 
 $cart_function->GetConnection($connect->connection);

?>

<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<p>&nbsp;</p>
<form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
<div style="margin:0px auto; width:600px;" >
    <div style="padding-bottom:10px">
    	<h1 align="center">Your Shopping Cart</h1>
    <input type="button" class="button" value="Continue Shopping" onclick="window.location='home.php'" />
    </div>
    	
    	
    	<?php
	
			if(isset($_SESSION['cart'])){ ?>
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
            <?php
            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>S/N</td><td>Sku</td><td>Name</td><td>Price</td><td>Qty</td><td>Line Total</td><td>Options</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname= $cart_function->get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF"><td><?php echo $i+1 ;?></td><td><?php echo $cart_function->get_sku($pid); ;?></td><td><?php echo $pname;?></td>
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".$cart_function->get_price($pid); ?></td>
                    <td><input type="text" name="product<?php echo $pid;?>" value="<?php echo $q;?>" maxlength="3" size="2" /></td>                    
                    <td><?php echo CONF_CURRENCY_ID."&nbsp;".round(($cart_function->get_price($pid))*$q,2); ?></td>
                    <td><a href="javascript:del(<?php echo $pid; ?>)">Remove</a></td></tr>
            <?php					
				}
			?>
            </table>
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
				<tr><td><b>Order Total: <?php echo CONF_CURRENCY_ID."&nbsp;".$cart_function->get_order_total();?></b></td><td colspan="5" align="right"><input type="button" value="Clear Cart" onclick="clear_cart()"><input type="button" value="Update Cart" onclick="update_cart()"><input type="button" value="Place Order" onclick="window.location='billing.php'"></td></tr></table>
			<?php
            }
			else{
				echo "<table><tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td></tr></table>";
			}
		?>   
    </div>
</form>				 
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
<?php include("Templates/footer.php");  ?>
