<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* honor BASE_URL if defined */
$BASE = defined('BASE_URL') ? BASE_URL : '.';

/* simple rate-limit + honeypot */
session_start();
if (!isset($_SESSION['last_contact'])) $_SESSION['last_contact'] = 0;
$success = isset($_GET['success']) && $_GET['success'] === 'true';

function clean($v){ return trim(filter_var($v, FILTER_SANITIZE_FULL_SPECIAL_CHARS)); }

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $hp = $_POST['website'] ?? ''; // honeypot
  if ($hp !== '') { http_response_code(400); exit('Bad request'); }
  if (time() - $_SESSION['last_contact'] < 20) { http_response_code(429); exit('Too many requests'); }

  $name    = clean($_POST['name']    ?? '');
  $email   = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
  $subject = clean($_POST['subject'] ?? 'Message from KeysON Lab');
  $message = clean($_POST['message'] ?? '');

  if (!$name || !$email || !$message) { http_response_code(400); exit('Missing fields'); }

  $body = "<b>Name:</b> {$name}<br><b>Email:</b> {$email}<br><b>Message:</b><br>".nl2br($message);

  try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth   = true;
    /* define these constants in your env/config */
    $mail->Username   = defined('GMAIL') ? GMAIL : 'your@gmail.com';
    $mail->Password   = defined('GMAIL_APP_PASSWORD') ? GMAIL_APP_PASSWORD : 'app-password';

    $mail->setFrom($mail->Username, 'KeysON Lab');
    $mail->addAddress($mail->Username, 'KeysON Lab Inbox');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
    $_SESSION['last_contact'] = time();
    header('Location: contacts.php?success=true'); exit;
  } catch (Exception $e) {
    http_response_code(500);
    echo "Error sending email: ".htmlspecialchars($mail->ErrorInfo);
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Contact Us | KeysON Lab</title>
<link rel="icon" type="image/png" href="<?php echo $BASE; ?>/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">
<style>
:root{
  --violet-2:#4b18d2; --magenta:#7d11b9; --violet-3:#9b2bff; --cyan:#00e4ff;
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

/* Header (scoped) */
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

/* Layout */
main{max-width:1040px; margin:0 auto; padding:calc(var(--header-h) + 28px) 6% 72px; display:grid; gap:24px; grid-template-columns:1.1fr .9fr;}
@media (max-width:980px){ main{grid-template-columns:1fr}}

/* Panels + cards */
.panel{
  background:var(--panel); border:1px solid var(--stroke); border-radius:var(--radius);
  backdrop-filter:blur(8px); padding:24px; box-shadow:0 0 28px rgba(155,43,255,.16);
}
h1,h2{font-family:'Exo 2',sans-serif; background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent}
h1{font-size:2.1rem; margin-bottom:8px}
h2{font-size:1.3rem; margin:10px 0 12px}
.meta{color:var(--muted); font-size:.95rem; margin-bottom:8px}
.card{background:var(--panel); border:1px solid var(--stroke); border-radius:16px; padding:18px; margin-bottom:16px}
.card h3{font-family:'Exo 2',sans-serif; font-size:1.05rem; margin-bottom:8px; background:var(--grad); -webkit-background-clip:text; -webkit-text-fill-color:transparent}

/* Form */
.form-group{margin-bottom:14px}
label{display:block; margin-bottom:6px; color:var(--muted); font-weight:600}
input[type="text"],input[type="email"],textarea{
  width:100%; padding:12px 14px; border-radius:14px; border:1px solid rgba(255,255,255,.18);
  background:rgba(255,255,255,.06); color:var(--text); outline:0; transition:.2s;
}
input:hover,textarea:hover{background:rgba(255,255,255,.09)}
input:focus,textarea:focus{border-color:rgba(155,43,255,.55); box-shadow:0 0 0 3px rgba(155,43,255,.25)}
textarea{min-height:140px; resize:vertical}
.button{
  display:inline-block; padding:14px 24px; border:0; border-radius:999px; font-weight:900; letter-spacing:.2px; color:#fff; cursor:pointer;
  background:var(--grad); box-shadow:0 10px 28px rgba(155,43,255,.22); transition:transform .12s, box-shadow .2s, background .3s
}
.button:hover{ background:var(--grad2); transform:translateY(-2px); box-shadow:0 16px 38px rgba(155,43,255,.32)}

/* Alerts */
.alert{
  padding:12px 14px; border-radius:12px; margin-bottom:12px; font-weight:700;
  border:1px solid rgba(0,255,153,.35); background:rgba(0,255,153,.08); color:#d6ffe8;
}
.small{color:var(--muted); font-size:.92rem}

/* Footer */
footer{text-align:center;padding:28px 6%;font-size:.92rem;color:var(--muted);border-top:1px solid var(--stroke)}
footer a{color:var(--violet-3); text-decoration:none} footer a:hover{color:var(--magenta)}
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
  <!-- LEFT: form -->
  <section class="panel">
    <div class="meta">We typically reply within 24–48h.</div>
    <h1>Contact Us</h1>

    <?php if ($success): ?>
      <div class="alert">Email sent successfully.</div>
    <?php endif; ?>

    <form action="contacts.php" method="post" novalidate>
      <!-- honeypot -->
      <input type="text" name="website" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px;opacity:0" aria-hidden="true">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input id="name" name="name" type="text" maxlength="120" required>
      </div>

      <div class="form-group">
        <label for="email">Your Email</label>
        <input id="email" name="email" type="email" maxlength="160" required>
      </div>

      <div class="form-group">
        <label for="subject">Subject</label>
        <input id="subject" name="subject" type="text" maxlength="180" required>
      </div>

      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea id="message" name="message" maxlength="5000" required></textarea>
      </div>

      <button class="button" type="submit" name="submit" value="1">Submit</button>
      <p class="small" style="margin-top:8px">By contacting us, you agree to our <a href="<?php echo $BASE; ?>/privacy_policy.php">Privacy Policy</a>.</p>
    </form>
  </section>

  <!-- RIGHT: help cards -->
  <aside>
    <div class="card">
      <h3>Order Questions</h3>
      <p class="meta">Include your order number for faster support.</p>
    </div>
    <div class="card">
      <h3>Shipping & Returns</h3>
      <p class="meta">EU shipping. Custom builds: defects covered; setup help free.</p>
    </div>
    <div class="card">
      <h3>Email</h3>
      <p class="meta">keyson.customs@gmail.com</p>
    </div>
  </aside>
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
