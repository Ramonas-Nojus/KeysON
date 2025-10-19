<?php
session_start();
require "inlcudes/autoload.php";
include 'settings-core-7189.php';

$products = new Products();

$category = $_GET['category'] ?? 'all';
$search   = $_GET['q'] ?? null;
$from     = isset($_GET['price_from']) && $_GET['price_from'] !== '' ? (float)$_GET['price_from'] : 0;
$to       = isset($_GET['price_to'])   && $_GET['price_to']   !== '' ? (float)$_GET['price_to']   : 99999;

/* --- CART ACTIONS (reliable) --- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? null;
  $pid    = (int)($_POST['product_id'] ?? 0);

  if ($action === 'add' && $pid) {
    $name  = trim($_POST['product_name'] ?? '');
    $price = (float)($_POST['product_price'] ?? 0);
    $image = trim($_POST['product_image'] ?? '');
    if ($name !== '' && $price > 0) {
      $_SESSION['cart'] = $_SESSION['cart'] ?? [];
      $_SESSION['cart'][$pid] = [
        'id'=>$pid,'name'=>$name,'price'=>$price,'image'=>$image
      ];
    }
    header("Location: ".$_SERVER['REQUEST_URI']); exit;
  }

  if ($action === 'remove' && $pid) {
    if (!empty($_SESSION['cart'][$pid])) unset($_SESSION['cart'][$pid]);
    header("Location: ".$_SERVER['REQUEST_URI']); exit;
  }
}

$accessories = $products->getFilteredProducts($search, $category, $from, $to);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Accessories | KeysON Lab</title>
<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
/* ===== THEME ===== */
:root{
  --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
  --bg:#0b0816; --bg2:#170e2d; --text:#f5f7fb; --muted:#b7bfd3;
  --panel:rgba(255,255,255,.05); --stroke:rgba(255,255,255,.10);
  --grad:linear-gradient(90deg,var(--violet-2),var(--magenta),var(--violet-3));
  --grad2:linear-gradient(90deg,var(--violet-3),var(--magenta),var(--cyan));
  --radius:18px; --header-h:76px;
  --ctrl-bg: rgba(255,255,255,.06);
  --ctrl-bg-hover: rgba(255,255,255,.09);
  --ctrl-border: rgba(255,255,255,.18);
  --ctrl-border-focus: rgba(155,43,255,.55);
  --placeholder: rgba(245,247,251,.45);
  --ring: 0 0 0 3px rgba(155,43,255,.25);
}
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{
  font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
  color:var(--text);
  background:
    radial-gradient(1200px 600px at 12% -8%, rgba(155,43,255,.25), transparent 60%),
    radial-gradient(900px 450px at 100% 0%, rgba(0,228,255,.18), transparent 60%),
    linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%);
  background-attachment: fixed; /* no tiling */
  overflow-x:hidden;
}

/* ===== HEADER ===== */
header{
  position:fixed;inset:0 0 auto 0;height:var(--header-h);z-index:50;
  display:flex;align-items:center;justify-content:space-between;
  padding:0 2.5%;
  background:rgba(16,12,30,.72);backdrop-filter:blur(14px);
  border-bottom:1px solid var(--stroke);
}
header img{height:50px}
nav ul{list-style:none;display:flex;gap:1.6rem}
nav a{color:var(--text);text-decoration:none;font-family:'Exo 2',sans-serif;font-weight:700;position:relative}
nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .25s}
nav a:hover::after{width:100%}
.menu-toggle{display:none;background:none;border:0;color:var(--text);font-size:28px;cursor:pointer}

/* ===== LAYOUT (FULL WIDTH) ===== */
main{
  width:100%;
  padding:calc(var(--header-h) + 24px) 2.5% 60px;
  display:grid;
  grid-template-columns:
    clamp(340px, 24vw, 460px) /* Filters */
    minmax(0,1fr)             /* Products */
    clamp(320px, 23vw, 460px) /* Cart */;
  gap:24px;
}

/* ===== PANELS ===== */
.panel{
  background:var(--panel);
  border:1px solid var(--stroke);
  border-radius:var(--radius);
  backdrop-filter:blur(8px);
  padding:18px;
  min-width:0;
  box-shadow:0 0 24px rgba(155,43,255,.14);
}
.panel h1{
  font-family:'Exo 2',sans-serif;font-size:1.35rem;margin-bottom:12px;
  background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent
}

