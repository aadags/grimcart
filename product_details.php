<?php session_start();
require ("includes/connection.php");
require ("includes/class.library.php");

$cart = new cart();

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

$cart->addProductToCart();

$cart_function->post_comment();

if(isset($_GET['id']))
{
$dpageid = $_GET["id"];

if($dpageid >0 )
	{
$page = mysqli_query($connect->connection, "SELECT * FROM products WHERE productID='$dpageid'");
if (mysqli_num_rows($page)==0)
{ echo '<font style="font-size:36px">PAGE NOT FOUND!!</font>'; }

else {
$pagepic = array();
while($pagerow = mysqli_fetch_assoc($page))
{
	$p_id = $pagerow['productID'];
	 $p_name = $pagerow['prod_name'];
	 $p_sku = $pagerow['prod_sku'];
	 $price = $pagerow['price'];
	 $desc = $pagerow['prod_desc'];
	 if(! $pagerow['picture1'] == false ){ $pagepic[0] = $pagerow['picture1']; }
	 if(! $pagerow['picture2'] == false ){ $pagepic[1] = $pagerow['picture2']; }
    if(! $pagerow['picture3'] == false ){ $pagepic[2] = $pagerow['picture3']; }
	if(! $pagerow['picture4'] == false ){ $pagepic[3] = $pagerow['picture4']; }
	if(! $pagerow['picture5'] == false ){ $pagepic[4] = $pagerow['picture5']; }
	 $stock = $pagerow['in_stock'];
	 $spec = $pagerow['prod_specs'];
	 $votes = $pagerow['counter'];
	 //$ratings = $pagerow['value'];
	 $listprice = $pagerow['listprice'];
}

$title = "Product Details - ".$p_name;

require_once("source/include/membersite_config.php");
if($fgmembersite->CheckLogin())
{
	include("Templates/product_header_login.php");  
}
else
{
	  include("Templates/product_header_default.php");
}

	
$user = $fgmembersite->UserFullName();

?>
<script type="text/javascript">
function addtocart(pid){
	    document.form1.productid.value =  pid;
		document.form1.submit();	
	}
	
</script>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<form name="form1" >
	<input type="hidden" name="productid" />
</form>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Star rating, jQuery, ajax">
<meta http-equiv="Content-Language" content="en">
<meta name="robots" content="index,follow">
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="keywords" content="slideman, sliderman.js, javascript slider, jquery, slideshow, effects" />
	<meta name="description" content="Sliderman.js - will do all the sliding for you :)" />
	<style type="text/css">
		* { margin: 0; outline: none; }
		body { background-color: #444444; }
		.c { clear: both; }
		#wrapper { margin: 0 auto; padding: 0 40px 60px 40px; width: 960px; }
		h2 { padding: 20px 0 10px 0; font-size: 24px; line-height: 40px; font-weight: normal; color: #adc276; text-shadow: 0 1px 3px #222222; }
		#votes{ color:#F00; font-size:18px; float:right; margin-top: -10px; margin-right:160px; }
		#words{ margin-top: 70px; padding-left:10px;}
	}
	
	</style>

	<!-- sliderman.js -->
	<script type="text/javascript" src="js/sliderman.1.3.7.js"></script>
    
	<link rel="stylesheet" type="text/css" href="css/sliderman.css" />
    <link href="rating/starrating.css" rel="stylesheet" type="text/css" media="screen" />
	<!-- /sliderman.js -->
    
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <p>&nbsp;</p>
<b style="font-size:45px; text-transform: capitalize;"><?php echo $p_name; ?></b>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="detailscontent">
	<div id="wrapper">

		<div id="examples_outer">
        
	        		<div id="SliderName_2" class="SliderName_2">
                    <?php for($x=0; $x<count($pagepic); $x++){ ?>
					<img src="<?php echo "images/products/".$pagepic[$x]; ?>" width="400" height="450" usemap="#img1map" />
					<div class="SliderName_2Description"><strong>sku: <?php echo $p_sku; ?></strong></div>
                     <?php } ?>
				    	<map name="img1map">
						<area href="#img1map-area1" shape="rect"  />
						<area href="#img1map-area2" shape="rect"  />
					</map>
				<div class="c"></div>
				<div id="SliderNameNavigation_2"></div>
				<div class="c"></div>

				<script type="text/javascript">
					effectsDemo2 = 'fade';
					var demoSlider_2 = Sliderman.slider({container: 'SliderName_2', width: 400, height: 450, effects: effectsDemo2,
						display: {
							autoplay: 150000,
							loading: {background: '#000000', opacity: 0.5, image: 'img/loading.gif'},
							buttons: {hide: true, opacity: 1, prev: {className: 'SliderNamePrev_2', label: ''}, next: {className: 'SliderNameNext_2', label: ''}},
							description: {hide: true, background: '#000000', opacity: 0.4, height: 50, position: 'bottom'},
							navigation: {container: 'SliderNameNavigation_2', label: '<img src="img/clear.gif" />'}
						}
					});
				</script>

				<div class="c"></div>
			</div>
           
            <div id="indetails">
            <div class="sku">sku: <?php echo $p_sku; ?> </div>
            <?php if(!($listprice < 0.01)) { 	?>
            <div style="margin-left:60px;" class="l_details">list price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$listprice; ?> <img src="images/star-sticker.jpg" width="72" height="67" style="margin-right: 40px;" class="l_detailsfloat" /> </div>
            <?php
			$de = $listprice - $price;
			$e = round(($de / $listprice),4);
			$pct_price = $e * 100;
			?>
            <div class="l_detailsfloat" style="margin-right:-60px; margin-top: -30px "><?php echo round($pct_price)."% off"; ?></div>
            

            <div style="margin-left:40px;" class="p_details">price: <b><?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$price; ?></b></div>
            
             <?php
			if($stock==0){
            ?>
            <div class="cartout"><a  style="margin-left: 80px;">Out of stock</a> <img src="" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:70px; /> </div>

            <?php
            }else {
              if($cart->product_exists($dpageid)){
			?>
            <div class="cartout"><a  style="margin-left: 80px;">Added to cart</a> <img src="" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:70px; /> </div>
            <?php
              } else{
            ?>
             <div class="cartbutton"><a onclick="addtocart(<?php echo $p_id; ?>)" href="javascript:void(0)" style="margin-left: 100px;">add to cart</a> <img src="images/cart button.png" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:150px; /> </div>
            <?php } }

			} else {?>
            <div class="p_details">price: <b><?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$price; ?></b></div>
            <?php
			if($stock==0){
			  ?>
              <div class="cartout"><a  style="margin-left: 80px;">Out of stock</a> <img src="" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:70px; /> </div>

              <?php
			}else {
		   if($cart->product_exists($dpageid)){
			?>
            <div class="cartout"><a  style="margin-left: 80px;">Added to cart</a> <img src="" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:70px; /> </div>
            <?php
              } else{
            ?>
             <div class="cartbutton"><a onclick="addtocart(<?php echo $p_id; ?>)" href="javascript:void(0)" style="margin-left: 100px;">add to cart</a> <img src="images/cart button.png" class="l_detailsfloat"  width="25" height="23" style="margin-top: 10px; margin-right:150px; /> </div>
            <?php } } ?>
            
            
            <?php } ?>
             </div>          
			<div class="c"></div>
		</div>
     
	  <div class="c"></div>
	</div>
   <div id="productspec">
   <p class="fh">Full Specifications:</p>
   <p class="fb">
   <?php echo $spec; ?>
   </p>
   </div>
   <div id="rating">
   <script src="rating/jquery.min.js" type="text/javascript"></script>
   <script type="text/javascript"> var id = "<?=$dpageid ?>";</script>
<script src="rating/starrating.js" type="text/javascript"></script>
<link href="rating/starrating.css" rel="stylesheet" type="text/css" media="screen" />
<p class="heading">customers rating</p>
<ul class='star-rating' style="margin-left: 38px">
  <li class="current-rating" id="current-rating"><!-- will show current rating --></li>
  <span id="ratelinks">
  <li><a href="javascript:void(0)" title="1 star out of 5" class="one-star">1</a></li>
  <li><a href="javascript:void(0)" title="2 stars out of 5" class="two-stars">2</a></li>
  <li><a href="javascript:void(0)" title="3 stars out of 5" class="three-stars">3</a></li>
  <li><a href="javascript:void(0)" title="4 stars out of 5" class="four-stars">4</a></li>
  <li><a href="javascript:void(0)" title="5 stars out of 5" class="five-stars">5</a></li>
  </span>
</ul>
   <div id="votes">
   <!--- votes goes here --->
   </div>
   <div id="words">
   <p>Place your additional product info and options on here..important addons and a little juicy look. always remember to give your customers enough juicy info to enable them pick up your goods.</p><p>DR designs wish you a robust happy sales year. </p>
   </div>
   <div id="commentbox">
   <p class="viewcom" style="font-size:15px;">COMMENTS</p><br/>
   <?php
   if($fgmembersite->CheckLogin())
{
	$get_user= mysqli_query($connect->connection, "SELECT userID FROM comments WHERE productID='$dpageid'");
	$userrow = mysqli_fetch_assoc($get_user);
	$f = $userrow['userID'];
		if(!($user == $f)){
?>
   <form name="commentform" id="commentform" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
   <textarea type="text" id="comment" cols="26" rows="5" name="comment" ></textarea><br/>
   <input type="hidden" name="pageid" value="<?php echo $dpageid; ?>" />
   <input type="hidden" name="userid" value="<?php echo $user; ?>" />
   <input type="submit" id="post" value="post" name="post" /><br/>
   </form>
   <?php
		}
   } else { echo "<p class='viewcom'>sign in to post comment</p><br/><br/>"; }?>
   <p id="viewcomment">
   <?php 
   $get_com= mysqli_query($connect->connection, "SELECT * FROM comments WHERE productID='$dpageid'");
   while($row_com = mysqli_fetch_assoc($get_com)){
   echo "<b>".$row_com['userID']."</b>";
   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;posted on &nbsp;<font style='color:#F90;'>".$row_com['date']."&nbsp;GMT</font><br/>";
   echo(($user == $row_com['userID']) && ($fgmembersite->CheckLogin())) ? "<br/>".$row_com['comment']."<br/><a target='_blank' href='accountmanager/myreviews.php'>Edit</a><br/><br/>" : "<br/>".$row_com['comment']."<br/><br/>";
   } ?>
   </p>
   </div>
   </div>


<!-- content -->

<!-- TemplateEndEditable --> 
</div>
</div>
</div>

<?php 
include("Templates/footer.php");  }
}else {echo '<font style="font-size:36px">PAGE NOT FOUND!!</font>';}
  }else {echo '<font style="font-size:36px">PAGE NOT FOUND!!</font>';}
 ?>

