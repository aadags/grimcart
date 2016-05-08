<?php session_start();
   require ("includes/connection.php");
require("includes/class.library.php");

$c_fn = new functions();

  unset($_SESSION['order']);
  $c_fn->RedirectToURL("cart.php");


?>