<?php session_start();
require ("includes/connection.php");
require ("includes/class.library.php");

$cart = new cart();

$function = new functions();

$function->GetConnection($connect->connection);

if (isset($_GET["result"]))
{
    $pagename = $_GET["index"];
	$catz = $_GET["result"];
	if($catz >0){
     $pagetitle = mysqli_query($connect->connection, "SELECT categoryID FROM categories WHERE parentID=$catz LIMIT 1");
     $do_pt = mysqli_fetch_assoc($pagetitle);
     $function->RedirectToURL("product.php?index=".$pagename."&result=".$do_pt['categoryID']);

	}else {echo '<font style="font-size:36px">PAGE NOT FOUND!!</font>';}
}else
{
	echo '<font style="font-size:36px">PAGE NOT FOUND!!</font>';
} ?>
