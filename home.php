<?php session_start();
/*
  -------------------------------------------------------------------------
      DR webtech's  GRIMCART
              Version 0.1
    This program is free software published under the
    terms of the GNU Lesser General Public License.

    This program is distributed in the hope that it will
    be useful - WITHOUT ANY WARRANTY; without even the
    implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.


	Questions & comments please send to damahrefeay@gmail.com
  -------------------------------------------------------------------------
*/
require ("includes/connection.php");
require_once("includes/class.library.php");
require_once("source/include/membersite_config.php");


$cart = new cart();

$cart_function = new functions();

$cart_function->GetConnection($connect->connection);

$p_q = mysqli_query($connect->connection, "SELECT COUNT(*) AS NumberOfProducts FROM products");

$pqrow = mysqli_fetch_assoc($p_q);
$n = $pqrow['NumberOfProducts'] ;

include("Templates/header_default.php");

?>

  <link id="main-css" href="css/main.css" rel="stylesheet" />

        <div id="box_1">
        <div id="boxName"><img src="images/grim.jpg" height="340px" width="230px" /></div>
        </div>
		<div id="examples_outer" style="float: right; margin-right: 20px">

			<div id="slider_container_1">

				<div id="SliderName">


				    <img src="mainslide/img/mainslide1.jpg" title="Description from Image Title" />
					<!--<div class="SliderNameDescription">for additional text and links on image</div>-->
					<img src="mainslide/img/mainslide2.jpg" />
                    <!--<div class="SliderNameDescription">for additional text and links on image</div>-->
					<img src="mainslide/img/mainslide3.jpg" />
					<!--<div class="SliderNameDescription">for additional text and links on image</div>-->
					<img src="mainslide/img/mainslide4.jpg" />
                    <!--<div class="SliderNameDescription">for additional text and links on image</div>-->
				</div>
				<div class="c"></div>
				<div id="SliderNameNavigation"></div>
				<div class="c"></div>

				<script type="text/javascript">

					// we created new effect and called it 'demo01'. We use this name later.
					Sliderman.effect({name: 'demo01', cols: 10, rows: 5, delay: 10, fade: true, order: 'straight_stairs'});

					var demoSlider = Sliderman.slider({container: 'SliderName', width: 640, height: 300, effects: 'demo01',
					display: {
						pause: true, // slider pauses on mouseover
						autoplay: 5000, // 5 seconds slideshow
						always_show_loading: 500, // testing loading mode
						description: {background: '#ffffff', opacity: 0.5, height: 50, position: 'bottom'}, // image description box settings
						loading: {background: '#000000', opacity: 0.2, image: 'img/loading.gif'}, // loading box settings
						buttons: {opacity: 1, prev: {className: 'SliderNamePrev', label: ''}, next: {className: 'SliderNameNext', label: ''}}, // Next/Prev buttons settings
						navigation: {container: 'SliderNameNavigation', label: '&nbsp;'} // navigation (pages) settings
					}});

				</script>

				<div class="c"></div>
			</div>
			<div class="c"></div>
		</div>

		


    <div class="split-home content">
      <div class="column-one">
      <div id="featured-box" class="home-box">
        <h2><span class="cms-content" id="cms-content-4" rel="4"><span>Featured product</span></span>s</h2>
        <?php

        $fp = mysqli_query($connect->connection, "SELECT * FROM products ORDER BY productID ASC LIMIT 2");

        while($fpview = mysqli_fetch_assoc($fp)){

		$p_id = $fpview['categoryID'];

		?>
        <div class="info">
          <div class="image"><a title="<?php echo $fpview['prod_name']; ?>" href="product_details.php?id=<?=$fpview['productID']?>"><img src="<?php echo "images/thumbnail/".$fpview['thumbnail']; ?>" alt="Placeholder image" name="" width="140" height="140" /></a></div>
          <div class="details" >
            <div class="name"><?php echo'<a href="product_details.php?id='.$fpview['productID'].'">'.$fpview['prod_name'].'</a>'; ?></div>
            <?php if(!($fpview['listprice'] < 0.01)){ ?>
            <div id="ProductRetailPrice2" class="retail-price"> List Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$fpview['listprice']; ?> <img src="images/star-sticker2.jpg" class="l_detailsfloat" style=" margin-left:-50px" /></div>
            <?php  
			$de = $fpview['listprice'] - $fpview['price']; 
			$e = round(($de / $fpview['listprice']),4);
			$pct_price = $e * 100; 
			?>
            <div class="l_detailsfloat">
              <p style=" margin-top:-2px; margin-right:-15px;"><?php echo round($pct_price)."% off"; ?></p>
            </div>
            <?php } ?>
            <div class="pricehome"> Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$fpview['price']; ?></div>
            <div class="description">
              <p> <?php echo $fpview['prod_desc']; ?></p>
            </div>
            <p style="color:#36C">

            </p>
            <div class="buttons"> <a title="<?php echo $fpview['prod_name']; ?>" href="product_details.php?id=<?php echo $fpview['productID'];?>" class="button">View Details</a></div>
          </div>
        </div>
        <p>&nbsp;</p>
        
       <?php } ?>
      </div>
    </div>
    <div class="column-two">
      <div id="popular-box" class="home-box">
        <h2>Hot products</h2>
        <?php

        $hp = mysqli_query($connect->connection, "SELECT * FROM products ORDER BY productID DESC LIMIT 2");

        while($hpview = mysqli_fetch_assoc($hp)){
			
			$p_id = $hpview['categoryID'];

			?>
        <div class="info">
          <div class="image"> <a title="<?php echo $hpview['prod_name']; ?>" href="product_details.php?id=<?=$hpview['productID']?>"><img src="<?php echo "images/thumbnail/".$hpview['thumbnail']; ?>" alt="Placeholder image" name="" width="140" height="140"></a></div>
          <div class="details" >
            <div class="name"><?php echo'<a href="product_details.php?id='.$hpview['productID'].'">'.$hpview['prod_name'].'</a>'; ?></div>
            <?php if(!($hpview['listprice'] < 0.01)){ ?>
            <div id="ProductRetailPrice" class="retail-price"> List Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$hpview['listprice']; ?> <img src="images/star-sticker2.jpg" class="l_detailsfloat" style=" margin-right: 20px;" /> </div>
            <?php
			$de = $hpview['listprice'] - $hpview['price']; 
			$e = round(($de / $hpview['listprice']),4);
			$pct_price = $e * 100; 
			?>
            <div class="l_detailsfloat" style="margin-right:-65px"><?php echo round($pct_price)."% off"; ?></div>
            <?php } ?>
            <div class="pricehome"> Price: <?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$hpview['price']; ?></div>
            <div class="description">
              <p>  <?php echo $hpview['prod_desc']; ?> </p>
            </div>

            <div class="buttons"> <a title="<?php echo $hpview['prod_name']; ?>" href="product_details.php?id=<?php echo $hpview['productID'];?>" class="button">View details</a></div>
          </div>
        </div>
        <p>&nbsp;</p>
         <?php } ?>
      </div>
    </div>
    </div>
    <h2>&nbsp;</h2>
