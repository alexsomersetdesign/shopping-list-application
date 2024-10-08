<?php

require('model/database.php');
require('model/product.php');
require('model/user.php');

//Get the hidden action field submitted by the post, this works as controller on smaller application
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if(!$action) {
  if(isset($_GET['user'])) {
    $action = "show-list";

  }
}


//Sanitize text input for security
$product = filter_input(INPUT_POST, 'product', FILTER_UNSAFE_RAW);

//Users ID
$user_id = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

//Registration and login sanitzation
$email = filter_input(INPUT_POST, 'email', FILTER_UNSAFE_RAW);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
$password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_UNSAFE_RAW);

//Spending limit sanitization
$spending_limit = filter_input(INPUT_POST, 'spending_limit', FILTER_UNSAFE_RAW);



switch($action) {

  case "add_product":
    add_product($product_id, $user_id);
    header("Location: /?user={$user_id}");
  break;

  case "remove_product":
    remove_product($product_id, $user_id);
    header("Location: /?user={$user_id}");
  break;

  case "purchase_product":
    purchase_product($product_id);
    header("Location: /?user={$user_id}");
  break;

  case "register":
    $register_response = register_user($email, $password, $password_confirm);
    header("Location: /?msg={$register_response}");
  break;

  case "login":
    $user_info = get_user($user_id, $email);
    $login_response = login_user($email, $password, $user_info['password']);
    //Check to see if user id is returned
    if(isset($login_response['id'])) {
      header("Location: /?user={$login_response['id']}");
      include('view/shopping-list.php');
    } else {
      header("Location: /?msg={$login_response}");
    }
  break;

  case "set_user_spending_limit":
    set_user_spending_limit($user_id, $spending_limit);
    header("Location: /?user={$user_id}");
  break;

  case "show-list":
    $user_products = get_user_products($user_id);
    $all_products = get_all_products();
    $user = get_user($user_id);
    include('view/shopping-list.php');
  break;

  default:
    include('view/login.php');

}