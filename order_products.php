<?php
session_start();

// Check if there are products in the cart
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p style='text-align:center; margin-top:50px; font-size:1.2rem;'>Your cart is empty. <a href='index.php'>Go back to shop</a></p>";
    exit;
}

$cart = $_SESSION['cart'];

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

// Calculate total
$total_price = 0;
foreach($cart as $item) {
    $total_price += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart Order</title>
<link rel="stylesheet" href="./style/order.css">
<style>
/* Body & Container */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f7;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 900px;
    margin: 60px auto;
    padding: 40px 30px;
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

/* Headers */
h1 {
    text-align: center;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 40px;
    color: #111;
}

h2 {
    font-weight: 600;
    font-size: 1.5rem;
    margin-top: 50px;
    margin-bottom: 20px;
    color: #111;
}

/* Table Styling */
.order-summary-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
}

.order-summary-table th,
.order-summary-table td {
    padding: 15px 20px;
    text-align: left;
}

.order-summary-table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    color: #777;
    letter-spacing: 0.05em;
}

.order-summary-table td {
    background: #fdfdfd;
    border-radius: 12px;
}

.order-summary-table tbody tr:hover td {
    background: #f0f0f0;
    transition: background 0.3s;
}

.order-img {
    width: 100px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

tfoot th {
    font-size: 1.1rem;
    font-weight: 700;
    color: #111;
}

tfoot td {
    font-size: 1.2rem;
    font-weight: 700;
    color: #27ae60;
}

/* Form Styling */
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


/* Checkout Button */
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
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(39,174,96,0.3);
}

.checkout-btn:hover {
    background: linear-gradient(135deg, #219150, #27ae60);
    box-shadow: 0 15px 35px rgba(39,174,96,0.4);
    transform: translateY(-2px);
}

/* Footer */
.footer {
    text-align: center;
    margin: 60px 0 30px;
    color: #777;
    font-size: 0.9rem;
}
</style>
</head>
<body>

<?php include "./inlcudes/header.php"; ?>

<div class="container">
    <h1>Your Cart</h1>

    <!-- Cart Table -->
    <table class="order-summary-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cart as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><img src="./img/products/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="order-img"></td>
                <td><?php echo $item['price']; ?>€</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total:</th>
                <td><?php echo $total_price; ?>€</td>
            </tr>
        </tfoot>
    </table>

    <!-- Shipping Form -->
    <h2>Shipping Information</h2>
    <form action="./products_checkout.php" method="post">
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

    <!-- Hidden total -->
    <input type="hidden" name="total_price" value="<?= isset($total_price) ? $total_price : 0 ?>">

    <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
</form>
</div>

<div class="footer">
    &copy; 2025 KeysON
</div>

</body>
</html>
