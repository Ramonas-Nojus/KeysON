<?php 
require "../inlcudes/autoload.php";
include '../settings-core-7189.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>


<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(90deg, rgba(75,24,210,1) 0%, rgba(125,17,185,1) 50%, rgba(58,7,101,1) 100%);
}

header {
    background: linear-gradient(90deg, rgba(75,24,210,1) 0%, rgba(125,17,185,1) 50%, rgba(58,7,101,1) 100%);
    color: #fff; /* White text color */
    padding: 20px; /* Add padding to the header */
    display: flex; /* Use flexbox for layout */
    justify-content: space-between; /* Distribute items evenly along the main axis */
    align-items: center; /* Center items vertically */
}

.logo img {
    width: 175px; /* Adjust the width of the logo */
    height: auto; /* Maintain aspect ratio */
    @media only screen and (max-width: 768px) {
        width: 100px;
    }
}

nav ul {
    list-style-type: none; /* Remove bullet points from the list */
    padding: 0; /* Remove default padding */
    display: flex; /* Use flexbox for layout */
}

nav ul li {
    margin-left: 20px; /* Add margin between list items */
}

nav ul li:first-child {
    margin-left: 0; /* Remove margin from the first list item */
}

nav ul li a {
    display: inline-block; /* Display links as block elements */
    padding: 10px 20px; /* Add padding to the links */
    background-color: #4f0a6bff; /* Background color for the links */
    color: #fff; /* White text color for links */
    text-decoration: none; /* Remove underline from links */
    border-radius: 5px; /* Add rounded corners */
    font-size: 18px; /* Adjust font size */
    transition: background-color 0.3s; /* Add transition effect for background color */
}

nav ul li a:hover {
    background-color: #391b68; /* Darker background color on hover */
}

.footer {
    background-color: transparent;
    color: grey;
    text-align: center;
    padding: 20px 0;
}

.footer p {
    font-size: 14px;
}

.footer .copyright {
    font-size: 12px;
}


</style>

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

$products = new Products();

if(isset($_GET['p_id'])){

    $id = $_GET['p_id'];

    $product = $products->getById($id);

    $name = $product['name'];
    $category = $product['category'];
    $image = $product['image'];
    $url = $product['supplier_url'];
    $stock = $product['stock'];
    $price = $product['price'];
    $description = $product['description'];

}

if(isset($_POST['edit_product'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $url = $_POST['url'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $edit_product = $products->editProduct($id, $name, $category, $image, $url, $stock, $price, $description, $product['image']);
}

if(isset($_GET['delete'])){

    $products->deleteProduct($_GET['delete']);
    header("Location: ".BASE_URL."/admin/products.php");
}


?>


<!-- Main Container -->
<div class="container">
    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Add New Product</h2>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" value="<?php echo $name ?>" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="Keycaps" <?= $category == "Keycaps" ? "selected" : "" ?>>Keycaps</option>
                        <option value="Arm Rests" <?= $category == "Arm Rests" ? "selected" : "" ?>>Arm Rests</option>
                        <option value="Cables" <?= $category == "Cables" ? "selected" : "" ?>>Cables</option>
                        <option value="Mats" <?= $category == "Mats" ? "selected" : "" ?>>Mats</option>
                        <option value="Cases" <?= $category == "Cases" ? "selected" : "" ?>>Cases</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    
                    <?php if (!empty($image)): ?>
                        <p class="mt-2">Current Image:</p>
                        <img width="150" src="<?php echo BASE_URL?>/img/products/<?php echo htmlspecialchars($image) ?>" alt="Current product image">
                        <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($image) ?>">
                    <?php endif; ?>
                </div>


                <div class="mb-3">
                    <label for="url" class="form-label">Product URL</label>
                    <input type="text" class="form-control" id="url" value="<?php echo $url ?>" name="url">
                    <a  target="_blank" href="<?php echo $url ?>">check link</a>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock" value="<?php echo $stock ?>" name="stock" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $price ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6"><?php echo htmlspecialchars($description) ?></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" name="edit_product" class="btn btn-primary px-4">Edit Product</button>
                </div>
            </form>

            <a class="btn btn-danger" href="?delete=<?php echo $id ?>">DELETE PRODUCT</a>

        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- CKEditor -->
<script>
    CKEDITOR.replace('description');
    CKEDITOR.instances.description.resize('100%', 200);
</script>
<!-- Footer -->
<div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
</div>

</body>
</html>
