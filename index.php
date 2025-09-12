<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeysOn Lab</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>

<?php include "./inlcudes/header.php"; ?>

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
                <p>KeysON Lab – we are committed to helping you build an exceptional keyboard that matches your unique style and preferences. With a wide selection, the ability to customize layouts, switches, keycaps, and designs, we give you the tools and knowledge to make your dream keyboard a reality. Our team of keyboard enthusiasts is dedicated to delivering the ultimate typing experience, one key at a time. Join us on this journey featuring keyboards as unique as you are.</p>
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
                    That’s why we created the "<a href="/guide.php">Guides</a>" section, where you’ll find detailed information and tips on selecting the best components for your keyboard. This will help you make informed decisions and build a keyboard that meets your needs and expectations. Learn more about switches, keycap options, layouts, and other important factors to create a unique, high-quality keyboard.
                </p>
            </div>
        </div>
        <div id="col-1" style="background-color: #6b7c93;">
            <div class="centered">
                <img src="img/blue-keycaps.png" style="width: 75%" alt="Blue Keycaps">
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">All rights reserved.</p>
    </div>
</body>

<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</html>
