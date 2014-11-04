<div class="mainContent">
	<div class="content">
		<div class="search_box">

			<h2>Search books...</h2>
			<form method="GET" action="search.php">
		        <input type="text" name='search' placeholder="Search...">
		        <input type="submit" value="Search">
			</form>

		</div>

		<article>
			<header>
				<h1>
					Books to buy...
				</h1>
			</header>
			
			<content>
				<?php include 'product.php'; ?>
			</content>

		</article>
	</div>
	<?php include 'includes/aside.php'; ?>
</div>