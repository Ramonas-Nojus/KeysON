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
if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $product):
        $total += $product['price']; ?>
        <div class="cart-item">
            <a style="color: black;" href="./product.php?p_id=<?= $product['id'] ?>">
                <img src="img/products/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="cart-item-details">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><strong>$<?= htmlspecialchars($product['price']) ?></strong></p>
            </a>
                    <form method="post" class="cart-form">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="action" value="remove">
                        <button type="submit">Remove</button>
                    </form>
                </div>
            
        </div>
    <?php endforeach; ?>
    <div class="cart-summary">
        <p><strong>Total: $<?= number_format($total, 2) ?></strong></p>
        <a href="./order_products.php" class="checkout-btn">Checkout</a>
    </div>
<?php
} else {
    echo "<p>Cart is empty</p>";
}
$cart_html = ob_get_clean();
header('Content-Type: application/json');
echo json_encode(['cart' => $cart_html]);
