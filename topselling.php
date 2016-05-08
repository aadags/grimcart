<?php session_start();
require ("includes/connection.php");
require ("includes/class.library.php");

$cart = new cart();

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

$cart->addProductToCart();

$per_page = CONF_PRODUCTS_PER_PAGE;
$pqy = mysqli_query($connect->connection, "SELECT COUNT(*) AS NumberOfProducts FROM products WHERE counter>1 ORDER BY productID");
$pqyrw = mysqli_fetch_assoc($pqy);
$pages_query = $pqyrw['NumberOfProducts'];

$pages = ceil($pages_query/ $per_page);

$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;



$title = "Top Selling Products";
?>


<?php
require_once("source/include/membersite_config.php");
if($fgmembersite->CheckLogin())
{
	include("Templates/product_header_login.php");
}
else
{
	  include("Templates/product_header_default.php");
}

?>
<script type="text/javascript">
function addtocart(pid){
	    document.form1.productid.value =  pid;
		document.form1.submit();	
	}
						 
</script>
<form name="form1" >
	<input type="hidden" name="productid" />
</form>
<?php echo "<b>".strtoupper($title)."</b>&nbsp; >>"; ?>
<!-- sidebar -->
<div id="sidebar">
<ul id="side-menu">

</ul>			</div>
<!-- TemplateBeginEditable name="Content" -->
<div id="page">
<!-- pagination -->
<div class="pagination top">
<div class="pages"> Page: <a class="selected"><?php echo $page; ?></a>&nbsp;of &nbsp;<?php echo $pages; ?></div>
</div>

<!-- content -->
<?php

$query = mysqli_query($connect->connection, "SELECT * FROM products WHERE counter>1 ORDER BY counter DESC LIMIT $start, $per_page");

while ($queryrow = mysqli_fetch_assoc($query))
{
    $p_id = $queryrow['categoryID'];
	$do = mysqli_query($connect->connection, "SELECT * FROM categories WHERE categoryID='$p_id'");
     $r_do = mysqli_fetch_assoc($do);
     $g_url = mysqli_query($connect->connection, "SELECT parentID FROM categories WHERE categoryID='$p_id'");
     $r_g = mysqli_fetch_assoc($g_url);
     $gr_g = $r_g['parentID'];
     $url = mysqli_query($connect->connection, "SELECT urlname FROM categories WHERE categoryID='$gr_g'");
     $urlrow = mysqli_fetch_assoc($url);
?>

<div class="pod product-list-item">
<div class="image"> <a title="<?php echo $queryrow['prod_name']; ?>" href="product_details.php?id=<?=$queryrow['productID']?>"> <img src="<?php echo "images/thumbnail/".$queryrow['thumbnail']; ?>" width="140" height="140" border="0" class="WADAResultThumb" /></a> </div>
<div class="details" >
<h3><?php echo '<a title="'.$queryrow['prod_name'].'" href="product_details.php?id='.$queryrow['productID'].'">'.$queryrow['prod_name'].'</a>'; ?></h3>
<?php if(!($queryrow['listprice'] < 0.01)){ ?>
<div id="ProductRetailPrice" class="retail-price"> List Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$queryrow['listprice']; ?> <img src="images/star-sticker2.jpg" style="margin-right:160px; margin-top:-20px" class="l_detailsfloat" /></div>
 <?php
			$de = $queryrow['listprice'] - $queryrow['price'];
			$e = round(($de / $queryrow['listprice']),4);
			$pct_price = $e * 100;
 ?>
<div class="l_detailsfloat" style="margin-right:-65px; margin-top:-20px"><?php echo round($pct_price)."% off"; ?></div>
<?php } ?>
<div class="price"> Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$queryrow['price']; ?> </div>
<div class="description">
<p> <?php echo $queryrow['prod_desc']; ?></p>
</div>
<?php
if(!$queryrow['in_stock'] == 0){
  if($cart->product_exists($queryrow['productID'])){
?>
<p class="atc">Added to cart</p>
<?php }else { ?>
<a title="add to cart" href="javascript:void(0)" onclick="addtocart(<?php echo $queryrow['productID']; ?>)"> <img src="images/cart button.png" height="33" class="atc" /></a>
<?php } }?>
<p style="color:#36C"><a href="product.php?index=<?=$urlrow['urlname']?>&result=<?=$r_do['categoryID']?>" title="<?php echo $r_do['cat_name']; ?>"><?php echo $r_do['cat_name']; ?></a></p>
<a class="button" title="<?php echo $queryrow['prod_name']; ?>" href="product_details.php?id=<?=$queryrow['productID']?>">View Details</a> </div>
</div>


<?php } ?>

<!-- pagination -->
<div class="pagination bottom">
<?php if($pages > 1){
if($page>1){ ?>
<div class="previous"> <span class="disabled"><?php echo '<a href="?page='.($page-1).'">Previous</a>'; ?></span> </div>
<?php } ?>
<?php
for ($x=1; $x<=$pages; $x++)
	{ echo ($x == $page) ? '<strong><a style="color:#FC0126" href="?page='.$x.'">'.$x.'</a></strong> ' : '<a href="?page='.$x.'">'.$x.'</a> ';  } ?>
    <?php if($page<$x-1){ ?>
<div class="next"><span class="disabled"><?php echo '<a href="?page='.($page+1).'">Next</a>'; ?></span></div>
<?php } ?>
</div>

<!-- TemplateEndEditable -->
<?php } ?>
</div>
</div>
<?php include("Templates/footer.php"); ?>
