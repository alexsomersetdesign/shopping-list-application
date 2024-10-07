<?php

//Add a product to the database
function add_product($product_id, $user_id) {
	global $db;
	$query = 'INSERT INTO user_products (product_id, user_id) VALUES (:product_id, :user_id)';

	//Prepare the query
	$statement = $db->prepare($query);

	//Bind value indicated in the query to the parameter passed to function
	$statement->bindValue(':product_id', $product_id);
	$statement->bindValue(':user_id', $user_id);

	//Execute the statement
	$statement->execute();

	//Frees up connection to the server so that other SQL statements may be issued, potentially add between multiple execute() methods
	$statement->closeCursor();

}

function get_user_products($user_id) {
	global $db;
	if($user_id) {
		$query = 'SELECT * from user_products as u left join products as p on p.id= u.product_id WHERE u.user_id=(:user_id)';

	}

	$statement = $db->prepare($query);
	$statement->bindValue(':user_id', $user_id);
	$statement->execute();

	$user_products = $statement->fetchAll();
	$statement->closeCursor();

	return $user_products;
}

function get_all_products() {
	global $db;
	
	$query = 'SELECT * FROM products';


	$statement = $db->prepare($query);
	$statement->execute();

	$all_products = $statement->fetchAll();
	$statement->closeCursor();

	return $all_products;
}

function remove_product($product_id, $user_id) {
	global $db;
	$query = 'DELETE FROM user_products WHERE product_id = :product_id AND user_id = :user_id ';

	var_dump($query);

	$statement = $db->prepare($query);
	$statement->bindValue(':product_id', $product_id);
	$statement->bindValue(':user_id', $user_id);
	$statement->execute();
	$statement->closeCursor();

}

function purchase_product($product_id) {
	global $db;
	$query = 'UPDATE products SET purchased = 1 WHERE ID = :product_id';

	$statement = $db->prepare($query);
	$statement->bindValue(':product_id', $product_id);
	$statement->execute();
	$statement->closeCursor();

}