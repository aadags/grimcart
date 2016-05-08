
<?PHP
require_once("./include/membersite_config.php");

$fgmembersite->LogOut();

 if(!$fgmembersite->CheckLogin())
{



	 if (isset($_GET["redirect_to"]))
{
	$file = $_GET["redirect_to"];
	if (($file == "/grimcart/product.php") || ($file == "/grimcart/products.php"))
	   {
		   $pagename = $_GET['pagename'];
           $cat = $_GET['cat'];
		   $page = $file.'?index='.$pagename;
		   $fgmembersite->RedirectToURL($page.'&result='.$cat);
	   }
	   else if ($file == "/grimcart/product_details.php")
	   {
		   $dpage = $_GET['id'];
		   $page = $file.'?id='.$dpage;
		   $fgmembersite->RedirectToURL($page);
	   }
	   else
	$fgmembersite->RedirectToURL($file);
    exit;
}
	  
}
?>