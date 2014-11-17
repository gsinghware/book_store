<aside id="right_sidebar">
    <?php 
	    if(logged_in() === true) 
		{
			include 'includes/widgets/loggedin.php';
			include 'includes/widgets/money_count.php';
			if (is_seller($session_user_id) === false) 
				include 'includes/widgets/seller.php';
			else
				include 'includes/widgets/sell_item.php';
		}
		else
		{
			include 'includes/widgets/login.php';
		}
		include 'includes/widgets/user_count.php';
	?>
</aside>