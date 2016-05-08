<?php
session_start();
require_once("../source/include/membersite_config.php");

require('../includes/connection.php');
$id = $_GET['id'];
$newstat = "under processing";
$sql = mysql_query("UPDATE `private_order` SET `status`='$newstat' WHERE `p_orderID`='$id'");
$fgmembersite->RedirectToURL('private_order.php');

?>