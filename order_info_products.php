<?php
/* ---- bootstrap ---- */
require 'inlcudes/autoload.php';
include 'settings-core-7189.php';

/* ---- errors in dev ---- */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ---- load order ---- */
if (!isset($_GET['order_number'])) { header('Location: '.(defined('BASE_URL')?BASE_URL:'./')); exit; }
$order_number = preg_replace('/[^A-Za-z0-9\-]/','',$_GET['order_number']);

$orders   = new Order;
$products = new Products;

$order = $orders->getProductOrder($order_number);
if(!$order){ header('Location: '.(defined('BASE_URL')?BASE_URL:'./')); exit; }

$name   = htmlspecialchars($order['customer_name'] ?? '');
$address= htmlspecialchars($order['address'] ?? '');
$price  = number_format((float)($order['price'] ?? 0), 2);
$email  = htmlspecialchars($order['email'] ?? '');
$date   = htmlspecialchars($order['date'] ?? '');
$status = trim($order['status'] ?? 'Ordered');

/* status steps */
$steps = ['Ordered','Being Prepared','Shipped'];
$active_idx = array_search($status, $steps);
if ($active_idx === false) $active_idx = 0;

/* product ids */
$products_ids = array_filter(array_map('trim', explode(',', $order['products'] ?? '')));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Order Information | KeysON Lab</title>
<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --violet-1:#2b0a49; --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
  --bg:#130a21; --bg2:#170e2d; --text:#f5f7fb; --muted:#b6bdd0;
  --panel:rgba(255,255,255,.05); --stroke:rgba(255,255,255,.10);
  --grad:linear-gradient(90deg,var(--violet-2),var(--magenta),var(--violet-3));
  --grad2:linear-gradient(90deg,var(--violet-3),var(--magenta),var(--cyan));
  --radius:20px; --header-h:76px;
}
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{
  color:var(--text); font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
  background:
    radial-gradient(1200px 600px at 5% 0%, rgba(155,43,255,.22), transparent 60%),
    radial-gradient(900px 450px at 100% 0%, rgba(0,228,255,.18), transparent 60%),
    linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%);
  background-attachment: fixed; overflow-x:hidden;
}
.neon-grid::before{
  content:""; position:fixed; inset:0; z-index:-2; pointer-events:none;
  background:
    linear-gradient(rgba(255,255,255,.04), rgba(255,255,255,.04)) center/100% 1px no-repeat,
    repeating-linear-gradient(90deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px),
    repeating-linear-gradient(0deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px);
  mask: radial-gradient(ellipse at center, rgba(0,0,0,.9), transparent 80%);
}

/* Header */
header{
  position:fixed; inset:0 0 auto 0; height:var(--header-h); z-index:50;
  display:flex; align-items:center; justify-content:space-between;
  padding:0 6%; background:rgba(20,10,40,.6); backdrop-filter:blur(14px);
  border-bottom:1px solid var(--stroke);
}
header img{height:55px}
nav ul{list-style:none;display:flex;gap:2rem}
nav a{color:var(--text);text-decoration:none;font-weight:700;font-family:'Exo 2',sans-serif;position:relative}
nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .25s}
nav a:hover::after{width:100%}
.menu-toggle{display:none;background:none;border:0;color:var(--text);font-size:28px;cursor:pointer}
@media (max-width:860px){
  .menu-toggle{display:block}
  nav{position:absolute; right:6%; top:var(--header-h); background:rgba(20,10,40,.95);
      border:1px solid var(--stroke); border-radius:12px; overflow:hidden; max-height:0; transition:max-height .3s}
  nav.open{max-height:280px}
  nav ul{flex-direction:column; padding:10px}
}

/* Layout */
main{max-width:1200px; margin:0 auto; padding:calc(var(--header-h) + 28px) 6% 72px; display:grid; gap:24px; grid-template-columns:1.2fr .8fr;}
@media (max-width:1080px){ main{grid-template-columns:1fr}}

/* Panels */
.panel{
  background:var(--panel); border:1px solid var(--stroke); border-radius:var(--radius);
  backdrop-filter:blur(8px); padding:22px; box-shadow:0 0 28px rgba(155,43,255,.16);
}
h1,h2,h3{font-family:'Exo 2',sans-serif; background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent}
h1{font-size:2.1rem; margin-bottom:8px}
h2{font-size:1.4rem; margin:14px 0}
.meta{color:var(--muted); font-size:.95rem; margin-bottom:8px}

/* Simple table */
.table{width:100%; border-collapse:separate; border-spacing:0 10px}
.table tr td,.table tr th{
  padding:12px 14px; background:rgba(255,255,255,.04); border:1px solid var(--stroke);
}
.table tr td:first-child,.table tr th:first-child{border-radius:12px 0 0 12px}
.table tr td:last-child,.table tr th:last-child{border-radius:0 12px 12px 0}
.table .right{text-align:right; font-weight:800}

/* Status tracker */
.tracker{display:flex; align-items:center; gap:10px; margin:14px 0 6px}
.step{flex:0 0 auto; padding:10px 14px; border-radius:999px; border:1px solid var(--stroke);
      background:rgba(255,255,255,.05); color:var(--muted); font-weight:700; font-size:.92rem; white-space:nowrap}
