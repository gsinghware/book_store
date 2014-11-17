<div class="book_display">
	<ul>
		<?php
			$result = mysql_query("SELECT * FROM `products` WHERE 1");

			while ( $row = mysql_fetch_array($result)) { ?>
				<li>
					<?php 
						date_default_timezone_set( 'America/New_York' );
                        $date = $row['expiry'];
                        $date = strtotime($date);
                        $rem = $date - time();
                        $day = floor($rem / 86400);
                        $hr  = floor(($rem % 86400) / 3600);
                        $min = floor(($rem % 3600) / 60);
                        $sec = ($rem % 60);
                        if ($day > 0)
                        {

	                      	echo "<img src=$row[image]" 

	                    ?>
							<h3><b>Title:</b>	 	<?php echo $row['title']; ?></a></h3><br>
							<p><b>Buy Now:</b> 		$<?php echo $row['price']; ?></p>
							<p><b>Current Bid:</b> 	$<?php echo $row['current_bid']; ?></p>

							<p><b>Bid Expires in:</b>
		                        <?php
		                            if($day) echo "$day Days ";
		                            if($hr) echo "$hr Hours ";
		                            if($min) echo "$min Minutes ";
		                            if($sec) echo "$sec Seconds ";
		                        
		                        ?>

		                    </p>

							<?php
								$id = $row['prod_id'];
								$link = 'prod_details.php?prod_id=' . $id;
								echo "<b><a href='$link' ><u>View Product Details</u></a></b>";
							?>
				</li>
				<?php
						}
			}
		?>
	</ul>
</div>