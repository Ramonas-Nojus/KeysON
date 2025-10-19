<?php
session_start();
require "inlcudes/autoload.php";
include 'settings-core-7189.php';

$products = new Products();

/* ---- product ---- */
$product_id = isset($_GET['p_id']) ? (int)$_GET['p_id'] : 0;
if (!$product_id) die("Product not found.");
$product = $products->getById($product_id);
if (!$product) die("Product not found.");

$name   = htmlspecialchars($product['name'] ?? 'Product');
$image  = htmlspecialchars($product['image'] ?? '');
$desc   = $product['description'] ?? '';
$price  = (float)($product['price'] ?? 0);
$related = $products->getRelated($product_id, $product['category'] ?? 'all');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  <title><?php echo htmlspecialchars($product['name']); ?> | KeysON Lab</title>
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
      color:var(--text);
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
      background:
        radial-gradient(1200px 600px at 12% -8%, rgba(155,43,255,.25), transparent 60%),
        radial-gradient(900px 450px at 100% 0%, rgba(0,228,255,.18), transparent 60%),
        linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%);
      background-attachment: fixed;
      overflow-x:hidden;
      padding-top: var(--header-h);
    }

    /* ===== HEADER ===== */
    header{
      position:fixed; inset:0 0 auto 0; height:var(--header-h); z-index:50;
      display:flex; align-items:center; justify-content:space-between;
      padding:0 2.5%; background:rgba(16,12,30,.72); backdrop-filter:blur(14px);
      border-bottom:1px solid var(--stroke);
    }
    header img{height:50px}
    nav ul{list-style:none;display:flex;gap:1.6rem}
    nav a{color:var(--text);text-decoration:none;font-family:'Exo 2',sans-serif;font-weight:700;position:relative}
    nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .25s}
    nav a:hover::after{width:100%}
    .menu-toggle{display:none;background:none;border:0;color:var(--text);font-size:28px;cursor:pointer}
    @media (max-width:820px){
      .menu-toggle{display:block}
      nav{position:absolute;right:2.5%;top:var(--header-h);background:rgba(20,10,40,.95);
          border:1px solid var(--stroke);border-radius:12px;overflow:hidden;max-height:0;transition:max-height .3s}
      nav.show{max-height:280px}
      nav ul{flex-direction:column;padding:10px}
    }

    /* ===== PAGE CONTAINERS ===== */
    .container{ max-width:1440px; margin:24px auto; padding:0 2.5%; }

    /* Product + Cart row (cart is sticky within this grid) */
    .top-grid{
      position:relative;
      display:grid;
      grid-template-columns: minmax(0,1.25fr) clamp(360px,24vw,460px);
      gap:28px;
      align-items:start;
      margin-bottom:32px;
    }

    /* Panels */
    .panel{
      background:var(--panel);
      border:1px solid var(--stroke);
      border-radius:var(--radius);
      backdrop-filter:blur(8px);
      padding:18px;
      min-width:0;
      box-shadow:0 0 24px rgba(155,43,255,.14);
    }

    /* ===== PRODUCT ===== */
    .keyboard-window{ /* panel styles applied via .panel but keep class for semantics */ }
    .product-page{display:flex;flex-wrap:wrap;gap:24px}
    .product-gallery{
      flex:1 1 760px;
      display:flex;align-items:center;justify-content:center;
    }
    .product-gallery .main-image{
      width:100%;
      max-width: 860px;
      object-fit: contain;
      display:block;
      background:
        radial-gradient(900px 600px at 20% 10%, rgba(155,43,255,.10), transparent 60%),
        radial-gradient(600px 380px at 80% 10%, rgba(0,228,255,.08), transparent 60%),
        rgba(255,255,255,.04);
      border:1px solid var(--stroke);
      border-radius:24px;
      box-shadow:
        0 14px 40px rgba(0,0,0,.35),
        0 0 28px rgba(75,24,210,.28),
        0 0 46px rgba(0,228,255,.22);
      image-rendering: -webkit-optimize-contrast;
      image-rendering: crisp-edges;
      transition: transform .22s ease, box-shadow .22s ease, filter .22s ease;
    }
    .product-gallery .main-image:hover{
      transform: translateY(-2px) scale(1.012);
      box-shadow:
        0 18px 54px rgba(0,0,0,.40),
        0 0 36px rgba(75,24,210,.36),
        0 0 60px rgba(0,228,255,.30);
    }

    .product-details{flex:1 1 560px; display:flex; flex-direction:column; gap:16px}
    .product-details h1{
      font-family:'Exo 2',sans-serif; font-size:clamp(1.8rem,3.2vw,2.2rem);
      margin:0 0 6px; letter-spacing:-.2px;
      background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    }
    .price{display:flex;align-items:center;gap:10px}
    .price .old-price{font-size:1rem;color:#ff8a8a;text-decoration:line-through;opacity:.7}
    .price .new-price{font-size:1.6rem;font-weight:900;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .vat-note{color:var(--muted);font-size:.92rem;margin-top:-6px}
    .long-desc{line-height:1.75;color:#dfe3ef;opacity:.92}

    /* Buttons */
    a{text-decoration:none}
    button{
      width:100%;background:var(--grad);border:none;border-radius:999px;color:#fff;
      padding:12px 16px;font-weight:800;cursor:pointer;transition:.2s;
      box-shadow:0 8px 30px rgba(155,43,255,.18);
      transform: translateY(0);
    }
    button:hover{background:var(--grad2);transform:translateY(-2px);box-shadow:0 10px 36px rgba(155,43,255,.28)}
    button:focus-visible{outline:0;box-shadow:var(--ring)}

    /* ===== CART (sticky) ===== */
    .cart{
      position: sticky;
      top: calc(var(--header-h) + 16px);
      max-height: calc(100vh - var(--header-h) - 32px);
      overflow: auto;
      -webkit-overflow-scrolling: touch;
      overscroll-behavior: contain;
      background: var(--panel);
      box-shadow: 0 10px 28px rgba(0,0,0,.28), 0 0 0 1px rgba(255,255,255,.05) inset;
      z-index: 1;
    }
    .cart h1{
      font-family:'Exo 2',sans-serif;font-size:1.35rem;margin-bottom:12px;
      background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent
    }
    .cart-items{display:flex;flex-direction:column;gap:12px;padding-right:4px}
    .cart-items::before{
      content:"";display:block;height:2px;border-radius:2px;margin-bottom:2px;
      background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);
    }
    .cart-item{
      display:grid;grid-template-columns:64px 1fr auto;align-items:center;gap:12px;
      background:rgba(255,255,255,.04);border:1px solid var(--stroke);
      border-radius:14px;padding:12px 14px;
    }
    .cart-item img{width:64px;aspect-ratio:1/1;object-fit:cover;border-radius:10px}
    .cart-item > div{min-width:0}
    .cart-item h3{
      font-size:14px;line-height:1.25;margin:0;
      display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden
    }
    .cart-item p{font-size:13px;color:var(--muted);margin:.25rem 0 0}
    .remove{
      background:linear-gradient(90deg,#e74c3c,#ff6b6b);border:none;color:#fff;
      border-radius:12px;padding:8px 12px;font-weight:900;cursor:pointer;transition:.2s;
      box-shadow:0 8px 22px rgba(255,90,90,.18);white-space:nowrap
    }
    .remove:hover{transform:translateY(-2px);filter:brightness(.95)}
    .cart-summary{
      position:sticky;bottom:0;z-index:2;
      margin:0 -18px -18px;padding:14px 18px 18px;text-align:center;
    }
    .checkout{
      display:inline-flex;justify-content:center;align-items:center;gap:10px;
      background:linear-gradient(90deg,#27ae60,#2ecc71);color:#fff;
      font-weight:900;border-radius:999px;padding:12px 22px;text-decoration:none;transition:.2s;width:100%
    }
    .checkout:hover{transform:translateY(-2px);box-shadow:0 0 22px rgba(39,174,96,.32)}

    /* ===== RELATED ===== */
    .related-window{
      background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.02));
      border:1px solid rgba(255,255,255,.10);
      border-radius:var(--radius);
      padding:20px 16px 26px;
      box-shadow:0 0 24px rgba(155,43,255,.14);
      margin-top: 28px;
    }
    .related-window h2{
      font-family:'Exo 2',sans-serif; font-size:1.3rem; text-align:center; margin:0 0 14px;
      background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent;
    }
    .related-products{display:flex;flex-wrap:wrap;justify-content:center;gap:16px}
    .related-item{
      flex:0 1 220px; background:rgba(255,255,255,.04); border:1px solid var(--stroke);
      border-radius:16px; padding:12px; text-align:center; transition: transform .18s ease, box-shadow .18s ease;
    }
    .related-item:hover{transform:translateY(-4px); box-shadow:0 0 30px rgba(155,43,255,.25)}
    .related-item img{width:100%;height:auto;border-radius:12px}
    .related-item p{margin:10px 0 0;color:var(--text)}

    /* ===== FOOTER ===== */
    .site-footer{color:var(--muted);text-align:center;padding:24px 2.5%;border-top:1px solid var(--stroke)}
    .site-footer a{color:var(--violet-3);text-decoration:none}
    .site-footer a:hover{color:var(--magenta)}

    /* ===== MOBILE ===== */
    @media (max-width:900px){
      .container{ max-width:100%; }
      .top-grid{ grid-template-columns:1fr; gap:18px; }
      .product-page{flex-direction:column}
      .product-gallery .main-image{ padding:16px; border-radius:20px; max-width:100%; }
      .cart{ position: static; max-height: none; overflow: visible; }
      .cart-item{grid-template-columns:60px 1fr}
    }

/* Narrow the global button rule */
.keyboard-window .cart-form button,
.products .card button,
.filters button {
  width:100%;
  background:var(--grad);
  border:none;
  border-radius:999px;
  color:#fff;
  padding:12px 16px;
  font-weight:800;
  cursor:pointer;
  transition:.2s;
  box-shadow:0 8px 30px rgba(155,43,255,.18);
}

/* Cart-specific buttons keep their look regardless of replacement */
.cart button.remove{
  background:linear-gradient(90deg,#e74c3c,#ff6b6b);
  border:none;color:#fff;border-radius:12px;padding:8px 12px;
  font-weight:900;cursor:pointer;transition:.2s;
  box-shadow:0 8px 22px rgba(255,90,90,.18);white-space:nowrap
}
.cart a.checkout{
  display:inline-flex;justify-content:center;align-items:center;gap:10px;
  background:linear-gradient(90deg,#27ae60,#2ecc71);color:#fff;
  font-weight:900;border-radius:999px;padding:12px 22px;text-decoration:none;transition:.2s;width:100%
}


  </style>
</head>
<body>

<header>
  <a href="<?php echo BASE_URL; ?>/">
    <div class="logo">
      <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysOn">
    </div>
  </a>
  <button class="menu-toggle" aria-label="Toggle menu">☰</button>
  <nav>
    <ul>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/keyboard_builder">Builder</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/products">Accessories</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/contacts">Contacts</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <!-- ROW 1: Product + Cart -->
  <div class="top-grid">
    <!-- Product -->
    <div class="panel keyboard-window">
      <div class="product-page">
        <div class="product-gallery">
          <img
            src="<?php echo BASE_URL ?>/img/products/<?php echo htmlspecialchars($product['image']); ?>"
            alt="<?php echo htmlspecialchars($product['name']); ?>"
            class="main-image">
        </div>

        <div class="product-details">
          <h1><?php echo htmlspecialchars($product['name']); ?></h1>

          <p class="price">
            <span class="old-price"><?php echo number_format($product['price'] * 2, 2); ?>€</span>
            <span class="new-price"><?php echo number_format($product['price'], 2); ?>€</span>
          </p>
          <p class="vat-note">Price includes VAT</p>

          <!-- Progressive enhancement: posts to handler; JS intercepts for AJAX -->
          <form action="<?php echo BASE_URL; ?>/cart-handler.php" method="post" class="cart-form">
            <input type="hidden" name="product_id" value="<?php echo (int)$product['id']; ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo number_format((float)$product['price'],2,'.',''); ?>">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
            <input type="hidden" name="action" value="add">
            <button type="submit">Add to Cart</button>
          </form>

          <p class="long-desc"><?php echo $product['description']; ?></p>
        </div>
      </div>
    </div>

    <!-- Cart (sticky) -->
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
          <form method="post" action="<?php echo BASE_URL; ?>/cart-handler.php">
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
  </div>

  <!-- ROW 2: Related -->
  <div class="related-window">
    <h2>You may also like</h2>
    <div class="related-products">
      <?php foreach ($related as $r): ?>
        <div class="related-item">
          <a href="<?php echo BASE_URL ?>/product/<?php echo (int)$r['id']; ?>" style="color:inherit">
            <img src="<?php echo BASE_URL ?>/img/products/<?php echo htmlspecialchars($r['image']); ?>" 
                 alt="<?php echo htmlspecialchars($r['name']); ?>">
            <p><?php echo htmlspecialchars($r['name']); ?></p>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<div class="site-footer">
  &copy; 2025 KeysON Lab — <a href="<?php echo BASE_URL ?>/privacy_policy">Privacy Policy</a>
  <div class="copyright" style="margin-top:5px;">All rights reserved.</div>
</div>

<script>
  // Mobile nav toggle
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });

  // Cart: Add + Remove (AJAX; JSON or HTML supported)
  document.body.addEventListener("submit", async (e) => {
    const form = e.target;

    // Intercept both the product add form and the cart remove forms
    if (!form.matches(".cart-form, .cart .cart-item form")) return;

    e.preventDefault();

    const fd = new FormData(form);
    fd.append("ajax", "1"); // hint for server to return JSON/snippet

    // Prefer the form's action; fall back to the handler path
    const action = form.getAttribute("action") || "<?php echo BASE_URL; ?>/cart-handler.php";

    try {
      const res  = await fetch(action, {
        method: form.method || "POST",
        headers: {
          "Accept": "application/json, text/html;q=0.9, */*;q=0.8",
          "X-Requested-With": "XMLHttpRequest"
        },
        body: fd
      });

      const text = await res.text();
      let html;

      // Try JSON first; if not JSON, treat as HTML snippet
      try {
        const json = JSON.parse(text);
        html = json.cart ?? json.html ?? null;
      } catch {
        html = text;
      }

      if (html) {
        const wrap = document.querySelector(".cart .cart-items");
        if (wrap) wrap.innerHTML = html;
      } else {
        // If we didn't get usable content, reload to stay consistent
        location.reload();
      }
    } catch (err) {
      console.error("Cart update failed:", err);
      location.reload();
    }
  });


</script>

</body>
</html>
