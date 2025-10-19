<?php include 'settings-core-7189.php'; ?>
<?php
session_start();

if (!isset($_POST['selectedKeyboardSize'])) { header('Location: '.BASE_URL); exit; }

$_SESSION['order'] = [
  'KeyboardSize'       => $_POST['selectedKeyboardSize'],
  'KeyboardColor'      => $_POST['selectedKeyboardColor'],
  'SwitchType'         => $_POST['selectedSwitchType'],
  'Keycaps'            => $_POST['selectedKeycaps'],
  'CableColor'         => $_POST['selectedCableColor'],
  'KeyboardSizePrice'  => (float)$_POST['selectedKeyboardSizePrice'],
  'KeyboardColorPrice' => (float)$_POST['selectedKeyboardColorPrice'],
  'SwitchTypePrice'    => (float)$_POST['selectedSwitchTypePrice'],
  'KeycapsPrice'       => (float)$_POST['selectedKeycapsPrice'],
  'CableColorPrice'    => (float)$_POST['selectedCableColorPrice'],
  'PVM'                => (float)$_POST['pvm'],
  'KeyboardSizeValue'  => $_POST['KeyboardSizeValue'],
  'KeyboardColorValue' => $_POST['KeyboardColorValue'],
  'SwitchTypeValue'    => $_POST['SwitchTypeValue'],
  'KeycapsValue'       => $_POST['KeycapsValue'],
  'CableColorValue'    => $_POST['CableColorValue'],
  'date'               => date('Y/m/d')
];

$order = $_SESSION['order'];
$user  = $_SESSION['user'] ?? null;

$total_price = $order['KeyboardSizePrice']
             + $order['KeyboardColorPrice']
             + $order['SwitchTypePrice']
             + $order['KeycapsPrice']
             + $order['CableColorPrice']
             + $order['PVM']
             + 30;
$order['totalPrice'] = $total_price;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Checkout | KeysON Lab</title>
<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css"/>
<style>
:root{
  --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
  --bg:#0b0816; --bg2:#170e2d; --text:#f5f7fb; --muted:#b7bfd3;
  --panel:rgba(255,255,255,.05); --stroke:rgba(255,255,255,.10);
  --grad:linear-gradient(90deg,var(--violet-2),var(--magenta),var(--violet-3));
  --grad2:linear-gradient(90deg,var(--violet-3),var(--magenta),var(--cyan));
  --radius:18px; --header-h:76px;
  --ctrl-bg: rgba(255,255,255,.06); --ctrl-bg-hover: rgba(255,255,255,.09);
  --ctrl-border: rgba(255,255,255,.18); --ctrl-border-focus: rgba(155,43,255,.55);
  --placeholder: rgba(245,247,251,.45); --ring: 0 0 0 3px rgba(155,43,255,.25);
}
*{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{
  font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif; color:var(--text);
  background:
    radial-gradient(1200px 600px at 12% -8%, rgba(155,43,255,.22), transparent 60%),
    radial-gradient(900px 450px at 100% 0%, rgba(0,228,255,.16), transparent 60%),
    linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%);
  background-attachment: fixed; overflow-x:hidden;
}

/* Header */
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

/* Layout */
main{
  padding:calc(var(--header-h) + 24px) 2.5% 60px;
  max-width:1200px; margin:0 auto; display:grid; gap:24px;
  grid-template-columns: minmax(0,1fr) clamp(360px, 34vw, 460px);
  align-items:start;
}
@media (max-width: 980px){ main{ grid-template-columns:1fr; } }

/* Panels */
.panel{
  background:var(--panel); border:1px solid var(--stroke); border-radius:var(--radius);
  backdrop-filter:blur(8px); padding:22px; box-shadow:0 0 24px rgba(155,43,255,.14); min-width:0;
}
.panel h1,.panel h2{
  font-family:'Exo 2',sans-serif; margin-bottom:12px;
  background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent;
}
.panel h1{font-size:2rem; text-align:center}
.panel h2{font-size:1.3rem}

/* Summary sticky */
.cart-sticky{
  position: sticky;
  top: calc(var(--header-h) + 16px);
  max-height: none;
  overflow: visible;
}

