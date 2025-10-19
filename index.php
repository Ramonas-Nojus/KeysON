<?php include 'settings-core-7189.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KeysON Lab — Build Your Way</title>
  <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/img/favicon.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
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

    /* Subtle neon grid background */
    .neon-grid::before{
      content:""; position:fixed; inset:0; z-index:-2; pointer-events:none;
      background:
        linear-gradient(rgba(255,255,255,.04), rgba(255,255,255,.04)) center/100% 1px no-repeat,
        repeating-linear-gradient(90deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px),
        repeating-linear-gradient(0deg, rgba(255,255,255,.04) 0 1px, transparent 1px 120px);
      mask: radial-gradient(ellipse at center, rgba(0,0,0,.9), transparent 80%);
    }

    *{box-sizing:border-box;margin:0;padding:0}
    body{
      background:var(--bg);
      color:var(--text);
      font-family:'Inter',sans-serif;
      overflow-x:hidden;
    }

    /* Header */
    header{
      position:fixed;width:100%;top:0;z-index:50;
      display:flex;justify-content:space-between;align-items:center;
      padding:1.2rem 6%;background:rgba(20,10,40,0.6);backdrop-filter:blur(14px);
      border-bottom:1px solid var(--stroke);
    }
    header img{height:55px}
    nav ul{list-style:none;display:flex;gap:2rem}
    nav a{color:var(--text);text-decoration:none;font-weight:600;font-family:'Exo 2',sans-serif;position:relative}
    nav a::after{content:'';position:absolute;left:0;bottom:-6px;height:2px;width:0;background:var(--grad);transition:width .3s}
    nav a:hover::after{width:100%}

    /* Section dividers */
    .divider{position:relative;height:80px;margin-top:-1px;overflow:hidden}
    .divider svg{position:absolute;bottom:0;left:0;width:100%;height:100%;display:block}

    /* Hero */
    .hero{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:0 10%;background:radial-gradient(900px 600px at 20% 10%,rgba(155,43,255,.2),transparent 60%),var(--bg)}
    .hero h1{font-family:'Exo 2',sans-serif;font-size:clamp(2.6rem,6vw,4.4rem);font-weight:800;line-height:1.1;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:1rem}
    .hero p{color:var(--muted);max-width:700px;font-size:1.1rem;line-height:1.7;margin-bottom:2rem}
    .cta{background:var(--grad);color:#fff;padding:14px 36px;border-radius:50px;font-weight:700;text-decoration:none;transition:all .3s;box-shadow:0 0 30px rgba(155,43,255,.3)}
    .cta:hover{transform:translateY(-3px);box-shadow:0 0 45px rgba(155,43,255,.4)}

    /* Highlights */
    .highlights{padding:10vh 8%;text-align:center;background:linear-gradient(180deg,rgba(255,255,255,.02),rgba(255,255,255,0))}
    .highlights h2{font-family:'Exo 2',sans-serif;font-size:2rem;margin-bottom:2rem;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:2rem}
    .card{background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.08);border-radius:18px;padding:2rem;transition:transform .3s,box-shadow .3s}
    .card:hover{transform:translateY(-6px);box-shadow:0 0 50px rgba(155,43,255,.2)}
    .card h3{font-family:'Exo 2',sans-serif;font-weight:700;margin-bottom:1rem}
    .card p{color:var(--muted)}

    /* GIF Showcase */
    .gif-showcase{display:flex;justify-content:center;align-items:center;padding:12vh 0;background:radial-gradient(800px 400px at 50% 50%,rgba(155,43,255,.15),transparent 70%)}
    .gif-frame{width:80%;max-width:1000px;border-radius:24px;overflow:hidden;border:1px solid rgba(255,255,255,.1);box-shadow:0 0 60px rgba(155,43,255,.25)}
    .gif-frame img{width:100%;display:block}

    /* Story */
    .story{padding:10vh 8%;text-align:center;background:linear-gradient(180deg,rgba(255,255,255,.01),rgba(255,255,255,.04))}
    .story h2{font-family:'Exo 2',sans-serif;font-size:2rem;margin-bottom:1rem;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .story p{color:var(--muted);max-width:800px;margin:0 auto;line-height:1.8;font-size:1.1rem}

    /* Guides Section */
    .guides{padding:10vh 8%;display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:3rem;background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.015))}
    .guides h2{font-family:'Exo 2',sans-serif;font-size:2rem;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:1rem}
    .guides p{color:var(--muted);font-size:1.05rem;line-height:1.7}
    .guides .cta{justify-self:center;padding:16px 42px;font-size:1.1rem}

    /* Journey */
    .journey{background:linear-gradient(180deg,rgba(255,255,255,.015),rgba(255,255,255,.03));padding:10vh 8%;border-top:1px solid rgba(255,255,255,0.08)}
    .journey h2{font-family:'Exo 2',sans-serif;font-size:2rem;text-align:center;margin-bottom:2rem;background:var(--grad);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
    .steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:2rem;text-align:center}
    .step{background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.02));border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:2rem;transition:transform .3s,box-shadow .3s}
    .step:hover{transform:translateY(-5px);box-shadow:0 0 40px rgba(155,43,255,.2)}
    .step h3{font-family:'Exo 2',sans-serif;font-weight:700;margin-bottom:.5rem}
    .step p{color:var(--muted)}

    /* Footer */
    footer{text-align:center;padding:3rem 5%;background:linear-gradient(90deg,rgba(75,24,210,0.15),rgba(155,43,255,0.15));color:var(--muted);font-size:.9rem;border-top:1px solid rgba(255,255,255,0.05)}
    footer a{color:var(--violet3);text-decoration:none}
    footer a:hover{color:var(--magenta)}

    @media(max-width:900px){.guides{grid-template-columns:1fr;text-align:center}.guides .cta{margin-top:1.5rem}}
  </style>
