<?php
session_start();
require "inlcudes/autoload.php";
include 'settings-core-7189.php';

$products = new Products();

// Get product ID from URL
$product_id = $_GET['p_id'] ?? null;

if (!$product_id) {
    die("Product not found.");
}

$product = $products->getById($product_id);

$related = $products->getRelated($product_id, $product['category']);

if (!$product) {
    die("Product not found.");
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>Custom Keyboard Builder | KeysON</title>
    <link rel="stylesheet" href="./style/builder.css">
    <link rel="stylesheet" href="./style/products.css">

</head>
<body>

<header>
        <a href="<?php echo BASE_URL; ?>/">
            <div class="logo">
                <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysOn">
            </div>
        </a>
        <nav>
            <ul>
                <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/keyboard_builder.php">Builder</a></li>
                <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/products.php">Accessories</a></li>
                <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/contacts.php">Contacts</a></li>
            </ul>
        </nav>
</header>

<style>
/* =========================
   PRODUCT PAGE LAYOUT
   ========================= */
.product-page {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  margin: 40px auto;
  padding: 20px;
  max-width: 1200px;
}

/* =========================
   PRODUCT IMAGE GALLERY
   ========================= */
.product-gallery {
  flex: 1 1 400px;
  justify-content: center;
  align-items: center;
}
.product-gallery .main-image {
  max-width: 100%;
  height: auto;
  border-radius: 14px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  transition: transform 0.3s ease;
}
.product-gallery .main-image:hover {
  transform: scale(1.02);
}

/* =========================
   PRODUCT DETAILS
   ========================= */
.product-details {
  flex: 1 1 400px;
  display: flex;
  flex-direction: column;
  gap: 22px;
}
.product-details h1 {
  font-size: 32px;
  margin: 0;
  font-weight: 700;
  letter-spacing: -0.5px;
  color: #111;
}
.product-details .price {
  font-size: 26px;
  font-weight: 700;
  color: #6a11cb;
}
.product-details .long-desc {
  font-size: 15px;
  line-height: 1.7;
  color: #444;
}

/* =========================
   ADD TO CART BUTTON
   ========================= */
.add-to-cart-btn {
  background: #111;
  color: #fff;
  border: none;
  padding: 14px 26px;
  border-radius: 999px;
  cursor: pointer;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.25s ease;
  width: fit-content;
}
.add-to-cart-btn:hover {
  background: #333;
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

/* =========================
   RELATED PRODUCTS
   ========================= */
.related-window {
  border-radius: 12px;
  background-color: #fff;
  padding: 20px 15px 40px;
  margin: 40px auto;
  max-width: 1100px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.related-window h2 {
  font-size: 24px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 25px;
  color: #111;
  border-bottom: 2px solid #f2f2f2;
  padding-bottom: 12px;
}
.related-products {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 22px;
}
.related-item {
  flex: 0 1 220px;
  background: #fff;
  border-radius: 12px;
  padding: 12px;
  text-align: center;
  transition: all 0.3s ease;
}
.related-item img {
  width: 100%;
  height: auto;
  border-radius: 10px;
}
.related-item p {
  margin-top: 12px;
  font-size: 14px;
  font-weight: 500;
  color: #333;
}
.related-item:hover {
  transform: translateY(-6px) scale(1.02);
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

/* =========================
   RESPONSIVE
   ========================= */
@media (max-width: 768px) {
  .product-page {
    flex-direction: column;
  }
  .related-item {
    width: 48%;
  }
}
@media (max-width: 480px) {
  .related-item {
    width: 100%;
  }
}

/* =========================
   SIDEBAR (optional reuse)
   ========================= */
.selection-panel {
  flex: 0.5;
}

</style>

<body>

<div class="container">
    <div class="keyboard-window">

        <div class="product-page">
        <!-- Product Images -->
            <div class="product-gallery">
                <img src="img/products/<?= htmlspecialchars($product['image']) ?>" 
                    alt="<?= htmlspecialchars($product['name']) ?>" 
                    class="main-image">
            </div>

            <div class="product-details">
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <p class="price">$<?= number_format($product['price'], 2) ?></p>

                <form method="post" class="cart-form">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>

                <p class="long-desc"><?= $product['description'] ?></p>
    
            </div>
        </div>
    </div>

             <div class="selection-panel cart-panel">
            <h1>Cart</h1>
            <div class="cart-items">
            <?php 
            if(!empty($_SESSION['cart'])):
                $total = 0;
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
            <?php else: ?>
                <p>Cart is empty</p>
            <?php endif; ?>
        </div>
    </div> 
</div>


<!-- Optional: Related Products -->

<div class="container">
    <div class="related-window">
        <h2>You may also like</h2>
        <div class="related-products">
          <?php foreach ($related as $r): ?>
              <div class="related-item">
                  <a href="product.php?p_id=<?= $r['id'] ?>">
                      <img src="img/products/<?= htmlspecialchars($r['image']) ?>" 
                          alt="<?= htmlspecialchars($r['name']) ?>">
                      <p><?= htmlspecialchars($r['name']) ?></p>
                  </a>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="products.js"></script>
</body>
</html>