/* Summary table */
.order-summary-table{ table-layout:fixed; border-spacing:12px 10px; }
.order-summary-table colgroup col:nth-child(1){ width:42%; }
.order-summary-table colgroup col:nth-child(2){ width:auto; }
.order-summary-table colgroup col:nth-child(3){ width:1%; }
.order-summary-table thead th{ padding:8px 10px 6px; color:var(--muted); text-transform:uppercase; font-size:.8rem; }
.order-summary-table td{
  padding:12px 14px; border-radius:12px; vertical-align:middle;
  background:rgba(255,255,255,.04); border:1px solid var(--stroke);
}
.order-summary-table td.name{ font-weight:800; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.order-summary-table td.option{ white-space:normal; line-height:1.3; }
.order-summary-table td.price{ text-align:right; white-space:nowrap; padding:0; background:transparent; border:none; }
.order-summary-table td.price .chip{
  display:inline-block; padding:10px 12px; border-radius:12px;
  background:rgba(255,255,255,.06); border:1px solid var(--stroke);
  font-weight:800; font-variant-numeric:tabular-nums;
}
.order-summary-table td.option:empty{ background:transparent; border:none; padding:0; }

.order-summary-table tfoot .sum-label{
  text-align:left; padding:10px 12px; color:var(--muted); font-weight:800;
  background:transparent; border:none;
}
.order-summary-table tfoot .sum-price{ text-align:right; padding:0; background:transparent; border:none; }
.order-summary-table tfoot .sum-price .chip{
  display:inline-block; padding:10px 12px; border-radius:12px;
  background:rgba(255,255,255,.06); border:1px solid var(--stroke);
  font-weight:900; font-variant-numeric:tabular-nums;
}
.order-summary-table tfoot .sum-price .chip--accent{
  background:rgba(0,255,153,.08); border-color:rgba(0,255,153,.35);
}

/* Build preview inside summary */
.preview-box{
  margin:6px 14px 14px; border:1px solid var(--stroke); border-radius:16px;
  background:linear-gradient(180deg,rgba(255,255,255,.03),rgba(255,255,255,.01)); padding:12px;
}
.preview-title{
  font-family:'Exo 2',sans-serif; font-weight:700; font-size:1rem; margin:4px 0 10px;
  background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent;
}
.keyboard-preview{ position:relative; width:100%; padding-top:42%; border-radius:12px; overflow:hidden; }
.kbrd-img{ position:absolute; inset:0; margin:auto; width:86%; height:auto; object-fit:contain; left:50%; transform:translateX(-50%); }
.kbrd-base{ z-index:2; filter:drop-shadow(0 0 10px rgba(155,43,255,.55)) drop-shadow(0 0 20px rgba(75,24,210,.45)) drop-shadow(0 0 38px rgba(0,228,255,.35)) brightness(1.04); animation:basePulse 4.5s ease-in-out infinite; }
.kbrd-cable{z-index:3} .kbrd-switches{z-index:4} .kbrd-keycaps{z-index:5}
@keyframes basePulse{0%,100%{filter:drop-shadow(0 0 10px rgba(155,43,255,.55)) drop-shadow(0 0 20px rgba(75,24,210,.45)) drop-shadow(0 0 38px rgba(0,228,255,.35)) brightness(1.04)}50%{filter:drop-shadow(0 0 15px rgba(155,43,255,.75)) drop-shadow(0 0 32px rgba(75,24,210,.6)) drop-shadow(0 0 60px rgba(0,228,255,.45)) brightness(1.08)}}

/* Total bar */
.total-bar{
  margin:10px 14px 0; padding:14px 16px; border:1px solid var(--stroke); border-radius:14px;
  background:linear-gradient(180deg, rgba(255,255,255,.04), rgba(255,255,255,.02));
  display:flex; justify-content:space-between; align-items:center; gap:12px;
}
.total-bar span:last-child{ margin-left:auto; font-weight:800; }

/* Form */
.form-group{margin-bottom:14px; position:relative;}
.form-group label{display:block;margin-bottom:6px;color:var(--muted);font-weight:600}
.form-group input,.form-group select{
  width:100%; padding:12px 14px; border-radius:14px; border:1px solid var(--ctrl-border);
  background:var(--ctrl-bg); color:var(--text); outline:0; transition:background .2s,border .2s,box-shadow .2s
}
.form-group input::placeholder{color:var(--placeholder)}
.form-group input:hover,.form-group select:hover{background:var(--ctrl-bg-hover)}
.form-group input:focus,.form-group select:focus{border-color:var(--ctrl-border-focus); box-shadow:var(--ring)}
.form-check{display:flex; align-items:flex-start; gap:10px; margin:10px 0; color:var(--muted); font-size:.95rem}
.form-check input{width:18px;height:18px;margin-top:2px;cursor:pointer}
.form-check a{color:var(--violet-3); text-decoration:none}
.form-check a:hover{text-decoration:underline}

/* Button */
.checkout-btn{
  display:block; width:100%; padding:14px 0; margin-top:14px; border:0; border-radius:999px;
  font-weight:900; letter-spacing:.2px; color:#fff; cursor:pointer;
  background:var(--grad); box-shadow:0 10px 28px rgba(155,43,255,.22);
  transition:transform .12s, box-shadow .2s, background .3s
}
.checkout-btn:hover{ background:var(--grad2); transform:translateY(-2px); box-shadow:0 16px 38px rgba(155,43,255,.32) }

/* Footer */
footer{
  width:100%; padding:28px 2.5%; text-align:center; font-size:.92rem; color:var(--muted);
  border-top:1px solid var(--stroke)
}
footer a{color:var(--violet-3); text-decoration:none}
footer a:hover{color:var(--magenta)}

/* Phone input (intl-tel-input) */
.form-group .iti { width: 100% !important; z-index: 3; }
#phone{ line-height:1.15; height:48px; padding-left:56px !important; }
.form-group input, .form-group select{ height:48px; }

/* Flag button */
.iti--allow-dropdown .iti__flag-container{ inset-inline-start:8px; }
.iti__selected-flag{
  height:36px !important; margin-top:6px !important; padding:0 10px !important;
  border-radius:10px !important; background:rgba(255,255,255,.06) !important;
  border:1px solid var(--ctrl-border) !important; transition:.2s !important;
}
.iti__selected-flag:hover{ background:rgba(255,255,255,.09) !important; border-color:var(--ctrl-border-focus) !important; box-shadow:0 0 0 3px rgba(155,43,255,.15) !important; }
.iti__selected-flag .iti__arrow{ border-top-color:var(--text) !important; opacity:.85 !important; }

/* Phone dropdown panel */
.iti__country-list{
  margin-top:8px !important; background:rgba(20,10,40,.98) !important; color:var(--text) !important;
  border:1px solid var(--stroke) !important; border-radius:14px !important;
  box-shadow:0 20px 50px rgba(0,0,0,.45), 0 0 0 1px rgba(255,255,255,.05) inset !important;
  backdrop-filter:blur(10px) !important; max-height:320px !important; z-index:99999 !important;
}
.iti__country{ padding:10px 12px !important; transition:background .15s !important; }
.iti__country:hover, .iti__country.iti__highlight{ background:rgba(255,255,255,.08) !important; }
.iti__country-name{ color:var(--text) !important; } .iti__dial-code{ color:var(--muted) !important; }
.iti__divider{ border-top-color:var(--stroke) !important; }
.iti__country-list{ scrollbar-width:thin; scrollbar-color:rgba(255,255,255,.2) transparent; }
.iti__country-list::-webkit-scrollbar{ width:10px } .iti__country-list::-webkit-scrollbar-thumb{ background:rgba(255,255,255,.2); border-radius:8px }

/* Mobile nav */
@media (max-width:820px){
  .menu-toggle{display:block}
  nav{
    position:absolute; right:2.5%; top:var(--header-h);
    background:rgba(20,10,40,.95); border:1px solid var(--stroke);
    border-radius:12px; overflow:hidden; max-height:0; transition:max-height .3s;
  }
  nav.open{max-height:280px}
  nav ul{flex-direction:column; padding:10px}
}

/* Custom select */
.select-hidden{ position:absolute !important; opacity:0 !important; pointer-events:none !important; width:0 !important; height:0 !important; }
.cs{ position:relative; font-size:14px; z-index:2; }
.cs-trigger{
  width:100%; height:48px; border-radius:14px; border:1px solid var(--ctrl-border);
  background:var(--ctrl-bg); color:var(--text); padding:12px 44px 12px 14px; text-align:left; cursor:pointer;
  transition:background .2s,border .2s,box-shadow .2s;
}
.cs-trigger:hover{ background:var(--ctrl-bg-hover); }
.cs-trigger:focus-visible{ outline:0; border-color:var(--ctrl-border-focus); box-shadow:var(--ring); }
.cs-trigger .cs-caret{
  position:absolute; right:14px; top:50%; width:10px; height:10px;
  border-right:2px solid rgba(255,255,255,.7); border-bottom:2px solid rgba(255,255,255,.7);
  transform:translateY(-60%) rotate(45deg); opacity:.9; pointer-events:none;
}
.cs-panel{
  position:absolute; left:0; right:0; top:calc(100% + 8px);
  background:rgba(20,10,40,.98); color:var(--text);
  border:1px solid var(--stroke); border-radius:14px;
  box-shadow:0 20px 50px rgba(0,0,0,.45), 0 0 0 1px rgba(255,255,255,.05) inset;
  backdrop-filter:blur(10px); max-height:320px; overflow:auto; z-index:99999; display:none;
}
.cs.open .cs-panel{ display:block; }
.cs-search{ padding:10px; border-bottom:1px solid var(--stroke); }
.cs-search input{
  width:100%; height:40px; border-radius:10px; border:1px solid var(--ctrl-border);
  background:rgba(255,255,255,.06); color:var(--text); padding:8px 10px;
}
.cs-list{ list-style:none; margin:0; padding:6px; }
.cs-option{ display:flex; align-items:center; gap:8px; padding:10px 10px; border-radius:10px; cursor:pointer; }
.cs-option:hover, .cs-option[aria-selected="true"]{ background:rgba(255,255,255,.08); }
.cs-label{ flex:1 1 auto; min-width:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.cs-panel{ scrollbar-width:thin; scrollbar-color:rgba(255,255,255,.2) transparent; }
.cs-panel::-webkit-scrollbar{ width:10px } .cs-panel::-webkit-scrollbar-thumb{ background:rgba(255,255,255,.2); border-radius:8px }
@media (max-width:700px){ .cs-panel{ max-height:50vh } }
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
  <!-- LEFT: STICKY summary -->
  <section class="panel cart-sticky">
    <h1>Order Summary</h1>

    <table class="order-summary-table">
      <colgroup><col><col><col></colgroup>
      <thead>
        <tr><th>Product</th><th>Option</th><th style="text-align:right;">Price</th></tr>
      </thead>
      <tbody>
        <tr><td class="name">Size</td><td class="option"><?php echo htmlspecialchars($order['KeyboardSize']); ?></td><td class="price"><span class="chip"><?php echo number_format($order['KeyboardSizePrice'],2); ?>€</span></td></tr>
        <tr><td class="name">Color</td><td class="option"><?php echo htmlspecialchars($order['KeyboardColor']); ?></td><td class="price"><span class="chip"><?php echo number_format($order['KeyboardColorPrice'],2); ?>€</span></td></tr>
        <tr><td class="name">Switches</td><td class="option"><?php echo htmlspecialchars($order['SwitchType']); ?></td><td class="price"><span class="chip"><?php echo number_format($order['SwitchTypePrice'],2); ?>€</span></td></tr>
        <tr><td class="name">Keycaps</td><td class="option"><?php echo htmlspecialchars($order['Keycaps']); ?></td><td class="price"><span class="chip"><?php echo number_format($order['KeycapsPrice'],2); ?>€</span></td></tr>
        <tr><td class="name">Cable</td><td class="option"><?php echo htmlspecialchars($order['CableColor']); ?></td><td class="price"><span class="chip"><?php echo number_format($order['CableColorPrice'],2); ?>€</span></td></tr>
        <tr><td class="name">Assembly</td><td class="option"></td><td class="price"><span class="chip">30.00€</span></td></tr>
        <tr><td class="name">VAT</td><td class="option"></td><td class="price"><span class="chip"><?php echo number_format($order['PVM'],2); ?>€</span></td></tr>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="2" class="sum-label">Shipping</th>
          <td class="sum-price"><span class="chip chip--accent">Free</span></td>
        </tr>
      </tfoot>
    </table>

    <div class="preview-box">
      <div class="preview-title">Build Preview</div>
      <div class="keyboard-preview">
        <img class="kbrd-img kbrd-base"     src="<?php echo BASE_URL ?>/img/<?php echo $order['KeyboardSizeValue'].'/'.$order['KeyboardColorValue']; ?>.png"  alt="Keyboard base">
        <img class="kbrd-img kbrd-cable"    src="<?php echo BASE_URL ?>/img/<?php echo $order['KeyboardSizeValue'].'/'.$order['CableColorValue']; ?>.png"   alt="Cable">
        <img class="kbrd-img kbrd-switches" src="<?php echo BASE_URL ?>/img/<?php echo $order['KeyboardSizeValue'].'/'.$order['SwitchTypeValue']; ?>.png"  alt="Switches">
        <img class="kbrd-img kbrd-keycaps"  src="<?php echo BASE_URL ?>/img/<?php echo $order['KeyboardSizeValue'].'/'.$order['KeycapsValue']; ?>.png"    alt="Keycaps">
      </div>
    </div>

    <div class="total-bar">
      <span style="color:var(--muted);">Hand-built, tuned & tested.</span>
      <span>Total: <?php echo number_format($total_price,2); ?>€</span>
    </div>
  </section>

  <!-- RIGHT: info panel -->
  <section class="panel info-panel">
    <h2>Shipping Information</h2>
    <form action="<?php echo BASE_URL; ?>/checkout" method="post" id="checkout-form">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="you@example.com"
               value="<?= isset($user['email']) ? htmlspecialchars($user['email']) : '' ?>" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone"
               value="<?= isset($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>" required>
      </div>

      <div class="form-group">
        <label for="country">Country</label>
        <select id="country" class="styled-select js-custom-select" name="country" required>
          <option value="">Select a country</option>
          <?php
            $countries = ["Austria","Belgium","Bulgaria","Croatia","Cyprus","Czech Republic","Denmark","Estonia","Finland","France","Germany","Greece","Hungary","Ireland","Italy","Latvia","Lithuania","Luxembourg","Malta","Netherlands","Poland","Portugal","Romania","Slovakia","Slovenia","Spain","Sweden","United Kingdom"];
            foreach ($countries as $c) {
              $sel = (!empty($user['country']) && $user['country']===$c) ? 'selected' : '';
              echo "<option value='".htmlspecialchars($c)."' $sel>$c</option>";
            }
          ?>
        </select>
      </div>

      <div class="form-group"><label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" placeholder="John"
               value="<?= isset($user['firstName']) ? htmlspecialchars($user['firstName']) : '' ?>" required>
      </div>
      <div class="form-group"><label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" placeholder="Doe"
               value="<?= isset($user['lastName']) ? htmlspecialchars($user['lastName']) : '' ?>" required>
      </div>
      <div class="form-group"><label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="Berlin"
               value="<?= isset($user['city']) ? htmlspecialchars($user['city']) : '' ?>" required>
      </div>
      <div class="form-group"><label for="address">Address</label>
        <input type="text" id="address" name="address" placeholder="123 Main St"
               value="<?= isset($user['address']) ? htmlspecialchars($user['address']) : '' ?>" required>
      </div>
      <div class="form-group"><label for="postal-code">Postal Code</label>
        <input type="text" id="postal-code" name="postal_code" placeholder="12345"
               value="<?= isset($user['postal_code']) ? htmlspecialchars($user['postal_code']) : '' ?>" required>
      </div>

      <div class="form-check">
        <input type="checkbox" id="privacy" name="privacy" required>
        <label for="privacy">I agree to the <a href="<?php echo BASE_URL; ?>/privacy_policy.php" target="_blank">Privacy Policy</a>.</label>
      </div>
      <div class="form-check">
        <input type="checkbox" id="preorder" name="preorder" required>
        <label for="preorder">I acknowledge this is a <strong>preorder</strong>. Assembly & shipping occur once all parts are available.</label>
      </div>

      <input type="hidden" name="total_price" value="<?= number_format($total_price,2,'.','') ?>">
      <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
    </form>
  </section>
</main>


<footer>
  &copy; 2025 KeysON Lab — <a href="<?php echo BASE_URL; ?>/privacy_policy.php">Privacy Policy</a><br/>
  All rights reserved. EU delivery only.
</footer>

<!-- libs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>

<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });

