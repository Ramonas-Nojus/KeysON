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
    $phone = $_GET['phone'];
    
    $date = date('Y/m/d');

} else {
    header('Location: '. BASE_URL);
}

$components = $KeyboardSize.','.$KeyboardColor.','.$SwitchType.','.$Keycaps.','.$CableColor;
$component_images = $KeyboardSizeValue.','.$KeyboardColorValue.','.$SwitchTypeValue.','.$KeycapsValue.','.$CableColorValue;

$privacy_policy_consent = "Accepted Privacy Policy (v1.0) on ". $date;

$order_number = date('Ymd') . uniqid();

$full_address = $country.', '. $city. ', '.$address.', '.$postal_code;

$order = new Order;
$order->addOrder($firstName.' '.$lastName, $email, $phone, $full_address, $components, $date, $price, $order_number, $component_images, $privacy_policy_consent);

$html_content = "
<!DOCTYPE html>
<html lang='en'>
  <body style='margin:0; padding:40px 0; border-radius:20px; font-family:Arial, sans-serif; background:linear-gradient(90deg, rgba(75,24,210,1) 0%, rgba(125,17,185,1) 50%, rgba(58,7,101,1) 100%);'>
    
    <!-- Outer wrapper for spacing -->
    <div style='padding:0 10px;'>

      <!-- Container -->
      <div style='max-width:600px; margin:0 auto; background:#fff; padding:30px; border-radius:20px; box-shadow:0 8px 20px rgba(0,0,0,0.2);'>
        
        <!-- Logo -->
        <div style='text-align:center; margin-bottom:25px;'>
          <img src='https://keysonlab.com/img/logo-no-background-color.png' alt='KeysON Lab Logo' style='max-width:150px; height:auto; display:block; margin:0 auto;'>
        </div>
        <hr>
        <!-- Header -->
        <div style='text-align:center;  padding-bottom:15px; margin-bottom:25px;'>
          <h1 style='margin:0; color: black; font-size:24px;'>Purchase Receipt</h1>
        </div>

        <!-- Greeting -->
        <p style='margin:0 0 15px 0; color:#333; font-size:15px;'>Hello,</p>
        <p style='margin:0 0 15px 0; color:#333; font-size:15px;'>We inform you that we have received your order.</p>

        <!-- Order Details -->
        <div style='background:#f9f9f9; padding:20px; border-radius:12px; margin:20px 0;'>
          <p style='margin:0 0 8px 0;'><strong>Order Number:</strong> #$order_number</p>
          <p style='margin:0 0 8px 0;'><strong>Date:</strong> $date</p>
          <p style='margin:0 0 8px 0;'><strong>Total Amount:</strong> $price €</p>
          <p style='margin:0 0 8px 0;'><strong>Buyer:</strong> $firstName $lastName</p>
          <p style='margin:0 0 8px 0;'><strong>Email:</strong> $email</p>
          <p style='margin:0 0 8px 0;'><strong>Phone Number:</strong> $phone</p>
          <p style='margin:0 0 8px 0;'><strong>Delivery:</strong> courier to your home</p>
          <p style='margin:0;'><strong>Address:</strong> $address, $city, $country, $postal_code</p>
        </div>

        <!-- View Order Button -->
        <div style='text-align:center; margin:30px 0 15px 0;'>
          <a href='".BASE_URL."/order/$order_number' 
             style='display:inline-block; background:#4b18d2; color:#fff; padding:14px 28px; border-radius:12px; text-decoration:none; font-weight:bold;'>
             View Order
          </a>
        </div>

        <!-- Footer -->
        <p style='font-size:12px; color:#777; text-align:center; margin-top:20px;'>
          Thank you for choosing <strong>KeysON Lab</strong>!
        </p>

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
    $mail->Username   = GMAIL;
    $mail->Password   = GMAIL_APP_PASSWORD;

    // Recipients
    $mail->setFrom(GMAIL, 'KeysON Lab');
    $mail->addAddress($email, $firstName . " " . $lastName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $html_content;

    $mail->send();

    header('Location: thank_you');
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}


?>
