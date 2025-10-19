<?php
session_start();
require 'vendor/autoload.php';

require 'inlcudes/autoload.php';

require_once 'settings-core-7189.php';


if(isset($_GET['email'])){

    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $country = $_GET['country'];
    $city = $_GET['city'];
    $address = $_GET['address'];
    $postal_code = $_GET['postal_code'];
    $price = $_GET['price']/100;
    $email = $_GET['email'];
    $phone = $_GET['phone'];

    $date = date('Y/m/d');


} else {
    header('Location: index.php');
}

$order_number = date('Ymd') . uniqid();

$full_address = $country.', '. $city. ', '.$address.', '.$postal_code;


$product_ids = array_column($_SESSION['cart'], 'id');

$products_string = implode(",", $product_ids);

$privacy_policy_consent = "Accepted Privacy Policy (v1.0) on ". $date;


$order = new Order;
$order->addProductsOrder(
    $firstName . ' ' . $lastName,
    $email,
    $phone,
    $full_address,
    $products_string,
    $date,
    $price,
    $order_number,
    $privacy_policy_consent
);

$_SESSION['cart'] = [];

$url = BASE_URL ."/accesorie_order/".$order_number;
$base  = BASE_URL;

$html_content = <<<HTML
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order {$order_number}</title>
    <style>
      /* Mobile tweaks for clients that honor <style> */
      @media (max-width:620px){
        .container{width:100% !important; border-radius:16px !important}
        .inner{padding:22px !important}
        .btn{width:100% !important}
      }
    </style>
  </head>
  <body style="margin:0; padding:0; background:#0b0816;">

    <!-- Background + outer padding -->
    <div style="
      padding:32px 12px;
      background:
        radial-gradient(1200px 600px at 12% -8%, rgba(155,43,255,.25), transparent 60%),
        radial-gradient(900px 450px at 100% 0%, rgba(0,228,255,.18), transparent 60%),
        linear-gradient(135deg,#0b0816 0%,#170e2d 100%);
      ">
      <!-- Centered fixed-width container (table for Outlook) -->
      <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center" class="container" width="600" style="
        width:600px; max-width:600px; margin:0 auto; border-collapse:separate; background:rgba(255,255,255,.06);
        border:1px solid rgba(255,255,255,.10); border-radius:20px;
        box-shadow:0 0 24px rgba(155,43,255,.14); backdrop-filter: blur(8px);
      ">
        <tr>
          <td class="inner" style="padding:28px;">

            <!-- Logo -->
            <div style="text-align:center; margin-bottom:18px;">
              <img src="{$base}/img/logo-no-background-2.png" alt="KeysON Lab" width="160" style="max-width:160px; height:auto; display:block; margin:0 auto;">
            </div>

            <!-- Divider line -->
            <div style="height:1px; background:rgba(255,255,255,.12); margin:8px 0 18px;"></div>

            <!-- Title -->
            <h1 style="
              margin:0 0 8px 0; font-family:Arial,Helvetica,sans-serif; font-size:24px; line-height:1.25; font-weight:800;
              color:#f5f7fb;
            ">
              Purchase Receipt
            </h1>
            <p style="margin:0 0 16px 0; font-family:Arial,Helvetica,sans-serif; font-size:15px; color:#dfe3ef;">
              Hello,<br>
              We inform you that we have received your order.
            </p>

            <!-- Order summary panel -->
            <div style="
              background:rgba(255,255,255,.07);
              border:1px solid rgba(255,255,255,.12);
              border-radius:14px;
              padding:16px 16px 6px 16px;
              margin:16px 0 22px;
            ">
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Order Number:</strong> #{$order_number}
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Date:</strong> {$date}
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Total Amount:</strong> {$price} €
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Buyer:</strong> {$firstName} {$lastName}
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Email:</strong> {$email}
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Phone Number:</strong> {$phone}
              </p>
              <p style="margin:0 0 10px; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Delivery:</strong> courier to your home
              </p>
              <p style="margin:0; font:14px/1.5 Arial,Helvetica,sans-serif; color:#f5f7fb;">
                <strong>Address:</strong> {$address}, {$city}, {$country}, {$postal_code}
              </p>
            </div>

            <!-- CTA button (gradient pill) -->
            <div style="text-align:center; margin:26px 0 8px;">
              <!-- Bulletproof-ish: table button so Outlook aligns it nicely -->
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" align="center">
                <tr>
                  <td>
                    <a href="{$url}" class="btn" style="
                      display:inline-block;
                      padding:14px 28px;
                      font-family:Arial,Helvetica,sans-serif;
                      font-size:15px;
                      font-weight:800;
                      text-decoration:none;
                      color:#fff;
                      border-radius:999px;
                      background:linear-gradient(90deg,#4b18d2,#7d11b9,#9b2bff);
                      box-shadow:0 8px 30px rgba(155,43,255,.18);
                    ">
                      View Order
                    </a>
                  </td>
                </tr>
              </table>
            </div>

            <!-- Footer -->
            <p style="margin:18px 0 0; font:12px/1.6 Arial,Helvetica,sans-serif; color:#b7bfd3; text-align:center;">
              Thank you for choosing <strong style="color:#dfe3ef;">KeysON Lab</strong>!
            </p>

          </td>
        </tr>
      </table>
    </div>
  </body>
</html>
HTML;



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