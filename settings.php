<?php  
include 'core/init.php';
protect_page();

include 'includes/overall/header.php';
include 'includes/aside.php';

if(empty($_POST) === false)
{
	$required_fields = array('first_name', 'email');
	// echo '<pre>', print_r($_POST, true), '</pre>';
	
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields))
		{
			$errors [] = 'Fields marked with astrirks are required.';
			break 1;
		}
	}

	if (empty($errors) === true)
	{
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors [] = 'A valid email address is required';
		}
		else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors [] = 'Sorry the email \'' . $_POST['email'] . '\' is already in use';
		}
	}
}
?>

<h1>Settings</h1>

<?php
	if (isset($_GET['success']) === true && empty($_GET['success']) === true)
	{
		echo "Your details have been updated.";
	} else 
	{
		if (empty($_POST) === false && empty($errors) === true) 
		{
			$update_data = array(
				'first_name' 	=> $_POST['first_name'],
				'last_name' 	=> $_POST['last_name'],
				'email' 		=> $_POST['email']
			);

			update_user($update_data);
			header("Location: settings.php?success");
			exit();
		} 
		else if (empty($errors) === false)
		{
			echo output_errors($errors);
		}
?>

		<form action="" method="POST">
			<ul>
				<li>
					First Name*: <br>
					<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
				</li>
				<li>
					Last Name: <br>
					<input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
				</li>
				<li>
					E-mail*: <br>
					<input type="text" name="email" value="<?php echo $user_data['email']; ?>">
				</li>
				<li>
					<input type="submit" name="Update">
				</li>
			</ul>
		</form>

<?php
	}

include 'includes/overall/footer.php'; 
?>
