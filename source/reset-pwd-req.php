<?PHP
require("../includes/connection.php");
require_once("./include/membersite_config.php");

$emailsent = false;
if(isset($_POST['submitted']))
{
   if($fgmembersite->EmailResetPasswordLink())
   {
        $fgmembersite->RedirectToURL("reset-pwd-link-sent.html");
        exit;
   }
}
$pageurl = $_SERVER['PHP_SELF'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Reset Password Request</title>
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

<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='resetreq' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Reset Password</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >Your Email*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>A link to reset your password will be sent to the email address</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("resetreq");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
    frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

// ]]>
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
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
<p align="center"> © 2014 All Rights Reserved. </p>
</div>
</div>
</body>
</html>