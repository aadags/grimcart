<?php



if($_GET['do']=='rate'){
	// do rate
	rate();
}else if($_GET['do']=='getrate'){
	// get rating
	getRating();
}else if($_GET['do']=='getvote'){
	// get vote
	getVotes();
}


// function to retrieve
function getRating(){
     // connect to database
    require("includes/connection.php");
	$p = strip_tags($_GET['pid']);
	$sql= "SELECT value, counter FROM products WHERE productID='$p';";
	$result=mysqli_query($connect->connection, $sql);
	$rs=mysqli_fetch_array($result);
	// set width of star
	$rating = (round($rs['value'] / $rs['counter'],1)) * 20; 
	echo $rating;

}

function getVotes(){
  // connect to database
    require("includes/connection.php");
	$p = strip_tags($_GET['pid']);
	$sql= "SELECT counter FROM products WHERE productID='$p';";
	$result=mysqli_query($connect->connection, $sql);
	$rs=mysqli_fetch_array($result);
	echo $rs['counter'];
}



// function to insert rating
function rate(){
  // connect to database
    require("includes/connection.php");
	$c = strip_tags($_GET['pid']);
	$text = strip_tags($_GET['rating']);
	$update = "UPDATE products SET counter = counter + 1, value = value + ".$_GET['rating']." WHERE productID='$c';";

	$result = mysqli_query($connect->connection, $update);
	if(mysqli_affected_rows($result) == 0){
		$insert = "INSERT INTO products (counter,value) VALUES ('1','".$_GET['rating']."') WHERE productID='$c';";
		$result = mysqli_query($connect->connection, $insert);
	}
}

?>
