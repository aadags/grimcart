<?php
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

function update_stock($pid,$q){
   $get = mysqli_query($connect->connection, "SELECT in_stock FROM products WHERE productID=$pid");
   $getrow = mysqli_fetch_assoc($get);
   $stock = $getrow['in_stock'];
   $restock = $stock - $q;
   mysql_query("UPDATE `products` SET `in_stock`='$restock' WHERE productID=$pid");
}

 function checkproductname($pname)
   {
     $flag=0;
     $dbname = array();
     $do = mysqli_query($connect->connection, "SELECT prod_name FROM products");
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
     $do = mysqli_query($connect->connection, "SELECT prod_sku FROM products");
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

 function checkorderauth($email,$orderno)
   {
     $flag=0;
     $dbemail = array();
     $dborderid = array();
     $do = mysqli_query($connect->connection, "SELECT cust_email,ordernumber FROM orders");
     while($dorow = mysqli_fetch_assoc($do)){
        $dbemail[] = $dorow['cust_email'];
        $dborderid[] = $dorow['ordernumber'];
     }
       for($i=0; $i<count($dbemail); $i++){
         if(($email == $dbemail[$i]) && ($orderno == $dborderid[$i])){
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
		$result=mysqli_query($connect->connection, "SELECT cat_name FROM categories WHERE categoryID='$cid'");
		$row=mysqli_fetch_array($result);
		return $row['cat_name'];
	}

	function get_product_name($pid){
		$result=mysqli_query($connect->connection, "SELECT prod_name FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['prod_name'];
	}
    	function get_shipment($pid){
		$result=mysqli_query($connect->connection, "SELECT shipment FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['shipment'];
	}

	function get_price($pid){
		$result=mysqli_query($connect->connection, "SELECT price FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['price'];
	}
	function get_sku($pid){
		$result=mysqli_query($connect->connection, "SELECT prod_sku FROM products WHERE productID='$pid'");
		$row=mysqli_fetch_array($result);
		return $row['prod_sku'];
	}

    function get_stock($pid){
		$result=mysqli_query($connect->connection, "SELECT in_stock FROM products WHERE productID='$pid'");
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
			$price=get_price($pid);
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
			$shipment=get_shipment($pid);
			$sum+=round(($shipment*$q),2);
		}
		return $sum;
	}

	function addtocart($pid,$q){
		if($pid<1 or $q<1) return;

		if(is_array($_SESSION['cart'])){
			if(product_exists($pid)) return;
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

	function delete_comment($pid,$uname){
		$result=mysqli_query($connect->connection, "DELETE FROM `comments` WHERE productID='$pid' AND userID='$uname'");
	}

	function edit_comment($pid,$uname,$com){
		$result=mysqli_query($connect->connection, "UPDATE `comments` SET `comment`='$com' WHERE productID='$pid' AND userID='$uname'");
		if($result)
		return "saved successfully";
		else
		return "error saving comment";
	}

	function viewcomment($id,$uname){
		$comments = mysqli_query($connect->connection, "SELECT `comment` FROM comments WHERE productID='$id' AND userID='$uname'");
		$row=mysqli_fetch_array($comments);
		return $row['comment'];
	}


function show_price($price) //show a number and selected currency sign
		//$price is in universal currency
{

	//now show price
	$price = round(100*$price)/100;
	if (round($price*10) == $price*10 && round($price)!=$price) $price = "$price"."0"; //to avoid prices like 17.5 - write 17.50 instead
	if (round($price) == $price) //add .00
		$price  = "$price".".00";

	$csign_left  = (defined("CONF_CURRENCY_ID_LEFT")) ? CONF_CURRENCY_ID_LEFT : "US $";
	$csign_right = (defined("CONF_CURRENCY_ID_RIGHT")) ? CONF_CURRENCY_ID_RIGHT : "";

	return $csign_left.$price.$csign_right;
}

function get_current_time() //get current date and time as a string
{
	return strftime("%Y-%m-%d %H:%M:%S", time());
}

function ShowNavigator($a, $offset, $q, $path, &$out)
{ 	
		//shows navigator [prev] 1 2 3 4 … [next]
		//$a - count of elements in the array, which is being navigated
		//$offset - current offset in array (showing elements [$offset ... $offset+$q])
		//$q - quantity of items per page
		//$path - link to the page (f.e: "index.php?categoryID=1&")

		if ($a > $q) //if all elements couldn't be placed on the page
		{

			//[prev]
			if ($offset>0) $out .= "<a href=\"".$path."offset=".($offset-$q)."\">[".STRING_PREVIOUS."]</a> &nbsp;";

			//digital links
			$k = $offset / $q;

			//not more than 4 links to the left
			$min = $k - 5;
			if ($min < 0) { $min = 0; }
			else {
				if ($min >= 1)
				{ //link on the 1st page
					$out .= "<a href=\"".$path."offset=0\">[1-".$q."]</a> &nbsp;";
					if ($min != 1) { $out .= "... &nbsp;"; };
				}
			}

			for ($i = $min; $i<$k; $i++)
			{
				$m = $i*$q + $q;
				if ($m > $a) $m = $a;

				$out .= "<a href=\"".$path."offset=".($i*$q)."\">[".($i*$q+1)."-".$m."]</a> &nbsp;";
			}

			//# of current page
			if (strcmp($offset, "show_all"))
			{
				$min = $offset+$q;
				if ($min > $a) $min = $a;
				$out .= "[".($k*$q+1)."-".$min."] &nbsp;";
			}
			else
			{
				$min = $q;
				if ($min > $a) $min = $a;
				$out .= "<a href=\"".$path."offset=0\">[1-".$min."]</a> &nbsp;";
			}

			//not more than 5 links to the right
			$min = $k + 6;
			if ($min > $a/$q) { $min = $a/$q; };
			for ($i = $k+1; $i<$min; $i++)
			{
				$m = $i*$q+$q;
				if ($m > $a) $m = $a;

				$out .= "<a href=\"".$path."offset=".($i*$q)."\">[".($i*$q+1)."-".$m."]</a> &nbsp;";
			}

			if ($min*$q < $a) { //the last link
				if ($min*$q < $a-$q) $out .= " ... &nbsp;&nbsp;";
				if (!($a%$q == 0))
					$out .= "<a class=no_underline href=\"".$path."offset=".($a-$a%$q)."\">".(floor($a/$q)+1)."</a> &nbsp;&nbsp;";
				else //$a is divided by $q
					$out .= "<a class=no_underline href=\"".$path."offset=".($a-$q)."\">".(floor($a/$q))."</a> &nbsp;&nbsp;";
			}

			//[next]
			if ($offset<$a-$q) $out .= "<a href=\"".$path."offset=".($offset+$q)."\">[".STRING_NEXT."]</a>";

			//[show all]
			if (strcmp($offset, "show_all"))
				$out .= " <a href=\"".$path."show_all=yes\">[".STRING_SHOWALL."]</a>";
			else
				$out .= " [".STRING_SHOWALL."]";

		}
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

function string_encode($s) // encodes a string with a simple algorythm
{
	$result = base64_encode($s);
	return $result;
}

function string_decode($s) // decodes a string encoded with string_encode()
{
	$result = base64_decode($s);
	return $result;
}
?>