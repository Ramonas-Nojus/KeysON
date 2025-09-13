
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Guides | KeysON Lab</title>
        <link rel="stylesheet" href="./style/guide.css"> <!-- Make sure to link your CSS file -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
<body>
    <?php include './inlcudes/header.php'; ?>
     <style>


        .thank-you-container {
        text-align: center;
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h1 {
        color: #4B18D2;
        margin-bottom: 20px;
        }

        p {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 30px;
        }

        a.button {
        display: inline-block;
        padding: 12px 25px;
        background: #4B18D2;
        color: #fff;
        text-decoration: none;
        border-radius: 8px;
        transition: background 0.3s ease;
        }

        a.button:hover {
        background: #6a3bd0;
        }
    </style>

    <div class="container">

        <div class="thank-you-container">
            <h1>Thank You!</h1>
            <p>Your order has been received and is being processed. You will receive an email confirmation shortly with your order details.</p>
            <a href="<?php echo BASE_URL ?>" class="button">Return to Home</a>
        </div>

    </div>


   <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>
</body>
<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</html>
