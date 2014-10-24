<aside id="right_sidebar">
    <?php 
	    if(logged_in() === true) 
		{
			include 'includes/widgets/loggedin.php';
			include 'includes/widgets/money_count.php';
		}
		else
		{
			include 'includes/widgets/login.php';
		}
		include 'includes/widgets/user_count.php';
	?>
</aside>