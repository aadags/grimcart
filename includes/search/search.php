<?php
$button = $_GET['submit'];
$search = $_GET['Search'];

	if (strlen($search)<=2)
	echo"search term too short";
	else
	{
		echo "you searched for<b>$search</b> <hr size='1'></br>";
		mysql_connect("localhost","root","");
		mysql_select_db("nyrahstore");
		$search_exploded=explode("",$search);
		foreach($search_exploded as $search_each)
		{
			$x++;
			if($x==1)
			$construct="keywords LIKE '%search_each%'";
			else
			$construct="AND keywords LIKE '%search_each%'";
		}
		$constructs = "SELECT * FROM products WHERE $construct";
		$run = mysql_query($constructs);
		$foundnum = mysql_num_rows($run);
		if($foundnum==0)
		{
			echo "sorry, there are no search results for <b>$search</b>.</br></br>Please check your spelling";
		}
		else
			{
				echo "$foundnum results found!<p>";
				$per_page = 1;
				$start = $_GET['start'];
				$max_pages = ceil($foundnum/$perpage);
				if(!$start)
				$start=0;
				$getquery=mysql_query("SELECT * FROM nyrahstore_products WHERE $construct LIMIT $start, $per_page");
				while($runrows=mysql_fetch_assoc($getquery))
				{
					$name=$runrows['prod_name'];
					$price=$runrows['price'];
					$thumbnail=['thumbnail'];
					$votes=['cust_votes'];
					$stock=['in_stock'];
				}
				//pagination starts
				echo"<center>";
				$prev = $start - $per_page;
				$next = $start + $per_page;
				$adjacents = 3;
				$last = $max_pages - 1;
				if(!($start <= 0))
				echo "<a href='search.php?search=$search&submit=Search+source+code&start=$prev'>Prev</a>";
				//pages
				if($max_pages<7 + ($adjacents*2))   //not enuff pages to bother breaking it up
				{
					$i = 0;
					for ($counter = 1;$counter<=$max_pages;$counter++)
					{
						if($i == $start)
						{
							echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a>";
						}
						else
						{
							echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a>";
						}
						$i=$i+$per_page;
					}
				}
				elseif($max_pages>5+($adjacents*2))
				{
					if(($start/$per_page)<1+($adjacent*2))
					{
						$i=0;
						for($counter=1;$counter<4+($adjacents*2);$counter++)
						{
							if($i==$start)
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a>";
							}
							else
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a>";
							}
							$i=$i+$per_page;
						}
					}
					//in the middle hide some front and some back
					elseif($max_pages_($adjacent*2)>($start/$per_page)&&($start/$per_page)>($adjacents*2))
					{
						echo "<a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a>";
						echo "<a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a>....";
						$i=$start;
						for($counter=($start/$per_page)+1;$counter<($start/$per_page)+$adjacents+2;$counter++)
						{
							if($i==$start)
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a>";
							}
							else
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a>";
							}
							$i=$i+$per_page;
						}
					}
					else
					{
						echo "<a href='search.php?search=$search&submit=Search+source+code&start=0'>1</a>";
						echo "<a href='search.php?search=$search&submit=Search+source+code&start=$per_page'>2</a>....";
						$i=$start;
						for($counter=($start/$per_page)+1;$counter<=$max_pages;$counter++)
						{
							if($i==$start)
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'><b>$counter</b></a>";
							}
							else
							{
								echo "<a href='search.php?search=$search&submit=Search+source+code&start=$i'>$counter</a>";
							}
							$i=$i+$per_page;
						}
					}
				}
				//next button
				if(!($start>=$foundnum-$per_page))
				echo "<a href='search.php?search=$search&submit=Search+source+code&start=$next'>Next</a>";
			}
			echo "</center>";
	}

				
			
?>