.step.active{color:#fff; border-color:rgba(155,43,255,.45); box-shadow:0 0 0 3px rgba(155,43,255,.18) inset, 0 0 30px rgba(155,43,255,.18)}
.line{height:2px; flex:1 1 auto; background:rgba(255,255,255,.12); position:relative; border-radius:2px}
.line.active{background:linear-gradient(90deg, rgba(75,24,210,.65), rgba(155,43,255,.65), rgba(0,228,255,.55))}

/* Product list */
.products{display:grid; grid-template-columns:1fr; gap:12px; margin-top:8px}
.product{
  display:grid; grid-template-columns:110px 1fr auto; gap:14px; align-items:center;
  padding:12px; border:1px solid var(--stroke); background:rgba(255,255,255,.04); border-radius:14px;
}
.product img{width:100%; height:auto; display:block; border-radius:10px; background:#0d0b18}
.product .name{font-weight:800}
.product .price{font-variant-numeric:tabular-nums; font-weight:900}
@media (max-width:520px){
  .product{grid-template-columns:88px 1fr; grid-template-areas:
    "img name" "img price";}
  .product img{grid-area:img}
  .product .name{grid-area:name}
  .product .price{grid-area:price; text-align:right}
}

/* Right column cards */
.card{background:var(--panel); border:1px solid var(--stroke); border-radius:16px; padding:18px; margin-bottom:16px}
.card h3{font-size:1.1rem; margin-bottom:8px}

/* Footer */
footer{text-align:center;padding:28px 6%;font-size:.92rem;color:var(--muted);border-top:1px solid var(--stroke)}
footer a{color:var(--violet-3); text-decoration:none} footer a:hover{color:var(--magenta)}
</style>
</head>
<body class="neon-grid">

<header>
  <a href="<?php echo BASE_URL; ?>/">
    <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysON Lab">
  </a>
  <button class="menu-toggle" aria-label="Toggle menu" onclick="document.querySelector('nav').classList.toggle('open')">☰</button>
  <nav>
    <ul>
      <li><a href="<?php echo BASE_URL; ?>/keyboard_builder">Builder</a></li>
      <li><a href="<?php echo BASE_URL; ?>/products">Accessories</a></li>
      <li><a href="<?php echo BASE_URL; ?>/contacts">Contacts</a></li>
    </ul>
  </nav>
</header>

<main>
  <!-- LEFT -->
  <section class="panel">
    <div class="meta">Order details</div>
    <h1>Order Information</h1>

    <table class="table">
      <tr><td>Date</td><td class="right"><?php echo $date; ?></td></tr>
      <tr><td>Order Number</td><td class="right">#<?php echo htmlspecialchars($order_number); ?></td></tr>
      <tr><td>Total Price</td><td class="right"><?php echo $price; ?> €</td></tr>
    </table>

    <h2>Status</h2>
    <div class="tracker" role="list" aria-label="Order status">
      <?php for($i=0;$i<count($steps);$i++): ?>
        <div class="step <?php echo ($i <= $active_idx ? 'active' : ''); ?>" role="listitem"><?php echo $steps[$i]; ?></div>
        <?php if($i < count($steps)-1): ?>
          <div class="line <?php echo ($i < $active_idx ? 'active' : ''); ?>"></div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>

    <h2>Keyboard Accessories</h2>
    <div class="products">
      <?php
      $list_total = 0.00;
      foreach($products_ids as $pid){
        $product = $products->getById($pid);
        if(!$product) continue;
        $pname = htmlspecialchars($product['name'] ?? 'Accessory');
        $pimg  = htmlspecialchars($product['image'] ?? '');
        $pprice= (float)($product['price'] ?? 0);
        $list_total += $pprice;
      ?>
        <div class="product">
          <img src="<?php echo BASE_URL; ?>/img/products/<?php echo $pimg; ?>" alt="<?php echo $pname; ?>">
          <div class="name"><?php echo $pname; ?></div>
          <div class="price"><?php echo number_format($pprice,2); ?>€</div>
        </div>
      <?php } ?>
    </div>

    <h2>User Information</h2>
    <table class="table">
      <tr><td>Name</td>   <td class="right"><?php echo $name; ?></td></tr>
      <tr><td>Email</td>  <td class="right"><?php echo $email; ?></td></tr>
      <tr><td>Address</td><td class="right"><?php echo $address; ?></td></tr>
    </table>
  </section>

  <!-- RIGHT -->
  <aside>
    <div class="card">
      <h3>What happens next?</h3>
      <p class="meta">We prepare your accessories order, pack safely, and ship with tracking (EU).</p>
    </div>
    <div class="card">
      <h3>Need help?</h3>
      <p class="meta">Questions about your order? <a href="<?php echo BASE_URL; ?>/contacts">Contact us</a> with your order number.</p>
    </div>
  </aside>
</main>

<footer>
  &copy; 2025 KeysON Lab — <a href="<?php echo BASE_URL; ?>/privacy_policy.php">Privacy Policy</a><br/>All rights reserved. EU delivery only.
</footer>

<script>
document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</body>
</html>
