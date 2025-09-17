<?php include 'settings-core-7189.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeysON Lab</title>
    <link rel="icon" type="image/png" href="./img/favicon.png">
    <link rel="stylesheet" href="./style/style.css">
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

    <div class="hero">
        <div>
            <img src="img/keyboard3.gif" alt="Animated Keyboard">
            <h1>Welcome to KeysON Lab</h1>
            <p>Create the perfect keyboard tailored to your needs.</p>
            <a class="cta-button" href="./keyboard_builder">Start Building</a>
        </div>
    </div>

    <div class="container">
        <div id="col-2">
            <h1>About Us</h1>
            <div class="centered">
                <p>Hi, I’m Nojus, the person behind KeysON Lab. I love keyboards and helping people create something that fits them perfectly. Here, you can customize every detail—layouts, switches, keycaps, and cases—to make a keyboard that feels truly yours. I’m here to share what I’ve learned and make sure your typing experience is as smooth and satisfying as possible. Let’s build your dream keyboard together, one key at a time.</p>
            </div>
        </div>
        <div id="col-1" style="background-color: #00CED1;">
            <div class="centered">
                <img src="img/blue-switch.png" style="width: 70%;" alt="Blue Switch">
            </div>
        </div>
    </div>

    <div class="container">
        <div id="col-1" style="background-color: #940707;">
            <div class="centered">
                <img src="img/keyboard-2.png" alt="Keyboard Section">
            </div>
        </div>
        <div id="col-2">
            <h1>Create Your Unique Keyboard</h1>
            <div class="centered" style="text-align: left;">
                <p>On our platform, you can:</p>
                <p><strong>Layout:</strong> Full, minimal, or medium.</p>
                <p><strong>Choose Switches:</strong> Suitable for your typing style.</p>
                <p><strong>Customize Keycaps:</strong> Color, legend, material.</p>
                <!-- <p><strong>Create Stunning Lighting:</strong> Choose colors and effects.</p> -->
                <p><strong>Personalize the Case:</strong> To match your style.</p>
                <p><strong>Select USB Connections:</strong> For convenient connectivity.</p>
                <p><strong>Add Extra Features:</strong> For example, enhanced stabilizers or multimedia keys.</p>
                <p>It’s your keyboard, your world. Start building now!</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="col-2">
            <h1>Not Sure Which Components to Choose?</h1>
            <div class="centered">
                <p>
                    We understand that choosing the right keyboard components can raise many questions.
                    That’s why we created the "<a href="./guide">Guides</a>" section, where you’ll find detailed information and tips on selecting the best components for your keyboard. This will help you make informed decisions and build a keyboard that meets your needs and expectations. Learn more about switches, keycap options, layouts, and other important factors to create a unique, high-quality keyboard.
                </p>
            </div>
        </div>
        <div id="col-1" style="background-color: #6b7c93;">
            <div class="centered">
                <img src="img/blue-keycaps.png" style="width: 75%" alt="Blue Keycaps">
            </div>
        </div>
    </div>

    <div style="text-align:center; padding:20px; font-size:14px; color: grey;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>
</body>

<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</html>
