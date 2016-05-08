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

$revfunc = new functions();
$revfunc->GetConnection($connect->connection);

$pageurl = $_SERVER['PHP_SELF'];


if(!$fgmembersite->CheckLogin())
{
	  $fgmembersite->RedirectToURL("../source/login.php?redirectpage=".$pageurl);
    exit;
}
$username1 = $fgmembersite->UserFullName();

$title = "My Reviews -".$fgmembersite->UserName();

include("header.php");
	
?>

<?php
if( isset($_REQUEST['command'])){

if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
	    $revfunc->delete_comment($_REQUEST['pid'],$_REQUEST['uname']);
	}
}


?>
<script language="javascript">
function del(pid){
		if(confirm('Do you really mean to delete this comment?')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
		
}


</script>
<!-- content -->

<h2>Welcome, <?php  echo $username1;?>! </h2>
	<div align="center" id="content">
		<hr align="center" noshade="noshade" size="2" width="100%">
       <h2>My reviews...</h2>
       <hr align="center" noshade="noshade" size="2" width="100%"><br/><br/>
    <form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
<input type="hidden" name="uname" value="<?php echo $username1; ?>" />
<table border="0" style="background:#666; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#FFF;" width="642" height="112" align="center" cellpadding="5px" cellspacing="1px">
<tr>
<td>PRODUCT NAME</td><td>COMMENT</td><td>DATE</td><td>OPTION</td>
</tr>
<?php $comments = mysqli_query($connect->connection, "SELECT * FROM comments WHERE `userID`='$username1'");

while($getcomm = mysqli_fetch_assoc($comments)){?>
<tr bgcolor="#FFFFFF" style="color: #000;">
<td><?php echo $revfunc->get_product_name($getcomm['productID']); ?></td><td><?php echo $getcomm['comment']; ?></td><td><?php echo $getcomm['date']; ?></td><td><a href="myreviews_edit.php?id=<?php echo $getcomm['productID']; ?>">Edit</a><br/><a href="javascript:del(<?php echo $getcomm['productID']; ?>)">Delete</a></td>
</tr>
<?php } ?>
</table>
</form><br/><br/>

</div>
    </div>
    
  
<!-- footer -->
<?php include("footer.php"); ?>