/* Phone input: render dropdown in body to avoid clipping */
const phoneInput = document.querySelector("#phone");
const iti = window.intlTelInput(phoneInput, {
  initialCountry: "auto",
  dropdownContainer: document.body,
  geoIpLookup: cb => {
    fetch("https://ipapi.co/json")
      .then(r=>r.json()).then(d=>cb(d.country_code))
      .catch(()=>cb(""));
  },
  nationalMode: false,
  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
});

/* Cleave for per-country formatting */
let cleave = new Cleave(phoneInput, {
  phone: true,
  phoneRegionCode: iti.getSelectedCountryData().iso2 || "us",
  delimiter: ' ',
  noImmediatePrefix: true
});
phoneInput.addEventListener("focus", () => {
  if (!phoneInput.value.startsWith("+")) {
    const c = iti.getSelectedCountryData();
    phoneInput.value = "+" + c.dialCode + " ";
  }
});
phoneInput.addEventListener("countrychange", () => {
  const country = iti.getSelectedCountryData().iso2;
  cleave.destroy();
  cleave = new Cleave(phoneInput, { phone: true, phoneRegionCode: country, delimiter: ' ', noImmediatePrefix: true });
});
document.querySelector("#checkout-form").addEventListener("submit", () => {
  phoneInput.value = iti.getNumber(); // E.164 for backend
});
</script>

