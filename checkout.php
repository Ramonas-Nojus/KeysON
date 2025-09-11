<?php 
session_start();

require_once './vendor/autoload.php';
require_once 'settings-core-7189.php';


$stripeSecretKey = STRIPE_SECRET_KEY;

$stripe = new \Stripe\StripeClient($stripeSecretKey);

$order = $_SESSION['order'];
$user = $_SESSION['user'];

if(!isset($_POST['checkout'])){
    header('Location: '.BASE_URL);
    exit;
}

// Save user data in session
$_SESSION['user'] = [
    'firstName'   => $_POST['firstName'],
    'lastName'    => $_POST['lastName'],
    'email'       => $_POST['email'],
    'country'     => $_POST['country'],
    'city'        => $_POST['city'],
    'address'     => $_POST['address'],
    'postal_code' => $_POST['postal_code'],
];

$order['price'] = $_POST['total_price'] * 100;



$KeyboardSize = $order['KeyboardSize'];
$KeyboardColor = $order['KeyboardColor'];
$SwitchType = $order['SwitchType'];
$Keycaps = $order['Keycaps'];
$CableColor = $order['CableColor'];

$KeyboardSizeValue = $order['KeyboardSizeValue'];
$KeyboardColorValue = $order['KeyboardColorValue'];
$SwitchTypeValue = $order['SwitchTypeValue'];
$KeycapsValue = $order['KeycapsValue'];
$CableColorValue = $order['CableColorValue'];

$price = $order['price'];

$firstName = $user['firstName'];
$email = $user['email'];
$lastName = $user['lastName'];
$country = $user['country'];
$city = $user['city'];
$address = $user['address'];
$postal_code = $user['postal_code'];



\Stripe\Stripe::setApiKey($stripeSecretKey);

$success_url =  BASE_URL. '/finish_order.php?' .
                'KeyboardSize=' . urlencode($KeyboardSize) .
                '&KeyboardColor=' . urlencode($KeyboardColor) .
                '&SwitchType=' . urlencode($SwitchType) .
                '&Keycaps=' . urlencode($Keycaps) .
                '&CableColor=' . urlencode($CableColor) .
                '&firstName=' . urlencode($firstName) .
                '&lastName=' . urlencode($lastName) .
                '&country=' . urlencode($country) .
                '&city=' . urlencode($city) .
                '&address=' . urlencode($address) .
                '&postal_code=' . urlencode($postal_code) .
                '&price=' . urlencode($price/100) .
                '&email=' . urlencode($email).
                '&KeyboardSizeValue=' . urlencode($KeyboardSizeValue) .
                '&KeyboardColorValue=' . urlencode($KeyboardColorValue) .
                '&SwitchTypeValue=' . urlencode($SwitchTypeValue) .
                '&KeycapsValue=' . urlencode($KeycapsValue) .
                '&CableColorValue=' . urlencode($CableColorValue);





$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => $success_url,

    "cancel_url" => BASE_URL. '/index.php',
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "eur",
                "unit_amount" => $price,
                "product_data" => [
                    "name" => "Keyboard",
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header("Location: ". $checkout_session->url);