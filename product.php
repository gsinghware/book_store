<div class="book_display">
	<ul>
		<?php
			$result = mysql_query("SELECT * FROM `products` WHERE 1");

			while ( $row = mysql_fetch_array($result) ) { ?>
				<li>
					<?php echo "<img src=$row[image]" ?>
					<h3><b>Title:</b>	 	<?php echo $row['title']; ?></a></h3><br>
					<p><b>Buy Now:</b> 		$<?php echo $row['price']; ?></p>
					<p><b>Current Bid:</b> 	$<?php echo $row['current_bid']; ?></p><br>
					<p><b><u>View Product Details</u></b></p>
				</li>
				<?php
			}
		?>
	</ul>
</div>