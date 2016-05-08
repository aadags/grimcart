<?PHP
require("../includes/connection.php");
require_once("./include/membersite_config.php");

$success = false;
if($fgmembersite->ResetPassword())
{
    $success=true;
}
$pageurl = $_SERVER['PHP_SELF'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Reset Password</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
      
      
       <link id="main-css" href="../css/main.css" rel="stylesheet" />
      <!-- TemplateBeginEditable name="head" -->
      <meta http-equiv="description" content="">
      <meta http-equiv="keywords" content="">
      <!-- TemplateEndEditable -->
      <script src="includes/ice/ice.js" type="text/javascript"></script>
</head>

<body class="index">	
<div id="user-menu-wrapper">
<div id="user-menu" class="content">
<ul id="header-menu">
<?PHP

if ($fgmembersite->CheckLogin())

{?>
   <li class="first">Hi,<a id="header-signin" href="../accountmanager/index.php"><?php echo $fgmembersite->UserFullName(); ?></a></li>	
   <li class="first"><a id="header-signin" href="../accountmanager/index.php">My Account</a></li>
   <li class="first"><a id="header-signin" href="source/logout.php?redirect_to=<?=$pageurl?>">Logout</a></li>
<?php } ?>
</ul></div>
</div>
<div id="header-wrapper">
<div id="header" class="content">
<div class="logo">
<a href="../home.php"><img src="../images/nyrahlogoreal.png" alt="My Store" width="227" height="110" id="header-logo" /></a>
</div>
</div>
</div>
<div id="content-wrapper" >
  
  <div id="content" class="content">

<div id='fg_membersite_content'>
<?php
if($success){
?>
<h2>Password is Reset Successfully</h2>
Your new password is sent to your email address.
<?php
}else{
?>
<h2>Error</h2>
<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
<?php
}
?>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
<!-- footer -->
<div id="footer-wrapper">
<div id="footer" class="content">
<ul>
<li class="first"><a style="" target="_blank" href="../FAQ.php" rel="">FAQ</a></li><li class=""><a href="#">Privacy Policy</a></li>
<li class="last"><a href="#" rel="">Terms of Use</a></li>
</ul>
<ul>
<p align="center"> © 2014 <a href="../home.php"><?php echo $sitename; ?></a>. All Rights Reserved. </p>
</ul>
</div>
</div>
</body>
</html>