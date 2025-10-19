<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Guides | KeysON Lab</title>
  <link rel="icon" type="image/png" href="./img/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet" />

  <style>
        :root{
      --violet-1:#2b0a49;  /* base */
      --violet-2:#4b18d2;  /* brand */
      --magenta:#7d11b9;   /* brand */
      --violet-3:#9b2bff;  /* brighter */
      --cyan:#00e4ff;      /* accent */
      --bg: #130a21;       /* page base */
      --text:#f5f7fb;      /* primary text */
      --muted:#b6bdd0;     /* secondary text */
      --panel: rgba(255,255,255,.04);
      --stroke: rgba(255,255,255,.10);
      --glow-1: rgba(75,24,210,.35);
      --glow-2: rgba(0,228,255,.25);
      --grad: linear-gradient(90deg, var(--violet-2), var(--magenta), var(--violet-3));
      --grad-cyan: linear-gradient(90deg, var(--violet-2), var(--cyan));
      --radius: 20px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; color:var(--text);
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
      background:
        radial-gradient(1200px 600px at 5% 0%, rgba(155,43,255,.25), transparent 60%),
        radial-gradient(800px 400px at 100% 0%, rgba(0,228,255,.20), transparent 60%),
        var(--bg);
      overflow-x:hidden;
    }