<h2>Grim Cart 1.1</h2>
<p>Grim shopping cart gives the easiest products sales and inventiry services with no rental fee.</p><p> Built by DR webtech, G-cart 0.1 offers free technical support for users. Unlike its sister app, 1.1 is fully object oriented. Its simply built template can be easily edited without hampering php codes.</p>
<p>&nbsp;</p>
<div id="otherview">
   <?php
    $op1 = mysqli_query($connect->connection, "SELECT * FROM products ORDER BY RAND() LIMIT 9");
    while($opr1 = mysqli_fetch_assoc($op1)){
   ?>
  <div id="prodbox1">
  <div class="pt"><a title="<?php echo $opr1['prod_name']; ?>" href="product_details.php?id=<?=$opr1['productID']?>"><img src="<?php echo "images/thumbnail/".$opr1['thumbnail']; ?>" width="120px" height="120px" /></a></div>
  <div class="pp"><?php echo CONF_CURRENCY_ISO3.CONF_CURRENCY_ID."&nbsp;".$opr1['price']; ?></div>
  <div class="pd"><?php echo $opr1['prod_desc']; ?></div>
  <div class="pn"><?php echo'<a title="'.$opr1['prod_name'].'" href="product_details.php?id='.$opr1['productID'].'">'.$opr1['prod_name'].'</a>'; ?></div>
  </div>
   <?php  }  ?>


  </div>
</div>
</div><!-- TemplateEndEditable -->

</div>
<?php include("Templates/footer.php"); ?>