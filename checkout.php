<?php 

require_once './vendor/autoload.php';

$stripeSecretKey = getenv('STRIPE_SECRET_KEY');

$stripe = new \Stripe\StripeClient($stripeSecretKey);


if(isset($_POST['price'])){
    $price = $_POST['price'] * 100;

    $KeyboardSizeValue = $_POST['KeyboardSizeValue'];
    $KeyboardColorValue = $_POST['KeyboardColorValue'];
    $SwitchTypeValue = $_POST['SwitchTypeValue'];
    $stabilizersValue = $_POST['stabilizersValue'];
    $KeycapsValue = $_POST['KeycapsValue'];
    $CableColorValue = $_POST['CableColorValue'];

    $KeyboardColorImg = $_POST['KeyboardColorImg'];
    $SwitchTypeImg = $_POST['SwitchTypeImg'];
    $KeycapsImg = $_POST['KeycapsImg'];
    $CableColorImg = $_POST['CableColorImg'];
    
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $lastName = $_POST['lastName'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];

} else {
    header('Location: index.php');
}



\Stripe\Stripe::setApiKey($stripeSecretKey);

$success_url =  'http://keyboardbuilder.local/finish_order.php?' .
                'KeyboardSizeValue=' . urlencode($KeyboardSizeValue) .
                '&KeyboardColorValue=' . urlencode($KeyboardColorValue) .
                '&SwitchTypeValue=' . urlencode($SwitchTypeValue) .
                '&stabilizersValue=' . urlencode($stabilizersValue) .
                '&KeycapsValue=' . urlencode($KeycapsValue) .
                '&CableColorValue=' . urlencode($CableColorValue) .
                '&firstName=' . urlencode($firstName) .
                '&lastName=' . urlencode($lastName) .
                '&city=' . urlencode($city) .
                '&address=' . urlencode($address) .
                '&postal_code=' . urlencode($postal_code) .
                '&price=' . urlencode($price/100) .
                '&email=' . urlencode($email).
                '&KeyboardColorImg=' . urlencode($KeyboardColorImg) .
                '&SwitchTypeImg=' . urlencode($SwitchTypeImg) .
                '&KeycapsImg=' . urlencode($KeycapsImg) .
                '&CableColorImg=' . urlencode($CableColorImg);





$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => $success_url,

    "cancel_url" => 'http://keyboardbuilder.local/index.php',
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "eur",
                "unit_amount" => $price,
                "product_data" => [
                    "name" => "Klaviatura",
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header("Location: ". $checkout_session->url);