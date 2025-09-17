<?php
session_start();

if(!isset($_POST['selectedKeyboardSize'])) {
    header('Location: index.php');
    exit;
}

// Store order info in session
$_SESSION['order'] = [
    'KeyboardSize' => $_POST['selectedKeyboardSize'],
    'KeyboardColor' => $_POST['selectedKeyboardColor'],
    'SwitchType' => $_POST['selectedSwitchType'],
    'Keycaps' => $_POST['selectedKeycaps'],
    'CableColor' => $_POST['selectedCableColor'],
    'KeyboardSizePrice' => $_POST['selectedKeyboardSizePrice'],
    'KeyboardColorPrice' => $_POST['selectedKeyboardColorPrice'],
    'SwitchTypePrice' => $_POST['selectedSwitchTypePrice'],
    'KeycapsPrice' => $_POST['selectedKeycapsPrice'],
    'CableColorPrice' => $_POST['selectedCableColorPrice'],
    'PVM' => $_POST['pvm'],
    'KeyboardSizeValue' => $_POST['KeyboardSizeValue'],
    'KeyboardColorValue' => $_POST['KeyboardColorValue'],
    'SwitchTypeValue' => $_POST['SwitchTypeValue'],
    'KeycapsValue' => $_POST['KeycapsValue'],
    'CableColorValue' => $_POST['CableColorValue'],
    'date' => date('Y/m/d')
];

$order = $_SESSION['order'];



$total_price = $order['KeyboardSizePrice'] + $order['KeyboardColorPrice'] + $order['SwitchTypePrice'] + $order['KeycapsPrice'] + $order['CableColorPrice'] + $order['PVM'] + 30;
$order['totalPrice'] = $total_price;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout | KeysON Lab</title>
<link rel="icon" type="image/png" href="./img/favicon.png">
<link rel="stylesheet" href="./style/order.css">
<style>
/* Container */
.container {
    max-width: 900px;
    margin: 60px auto;
    padding: 40px 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

/* Headers */
h1, h2 {
    color: #111;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
}

/* Form */
.form-group {
    margin-bottom: 20px;
}
.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #555;
}
.form-group input,
.form-group select {
    width: 100%;
    max-width: 100%;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: 0.2s;
    box-sizing: border-box;
}
.form-group input:focus,
.form-group select:focus {
    border-color: #27ae60;
    box-shadow: 0 0 8px rgba(39,174,96,0.2);
    outline: none;
}

/* Make select look modern */
.styled-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: #fff url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"><polygon points="0,0 16,0 8,8" fill="%23999"/></svg>') no-repeat right 10px center;
    background-size: 12px;
}

/* Button */
.checkout-btn {
    display: block;
    width: 100%;
    padding: 18px 0;
    margin-top: 30px;
    font-size: 1rem;
    font-weight: 700;
    text-align: center;
    color: #fff;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(39,174,96,0.3);
}
.checkout-btn:hover {
    background: linear-gradient(135deg, #219150, #27ae60);
    transform: translateY(-2px);
}

/* Table */
.order-summary-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    margin-bottom: 40px;
}
.order-summary-table th,
.order-summary-table td {
    padding: 12px 20px;
    text-align: left;
}
.order-summary-table th {
    color: #777;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
}
.order-summary-table td {
    background: #fdfdfd;
    border-radius: 10px;
}
.order-summary-table tbody tr:hover td {
    background: #f0f0f0;
    transition: 0.3s;
}
tfoot th,
tfoot td {
    font-weight: 700;
    font-size: 1.1rem;
    color: #111;
}
tfoot td {
    color: #27ae60;
}

