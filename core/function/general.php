<?php 

function register_bid($session_user_id, $prod_id, $register_bid)
{
	$user_id = (int)$session_user_id;
	mysql_query("UPDATE `products` SET `current_bid` = '$register_bid' WHERE `prod_id` = $prod_id");
	mysql_query("UPDATE `products` SET `cur_highest_bidder` = '$user_id' WHERE `prod_id` = $prod_id");
}

function register_comment($register_comment)
{
	array_walk($register_comment, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($register_comment)). '`';
	$data = '\'' . implode('\', \'', $register_comment) . '\'';

	$query = mysql_query("INSERT INTO comment ($fields) VALUES ($data)");
}

function admin_protect() 
{
	global $user_data;
	if(is_admin($user_data['user_id']) === false)
	{
		header('Location: index.php');
		exit();
	}
}

function logged_in_redirect()
{
	if(logged_in() === true)
	{
		header('Location: index.php');
		exit();
	}
}

function protect_page()
{
	if (logged_in() === false)
	{
		header('Location: protected.php');
		exit();
	}
}

function array_sanitize(&$item) 
{
	$item = mysql_real_escape_string($item);
}

function sanitize($data) 
{
	return mysql_real_escape_string($data);
}

function output_errors($errors)
{
	$output = array();
	foreach ($errors as $error) {
		$output[] = '<li>'. $error . '</li>';
	}

	return '<ul>'. implode('', $output) .'</ul>';
}
?>