<?php 

function update_user($update_data)
{
	global $session_user_id;
	$update = array();
	array_walk($update_data, 'array_sanitize');

	foreach ($update_data as $key => $value) {
		$update[] = '`' . $key . '` = \'' . $value .'\'';
	}
	
	mysql_query("UPDATE `users` SET " . implode(', ', $update) . "WHERE user_id = $session_user_id");
}

function change_password($session_user_id, $password)
{
	$user_id = (int)$session_user_id;
	$password = md5($password);
	mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id");
}

function register_user($register_data)
{
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);

	$fields = '`' . implode('`, `', array_keys($register_data)). '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';

	$query = mysql_query("INSERT INTO users ($fields) VALUES ($data)");
	echo "INSERT INTO users ($fields) VALUES ($data)";
}

function user_count()
{
	return mysql_result(mysql_query("SELECT COUNT('user_id') FROM users WHERE active = 1 "), 0);
}

function money()
{
	global $session_user_id;
	return mysql_result(mysql_query("SELECT `money` FROM `users` WHERE `user_id` = $session_user_id"), 0);
}

function user_data($user_id)
{
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();			// num of args 
	$func_get_args = func_get_args();			// display the array of args

	// print_r($func_get_args);

	if($func_num_args > 1)
	{
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$query = "SELECT $fields FROM users WHERE user_id = $user_id ";
		$result = mysql_query($query);
		$data = mysql_fetch_assoc($result);

		return $data;
	}
	// print_r($func_get_args);
}

function logged_in()
{
	return (isset($_SESSION['user_id'])) ? true : false;
}

function email_exists($email)
{
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE email = '$email' " );
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_exists($username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' " );
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_active($username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' AND active = 1 ");
	return (mysql_result($query, 0) == 1) ? true : false;
}

function user_id_from_username($username)
{
	$username = sanitize($username);
	$query = mysql_query("SELECT user_id FROM users WHERE username = '$username' ");
	return mysql_result($query, 0, 'user_id');
}

function login($username, $password)
{
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = md5($password);

	$query = mysql_query("SELECT COUNT(user_id) FROM users WHERE username = '$username' and password = '$password' ");
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

?>


