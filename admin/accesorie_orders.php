<?php session_start(); ?>
<?php require '../inlcudes/autoload.php' ?>
<?php include '../settings-core-7189.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="./style/style.css">
</head>

<?php 

if(!isset($_SESSION['id'])){
    header("Location: ./login.php");

}

$orders = new Order;


if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $orders->assignAccesoriesWorker($_SESSION['id'], $order_id);
    header('Location: ./accesorie_orders.php');
}

?>

<body>
    <header>
        <div class="logo">
            <a href="/">
                <img src="../img/logo-no-background-2.png" alt="Your Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a class="dropbtn" href="/admin/">Orders</a></li>
                <li><a class="dropbtn" href="/admin/accesorie_orders.php">Accesorie Orders</a></li>
                <li><a class="dropbtn" href="/admin/my_orders.php">My Assigned Orders</a></li>
                <li><a class="dropbtn" href="/admin/dashboard.php">Dashboard</a></li>
                <li><a class="dropbtn" href="/admin/logout.php">Logout</a></li>
                <li><a class="dropbtn" href="./add_product.php">Add Product</a></li>
            </ul>
        </nav>
    </header>
<div class="container">
        <section id="orders">
            <h2>Orders</h2>
            <a class="order-button <?php echo (!isset($_GET['progress']) || $_GET['progress'] == 0) ? "active" : ""; ?>"  href="?progress=0">Not Processed</a>
            <a class="order-button <?php echo (isset($_GET['progress']) && $_GET['progress'] == 1) ? "active" : ""; ?>" href="?progress=1">Processed</a>

            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Number</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Order Status</th>
                        <th>Price</th>
                        <th>Worker ID</th>

                    </tr>
                </thead>
                <tbody>

                    <?php 

                    if(!isset($_GET['progress']) || $_GET['progress'] == 0){
                        $order = $orders->getProductOrders($_SESSION['id']);
                    } else if (isset($_GET['progress']) && $_GET['progress'] == 1){ 
                        $order = $orders->getFinisheProductdOrders($_SESSION['id']);
                     }

                    
                        foreach($order as $row){

                            $id = $row['id'];
                            $order_nr = $row['order_number'];
                            $name = $row['customer_name'];
                            $status = $row['status'];
                            $order_number = $row['order_number'];
                            $date = $row['date'];
                            $price = $row['price'];
                            $worker = $row['worker'];
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $order_nr; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $price; ?> €</td>
                            <td><?php echo $worker; ?></td>

                            <?php if($worker == 0){ ?> 
                                <td>
                                    <a class="btn" href="?order_id=<?php echo $id; ?>">Accept</a>
                                </td>
                            <?php } ?> 

                            <td>
                                <a class="btn" href="./accesorie.php?order_nr=<?php echo $order_nr; ?>">Details</a>
                            </td>
                        </tr>

                    <?php } ?>
                    
                </tbody>
            </table>
        </section>
    </div>

    <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>

    <!-- Add your JavaScript files here -->
    <script src="script.js"></script>
</body>
</html>
