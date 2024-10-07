<?php

//Add a user to the database
function login_user($email, $password) {
	global $db;
	$query = 'SELECT * FROM users WHERE email = :email AND password = :password';

	//Prepare the query
	$statement = $db->prepare($query);

	//Bind value indicated in the query to the parameter passed to function
	$statement->bindValue(':email', $email);
	$statement->bindValue(':password', $password);

	//Execute the statement
	$statement->execute();

	$user = $statement->fetch();

	//Frees up connection to the server so that other SQL statements may be issued, potentially add between multiple execute() methods
	$statement->closeCursor();

	return $user;

}