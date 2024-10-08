<?php

//Add a user to the database
function login_user($email, $password) {
	global $db;

	//Hash password and check against saved hashed password
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// var_dump($hashed_password);
	// die();

	if(password_verify($password, $hashed_password)) {

		$password = $hashed_password;

		var_dump($password);
		die();

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
	}
}


function register_user($email, $password, $confirm_password) {
	global $db;

	if(!empty($email) && !empty($password) && !empty($confirm_password)) {

		if($password == $confirm_password) {

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


function get_user($user_id) {
	global $db;

	$query = 'SELECT * FROM users WHERE id = :user_id';

	$statement = $db->prepare($query);
	$statement->bindValue(':user_id', $user_id);
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






