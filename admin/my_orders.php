<?php session_start(); ?>
<?php require '../inlcudes/autoload.php' ?>
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
    header("Location: /admin/login.php");

}

$orders = new Order;


?>

<body>
    <header>
        <div class="logo">
            <img src="/img/logo-no-background-2.png" alt="Your Logo">
        </div>
        <nav>
            <ul>
                <li><a class="dropbtn" href="/">Home</a></li>
                <li><a class="dropbtn" href="/admin/">Orders</a></li>
                <li><a class="dropbtn" href="/admin/my_orders.php">My Assigned Orders</a></li>
                <li><a class="dropbtn" href="/admin/dashboard.php">Dashboard</a></li>
                <li><a class="dropbtn" href="/admin/logout.php">Logout</a></li>
            </ul>
        </nav>
</header>
<div class="container">
        <section id="orders">
        <h2>My Assigned Orders</h2>
            <a class="order-button" href="/admin/my_orders.php?not_proccessed=true">Not Processed</a>
            <a class="order-button" href="/admin/my_orders.php">Being Processed</a>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Order Status</th>
                        <th>Price</th>

                    </tr>
                </thead>
                <tbody>

                    <?php 
                    
                    if(isset($_GET['not_proccessed'])){
                        $order = $orders->getNotProcessedOrders($_SESSION['id']);
                    } else { 
                        $order = $orders->getAssignedOrders($_SESSION['id']);
                     }


                        foreach($order as $row){

                            $id = $row['id'];
                            $name = $row['customer_name'];
                            $status = $row['status'];
                            $order_number = $row['order_number'];
                            $date = $row['date'];
                            $price = $row['price'];
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $price; ?> €</td>

                            <td>
                                <a class="btn" href="./order.php?order_nr=<?php echo $order_number; ?>">Details</a>
                            </td>
                        </tr>

                    <?php } ?>
                    
                </tbody>
            </table>
        </section>
    </div>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">Visos teisės saugomos.</p>
    </div>

    <!-- Add your JavaScript files here -->
    <script src="script.js"></script>
</body>
</html>
