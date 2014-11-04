<?php  
include 'core/init.php';
include 'includes/overall/header.php';
include 'includes/aside.php';
?>

<div class="book_display">
	<ul>
		<?php
		    $query = $_GET['search']; 
		    // gets value sent over search form
		     
		    $min_length = 3;
		    // you can set minimum length of the query if you want
		    
		    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
		         
		        $query = htmlspecialchars($query); 
		        // changes characters used in html to their equivalents, for example: < to &gt;
		         
		        $query = mysql_real_escape_string($query);
		        // makes sure nobody uses SQL injection
		         
		        $raw_results = mysql_query("SELECT * FROM products
		            WHERE (`title` LIKE '%".$query."%') ") or die(mysql_error());
		         
		        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following

		            while ( $row = mysql_fetch_array($raw_results)) { ?>
						<li>
							<?php echo "<img src=$row[image]" ?>
							<h3><b>Title:</b>	 	<?php echo $row['title']; ?></a></h3><br>
							<p><b>Buy Now:</b> 		$<?php echo $row['price']; ?></p>
							<p><b>Current Bid:</b> 	$<?php echo $row['current_bid']; ?></p><br>
							<p><b><u>View Product Details</u></b></p>
						</li>
						<?php
					}    
		        }
		        else { 	// if there is no matching rows do following
		            echo "No results";
		        }
		    }
		    else { 		// if query length is less than minimum
		        echo "Minimum length is ".$min_length;
		    }
		?>
	</ul>
</div>

<?php include 'includes/overall/footer.php'; ?>