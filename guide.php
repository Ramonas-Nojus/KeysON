<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Keyboard Building Guide</title>
    <link rel="stylesheet" href="./style/guide.css"> <!-- Make sure to link your CSS file -->
</head>
<body>
    <?php include './inlcudes/header.php'; ?>

    <div class="container">

        <!-- Guides section: KeysON core + integrated Niterria posts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    color: #222;
  }

  .guides-section {
    max-width: 1100px;
    margin: 60px auto;
    background: #fff;
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
  }

  .guides-section h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .guides-section p {
    color: #555;
    line-height: 1.6;
    margin-bottom: 25px;
  }

  .guides-section h2 {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 30px 0 15px;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-left: 4px solid #6a11cb;
    padding-left: 10px;
  }

  .guide-card {
    background: #fafafa;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .guide-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  }

  .guide-card h3 {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .guide-card p {
    font-size: 0.9rem;
    color: #555;
  }

  .guide-card a {
    display: inline-block;
    margin-top: 12px;
    font-weight: 600;
    color: #6a11cb;
    text-decoration: none;
  }

  .future-posts .guide-card {
    background: #f3f3f3;
    color: #999;
    text-align: center;
    border: 2px dashed #ddd;
    cursor: default;
  }

  .future-posts .guide-card h3 {
    color: #666;
    margin-bottom: 5px;
  }

  .future-posts .guide-card p {
    color: #999;
    font-size: 0.85rem;
  }
</style>

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
      <a href="#">Read: Best Keyboard Sizes 2025 →</a>
    </div>

    <div class="guide-card">
      <h3>Switches</h3>
      <p>Pick by feel, sound, and speed. Learn the difference between clicky, linear, and tactile.</p>
      <a href="#">Read: Best Switches 2025 →</a>
    </div>

    <div class="guide-card">
      <h3>Stabilizers</h3>
      <p>Essential for big keys like Enter & Space. Choose between plate-mounted, screw-in, or clip-in.</p>
    </div>

    <div class="guide-card">
      <h3>Keycaps</h3>
      <p>Pick based on material (ABS vs PBT), texture, and profile (Cherry, OEM, SA).</p>
    </div>

    <div class="guide-card">
      <h3>Cables</h3>
      <p>Choose between straight or coiled. Consider aesthetics, length, and flexibility.</p>
    </div>

    <h2>Considerations</h2>
    <div class="guide-card">
      <h3>Design Options</h3>
      <p>Layouts, shapes, and extra features (like knobs or OLED screens) can transform usability.</p>
    </div>

    <div class="guide-card">
      <h3>Aesthetics & Style</h3>
      <p>Lighting, keycap colors, and overall theme create a setup that feels personal and inspiring.</p>
    </div>

    <h2>Conclusion</h2>
    <p>This guide provides the foundation for building your custom keyboard. Mix KeysON fundamentals with Niterria’s practical posts to unlock both knowledge and curated product picks.</p>
  </div>

  <div class="future-posts">
    <h2>Coming Soon</h2>

    <div class="guide-card">
      <h3>Best Stabilizers for 2025</h3>
      <p>Clip-in, screw-in, and plate-mounted compared with noise reduction tips.</p>
    </div>

    <div class="guide-card">
      <h3>Keycap Profiles Explained</h3>
      <p>SA, DSA, Cherry, OEM — which one fits your hands best?</p>
    </div>

    <div class="guide-card">
      <h3>Best Custom Keyboard Cables 2025</h3>
      <p>Coiled vs straight, aviator connectors, and aesthetics for your setup.</p>
    </div>

    <div class="guide-card">
      <h3>RGB Lighting Setups 2025</h3>
      <p>From underglow to per-key effects, master your keyboard lighting.</p>
    </div>

    <div class="guide-card">
      <h3>Top Mistakes Beginners Make</h3>
      <p>Avoid these common pitfalls when building your first custom keyboard.</p>
    </div>
  </div>
</div>


    </div>
    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">All rights reserved.</p>
    </div>
</body>
<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</html>
