<?php

/*
  -------------------------------------------------------------------------
      DR webtech's  GRIMCART  class library
              Version 1.0
    This program is free software published under the
    terms of the GNU Lesser General Public License.

    This program is distributed in the hope that it will
    be useful - WITHOUT ANY WARRANTY; without even the
    implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.


	Questions & comments please send to damahrefeay@gmail.com
  -------------------------------------------------------------------------
*/


/* the forms handling class */

class form
{

    var $error;
    var $connection;

    function GetConnection($conn)
    {
      $this->connection = $conn;
    }


   function GetBilling()
   {
       if(empty($_REQUEST['command']))
       {
         return false;
       }

	   if(!$_REQUEST['command']=='update')
       {
         return false;
       }

	    $_SESSION['order']=array();
		$_SESSION['order'][0]['custname']=$this->test_input($_REQUEST['name']);
		$_SESSION['order'][0]['custaddress']=$this->test_input($_REQUEST['address']);
		$_SESSION['order'][0]['custzip']=$this->test_input($_REQUEST['zip']);
		$_SESSION['order'][0]['custcity']=$this->test_input($_REQUEST['city']);
		$_SESSION['order'][0]['custstate']=$this->test_input($_REQUEST['state']);
		$_SESSION['order'][0]['custcountry']=$this->test_input($_REQUEST['country']);
		$_SESSION['order'][0]['custphone']=$this->test_input($_REQUEST['phone']);
		$_SESSION['order'][0]['custdate']=date("Y-m-d G.i:s P",time());
		$r= "gm";
		$orderno = strtoupper(uniqid($r));
        $_SESSION['order'][0]['c_orderid'] = $orderno;

        return true;

   }

   function trackOrder()
   {
      if(empty($_GET['getorder']))
      {
        return false;
      }

      if(empty($_GET['email']))
      {
         $this->assignError("Please provide your email");
         return false;
      }

      if(empty($_GET['ordernumber']))
      {
         $this->assignError("Please provide the ordernumber sent to you");
         return false;
      }

      $cust_email = $this->test_input($_GET['email']);
      $order_id = $this->test_input($_GET['ordernumber']);

      if(!$this->checkorderauth($cust_email,$order_id))
      {
         $this->assignError("Your email or ordernumber is incorrect! please check.");
         return false;
      }

      return true;



   }

   function checkorderauth($email,$orderno)
   {

     $do = mysqli_query($this->connection, "SELECT * FROM orders WHERE cust_email=$email AND ordernumber=$orderno");
     if($do)
     return true;

   }

   function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }

    function test_input($data)
    {
        //check and protect form data from malicious codes
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $this->Sanitize($data);
        return $data;
    }

    function Sanitize($str,$remove_nl=true)
    {
        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }

    function getMysqlError($link)
    {
      $this->error = mysqli_error($link) ;
    }

    function showError()
    {
      return $this->error;
    }

    function assignError($err)
    {
      $this->error = $err;
    }

    function GetPrivateOrder()
    {

       if(empty($_POST['Submit']))
       {
          return false;
       }

       if(empty($_POST['ordername']))
       {
         $this->assignError("Please supply your product name!");
         return false;
       }

       if(empty($_POST['orderspec']))
       {
         $this->assignError("Please supply your specifications!");
         return false;
       }

       if(!$this->SavePrivateOrder())
       {
         $this->assignError("Error saving your order!");
         return false;
       }

       $this->assignError("Order Successfully Submitted!");

       return true;


    }

    function SavePrivateOrder()
    {

      $ordername = $this->test_input($_POST['ordername']);
      $orderspec = $this->test_input($_POST['orderspec']);
      $username = $_POST['username'];
      $r= "po";
      $a = strtoupper(uniqid($r));

	  $userdata = mysqli_query($this->connection, "SELECT * FROM fgusers3 WHERE `username`='$username'");
	  $userda = mysqli_fetch_assoc($userdata);
	  $custname = $userda['name'];
	  $custemail = $userda['email'];
      $default = "not treated";
	  $time = date("Y-m-d G.i:s P",time());
	  $sql = mysqli_query($this->connection, "INSERT INTO `private_order`"."(`name`, `p_ordernumber`, `email`, `ordername`, `orderspec`, `username`, `status`, `orderdate`)". "VALUES ('$custname','$a','$custemail','$ordername','$orderspec','$username','$default','$time')");
      if($sql)
      return true;
    }

}







/* General functions class */