</head>
<body class="neon-grid">
  <header>
    <a href="<?php echo BASE_URL; ?>/">
      <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysON Lab">
    </a>
    <nav>
      <ul>
        <li><a href="<?php echo BASE_URL; ?>/keyboard_builder">Builder</a></li>
        <li><a href="<?php echo BASE_URL; ?>/products">Accessories</a></li>
        <li><a href="<?php echo BASE_URL; ?>/contacts">Contacts</a></li>
      </ul>
    </nav>
  </header>

  <section class="hero">
    <h1>Where Craftsmanship Meets Technology</h1>
    <p>KeysON Lab creates custom mechanical keyboards designed for precision, comfort, and individuality. Choose your perfect combination of layout, switches, and materials — and we’ll bring your vision to life.</p>
    <a href="<?php echo BASE_URL; ?>/keyboard_builder" class="cta">Start Building</a>
  </section>

  <div class="divider">
    <svg viewBox="0 0 1440 320"><path fill="rgba(255,255,255,.05)" d="M0,128L60,122.7C120,117,240,107,360,138.7C480,171,600,245,720,245.3C840,245,960,171,1080,128C1200,85,1320,75,1380,69.3L1440,64V320H0Z"></path></svg></div>

  <section class="highlights">
    <h2>Why Build with KeysON</h2>
    <div class="cards">
      <div class="card"><h3>Custom Freedom</h3><p>Design your layout, switches, and look with total control — every board is uniquely yours.</p></div>
      <div class="card"><h3>Premium Components</h3><p>We use high-quality materials for smooth sound, feel, and durability that lasts.</p></div>
      <div class="card"><h3>Precision Assembly</h3><p>Every build is assembled and tested by hand, ensuring unmatched performance.</p></div>
    </div>
  </section>

  <div class="divider">
    <svg viewBox="0 0 1440 320"><path fill="rgba(255,255,255,.04)" d="M0,192L80,170.7C160,149,320,107,480,117.3C640,128,800,192,960,192C1120,192,1280,128,1360,96L1440,64V0H0Z"></path></svg></div>

  <section class="gif-showcase">
    <div class="gif-frame">
      <img src="<?php echo BASE_URL; ?>/img/keyboard3.gif" alt="Keyboard Animation">
    </div>
  </section>

  <section class="story">
    <h2>Born from a Passion for Perfection</h2>
    <p>Hi, I’m Nojus — the person behind KeysON Lab. This project started as a personal obsession with sound, feel, and form. I wanted a place where anyone could design their ideal keyboard — not just buy one. Every build we create is tuned, tested, and crafted to bring a sense of satisfaction that goes beyond typing. KeysON Lab isn’t about mass production — it’s about your perfect board.</p>
  </section>

  <section class="guides">
    <div>
      <h2>Need Help Choosing?</h2>
      <p>We understand — picking the right switches, layout, or materials can be overwhelming. That’s why we built a dedicated Guides section. Learn everything you need about switches, keycaps, layouts, and more before you start building.</p>
    </div>
    <a href="<?php echo BASE_URL; ?>/guide" class="cta">Explore Guides</a>
  </section>

  <section class="journey">
    <h2>Your Build Journey</h2>
    <div class="steps">
      <div class="step"><h3>1. Configure</h3><p>Pick your size, switches, and look in our builder.</p></div>
      <div class="step"><h3>2. Assemble</h3><p>We build, tune, and test your board with precision.</p></div>
      <div class="step"><h3>3. Deliver (EU)</h3><p>Secure packaging and tracked delivery across Europe.</p></div>
    </div>
  </section>

  <footer>
    &copy; 2025 KeysON Lab — <a href="<?php echo BASE_URL; ?>/privacy_policy">Privacy Policy</a><br>All rights reserved. EU delivery only.
  </footer>
  <script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</body>
</html>