/* ===== FILTERS (PREMIUM CONTROLS) ===== */
.filters h3{color:var(--muted);margin:16px 0 10px;font-size:1rem;letter-spacing:.2px}
.filters form{display:grid;gap:12px;align-items:center}
#search-form{grid-template-columns: 1fr 150px;}
#price-form {grid-template-columns: 1fr 1fr 150px;}
@media (max-width: 1000px){ #search-form,#price-form{grid-template-columns:1fr;} }

.filters input[type="text"], .filters input[type="number"]{
  appearance:none;width:100%;min-width:0;
  background:var(--ctrl-bg);
  border:1px solid var(--ctrl-border);
  color:var(--text);padding:12px 14px;border-radius:14px;
  font-size:14px;line-height:1;transition: background .2s,border .2s,box-shadow .2s,transform .05s;
}
.filters input::placeholder{ color:var(--placeholder); }
.filters input:hover{ background:var(--ctrl-bg-hover); }
.filters input:focus{ outline:0;border-color:var(--ctrl-border-focus);box-shadow:var(--ring); }
.filters input[type=number]::-webkit-outer-spin-button,
.filters input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
.filters input[type=number]{ -moz-appearance: textfield; }

.filters button{
  width:100%;padding:12px 14px;border-radius:14px;border:0;cursor:pointer;
  font-weight:800;font-size:14px;letter-spacing:.2px;color:#fff;
  background:var(--grad);
  box-shadow:0 8px 30px rgba(155,43,255,.18);
  transition: transform .12s, box-shadow .2s, background .3s;
}
.filters button:hover{ background:var(--grad2); transform:translateY(-2px); box-shadow:0 10px 36px rgba(155,43,255,.28); }

.categories{
  display:grid;gap:10px;
  grid-template-columns: repeat(auto-fit, minmax(140px,1fr));
}
.categories a{
  display:inline-flex;justify-content:center;align-items:center;
  padding:10px 12px;border-radius:999px;border:1px solid var(--ctrl-border);
  background:var(--ctrl-bg);color:var(--text);text-decoration:none;
  font-weight:700;font-size:13px;letter-spacing:.2px;
  transition: background .2s,border .2s,transform .1s,box-shadow .2s;
  white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
}
.categories a:hover{ background:var(--ctrl-bg-hover); transform:translateY(-1px); }
.categories a.active{ background:var(--grad); border-color:transparent; box-shadow:0 8px 26px rgba(155,43,255,.25); }

/* ===== PRODUCTS ===== */
.products h1{text-align:center;margin:6px 0 16px}
.grid{
  display:grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap:18px;width:100%;min-width:0;
}
.card{
  display:flex;flex-direction:column;align-items:stretch;
  background:linear-gradient(180deg,rgba(255,255,255,.06),rgba(255,255,255,.02));
  border:1px solid rgba(255,255,255,.10);
  border-radius:16px;padding:16px;transition:.25s
}
.card:hover{transform:translateY(-4px);box-shadow:0 0 30px rgba(155,43,255,.25)}
.card .media{display:block}
.card img{width:100%;height:auto;border-radius:12px;margin-bottom:12px;transition:transform .3s}
.card:hover img{transform:scale(1.03)}
.card .title{display:block;text-decoration:none;color:var(--text)}
.card h3{font-family:'Exo 2',sans-serif;font-size:15px;margin:.35rem 0 .3rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.card .price{color:var(--muted);font-size:.96rem;margin-bottom:12px}
.card .actions{margin-top:auto}
.card button{
  width:100%;background:var(--grad);border:none;border-radius:999px;color:#fff;
  padding:12px 16px;font-weight:800;cursor:pointer;transition:.2s;
  box-shadow:0 8px 30px rgba(155,43,255,.18);
}
.card button:hover{background:var(--grad2);transform:translateY(-2px);box-shadow:0 10px 36px rgba(155,43,255,.28)}

/* === CART (optimized, no conflicts) === */
.cart{display:flex;flex-direction:column;gap:12px;padding:18px}

.cart-items{display:flex;flex-direction:column;gap:12px;padding-right:4px}
.cart-items::before{
  content:"";display:block;height:2px;border-radius:2px;margin-bottom:2px;
  background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);
}

/* Item row: thumb | details | remove */
.cart-item{
  display:grid;grid-template-columns:64px 1fr auto;align-items:center;gap:12px;
  background:rgba(255,255,255,.04);border:1px solid var(--stroke);
  border-radius:14px;padding:12px
}
.cart-item img{width:64px;aspect-ratio:1/1;object-fit:cover;border-radius:10px}
.cart-item > div{min-width:0}
.cart-item h3{
  font-size:14px;line-height:1.25;margin:0;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;
  overflow:hidden
}
.cart-item p{font-size:13px;color:var(--muted);margin:.25rem 0 0}
.cart-item form{display:flex;align-items:center}

/* Buttons */
.remove{
  background:linear-gradient(90deg,#e74c3c,#ff6b6b);border:none;color:#fff;
  border-radius:12px;padding:8px 12px;font-weight:900;cursor:pointer;transition:.2s;
  box-shadow:0 8px 22px rgba(255,90,90,.18);white-space:nowrap
}
.remove:hover{transform:translateY(-2px);filter:brightness(.95)}

.cart-summary{
  position:sticky;bottom:0;z-index:2;
  margin:0 -18px -18px;padding:12px 18px 18px;text-align:center;
}
.cart-summary p{margin-bottom:10px}
.checkout{
  display:inline-flex;justify-content:center;align-items:center;gap:10px;
  background:linear-gradient(90deg,#27ae60,#2ecc71);color:#fff;
  font-weight:900;border-radius:999px;padding:12px 22px;text-decoration:none;transition:.2s;width:100%
}
.checkout:hover{transform:translateY(-2px);box-shadow:0 0 22px rgba(39,174,96,.32)}

/* Scrollbars for side panels */
.cart,.filters{scrollbar-width:thin;scrollbar-color:rgba(255,255,255,.18) transparent}
.cart::-webkit-scrollbar,.filters::-webkit-scrollbar{width:10px}
.cart::-webkit-scrollbar-thumb,.filters::-webkit-scrollbar-thumb{background:rgba(255,255,255,.18);border-radius:8px}

/* Mobile */
@media (max-width:560px){
  .cart-item{grid-template-columns:56px 1fr}
  .cart-item img{width:56px}
  .cart-item form{grid-column:1/-1;justify-content:flex-end}
}

/* Mobile refinements */
@media (max-width: 560px){
  .cart-item{ grid-template-columns:56px 1fr; }
  .cart-item form{ grid-column:1 / -1; justify-content:flex-end; }
}


/* ===== FOOTER ===== */
footer{
  width:100%;padding:28px 2.5%;text-align:center;font-size:.92rem;color:var(--muted);
  border-top:1px solid var(--stroke)
}
footer a{color:var(--violet-3);text-decoration:none}
footer a:hover{color:var(--magenta)}

/* ===== RESPONSIVE ===== */
@media (max-width: 1120px){
  main{grid-template-columns: clamp(320px, 30vw, 420px) minmax(0,1fr);}
}
@media (max-width: 820px){
  .menu-toggle{display:block}
  nav{
    position:absolute;right:2.5%;top:var(--header-h);
    background:rgba(20,10,40,.95);border:1px solid var(--stroke);
    border-radius:12px;overflow:hidden;max-height:0;transition:max-height .3s;
  }
  nav.open{max-height:280px}
  nav ul{flex-direction:column;padding:10px}
  main{grid-template-columns: 1fr;gap:16px;padding:calc(var(--header-h) + 16px) 2.5% 44px}
  #search-form,#price-form{grid-template-columns:1fr;}
}


/* --- Sticky side panels: desktop-only, smooth on touch --- */

/* Default: sticky for large screens */
.filters, .cart{
  position: sticky;
  top: calc(var(--header-h) + 16px);
  max-height: calc(100vh - var(--header-h) - 32px);
  overflow: auto;
  -webkit-overflow-scrolling: touch;   /* iOS momentum */
  overscroll-behavior: contain;        /* no bounce chaining */
  background: var(--panel);            /* avoid transparency artifacts */
  z-index: 1;                          /* above grid content */
}

/* Prevent parent from breaking sticky */
main{ align-items: start; }

/* iOS safe-area padding when sticky */
@supports (padding-top: env(safe-area-inset-top)){
  .filters, .cart{ top: calc(var(--header-h) + env(safe-area-inset-top) + 8px); }
}

/* Phone & small tablets: disable sticky (normal flow) */
@media (max-width: 900px), (hover: none) {
  .filters, .cart{
    position: static;
    max-height: none;
    overflow: visible;
  }
}

/* Tiny UX polish: ensure interior spacing works when scrollable */
.filters > *, .cart > *{ min-width: 0; }



</style>
</head>
<body>

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
  <!-- FILTERS -->
  <aside class="panel filters">
    <h1>Filters</h1>

    <h3>Search</h3>
    <form id="search-form" method="get">
      <input type="text" name="q" placeholder="Search products..." value="<?= htmlspecialchars($search ?? '') ?>">
      <input type="hidden" name="price_from" value="<?= htmlspecialchars($from) ?>">
      <input type="hidden" name="price_to" value="<?= htmlspecialchars($to) ?>">
      <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
      <button type="submit">Search</button>
    </form>

    <h3>Price</h3>
    <form id="price-form" method="get">
      <input type="number" name="price_from" placeholder="From €" value="<?= htmlspecialchars($from) ?>">
      <input type="number" name="price_to" placeholder="To €" value="<?= htmlspecialchars($to) ?>">
      <input type="hidden" name="q" value="<?= htmlspecialchars($search ?? '') ?>">
      <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
      <button type="submit">Filter</button>
    </form>

    <h3>Categories</h3>
    <div class="categories">
      <?php
        $cats = ['all','Keycaps','Arm Rests','Cables','Mats','Cases'];
        foreach($cats as $c):
          $is = ($category === $c) ? 'active' : '';
      ?>
        <a class="<?= $is ?>"
           href="?category=<?= urlencode($c) ?>&q=<?= urlencode($search ?? '') ?>&price_from=<?= urlencode($from) ?>&price_to=<?= urlencode($to) ?>">
           <?= htmlspecialchars($c) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <div class="categories" style="margin-top:10px">
      <a href="?" style="border-color:#ff6b6b">Reset</a>
    </div>
  </aside>

  <!-- PRODUCTS -->
  <section class="panel products">
    <h1>Keyboard Accessories</h1>
    <div class="grid">
      <?php foreach($accessories as $p): ?>
        <div class="card">
          <a class="media" href="<?php echo BASE_URL ?>/product/<?= (int)$p['id'] ?>">
            <img src="<?php echo BASE_URL ?>/img/products/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
          </a>
          <a class="title" href="<?php echo BASE_URL ?>/product/<?= (int)$p['id'] ?>">
            <h3><?= htmlspecialchars($p['name']) ?></h3>
          </a>
          <p class="price"><strong><?= number_format((float)$p['price'], 2) ?>€</strong></p>
          <form class="actions" method="post">
            <input type="hidden" name="product_id" value="<?= (int)$p['id'] ?>">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($p['name']) ?>">
            <input type="hidden" name="product_price" value="<?= number_format((float)$p['price'],2,'.','') ?>">
            <input type="hidden" name="product_image" value="<?= htmlspecialchars($p['image']) ?>">
            <input type="hidden" name="action" value="add">
            <button type="submit">Add to Cart</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- CART -->
  <aside class="panel cart">
    <h1>Cart</h1>
    <div class="cart-items">
      <?php if(!empty($_SESSION['cart'])): $total=0; foreach($_SESSION['cart'] as $c): $total += (float)$c['price']; ?>
        <div class="cart-item">
          <img src="<?php echo BASE_URL ?>/img/products/<?= htmlspecialchars($c['image']) ?>" alt="">
          <div>
            <h3><?= htmlspecialchars($c['name']) ?></h3>
            <p><strong><?= number_format((float)$c['price'],2) ?>€</strong></p>
          </div>
          <form method="post">
            <input type="hidden" name="product_id" value="<?= (int)$c['id'] ?>">
            <input type="hidden" name="action" value="remove">
            <button class="remove" type="submit">Remove</button>
          </form>
        </div>
      <?php endforeach; ?>
      <div class="cart-summary">
        <p><strong>Total: <?= number_format($total,2) ?>€</strong></p>
        <a class="checkout" href="<?php echo BASE_URL; ?>/order_products">Checkout</a>
      </div>
      <?php else: ?>
        <p style="color:var(--muted)">Cart is empty</p>
      <?php endif; ?>
    </div>
  </aside>
</main>

<footer>
  &copy; 2025 KeysON Lab — <a href="<?php echo BASE_URL; ?>/privacy_policy">Privacy Policy</a><br/>All rights reserved. EU delivery only.
</footer>

<script>
/* mobile nav toggle + close on outside click */
document.addEventListener('click', (e)=>{
  const nav=document.querySelector('nav');
  const toggle=e.target.closest('.menu-toggle');
  if(toggle){ nav.classList.toggle('open'); return; }
  if(nav && !nav.contains(e.target)) nav.classList.remove('open');
});
</script>
</body>
</html>
