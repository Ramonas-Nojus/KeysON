<?php 
session_start();

require_once './vendor/autoload.php';
require_once 'settings-core-7189.php';


$stripeSecretKey = STRIPE_SECRET_KEY;

$stripe = new \Stripe\StripeClient($stripeSecretKey);


if(isset($_POST['checkout'])){
    
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];
    $price = $_POST['total_price'] * 100;

} else {
    header('Location: '.BASE_URL);
}


// Save user data in session
$_SESSION['user'] = [
    'firstName'   => $_POST['firstName'],
    'lastName'    => $_POST['lastName'],
    'email'       => $_POST['email'],
    'phone'       => $_POST['phone'],
    'country'     => $_POST['country'],
    'city'        => $_POST['city'],
    'address'     => $_POST['address'],
    'postal_code' => $_POST['postal_code'],
];


\Stripe\Stripe::setApiKey($stripeSecretKey);

$success_url =  BASE_URL. '/finish_products_order.php?' .
                'firstName=' . urlencode($firstName) .
                '&lastName=' . urlencode($lastName) .
                '&email=' . urlencode($email).
                '&phone=' . urlencode($phone).
                '&country=' . urlencode($country) .
                '&city=' . urlencode($city) .
                '&address=' . urlencode($address) .
                '&postal_code=' . urlencode($postal_code) .
                '&price=' . urlencode($price);





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
                    "name" => "Keyboard Accesories",
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header("Location: ". $checkout_session->url);