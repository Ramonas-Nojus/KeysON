<?php
session_start();
require "inlcudes/autoload.php";
include 'settings-core-7189.php';

$products = new Products();

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$product_id = $_POST['product_id'] ?? null;
$action = $_POST['action'] ?? null;

if ($product_id && $action) {

    if ($action === 'add') {
        // Fetch product by ID
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
        $stmt = $products->connection()->prepare($sql);
        $stmt->bindParam(':id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $_SESSION['cart'][$product_id] = $product;
        }
    }

    if ($action === 'remove') {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Return updated cart HTML
ob_start();
$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $total += (float)$product['price'];

        $id    = (int)$product['id'];
        $name  = htmlspecialchars($product['name']);
        $img   = htmlspecialchars($product['image']);
        $price = number_format((float)$product['price'], 2);
        ?>
        <div class="cart-item">
          <a href="<?php echo BASE_URL; ?>/product/<?= $id ?>" style="color: white; text-decoration: none;">
            <img src="<?php echo BASE_URL; ?>/img/products/<?= $img ?>" alt="<?= $name ?>">
          </a>
          <div class="cart-item-details">
            <h3><?= $name ?></h3>
            <p><strong><?= $price ?>€</strong></p>
          </div>
          <form method="post" action="<?php echo BASE_URL; ?>/cart-handler.php" class="cart-form">
            <input type="hidden" name="product_id" value="<?= $id ?>">
            <input type="hidden" name="action" value="remove">
            <button type="submit" class="remove">Remove</button>
          </form>
        </div>
        <?php
    }
    ?>
    <div class="cart-summary">
      <p><strong>Total: <?= number_format($total, 2) ?>€</strong></p>
      <a href="<?php echo BASE_URL; ?>/order_products" class="checkout">Checkout</a>
    </div>
    <?php
} else {
    echo '<p style="color:var(--muted)">Cart is empty</p>';
}

$cart_html = ob_get_clean();
header('Content-Type: application/json');
echo json_encode(['cart' => $cart_html]);
