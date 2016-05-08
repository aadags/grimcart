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
include ("../includes/connection.php");
require ("../includes/class.library.php");
require_once("../source/include/membersite_config.php");

$form_rev_edit = new form();
$rev_edit = new functions();
$rev_edit->GetConnection($connect->connection);

$pageurl = $_SERVER['PHP_SELF'];


if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
    exit;
}
$username1 = $fgmembersite->UserFullName();

$title = "My Reviews -".$fgmembersite->UserName();

if(isset($_GET['id']) && ($_GET['id']>0))
{
	$id = $_GET['id'];
}
else
{
	$fgmembersite->RedirectToURL("myreviews.php");
}

include("header.php");
?>

<h2>Welcome, <?php  echo $username1;?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My reviews...</h2>
       <hr align="center" noshade="noshade" size="2" width="100%"><br/><br/>
<div id="reviewedit">
<?php
if(isset($_POST['save']))
{
	$com = $form_rev_edit->test_input($_POST['comment']);
	echo $rev_edit->edit_comment($id,$username1,$com)."<br/><br/><a href='myreviews.php'><< BACK</a><br/><br/>";
	?>
   <label>EDIT COMMENT</label>
<form id="commentform" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<textarea name="comment" rows="10" cols="40"><?php echo $rev_edit->viewcomment($id,$username1); ?></textarea><br/>
<input type="submit" value="SAVE" name="save" />
</form> 
    
    <?php
}
else
{
?>
<label>EDIT COMMENT</label>
<form id="commentform" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
<textarea name="comment" rows="10" cols="40"><?php echo $rev_edit->viewcomment($id,$username1); ?></textarea><br/>
<input type="submit" value="SAVE" name="save" />
</form>
<?php } ?>
</div>
</div>
    </div>
    
  
<!-- footer -->
<?php include("footer.php"); ?>