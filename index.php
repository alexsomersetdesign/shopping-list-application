<?php

require('model/database.php');
require('model/product.php');


//Sanitize text input for security
$product = filter_input(INPUT_POST, 'product', FILTER_UNSAFE_RAW);

//Users ID
//$user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);


//Get the hidden action field submitted by the post, this works as controller on smaller application
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);

$user_id = 1;

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


  



  default:
    $user_products = get_user_products(1);
    $all_products = get_all_products();

    include('view/shopping-list.php');


}