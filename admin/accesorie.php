<?php require "../inlcudes/autoload.php" ?>
<?php include '../settings-core-7189.php'; ?>

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Page</title>
    <link rel="stylesheet" href="./style/order.css"> <!-- Link your CSS file here -->
</head>
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
                <li><a class="dropbtn" href="./products.php">Products</a></li>
            </ul>
        </nav>
    </header>

    <?php 
    
    $orders = new Order;
    $products = new Products;


    if(isset($_GET['order_nr'])){
        $order_nr = $_GET['order_nr'];

        $order = $orders->getProductOrder($order_nr);

        $name = $order['customer_name'];
        $address = $order['address'];
        $price = $order['price'];
        $email = $order['email'];
        $date = $order['date'];
        $status = $order['status'];
        $id = $order['id'];
        $worker = $order['worker'];
        $phone = $order['phone'];
        
        
        $products_ids = explode(",", $order["products"]);

     } else {
        header('Location: ./');
    }

    if(isset($_GET['accept'])){
        $orders->assignAccesoriesWorker($_SESSION['id'], $_GET['accept']);
        header('Location: ./accesorie.php?order_nr='.$order_nr);
    }

    if(isset($_POST['status'])){
        $status = $_POST['status'];
        $orders->updateAccesorieStatus($status, $id);
        header('Location: ./accesorie.php?order_nr='.$order_nr);
    }
    
    ?>

    <main>
    <div class="container">
            <h2>Order Details</h2>
            <div class="order">
                <h3>Order ID: <?php echo $id; ?></h3>
                <p><strong>Order Number:</strong> <?php echo $order_nr; ?></p>
                <p><strong>Customer:</strong> <?php echo $name; ?></p>
                <p><strong>Address:</strong> <?php echo $address; ?></p>
                <p><strong>phone:</strong> <?php echo $phone; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Date:</strong> <?php echo $date; ?></p>
                <p><strong>Price:</strong> <?php echo $price; ?></p>
                <p><strong>Status:</strong> <?php echo $status; ?></p>

                <br>
                <hr>

                <table>
                    <tbody>
                        <tr>
                            <?php 
                            foreach($products_ids as $product_id){ 
                                
                                $product =  $products->getById($product_id);
                                ?>
                                <tr>
                                    <td><img style="width: 150px;" src="<?php echo BASE_URL ?>/img/products/<?php echo $product["image"] ?>"></td>
                                    <td><?php echo $product["name"] ?></td>
                                    <td><?php echo $product["price"] ?>€</td>
                                    <td><a class="btn" target="_blank" href="<?php echo $product["supplier_url"] ?>">BUY</a></td>
                                </tr>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                
                <script>
                    window.addEventListener('load', function() {
                        document.getElementById('container').style.height = document.getElementById('image').height + 'px';
                    });

                    window.addEventListener('resize', function() {
                        document.getElementById('container').style.height = document.getElementById('image').height + 'px';
                    });
                </script>


                 <?php if($worker != 0){  ?>
                <div class="update-status">
                    <form action="./accesorie.php?order_nr=<?php echo $order_nr; ?>" method="post">
                        <label for="status">Update Status:</label>
                        <select name="status" id="status">
                            <option value="Ordered">Ordered</option>
                            <option value="Being Prepared">Being Prepared</option>
                            <option value="Shipped">Shipped</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                        <button class="btn" type="submit">Update</button>
                    </form>
                </div>
                <?php  } else { ?>                                  
                    <a class="btn" href="?order_nr=<?php echo $order_nr; ?>&accept=<?php echo $id; ?>">Accept</a>
                <?php } ?>
            </div>
        </section>
    </main>

    <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>
</body>
</html>