/* Keyboard Preview */
.keyboard-preview {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 40px auto;
    border-radius: 12px;
    overflow: hidden;
    background: #f5f5f7;
    padding-top: 40%;
}
.keyboard-preview img {
    width: 100%;
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

/* Responsive Fix */
@media (max-width: 768px) {
    .container {
        padding: 30px 20px;
    }
    .form-group input,
    .form-group select {
        font-size: 0.95rem;
        padding: 10px 12px;
    }
    .checkout-btn {
        padding: 16px 0;
        font-size: 0.95rem;
    }
}

.form-check {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
    font-size: 14px;
    line-height: 1.4;
  }

  .form-check input[type="checkbox"] {
    margin-right: 10px;
    margin-top: 2px;
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .form-check label {
    cursor: pointer;
    color: #333;
  }

  .form-check a {
    color: #4B18D2;
    text-decoration: none;
  }

  .form-check a:hover {
    text-decoration: underline;
  }



  /* Hide hamburger by default */
.menu-toggle {
  display: none;
  font-size: 28px;
  background: none;
  border: none;
  cursor: pointer;
  
}@media (max-width: 768px) {
  /* Show hamburger on phones */
  .menu-toggle {
    display: block;
    color: inherit;
    position: relative;
    z-index: 1001; /* stays above everything */
  }

  /* Nav dropdown hidden by default */
  header nav {
    position: absolute;
    top: 70px;       /* adjust for header height */
    right: 0;
    width: 100%;
    background: inherit;
    text-align: center;
    z-index: 1000;

    /* Smooth dropdown animation */
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease, box-shadow 0.3s ease;
    border-radius: 0 0 12px 12px;  /* rounded bottom corners */

  }

  /* Stack menu items vertically */
  header nav ul {
    flex-direction: column;
    gap: 10px;
    padding: 15px 0;
  }

  /* Show menu when toggled */
  header nav.show {
    max-height: 300px; /* adjust if menu is taller */
  }

  /* Logo fix */
  header .logo img {
    max-height: 45px;
    height: auto;
    width: auto;
  }
}


@media (max-width: 768px) {
  header nav {
    position: absolute;
    top: 70px;
    right: 0;
    width: 100%;
    background: inherit;
    text-align: center;
    z-index: 1000;

    /* animation */
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.35s ease;
    border-radius: 0 0 12px 12px;

    /* ❌ no border here */
    border-bottom: none;
  }

  header nav.show {
    max-height: 300px; /* adjust if menu is taller */

    /* ✅ border only when open */
    border-bottom: 3px solid #000;
  }
}





</style>
</head>
<body>

<?php include "./inlcudes/header.php"; ?>

<div class="container">
    <h1>Checkout</h1>

    <!-- Order Summary -->
    <h2>Order Summary</h2>
    <table class="order-summary-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Option</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Keyboard</td><td></td><td></td></tr>
            <tr><td>Size</td><td><?php echo $order['KeyboardSize']; ?></td><td><?php echo $order['KeyboardSizePrice']; ?>€</td></tr>
            <tr><td>Color</td><td><?php echo $order['KeyboardColor']; ?></td><td><?php echo $order['KeyboardColorPrice']; ?>€</td></tr>
            <tr><td>Switches</td><td><?php echo $order['SwitchType']; ?></td><td><?php echo $order['SwitchTypePrice']; ?>€</td></tr>
            <tr><td>Keycaps</td><td><?php echo $order['Keycaps']; ?></td><td><?php echo $order['KeycapsPrice']; ?>€</td></tr>
            <tr><td>Cable</td><td><?php echo $order['CableColor']; ?></td><td><?php echo $order['CableColorPrice']; ?>€</td></tr>
            <tr><td>Assembly</td><td></td><td>30€</td></tr>
            <tr><td>VAT</td><td></td><td><?php echo $order['PVM']; ?>€</td></tr>
        </tbody>
        <tfoot>
            <tr><th colspan="2">Shipping:</th><td>Free</td></tr>
            <tr><th colspan="2">Total Price:</th><td><?php echo $total_price; ?>€</td></tr>
        </tfoot>
    </table>

    <!-- Keyboard Preview -->
    <div class="keyboard-preview" style="padding-top:40%;">
        <img src="./img/<?php echo $order['KeyboardSizeValue'].'/'.$order['KeyboardColorValue']; ?>.png" style="z-index:0;">
        <img src="./img/<?php echo $order['KeyboardSizeValue'].'/'.$order['SwitchTypeValue']; ?>.png" style="z-index:1;">
        <img src="./img/<?php echo $order['KeyboardSizeValue'].'/'.$order['KeycapsValue']; ?>.png" style="z-index:2;">
        <img src="./img/<?php echo $order['KeyboardSizeValue'].'/'.$order['CableColorValue']; ?>.png" style="z-index:0;">
    </div>

    <!-- Shipping Form -->
    <h2>Shipping Information</h2>
    <form action="./checkout.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="you@example.com"
                value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="country">Country:</label>
            <select id="country" class="styled-select" name="country" required>
                <option value="">Select a country</option>
                <?php
                $countries = ["Austria","Belgium","Bulgaria","Croatia","Cyprus","Czech Republic","Denmark","Estonia","Finland","France","Germany","Greece","Hungary","Ireland","Italy","Latvia","Lithuania","Luxembourg","Malta","Netherlands","Poland","Portugal","Romania","Slovakia","Slovenia","Spain","Sweden","United Kingdom"];
                foreach ($countries as $c) {
                    $selected = (isset($user['country']) && $user['country'] === $c) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($c) . "' $selected>$c</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="John"
                value="<?= isset($user['firstName']) ? htmlspecialchars($user['firstName']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Doe"
                value="<?= isset($user['lastName']) ? htmlspecialchars($user['lastName']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="Berlin"
                value="<?= isset($user['city']) ? htmlspecialchars($user['city']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="123 Main St"
                value="<?= isset($user['address']) ? htmlspecialchars($user['address']) : '' ?>" required>
        </div>

        <div class="form-group">
            <label for="postal-code">Postal Code:</label>
            <input type="text" id="postal-code" name="postal_code" placeholder="12345"
                value="<?= isset($user['postal_code']) ? htmlspecialchars($user['postal_code']) : '' ?>" required>
        </div>

        <div class="form-check">
        <input type="checkbox" id="privacy" name="privacy" required>
        <label for="privacy">
            I agree to the <a href="<?php echo BASE_URL ?>/privacy_policy.php" target="_blank">Privacy Policy</a>.
        </label>
        </div>

        <div class="form-check">
        <input type="checkbox" id="preorder" name="preorder" required>
        <label for="preorder">
            I acknowledge that this is a <strong>preorder</strong>. My order will be assembled and shipped only once all parts are available, and delivery times may vary.
        </label>
        </div>

        <!-- Hidden total -->
        <input type="hidden" name="total_price" value="<?= isset($total_price) ? $total_price : 0 ?>">

        <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
    </form>


</div>

    <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>
<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</body>
</html>