<script>
/* Custom dark select (enhances the native select) */
(function(){
  document.querySelectorAll('select.js-custom-select').forEach((sel)=>{
    sel.classList.add('select-hidden');
    const wrap = document.createElement('div'); wrap.className = 'cs';
    sel.parentNode.insertBefore(wrap, sel); wrap.appendChild(sel);

    const trigger = document.createElement('button');
    trigger.type = 'button'; trigger.className = 'cs-trigger';
    trigger.setAttribute('aria-haspopup','listbox'); trigger.setAttribute('aria-expanded','false');
    trigger.innerHTML = `<span class="cs-value"></span><span class="cs-caret"></span>`;
    wrap.appendChild(trigger);

    const panel = document.createElement('div'); panel.className = 'cs-panel';
    panel.innerHTML = `<div class="cs-search"><input type="text" placeholder="Search..."></div><ul class="cs-list" role="listbox"></ul>`;
    wrap.appendChild(panel);

    const valueEl = trigger.querySelector('.cs-value');
    const listEl  = panel.querySelector('.cs-list');
    const search  = panel.querySelector('input');

    const options = Array.from(sel.options).map(o=>({
      value:o.value, label:o.textContent, disabled:o.disabled || (o.value===""), selected:o.selected
    }));

    function render(list){
      listEl.innerHTML = '';
      list.forEach(o=>{
        const li = document.createElement('li');
        li.className = 'cs-option';
        li.setAttribute('role','option');
        li.setAttribute('data-value', o.value);
        li.setAttribute('aria-selected', o.selected ? 'true' : 'false');
        if(o.disabled){ li.style.opacity=.45; li.style.pointerEvents='none'; }
        li.innerHTML = `<span class="cs-label">${o.label}</span>`;
        listEl.appendChild(li);
      });
    }
    function updateLabel(){
      const current = options.find(o=>o.selected) || options.find(o=>!o.disabled) || options[0];
      valueEl.textContent = current?.label || 'Select...';
    }
    function open(){
      wrap.classList.add('open'); trigger.setAttribute('aria-expanded','true');
      panel.style.width = getComputedStyle(trigger).width;
      search.focus(); search.select();
    }
    function close(){ wrap.classList.remove('open'); trigger.setAttribute('aria-expanded','false'); }
    function selectValue(val){
      options.forEach(o=>o.selected = (o.value===val));
      sel.value = val; sel.dispatchEvent(new Event('change', {bubbles:true}));
      Array.from(listEl.children).forEach(li => li.setAttribute('aria-selected', li.dataset.value===val ? 'true' : 'false'));
      updateLabel(); close(); trigger.focus();
    }

    render(options); updateLabel();

    trigger.addEventListener('click', (e)=>{ e.preventDefault(); wrap.classList.contains('open') ? close() : open(); });
    listEl.addEventListener('click', (e)=>{ const li=e.target.closest('.cs-option'); if(li) selectValue(li.dataset.value); });
    search.addEventListener('input', ()=>{
      const q = search.value.trim().toLowerCase();
      render(options.filter(o => o.label.toLowerCase().includes(q) || o.value.toLowerCase().includes(q)));
    });
    document.addEventListener('click', (e)=>{ if(!wrap.contains(e.target)) close(); });
    trigger.addEventListener('keydown',(e)=>{ if(e.key==='Enter'||e.key===' '||e.key==='ArrowDown'){ e.preventDefault(); open(); }});
    panel.addEventListener('keydown',(e)=>{ if(e.key==='Escape'){ e.preventDefault(); close(); trigger.focus(); }});
    sel.addEventListener('change', updateLabel);
  });
})();
</script>


