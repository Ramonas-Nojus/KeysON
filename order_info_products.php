<?php require 'inlcudes/autoload.php'; ?>
<?php include 'settings-core-7189.php'; ?>
<?php
error_reporting(E_ALL);  // Show all errors
ini_set('display_errors', 1);  // Enable error display
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Information | KeysON Lab</title>
    <link rel="icon" type="image/png" href="<?php echo BASE_URL ?>/img/favicon.png">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/style/order_info.css">
</head>

<header>
  <a href="<?php echo BASE_URL; ?>/">
    <div class="logo">
      <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysOn">
    </div>
  </a>

  <!-- Mobile menu toggle -->
  <button class="menu-toggle" aria-label="Toggle menu">☰</button>

  <nav>
    <ul>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/keyboard_builder">Builder</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/products">Accessories</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/contacts">Contacts</a></li>
    </ul>
  </nav>
</header>


<?php
if(isset($_GET['order_number'])){
    $order_number = $_GET['order_number'];

    $orders = new Order;
    $products = new Products;

    $order = $orders->getProductOrder($order_number);

    $name = $order['customer_name'];
    $address = $order['address'];
    $price = $order['price'];
    $email = $order['email'];
    $date = $order['date'];
    $status = $order['status'];

} else {
    header('Location: index.php');
}

    $products_ids = explode(",", $order["products"]);


?>

<body>
    <div class="container">
        <h1>Order Information</h1>        
        <table>
            <tr>
                <td>Date</td>
                <td class="center"><?php echo $date; ?></td>
            </tr>
            <tr>
                <td>Order Number</td>
                <td class="center">#<?php echo $order_number ?></td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td class="center"><?php echo $price; ?> €</td>
            </tr>
        </table>

        <div class="status-bar">
            <div class="status">Ordered</div>
            <div class="status-line"></div>
            <div class="status">Being Prepared</div>
            <div class="status-line"></div>
            <div class="status">Shipped</div>

        </div>

        <script>
            var status = "<?php echo $status; ?>";
            var statusElements = document.querySelectorAll('.status');
            var statusLineElements = document.querySelectorAll('.status-line');
            var statusIndex = -1;

            for (var i = 0; i < statusElements.length; i++) {
                if (statusElements[i].textContent.trim() === status) {
                    statusIndex = i;
                    break;
                }
            }

            if (statusIndex !== -1) {
                for (var j = 0; j <= statusIndex; j++) {
                    statusElements[j].classList.add('active');
                    if (j > 0) {
                        statusLineElements[j - 1].classList.add('active');
                    }
                }
            }
        </script>

        <h2>Keyboard Accesories</h2>
        <table>
            

                <?php 
                
                foreach($products_ids as $product_id){ 
                    
                    $product =  $products->getById($product_id);
                    ?>
                    <tr>
                        <td><img style="width: 150px;" src="<?php echo BASE_URL ?>/img/products/<?php echo $product["image"] ?>"></td>
                        <td><?php echo $product["name"] ?></td>
                        <td><?php echo $product["price"] ?>€</td>
                    </tr>
               <?php } ?>
        </table>

        <h2>User Information</h2>
        <table>
            <tr>
                <td>Name</td>
                <td class="center"><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td class="center"><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td class="center"><?php echo $address; ?></td>
            </tr>
        </table>
    </div>

    <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>
<script>
  document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });
</script>
</html>
