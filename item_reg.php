<?php  
include 'core/init.php';
include 'includes/overall/header.php';
include 'includes/aside.php';
?>

	<h1>Sell a Book</h1>

	<h4>All field marked with an astrisk are required.</h4>
	<form action="" method="post">
		<ul>
			<li>
				Title* <br>
				<input type="text" name="first_name">
			</li>
			<li>
				Image Link* <br>
				<input type="text" name="img_link">
			</li>
			<li>
				Author* <br>
				<input type="text" name="Author_name">
			</li>
			<li>
				Year* <br>
				<input type="text" name="username"> 
			</li>
			<li>
				Description* <br>
				<input type="text" name="description"> 
			</li>
			<li>
				Categories* <br>
				<input type="text" name="categories"> 
			</li>
			<li>
				Language* <br>
				<input type="text" name="language"> 
			</li>
			<li>
				Publisher* <br>
				<input type="text" name="publisher"> 
			</li>
			<li>
				<input type="submit" value="Register">
			</li>
		</ul>
	</form>

<?php 
include 'includes/overall/footer.php'; 
?>