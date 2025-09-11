<?php require 'includes/autoload.php'; ?>
<?php include 'settings-core-7189.php'; ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['order_id'])) {
    header('Location: index.php');
    exit;
}

$order_id = intval($_GET['order_id']);

$orders = new Order;
//$order = $orders->getOrderProducts($order_id); // <-- make this method fetch from orders_products

if (!$order) {
    die("Order not found.");
}

$name = $order['customer_name'];
$address = $order['customer_address'];
$price = $order['total_amount'];
$email = $order['customer_email'];
$date = $order['date'];
$status = $order['status'];

// fetch ordered items
$db = $orders->connection();
$stmt = $db->prepare("SELECT oi.*, p.name, p.image 
                      FROM order_items oi 
                      JOIN products p ON oi.product_id = p.id 
                      WHERE oi.order_id = ?");
$stmt->execute([$order_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Information</title>
    <link rel="stylesheet" href="../style/order_info.css">
</head>

<header>
    <div class="logo">
        <img src="../img/logo-no-background-2.png" alt="Your Logo">
    </div>
    <nav>
        <ul>
            <li><a class="dropbtn" href="./">Home</a></li>
            <li><a class="dropbtn" href="../contacts.php">Contact</a></li>
        </ul>
    </nav>
</header>

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
                <td class="center">#<?php echo $order_id; ?></td>
            </tr>
            <tr>
                <td>Total Price</td>
                <td class="center"><?php echo $price; ?> €</td>
            </tr>
        </table>

        <!-- STATUS BAR -->
        <div class="status-bar">
            <div class="status">Ordered</div>
            <div class="status-line"></div>
            <div class="status">Processing</div>
            <div class="status-line"></div>
            <div class="status">Shipped</div>
            <div class="status-line"></div>
            <div class="status">Delivered</div>
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

        <h2>Products</h2>
        <table>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <?php foreach ($items as $item): ?>
            <tr>
                <td class="center">
                    <img src="../img/products/<?php echo htmlspecialchars($item['image']); ?>" 
                         alt="<?php echo htmlspecialchars($item['name']); ?>" 
                         style="width: 80px; height: auto;">
                </td>
                <td class="center"><?php echo htmlspecialchars($item['name']); ?></td>
                <td class="center"><?php echo $item['quantity']; ?></td>
                <td class="center"><?php echo $item['price']; ?> €</td>
            </tr>
            <?php endforeach; ?>
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

    <div class="footer">
        &copy; 2025 KeysON Lab
        <p class="copyright">All rights reserved.</p>
    </div>
</body>
</html>