footer {
  background: transparent;   /* footer uses same gradient as rest of page */
}

    body{
      font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
      color:var(--text);
      background: radial-gradient(circle at 15% 10%, rgba(155,43,255,.25) 0%, transparent 70%),
                  radial-gradient(circle at 85% 5%, rgba(0,228,255,.18) 0%, transparent 70%),
                  linear-gradient(180deg, #0d0a1a 0%, #0e0b20 100%);
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      overflow-x:hidden;
    }

    /* Neon grid overlay (static, non-repeating) */
    body::before{
      content:""; position:fixed; inset:0; z-index:-2; pointer-events:none;
      background:
        linear-gradient(rgba(255,255,255,.04), rgba(255,255,255,.04)) center/100% 1px no-repeat,
        repeating-linear-gradient(90deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px),
        repeating-linear-gradient(0deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px);
      mask: radial-gradient(ellipse at center, rgba(0,0,0,.9), transparent 80%);
    }

    /* ---------- HEADER ---------- */
    header{
      position:fixed;
      top:0;left:0;width:100%;
      z-index:100;
      display:flex;justify-content:space-between;align-items:center;
      padding:1.2rem 6%;
      background:rgba(20,10,40,0.6);
      backdrop-filter:blur(14px);
      border-bottom:1px solid var(--stroke);
    }
    header img{height:55px}
    nav ul{list-style:none;display:flex;gap:2rem;margin:0;padding:0}
    nav a{
      color:var(--text);
      text-decoration:none;
      font-weight:600;
      font-family:'Exo 2',sans-serif;
      position:relative;
    }
    nav a::after{
      content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;
      background:var(--grad);transition:width .3s;
    }
    nav a:hover::after{width:100%}

    /* ---------- CONTENT ---------- */
    .guides-wrap{
      max-width:1100px;
      margin:140px auto 60px;
      padding:40px 32px;
      background:linear-gradient(180deg,var(--panel),var(--panel-deep));
      border:1px solid var(--stroke);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
    }

    .guides-section{
      display:grid;
      grid-template-columns:2fr 1fr;
      gap:40px;
    }
    @media(max-width:1024px){.guides-section{grid-template-columns:1fr}}

    h1,h2,h3{margin:0 0 16px 0}
    h1{
      font:800 30px "Exo 2",sans-serif;
      background:var(--grad);
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }
    h2{
      font:800 18px "Exo 2",sans-serif;
      background:var(--grad);
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
      margin:24px 0 12px;
    }
    h3{font:700 16px "Exo 2",sans-serif;color:var(--text);}
    p{color:var(--muted);line-height:1.7;margin-bottom:18px;}

    .guide-card{
      background:rgba(255,255,255,.04);
      border:1px solid var(--stroke);
      border-radius:16px;
      padding:18px 20px;
      margin-bottom:18px;
      box-shadow:0 10px 30px rgba(0,0,0,.10);
      transition:transform .25s ease, box-shadow .25s ease, background .25s;
    }
    .guide-card:hover{
      transform:translateY(-4px);
      background:rgba(255,255,255,.06);
      box-shadow:0 20px 45px rgba(155,43,255,.25);
    }
    .guide-card a{
      display:inline-block;
      margin-top:8px;
      font-weight:700;
      color:#bba7ff;
      text-decoration:none;
    }
    .guide-card a:hover{
      color:#fff;
      text-shadow:0 0 18px rgba(155,43,255,.35);
    }

    .future-posts{
      background:rgba(255,255,255,.02);
      border:1px solid var(--stroke);
      border-radius:16px;
      padding:20px;
    }
    .future-posts h2{text-align:center;margin-bottom:18px;}
    .future-posts .guide-card{
      background:rgba(255,255,255,.02);
      border:1px dashed rgba(255,255,255,.15);
      box-shadow:none;text-align:center;
    }

    footer{
      text-align:center;
      padding:3rem 5%;
      color:var(--muted);
      font-size:.9rem;
      border-top:1px solid rgba(255,255,255,0.05);
    }

    /* Mobile nav */
    .menu-toggle{display:none;font-size:28px;background:none;border:none;color:var(--text);}
    @media(max-width:768px){
      .menu-toggle{display:block}
      header nav{
        position:absolute;top:70px;right:0;width:100%;
        text-align:center;background:rgba(20,10,40,.9);
        backdrop-filter:blur(14px);
        max-height:0;overflow:hidden;
        transition:max-height .35s ease;
        border-top:1px solid var(--stroke);
      }
      header nav.show{max-height:320px;border-bottom:1px solid var(--stroke)}
      header nav ul{flex-direction:column;gap:12px;padding:16px 0}
    }
  </style>
</head>

<body>
  <header>
    <a href="./"><img src="./img/logo-no-background-2.png" alt="KeysON Lab"></a>
    <button class="menu-toggle">☰</button>
    <nav>
      <ul>
        <li><a href="./keyboard_builder">Builder</a></li>
        <li><a href="./products">Accessories</a></li>
        <li><a href="./contacts">Contacts</a></li>
      </ul>
    </nav>
  </header>

  <div class="guides-wrap">
    <div class="guides-section">
      <div>
        <h1>KeysON Guides</h1>
        <p>Core building fundamentals + Niterria 2025 posts for practical product picks and trends.</p>

        <h2>Overview</h2>
        <p>KeysON = evergreen knowledge. Niterria = practical, product-focused deep dives. Combined, they cover everything you need for your dream keyboard build.</p>

        <h2>Component Selection</h2>
        <div class="guide-card">
          <h3>Keyboard Size</h3>
          <p>Popular sizes: Full (100%), TKL (80%), 75%, 65%, 60%. KeysON explains compatibility + ergonomics.</p>
          <a href="https://niterria.com/post/how-to-choose-the-best-keyboard-size-for-you-full-guide?p_id=500">Read: Best Keyboard Sizes 2025 →</a>
        </div>

        <div class="guide-card">
          <h3>Switches</h3>
          <p>Pick by feel, sound, and speed. Learn the difference between clicky, linear, and tactile.</p>
          <a href="https://niterria.com/post/clicky-linear-or-tactile-discover-the-best-mechanical-keyboard-switches-for-2025?p_id=491">Read: Best Switches 2025 →</a>
        </div>

        <div class="guide-card"><h3>Stabilizers</h3><p>Essential for big keys like Enter & Space. Choose between plate-mounted, screw-in, or clip-in.</p></div>
        <div class="guide-card"><h3>Keycaps</h3><p>Pick based on material (ABS vs PBT), texture, and profile (Cherry, OEM, SA).</p></div>
        <div class="guide-card"><h3>Cables</h3><p>Choose between straight or coiled. Consider aesthetics, length, and flexibility.</p></div>

        <h2>Considerations</h2>
        <div class="guide-card"><h3>Design Options</h3><p>Layouts, shapes, and extra features (like knobs or OLED screens) can transform usability.</p></div>
        <div class="guide-card"><h3>Aesthetics & Style</h3><p>Lighting, keycap colors, and overall theme create a setup that feels personal and inspiring.</p></div>

        <h2>Conclusion</h2>
        <p>This guide provides the foundation for building your custom keyboard. Mix KeysON fundamentals with Niterria’s practical posts to unlock both knowledge and curated product picks.</p>
      </div>

      <div class="future-posts">
        <h2>Coming Soon</h2>
        <div class="guide-card"><h3>Best Stabilizers for 2025</h3><p>Clip-in, screw-in, and plate-mounted compared with noise reduction tips.</p></div>
        <div class="guide-card"><h3>Keycap Profiles Explained</h3><p>SA, DSA, Cherry, OEM — which one fits your hands best?</p></div>
        <div class="guide-card"><h3>Best Custom Keyboard Cables 2025</h3><p>Coiled vs straight, aviator connectors, and aesthetics for your setup.</p></div>
        <div class="guide-card"><h3>RGB Lighting Setups 2025</h3><p>From underglow to per-key effects, master your keyboard lighting.</p></div>
        <div class="guide-card"><h3>Top Mistakes Beginners Make</h3><p>Avoid these common pitfalls when building your first custom keyboard.</p></div>
      </div>
    </div>
  </div>

  <footer>
    &copy; 2025 KeysON Lab — <a href="./privacy_policy">Privacy Policy</a><br>All rights reserved.
  </footer>

  <script>
    document.querySelector(".menu-toggle").addEventListener("click",()=>{
      document.querySelector("header nav").classList.toggle("show");
    });
  </script>
</body>
</html>