class functions
{

var $connection;

function GetConnection($conn)
{
  $this->connection = $conn;
}

function giveConnection()
{
  return $this->connection;
}

function update_stock($pid,$q){
   $get = mysqli_query($this->connection, "SELECT in_stock FROM products WHERE productID=$pid");
   $getrow = mysqli_fetch_assoc($get);
   $stock = $getrow['in_stock'];
   $restock = $stock - $q;
   mysqli_query($this->connection, "UPDATE `products` SET `in_stock`='$restock' WHERE productID=$pid");
}

function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }

 function checkproductname($pname)
   {
     $flag=0;
     $dbname = array();
     $do = mysqli_query($this->connection, "SELECT prod_name FROM products");
     while($dorow = mysqli_fetch_assoc($do)){
        $dbname[] = $dorow['prod_name'];
     }
       for($i=0; $i<count($dbname); $i++){
         if(($pname == $dbname[$i])){
            	$flag=1;
				break;
         }
       }
       return $flag;
   }

    function checkproductsku($sku)
   {
     $flag=0;
     $dbsku = array();
     $do = mysqli_query($this->connection, "SELECT prod_sku FROM products");
     while($dorow = mysqli_fetch_assoc($do)){
        $dbsku[] = $dorow['prod_sku'];
     }
       for($i=0; $i<count($dbsku); $i++){
         if(($sku == $dbsku[$i])){
            	$flag=1;
				break;
         }
       }
       return $flag;
   }

   function test_input($data)
   {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }

   	function get_pcat_name($cid){
		$result=mysqli_query($this->connection, "SELECT cat_name FROM categories WHERE categoryID='$cid'");
		$row=mysqli_fetch_array($result);
		return $row['cat_name'];
	}

	function get_product_name($pid){
		$result=mysqli_query($this->connection, "SELECT prod_name FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['prod_name'];
	}
    	function get_shipment($pid){
		$result=mysqli_query($this->connection, "SELECT shipment FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['shipment'];
	}

	function get_price($pid){
		$result=mysqli_query($this->connection, "SELECT price FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['price'];
	}
	function get_sku($pid){
		$result=mysqli_query($this->connection, "SELECT prod_sku FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['prod_sku'];
	}

    function get_stock($pid){
		$result=mysqli_query($this->connection, "SELECT in_stock FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['in_stock'];
	}

	function remove_product($pid){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}

	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=$this->get_price($pid);
			$sum+=round(($price*$q),2);
		}
		return $sum;
	}

    	function get_shipping_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$shipment=$this->get_shipment($pid);
			$sum+=round(($shipment*$q),2);
		}
		return $sum;
	}

    function post_comment()
    {
      if(empty($_POST['post']))
      {
        return false;
      }

      if(empty($_POST['comment']) || empty($_POST['pageid']) || empty($_POST['userid']))
      {
        return false;
      }
        $ff = new form();

        $id = $_POST['pageid'];
        $userid = $_POST['userid'];
        $comment = $ff->test_input($_POST['comment']);
        $date=date("Y-m-d G.i:s P",time());

        $insert = "INSERT INTO comments (`comment`, `productID`, `userID`, `date`) VALUES ('$comment','$id','$userid','$date')";

        if(!mysqli_query($this->connection, $insert))
        {
          return false;
        }

        return true;


    }

	function delete_comment($pid,$uname){
		$result=mysqli_query($this->connection, "DELETE FROM `comments` WHERE productID='$pid' AND userID='$uname'");
	}

	function edit_comment($pid,$uname,$com){
		$result=mysqli_query($this->connection, "UPDATE `comments` SET `comment`='$com' WHERE productID='$pid' AND userID='$uname'");
		if($result)
		return "saved successfully";
		else
		return "error saving comment";
	}

	function viewcomment($id,$uname){
		$comments = mysqli_query($this->connection, "SELECT `comment` FROM comments WHERE productID='$id' AND userID='$uname'");
		$row=mysqli_fetch_array($comments);
		return $row['comment'];
	}

    function validate_search_string($s) //validates $s - is it good as a search query
{
	//exclude special SQL symbols
	$s = str_replace("%","",$s);
	$s = str_replace("_","",$s);
	//",',\
	$s = stripslashes($s);
	$s = str_replace("'","\'",$s);
	return $s;

} //validate_search_string

}








/* Cart handling class */

class cart
{

  var $cart_error;

  function assign_cart()
  {
    if(empty($_REQUEST['command']))
    {
      return false;
    }

    if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0)
     {
      $this->DeleteCart();
     }

    if($_REQUEST['command']=='clear')
     {
       $this->ClearCart();
     }

    if($_REQUEST['command']=='update')
    {
      $this->Updatecart();
    }

    return true;

  }

  function DeleteCart()
  {
     $cart_functions = new functions();

     $cart_functions->remove_product($_REQUEST['pid']);
  }

  function ClearCart()
  {
		unset($_SESSION['cart']);
  }

  function Updatecart()
  {
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
                return true;
			}

	    }
  }

  function addProductToCart()
  {
    if(empty($_GET['productid']))
    {
      return false;
    }

	if($_GET['productid'] > 0 )
	{

    	$pid=$_REQUEST['productid'];
	    $this->addtocart($pid,1);

	}

  }

  	function addtocart($pid,$q){
		if($pid<1 or $q<1) return;

		if(is_array($_SESSION['cart'])){
			if($this->product_exists($pid)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
			$_SESSION['cart'][$max]['qty']=$q;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
			$_SESSION['cart'][0]['qty']=$q;
		}
	}

	function product_exists($pid){
	  if(isset($_SESSION['cart'])){
		$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
    }
    }

  function HandleError($err)
  {
    $this->cart_error = $err;
  }

  function viewError()
  {
    return $this->cart_error;
  }



}


?>