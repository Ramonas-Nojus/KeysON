<?php require 'vendor/autoload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./style/contacts.css">
</head>
<body>    
    <?php
        include "./inlcudes/header.php"; 

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $subject = $_POST['subject'];

            $body = "
                name: $name <br>
                email: $email <br>
                message: $message
            ";

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
                $mail->Password   = getenv('GMAIL_APP_PASSWORD');

                // Recipients
                $mail->setFrom('keyon.customs@gmail.com', 'KeyON');
                $mail->addAddress('keyon.customs@gmail.com', $name);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $body;

                $mail->send();

                header('Location: contacts.php?success=true');
            } catch (Exception $e) {
                echo "Error sending email: {$mail->ErrorInfo}";
            }
            
        }
        
        ?>

    <div class="container">

        <?php if(isset($_GET['success'])){ ?>
            <div class="success-message">Email sent successfully</div>
        <?php } ?>

        <h1>Contact Us</h1>
        <form class="contact-form" action="contacts.php" method="post">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" required></textarea>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>
