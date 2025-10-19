<?php
$BASE = defined('BASE_URL') ? BASE_URL : '.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Privacy Policy | KeysON Lab</title>
<link rel="icon" type="image/png" href="<?php echo $BASE; ?>/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
  --bg:#130a21; --bg2:#170e2d; --text:#f5f7fb; --muted:#b6bdd0;
  --panel:rgba(255,255,255,.05); --stroke:rgba(255,255,255,.10);
  --grad:linear-gradient(90deg,var(--violet-2),var(--magenta),var(--violet-3));
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

/* ===== Site header (scoped) ===== */
.site-header{
  position:fixed; inset:0 0 auto 0; height:var(--header-h); z-index:50;
  display:flex; align-items:center; justify-content:space-between;
  padding:0 6%; background:rgba(20,10,40,.6); backdrop-filter:blur(14px);
  border-bottom:1px solid var(--stroke);
}
.site-header img{height:55px}
.site-header nav ul{list-style:none;display:flex;gap:2rem}
.site-header nav a{color:var(--text);text-decoration:none;font-weight:700;font-family:'Exo 2',sans-serif;position:relative}
.site-header nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .25s}
.site-header nav a:hover::after{width:100%}
.menu-toggle{display:none;background:none;border:0;color:var(--text);font-size:28px;cursor:pointer}
@media (max-width:860px){
  .menu-toggle{display:block}
  .site-header nav{position:absolute; right:6%; top:var(--header-h); background:rgba(20,10,40,.95);
      border:1px solid var(--stroke); border-radius:12px; overflow:hidden; max-height:0; transition:max-height .3s}
  .site-header nav.open{max-height:280px}
  .site-header nav ul{flex-direction:column; padding:10px}
}

/* ===== Main ===== */
main{max-width:980px; margin:0 auto; padding:calc(var(--header-h) + 28px) 6% 72px;}
.panel{
  background:var(--panel); border:1px solid var(--stroke); border-radius:var(--radius);
  backdrop-filter:blur(8px); padding:26px; box-shadow:0 0 28px rgba(155,43,255,.16);
}
h1,h2{font-family:'Exo 2',sans-serif; background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent}
h1{font-size:2.2rem; margin:6px 0 10px}
h2{font-size:1.35rem; margin:22px 0 10px}
p,li{color:var(--text); line-height:1.75}
p{margin:0 0 14px}
ul{margin:8px 0 16px 18px}
.small{color:var(--muted); font-size:.95rem}
.section{margin-top:14px}
hr{border:none;height:1px;background:var(--stroke); margin:18px 0}

/* Ensure only the site header is fixed; article headers remain normal */
article > header{position:static; padding:0; margin:0 0 6px}

/* ===== Footer ===== */
footer{text-align:center;padding:28px 6%;font-size:.92rem;color:var(--muted);border-top:1px solid var(--stroke)}
footer a{color:var(--violet-3); text-decoration:none}
footer a:hover{color:var(--magenta)}
</style>
</head>
<body class="neon-grid">

<header class="site-header">
  <a href="<?php echo $BASE; ?>/">
    <img src="<?php echo $BASE; ?>/img/logo-no-background-2.png" alt="KeysON Lab">
  </a>
  <button class="menu-toggle" aria-label="Toggle menu" onclick="document.querySelector('.site-header nav').classList.toggle('open')">☰</button>
  <nav>
    <ul>
      <li><a href="<?php echo $BASE; ?>/keyboard_builder">Builder</a></li>
      <li><a href="<?php echo $BASE; ?>/products">Accessories</a></li>
      <li><a href="<?php echo $BASE; ?>/contacts">Contacts</a></li>
    </ul>
  </nav>
</header>

<main>
  <article class="panel" role="article">
    <header>
      <p class="small"><strong>Last updated:</strong> 13 September 2025</p>
      <h1>Privacy Policy</h1>
      <p class="small">This Privacy Policy explains how <strong>KeysON Lab</strong> (“we”, “our”, “us”) collects, uses, and protects your personal information when you visit our website and place an order. We comply with the GDPR.</p>
    </header>
    <hr>

    <section class="section" id="info-we-collect">
      <h2>1. Information We Collect</h2>
      <ul>
        <li>Name and surname</li>
        <li>Shipping and billing address</li>
        <li>Email address</li>
        <li>Phone number (if required for shipping)</li>
        <li>Payment details (processed by third-party providers)</li>
        <li>Technical data (IP, browser, cookies for functionality)</li>
      </ul>
    </section>

    <section class="section" id="how-we-use">
      <h2>2. How We Use Your Data</h2>
      <p>We use your information only for:</p>
      <ul>
        <li>Processing and shipping your orders</li>
        <li>Communicating about your purchase</li>
        <li>Customer support</li>
        <li>Legal/accounting obligations</li>
        <li>Improving website and services</li>
      </ul>
      <p><strong>We do not sell or rent</strong> your personal data.</p>
    </section>

    <section class="section" id="sharing">
      <h2>3. Sharing Your Data</h2>
      <p>Shared only with trusted providers required to fulfill your order:</p>
      <ul>
        <li>Payment processors (e.g., Stripe, PayPal)</li>
        <li>Shipping/logistics companies</li>
        <li>Hosting and technical support</li>
      </ul>
      <p>Partners must keep data secure and use it only for the agreed purpose.</p>
    </section>

    <section class="section" id="retention">
      <h2>4. Data Retention</h2>
      <p>Order info is stored as required by law (typically 5–10 years for tax/accounting). Other data is kept only as long as needed or until deletion is requested.</p>
    </section>

    <section class="section" id="rights">
      <h2>5. Your Rights (GDPR)</h2>
      <ul>
        <li>Access your personal data</li>
        <li>Request correction</li>
        <li>Request deletion (“right to be forgotten”)</li>
        <li>Restrict or object to processing</li>
        <li>Data portability</li>
      </ul>
      <p>Contact: <strong>keyson.customs@gmail.com</strong>.</p>
    </section>

    <section class="section" id="cookies">
      <h2>6. Cookies</h2>
      <p>We use cookies for functionality and UX. You can control cookies in your browser settings.</p>
    </section>

    <section class="section" id="security">
      <h2>7. Data Security</h2>
      <p>We apply technical and organizational measures to protect your personal data against loss, misuse, or unauthorized access.</p>
    </section>

    <section class="section" id="contact">
      <h2>8. Contact Us</h2>
      <p><strong>KeysON Lab</strong><br>
      Email: <strong>keyson.customs@gmail.com</strong><br>
      Address: <strong>Avilés, Spain</strong></p>
    </section>
  </article>
</main>

<footer>
  &copy; 2025 KeysON Lab — <a href="<?php echo $BASE; ?>/privacy_policy.php">Privacy Policy</a><br/>All rights reserved. EU delivery only.
</footer>

<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</body>
</html>
