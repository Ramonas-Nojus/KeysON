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
    <title>Add Product</title>
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
                <img src="../img/logo-no-background-2.png" alt="Your Logo">
            </div>
            <nav>
                <ul>
                    <li><a class="dropbtn" href="/">Home</a></li>
                    <li><a class="dropbtn" href="./">Orders</a></li>
                    <li><a class="dropbtn" href="./my_orders.php">My Assigned Orders</a></li>
                    <li><a class="dropbtn" href="./dashboard.php">Dashboard</a></li>
                    <li><a class="dropbtn" href="./logout.php">Logout</a></li>
                    <li><a class="dropbtn" href="./add_product.php">Add Product</a></li>
                </ul>
            </nav>
    </header>

<?php 

$products = new Products();

if(isset($_POST['create_product'])){

    $name = $_POST['name'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $url = $_POST['url'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $add_product = $products->addProduct($name, $category, $image, $url, $stock, $price, $description);
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
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="Keycaps">Keycaps</option>
                        <option value="Arm Rests">Arm Rests</option>
                        <option value="Cables">Cables</option>
                        <option value="Mats">Mats</option>
                        <option value="Cases">Cases</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">Product URL</label>
                    <input type="text" class="form-control" id="url" name="url">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price ($)</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="6"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" name="create_product" class="btn btn-primary px-4">Add Product</button>
                </div>
            </form>
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
<footer class="bg-white text-center py-3 mt-auto shadow-sm">
    &copy; 2025 KeysON Lab. <span class="text-muted">Visos teisės saugomos.</span>
</footer>

</body>
</html>
