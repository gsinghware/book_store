<?php 

include 'core/init.php';
logged_in_redirect();

if(empty($_POST) === false)
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	// echo $username, ' ', $password;

	if(empty($username) || empty($password)) 
	{
		$errors[] = 'You need to enter a username and a password.';
	}
	else if (user_exists($username) === false)
	{
		$errors[] = 'We can\'t find that user.';
	}
	else if (user_active($username) === false)
	{
		$errors[] = 'You haven\'t activated your acount';
	}
	else 
	{
		if (strlen($password) > 32)
		{
			$errors[] = 'Password too long.';
		}

		$login = login($username, $password);

		if ($login === false) 
		{
			$errors[] = 'That username/password combination is incorrect';
		}
		else 
		{
			$_SESSION['user_id'] = $login;			// login return the user_id
			
			header('Location: index.php');
			exit();
		}
	}
} 
else 
{
	$errors[] = 'No data recieved';
}

include 'includes/overall/header.php'; 
// echo output_errors($errors);

if(empty($errors) === false)
{
	?>
	<h2>We tried to log you in, but ...</h2>
<?php
	echo output_errors($errors);
}
include 'includes/overall/footer.php';
?>