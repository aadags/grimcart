<?php
require("conf.php");
require('class.connection.php');

$hostname_localhost = "";     //supply local host name
$database_localhost = "";     //supply database name
$username_localhost = "";             //supply database username
$password_localhost = "";          //supply database password

$sitename = CONF_SHOP_NAME;       //constant called from conf.php

$connect = new connections();

$connect->get_DB($hostname_localhost,$username_localhost,$password_localhost,$database_localhost); //get database log in details

$connect->DBLogin();   //database log in and connection

echo $connect->get_Error(); //error detection


?>