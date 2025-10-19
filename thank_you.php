<?php include 'settings-core-7189.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"/>
  <title>Thank You | KeysON Lab</title>
  <link rel="icon" type="image/png" href="<?php echo BASE_URL ?>/img/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Exo+2:wght@700;800&display=swap" rel="stylesheet">

  <style>
    /* ===== THEME ===== */
    :root{
      --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
      --bg:#0b0816; --bg2:#170e2d; --text:#f5f7fb; --muted:#b7bfd3;
      --panel:rgba(255,255,255,.06); --stroke:rgba(255,255,255,.10);
      --grad:linear-gradient(90deg,var(--violet-2),var(--magenta),var(--violet-3));
      --grad2:linear-gradient(90deg,var(--violet-3),var(--magenta),var(--cyan));
      --radius:20px; --header-h:76px;
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
      background-attachment: fixed;
      overflow-x:hidden;
      padding-top: var(--header-h);
    }

    /* ===== HEADER (glass) ===== */
    header{
      position:fixed; inset:0 0 auto 0; height:var(--header-h); z-index:50;
      display:flex; align-items:center; justify-content:space-between;
      padding:0 2.5%;
      background:rgba(16,12,30,.72);
      backdrop-filter:blur(14px);
      border-bottom:1px solid var(--stroke);
    }
    header img{height:50px}
    nav ul{list-style:none;display:flex;gap:1.6rem}
    nav a{color:var(--text);text-decoration:none;font-family:'Exo 2',sans-serif;font-weight:800;position:relative}
    nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .25s}
    nav a:hover::after{width:100%}
    .menu-toggle{display:none;background:none;border:0;color:var(--text);font-size:28px;cursor:pointer}

    @media (max-width:820px){
      .menu-toggle{display:block}
      nav{
        position:absolute;right:2.5%;top:var(--header-h);
        background:rgba(20,10,40,.95);border:1px solid var(--stroke);
        border-radius:14px;overflow:hidden;max-height:0;transition:max-height .3s;
      }
      nav.show{max-height:280px}
      nav ul{flex-direction:column;padding:10px}
    }

    /* ===== PAGE LAYOUT ===== */
    .wrap{
      max-width:1200px; margin:28px auto; padding:0 2.5%;
      display:grid;
      grid-template-columns: minmax(0,1fr);
      gap:22px;
    }

    .thanks-card{
      margin: 0 auto;
      width: min(680px, 100%);
      background: var(--panel);
      border:1px solid var(--stroke);
      border-radius: var(--radius);
      box-shadow: 0 0 24px rgba(155,43,255,.14), 0 12px 30px rgba(0,0,0,.25);
      backdrop-filter: blur(8px);
      padding: clamp(22px, 4vw, 36px);
      text-align: center;
    }

    .thanks-card .title{
      margin: 4px 0 8px;
      font-family:'Exo 2',sans-serif;
      font-size: clamp(1.6rem, 3.6vw, 2.2rem);
      font-weight: 800;
      letter-spacing: -0.2px;
      background: var(--grad);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .thanks-card p{
      color: #dfe3ef;
      opacity: .95;
      line-height:1.75;
      font-size: clamp(14px, 1.6vw, 16px);
      margin: 0 0 18px;
    }

    .cta{
      display:inline-block;
      margin-top:10px;
      padding: 12px 22px;
      border-radius: 999px;
      text-decoration:none;
      color:#fff;
      font-weight:800;
      background: var(--grad);
      box-shadow: 0 8px 28px rgba(155,43,255,.18);
      transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .cta:hover{ transform: translateY(-2px); box-shadow:0 12px 36px rgba(155,43,255,.28) }
    .cta:active{ transform: translateY(0) scale(.98) }

    /* tiny divider line */
    .divider{
      height:1px; width:100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.14), transparent);
      margin: 16px 0 22px;
      border-radius: 1px;
    }

    /* ===== FOOTER ===== */
    footer{
      width:100%; padding:28px 2.5%; text-align:center; font-size:.95rem; color:var(--muted);
      border-top:1px solid var(--stroke)
    }
    footer a{ color:#9b2bff; text-decoration:none }
    footer a:hover{ color:#7d11b9 }

    @media (max-width:520px){
      .thanks-card{ border-radius:18px; }
    }

    /* 1) Make the whole page a column layout */
    html, body { height: 100%; }
    body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    }

    /* 2) Let your main content take the available height */


    /* 3) Footer naturally sits at the bottom now */
    footer { margin-top: auto; }

  </style>
</head>
<body>

<header>
  <a href="<?php echo BASE_URL; ?>/">
    <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysON Lab">
  </a>
  <button class="menu-toggle" aria-label="Toggle menu">☰</button>
  <nav>
    <ul>
      <li><a href="<?php echo BASE_URL; ?>/keyboard_builder.php">Builder</a></li>
      <li><a href="<?php echo BASE_URL; ?>/products.php">Accessories</a></li>
      <li><a href="<?php echo BASE_URL; ?>/contacts.php">Contacts</a></li>
    </ul>
  </nav>
</header>

<main class="wrap">
  <section class="thanks-card">
    <h1 class="title">Thank You!</h1>
    <div class="divider"></div>
    <p>Your order has been received and is being processed.</p>
    <p>You’ll get an email confirmation shortly with all the details.</p>
    <a class="cta" href="<?php echo BASE_URL; ?>/">Return to Home</a>
  </section>
</main>

<footer>
  &copy; 2025 KeysON Lab —
  <a href="<?php echo BASE_URL; ?>/privacy_policy.php">Privacy Policy</a>
  <div style="margin-top:6px;font-size:.85rem;">All rights reserved.</div>
</footer>

<script>
  // Mobile nav toggle
  document.querySelector(".menu-toggle")?.addEventListener("click", () => {
    document.querySelector("header nav")?.classList.toggle("show");
  });
  // Close nav on outside click (mobile)
  document.addEventListener("click", (e) => {
    const nav = document.querySelector("header nav");
    const toggle = e.target.closest(".menu-toggle");
    if (!toggle && nav && !nav.contains(e.target)) nav.classList.remove("show");
  });
</script>

</body>
</html>
