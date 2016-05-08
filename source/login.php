<?PHP session_start();
require("../includes/connection.php");
require_once("./include/membersite_config.php");
if($fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL('../home.php');
}

if (isset($_GET['redirectpage']))
{
$pageurls = $_GET['redirectpage'];

if ((isset($_GET['pagename'])) && (isset($_GET['cat'])))
	   {
		   $pagename = $_GET['pagename'];
           $cat = $_GET['cat'];
		   $page = $pageurls.'?index='.$pagename;
		   
	   }
	   if (isset($_GET['id']))
	   {
		   $dpageid = $_GET['id'];
           $page = $pageurls.'?id='.$dpageid;

	   }
	   
}
if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {

	   if (isset($_GET['productredirect']))
	   {
		   $p = $_GET['productredirect'];
		   $c = $_GET['catid'];
		   $fgmembersite->RedirectToURL($p.'&result='.$c);
	   }
	    else if (isset($_GET['productdetail']))
	   {
		   $p = $_GET['productdetail'];
		   $fgmembersite->RedirectToURL($p);
	   }
	   else if (isset($_GET['redirectpage'])){
        $p = $_GET['redirectpage'];
        $fgmembersite->RedirectToURL($p);  }

        else { $fgmembersite->RedirectToURL('../home.php'); }
   }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Login</title>
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
  
<!-- Form Code Start -->
<div id='fg_membersite'>
<?php
if(isset($pageurls)) {
if (isset($_GET['id']))
{
?>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>?productdetail=<?=$page?>' method='post' accept-charset='UTF-8'>

<?php

}
else if ((isset($_GET['pagename'])) && (isset($_GET['cat'])))
{
?>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>?productredirect=<?=$page?>&catid=<?=$cat?>' method='post' accept-charset='UTF-8'>

<?php

}
else
{
?>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>?redirectpage=<?=$pageurls?>' method='post' accept-charset='UTF-8'>
<?php }} else { ?>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<?php } ?>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >Username*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label><br/>
    <input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
<div class='contactus'><a href='register.php'><strong>REGISTER NOW!</strong></a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<!--
Form Code End (see html-form-guide.com for more info.)
-->
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
