<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$db       = 'arfrobite';


// Connect to mysql
$mysqli = new mysqli($host, $username, $password, $db);

// Check if there is any error in creating db connection.
if ($mysqli->connect_error) {
  die('Connect Error: Could not connect to database');
}
 



error_reporting(E_ALL); 
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE); 
ini_set('log_errors', TRUE);
ini_set('error_log', '../system_logs/ArfrobiteSystemErrors.txt'); 
 
 

 
include_once('encryption_functions.php');
include_once('signup_signin_process.php');
include_once('home_functions.php');
include_once('cart_functions.php');
include_once('account_functions.php');
include_once('payment_functions.php');
include_once('order_functions.php');
include_once('menu_functions.php');
include_once('notification_system.php');
include_once('delivery_functions.php');





$DBCrud               = new SignUp_SignIn();
$uiEncry              = new IdEncrypt();
$HomeData             = new HomePage();
$cartItems            = new SaveToCart();
$profile              = new GetProfile();
$RegisterResAndRider  = new RegisterRestaurantAndRiders();
$payment              = new PaymentFunctions();
$order                = new OrderSystem();
$menu                 = new Menu();
$notification         = new Notifications();
$delivery             = new DeliveryFunctions();


?>