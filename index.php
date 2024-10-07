<?php

require('model/database.php');
require('model/product.php');
require('model/user.php');

//Get the hidden action field submitted by the post, this works as controller on smaller application

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);



//Sanitize text input for security
$product = filter_input(INPUT_POST, 'product', FILTER_UNSAFE_RAW);

//Users ID
//$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

//Registration and login sanitzation
$email = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
$password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_UNSAFE_RAW);

if(isset($_GET['user'])) {
  
} else {
  
}




switch($action) {

  case "add_product":
  add_product($product_id, $user_id);
  header("Location: /");
  break;

  case "remove_product":
  remove_product($product_id, $user_id);
  header("Location: /");
  break;

  case "purchase_product":
  purchase_product($product_id);
  header("Location: /");
  break;

  case "login":
  $user = login_user($email, $password);

  //Check to see if user id is returned
  if(isset($user['id'])) {
    header("Location: /?user={$user['id']}");
    include('view/shopping-list.php');
  } else {
    header("Location: /");
    include('view/login.php');
  }
  break;

  case "show-list":
  $user_products = get_user_products();
  $all_products = get_all_products();
  include('view/shopping-list.php');
  break;

  default:
    $user_products = get_user_products(1);
    $all_products = get_all_products();
    include('view/login.php');

}