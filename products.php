<?php
session_start();
require "inlcudes/autoload.php";
include 'settings-core-7189.php';


// Example products array (you can later replace with DB)
$products = new Products();


$category = $_GET['category'] ?? 'all';
$search   = $_GET['q'] ?? null;

// Use defaults if empty or non-numeric
$from = isset($_GET['price_from']) && $_GET['price_from'] !== '' ? (float)$_GET['price_from'] : 0;
$to   = isset($_GET['price_to']) && $_GET['price_to'] !== '' ? (float)$_GET['price_to'] : 99999;

$accessories = $products->getFilteredProducts($search, $category, $from, $to);




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

   

<div class="container">
    <div class="selection-panel">
        <h1>Filters</h1>

        <h3>Search</h3>
        <form id="search-form" method="get" style="display:flex; gap:5px; align-items:center;">
            <input type="text" name="q" id="product-search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>" style="padding:5px; flex:1;">
            <input type="hidden" name="price_from" value="<?= htmlspecialchars($from) ?>">
            <input type="hidden" name="price_to" value="<?= htmlspecialchars($to) ?>">
            <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
            <button type="submit" style="padding:5px 10px;">Search</button>
        </form>

        <h3>Price</h3>
        <form id="price-form" method="get" style="display:flex; gap:5px; align-items:center;">
            <input type="number" name="price_from" placeholder="From $" class="price-input" value="<?= htmlspecialchars($from) ?>">
            <input type="number" name="price_to" placeholder="To $" class="price-input" value="<?= htmlspecialchars($to) ?>">
            <input type="hidden" name="q" value="<?= htmlspecialchars($search) ?>">
            <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
            <button type="submit" class="price-btn">Filter</button>
        </form>

        <h3>Categories</h3>
        <div class="category-selection">
            <a href="?category=all&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">All</a>
            <a href="?category=Keycaps&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">Keycaps</a>
            <a href="?category=Arm Rests&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">Arm Rests</a>
            <a href="?category=Cables&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">Cables</a>
            <a href="?category=Mats&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">Mats</a>
            <a href="?category=Cases&q=<?= urlencode($search) ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">Cases</a>
        </div>
<br>
        <div class="category-selection">
            <a href="?" style="border-color: red;">
                Reset Filters
            </a>
        </div>
    </div>

        <div class="keyboard-window">
            <h1>Keyboard Accessories</h1>
            <div class="products-grid">
                <?php foreach($accessories as $product): ?>
                    <div class="card">
                        <a style="color: black;" href="./product.php?p_id=<?= $product['id'] ?>">
                            <img src="img/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            <h3><?= $product['name'] ?></h3>
                            <p><strong>$<?= $product['price'] ?></strong></p>
                        </a>

                        <form method="post" class="cart-form">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="action" value="add">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
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

    <div class="footer">
        &copy; 2025 KeysON Lab
        <p class="copyright">All rights.</p>
    </div>

    <script src="products.js"></script>
</body>
</html>