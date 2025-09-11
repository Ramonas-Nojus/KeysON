<?php 
require 'vendor/autoload.php';

require 'inlcudes/autoload.php';

require_once 'settings-core-7189.php';


if(isset($_GET['KeyboardSize'])){
    $KeyboardSizeValue = $_GET['KeyboardSizeValue'];
    $KeyboardColorValue = $_GET['KeyboardColorValue'];
    $SwitchTypeValue = $_GET['SwitchTypeValue'];
    $KeycapsValue = $_GET['KeycapsValue'];
    $CableColorValue = $_GET['CableColorValue'];

    $KeyboardSize = $_GET['KeyboardSize'];
    $KeyboardColor = $_GET['KeyboardColor'];
    $SwitchType = $_GET['SwitchType'];
    $Keycaps = $_GET['Keycaps'];
    $CableColor = $_GET['CableColor'];

    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $country = $_GET['country'];
    $city = $_GET['city'];
    $address = $_GET['address'];
    $postal_code = $_GET['postal_code'];
    $price = $_GET['price'];
    $email = $_GET['email'];
    
    $date = date('Y/m/d');

} else {
    header('Location: '. BASE_URL);
}

$components = $KeyboardSize.','.$KeyboardColor.','.$SwitchType.','.$Keycaps.','.$CableColor;
$component_images = $KeyboardSizeValue.','.$KeyboardColorValue.','.$SwitchTypeValue.','.$KeycapsValue.','.$CableColorValue;


$order_number = date('Ymd') . uniqid();

$full_address = $country.', '. $city. ', '.$address.', '.$postal_code;

$order = new Order;
$order->addOrder($firstName.' '.$lastName, $email, $full_address, $components, $date, $price, $order_number, $component_images);

$html_content = "

<!DOCTYPE html>
<html lang='lt'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Kvitas</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                margin: 0;
                padding: 0;
                background: linear-gradient(90deg, rgba(75,24,210,1) 0%, rgba(125,17,185,1) 50%, rgba(58,7,101,1) 100%);
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1,
            h2,
            p {
                margin: 0;
            }

            .receipt-header {
                text-align: center;
                padding-bottom: 20px;
                border-bottom: 1px solid #ccc;
                margin-bottom: 20px;
            }


            .receipt-details {
                padding: 20px;
                background: #f9f9f9;
                border-radius: 6px;
                margin-bottom: 20px;
            }

            .receipt-details p {
                margin-bottom: 10px;
            }

            .item {
                padding: 10px;
                background: #f2f2f2;
                border-radius: 6px;
                margin-bottom: 10px;
            }

            .item:last-child {
                margin-bottom: 0;
            }

            .tracking-link {
                margin: 20px;
                text-align: center;
            }

            .tracking-link a {
                color: #007bff;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='receipt-header'>
                <h1>Purchase Receipt</h1>
            </div>
            <div class='receipt-details'>
                <p>Hello,</p>
                <p>We inform you that we have received your order.</p>
                <br>
                <p><strong>Order Number: </strong> #$order_number</p>
                <p><strong>Date:</strong> $date</p>
                <p><strong>Total Amount:</strong> $price €</p>
                <p><strong>Buyer:</strong> $firstName $lastName</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Delivery:</strong> courier to your home</p>
                <p><strong>Address:</strong> $address, $city, $country, $postal_code</p>
                <p>You can view more information about your order by clicking <a href='".BASE_URL."/order/$order_number'>this link</a></p>
            </div>
        </div>
    </body>
</html>";


require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$subject = "Order Confirmation";

try {
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth   = true;
    $mail->Username   = 'keyon.customs@gmail.com';
    $mail->Password   = GMAIL_APP_PASSWORD;

    // Recipients
    $mail->setFrom('keyon.customs@gmail.com', 'KeysON');
    $mail->addAddress($email, $firstName . " " . $lastName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $html_content;

    $mail->send();

    header('Location: index.php');
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}


?>
