<?php include 'settings-core-7189.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | KeysON Lab</title>
    <link rel="icon" type="image/png" href="<?php echo BASE_URL ?>/img/favicon.png">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/style/guide.css"> <!-- Your external CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* =======================
           CONTAINER / MAIN CONTENT
           ======================= */
        .container {
            text-align: center;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 90%;          /* Make it scale on desktop */
            max-width: 450px;    /* Restrict max width */
            margin: 40px auto;   /* Center vertically and horizontally */
            box-sizing: border-box; /* include padding in width */
        }
        
        h1 {
            color: #4B18D2;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 30px;
            color: #333;
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

        /* =======================
           FOOTER
           ======================= */
        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: white;
            background: transparent;
        }

        footer a {
            color: #4B18D2;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer .copyright {
            margin-top: 5px;
            font-size: 12px;
            color: #ccc;
        }

        /* =======================
           MOBILE OPTIMIZATION
           ======================= */
       @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
                margin: 30px auto;
            }

            h1 {
                font-size: 1.6rem;
            }

            p {
                font-size: 15px;
            }

            a.button {
                padding: 10px 20px;
                font-size: 15px;
            }
        }
        @media (max-width: 480px) {
            .container {
                width: 95%;
                padding: 20px;
                margin: 20px auto;
            }

            h1 {
                font-size: 1.4rem;
            }

            p {
                font-size: 14px;
            }

            a.button {
                padding: 10px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<header>
  <a href="<?php echo BASE_URL; ?>/">
    <div class="logo">
      <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysOn">
    </div>
  </a>

  <!-- Mobile menu toggle -->
  <button class="menu-toggle" aria-label="Toggle menu">☰</button>

  <nav>
    <ul>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/keyboard_builder.php">Builder</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/products.php">Accessories</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/contacts.php">Contacts</a></li>
    </ul>
  </nav>
</header>

    <main class="container">
        <h1>Thank You!</h1>
        <p>Your order has been received and is being processed. You will receive an email confirmation shortly with your order details.</p>
        <a href="<?php echo BASE_URL ?>" class="button">Return to Home</a>
    </main>

    <footer>
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php">Privacy Policy</a>
        <p class="copyright">All rights reserved.</p>
    </footer>

    <script>
        // Hamburger toggle
        const menuToggle = document.querySelector(".menu-toggle");
        if(menuToggle) {
            menuToggle.addEventListener("click", () => {
                const nav = document.querySelector("header nav");
                if(nav) nav.classList.toggle("show");
            });
        }
    </script>
</body>
</html>
