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
require ("../includes/connection.php");
require ("../includes/class.library.php");
require("../source/include/membersite_config.php");


$pageurl = $_SERVER['PHP_SELF'];

if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
   exit;
}

$username1 = $fgmembersite->UserFullName();

$fgmembersite->UpdateUserData();

$title = "My Account -".$fgmembersite->UserName();
include("header.php");

$pageurl = $_SERVER['PHP_SELF'];

?>

<!-- content -->
<h2>Welcome, <?php  echo $username1; ?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My Profile</h2>
       <hr align="center" noshade="noshade" size="2" width="100%">
       <font style="color: #CC0000"><?php echo $fgmembersite->GetErrorMessage(); ?></font>
       <div id='fg_membersite'>

       <form id='register' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post' accept-charset='UTF-8'>
       
       <input type='hidden' name='submitted' id='submitted' value='1'/>
       
       <table cellpadding="20" cellspacing="20">
       <tr>
       <td>
       <label for='name' >Your Full Name*: </label><br/>
       </td>
       <td>
       <input type='text' name='name' id='name' value='<?php echo $fgmembersite->UserName(); ?>' maxlength="50" /><br/>
       
       </td>
       </tr>
       <tr>
       <td>
       <label for='email' >Email Address*:</label><br/>
       </td>
       <td>
       <input disabled type='text' name='email' id='email' value='<?php echo $fgmembersite->UserEmail(); ?>' maxlength="50" /><br/>

       </td>
       </tr>
       <tr>
       <td>
       <label for='username' >Username*:</label><br/>
       </td>
       <td>
       <input disabled type='text' name='username' id='username' value='<?php echo $username1; ?>' maxlength="50" /><br/>

       </td>
       </tr>
       <tr>
       <td>
       <label for='phonenumber' >Phone Number:</label><br/>
       </td>
       <td>
       <input type='text' name='phonenumber' id='phonenumber' value='<?php echo $fgmembersite->UserMobile(); ?>' maxlength="50" /><br/>

       </td>
       </tr>
       
       <tr>
       <td>
       <input type='submit' name='Submit' value='SAVE' />
       </td>
       <td></td>
       </tr>
       </table>
     </form>

   </div>
     	</div>
    </div>
<!-- footer -->
<?php include("footer.php"); ?>