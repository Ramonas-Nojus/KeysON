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

$products = new Products;


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
                <li><a class="dropbtn" href="./products.php">Products</a></li>
            </ul>
        </nav>
    </header>

<div class="container">
        <section id="orders">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>stock</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 

                        $product = $products->getFilteredProducts();

                        foreach($product as $row){

                            $id = $row['id'];

                            $name = $row['name'];
                            $category = $row['category'];
                            $image = $row['image'];
                            $url = $row['supplier_url'];
                            $stock = $row['stock'];
                            $price = $row['price'];
                            $description = $row['description'];

                    ?>
                            <tr onclick="window.location='<?php echo BASE_URL ?>/admin/edit_product.php?p_id=<?php echo $id ?>'" style="cursor:pointer;">
                                <td><?php echo $id; ?></td>
                                <td><img width="125px" src="<?php echo BASE_URL ?>/img/products/<?php echo $image; ?>"> </td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $price; ?> €</td>
                                <td><?php echo $stock; ?></td>
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
