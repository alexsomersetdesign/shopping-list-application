<?php

function login_user($email, $password, $hashed_password) {
	global $db;

	//Get password associated to an email address, verify
	if(password_verify($password, $hashed_password)) {

		$password = $hashed_password;

		$query = 'SELECT * FROM users WHERE email = :email AND password = :password';

		//Prepare the query
		$statement = $db->prepare($query);

		//Bind value indicated in the query to the parameter passed to function
		$statement->bindValue(':email', $email);
		$statement->bindValue(':password', $password);

		//Execute the statement
		$statement->execute();

		//Fetch the user
		$user = $statement->fetch();

		//Frees up connection to the server so that other SQL statements may be issued
		$statement->closeCursor();

		return $user;
	} else {
		$message = 'login-fail';
		return $message;
	}
}

function register_user($email, $password, $confirm_password) {
	global $db;

	//Check and ensure all fields are populated
	if(!empty($email) && !empty($password) && !empty($confirm_password)) {

		//Ensure password and password confirm match
		if($password == $confirm_password) {

			//Encrypt password
			$password = password_hash($password, PASSWORD_DEFAULT);

			$query = 'INSERT INTO users (email, password) VALUES (:email, :password)';

			$statement = $db->prepare($query);
			$statement->bindValue(':email', $email);
			$statement->bindValue(':password', $password);
			$statement->execute();
			$statement->closeCursor();

			$message = 'success';
			return $message;
		}
		else {
			$message = "fail-2";
			return $message;
		}
	} else {
		$message = "fail-1";
		return $message;
	}
}

function get_user($user_id = '', $email = '') {
	global $db;

	$query = 'SELECT * FROM users WHERE id = :user_id OR email = :email';

	$statement = $db->prepare($query);
	$statement->bindValue(':user_id', $user_id);
	$statement->bindValue(':email', $email);
	$statement->execute();
	$user = $statement->fetch();
	$statement->closeCursor();

	return $user;

}

function set_user_spending_limit($user_id, $spending_limit) {
	global $db;

	$query = 'UPDATE users SET spending_limit = :spending_limit WHERE id = :user_id';

	$statement = $db->prepare($query);
	$statement->bindValue(':user_id', $user_id);
	$statement->bindValue(':spending_limit', $spending_limit);
	$statement->execute();
	$statement->closeCursor();

}






