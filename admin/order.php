<?php require "../inlcudes/autoload.php" ?>
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

    <?php 
    
    $orders = new Order;

    if(isset($_GET['order_nr'])){
        $order_nr = $_GET['order_nr'];

        $order = $orders->getOrder($order_nr);

        $name = $order['customer_name'];
        $address = $order['address'];
        $price = $order['price'];
        $email = $order['email'];
        $date = $order['date'];
        $status = $order['status'];
        $id = $order['id'];
        
        
        $components = explode(",", $order['components']);
        $component_images = explode(",", $order['component_images']);        
    } else {
        header('Location: ./');
    }


    if(isset($_POST['status'])){
        $status = $_POST['status'];
        $orders->updateStatus($status, $id);
        header('Location: ./order.php?order_nr='.$order_nr);
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
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Date:</strong> <?php echo $date; ?></p>
                <p><strong>Price:</strong> <?php echo $price; ?></p>
                <p><strong>Status:</strong> <?php echo $status; ?></p>

                <br>
                <hr>

                <table>
                    <tbody>
                        <tr>
                            <td><strong>Keyboard Size:</strong></td>
                            <td><?php echo $components[0]; ?>%</td>
                        </tr>
                        <tr>
                            <td><strong>Keyboard Color:</strong></td>
                            <td><?php echo $components[1]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Switches:</strong></td>
                            <td><?php echo $components[2]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Stabilizers:</strong></td>
                            <td><?php echo $components[3]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Keycaps:</strong></td>
                            <td><?php echo $components[4]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Cable:</strong></td>
                            <td><?php echo $components[5]; ?></td>
                        </tr>
                    </tbody>
                </table>
                
                <div id="container" style="width: 50%; margin: auto; border: 3px solid; border-radius: 10px; position: relative; overflow: hidden;">
                    <img id="image" src="/img/<?php echo $components[0].'/'.$component_images[0]; ?>.png" style="z-index: 1; width: 100%; position: absolute;">
                    <img src="/img/<?php echo $components[0].'/'.$component_images[1]; ?>.png" style="z-index: 2; width: 100%; position: absolute;">
                    <img src="/img/<?php echo $components[0].'/'.$component_images[2]; ?>.png" style="z-index: 3; width: 100%; position: absolute;">
                    <img src="/img/<?php echo $components[0].'/'.$component_images[3]; ?>.png" style="z-index: 0; width: 100%; position: absolute;">
                </div>

                <script>
                    // Wait for all images to load before calculating the container's height
                    window.addEventListener('load', function() {
                        document.getElementById('container').style.height = document.getElementById('image').height + 'px';
                    });

                    window.addEventListener('resize', function() {
                        document.getElementById('container').style.height = document.getElementById('image').height + 'px';
                    });
                </script>

                <!-- Add more order details as needed -->
                <div class="update-status">
                    <form action="./order.php?order_nr=<?php echo $order_nr; ?>" method="post">
                        <label for="status">Update Status:</label>
                        <select name="status" id="status">
                            <option value="Užsakytas">Užsakytas</option>
                            <option value="Gaunamos Detalės">Gaunamos Detalės</option>
                            <option value="Užsakymas Renkamas">Užsakymas Renkamas</option>
                            <option value="Išsiųstas">Išsiųstas</option>
                            <option value="Pristatytas">Pristatytas</option>
                        </select>
                        <button class="btn" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">Visos teisės saugomos.</p>
    </div>
</body>
</html>