<script>
/* ===== Robust sync: Country <-> Phone, safe against undefined dial codes ===== */
(function () {
  const phoneInput    = document.querySelector('#phone');
  const countrySelect = document.querySelector('#country');
  if (!phoneInput || !countrySelect || !window.intlTelInputGlobals) return;

  // Use existing instance (you already initialized iti earlier)
  const iti = window.intlTelInputGlobals.getInstance(phoneInput);
  if (!iti) return;

  /* Wait until the plugin actually has a dialCode (geoIpLookup is async). */
  function waitForDialCode(timeout = 2500) {
    return new Promise(resolve => {
      const hasCode = () => {
        const d = iti.getSelectedCountryData();
        return d && typeof d.dialCode === 'string' && d.dialCode.length;
      };
      const finish = () => resolve(iti.getSelectedCountryData());

      if (hasCode()) return finish();

      const onChange = () => { if (hasCode()) { cleanup(); finish(); } };
      const tick = setInterval(() => { if (hasCode()) { cleanup(); finish(); } }, 60);
      const to = setTimeout(() => { cleanup(); finish(); }, timeout);

      function cleanup() {
        clearInterval(tick);
        clearTimeout(to);
        phoneInput.removeEventListener('countrychange', onChange);
      }
      phoneInput.addEventListener('countrychange', onChange);
    });
  }

  // Add/replace dial prefix (only when we *have* a dial code)
  function ensureDialPrefix({ force = false } = {}) {
    const d = iti.getSelectedCountryData();
    if (!d || !d.dialCode) return;                         // <-- guard, no “undefined”
    const prefix = '+' + d.dialCode + ' ';
    const raw = phoneInput.value || '';
    const digits = raw.replace(/\D+/g, '');

    if (force || digits.length < 4 || !raw.trim().startsWith('+')) {
      const stripped = raw.replace(/^\+\d+(\s+)?/, '');    // remove any old +cc
      phoneInput.value = prefix + stripped.trim();
      requestAnimationFrame(() => {
        const len = phoneInput.value.length;
        phoneInput.setSelectionRange(len, len);
      });
    }
  }

  // Map visible country label -> iso2 for intl-tel-input
  function isoFromSelectLabel(label) {
    const all = window.intlTelInputGlobals.getCountryData();
    if (!label) return null;
    const lower = label.toLowerCase();
    let m = all.find(c => c.name.toLowerCase() === lower);
    if (m) return m.iso2;
    // relaxed match (handles variants)
    m = all.find(c => lower.startsWith(c.name.toLowerCase()));
    return m ? m.iso2 : null;
  }

  // Select => phone widget
  countrySelect.addEventListener('change', () => {
    const label = countrySelect.options[countrySelect.selectedIndex]?.text || countrySelect.value || '';
    const iso2 = isoFromSelectLabel(label);
    if (iso2) {
      try { iti.setCountry(iso2); } catch (_) {}
      ensureDialPrefix({ force: false });
    }
  });

  // Phone widget => select
  phoneInput.addEventListener('countrychange', () => {
    const d = iti.getSelectedCountryData();
    if (!d || !d.name) return;
    const opt = Array.from(countrySelect.options).find(o => o.text.toLowerCase() === d.name.toLowerCase());
    if (opt && countrySelect.value !== opt.value) {
      countrySelect.value = opt.value;
      countrySelect.dispatchEvent(new Event('change', { bubbles: true }));
    }
    ensureDialPrefix({ force: false });
  });

  // Initial prefill: only after a real dial code exists
  (async () => {
    const alreadyHasPlus = /^\s*\+/.test(phoneInput.value || '');
    if (!alreadyHasPlus) {
      await waitForDialCode();          // waits for geoIp to resolve
      ensureDialPrefix({ force: true }); // now safe to write prefix
    }
  })();
})();
</script>
</body>
</html>