<?php require '../inlcudes/autoload.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css">
    <title>Admin | Log In</title>
</head>

<body>


<div class="container">

<?php 

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $password = $_POST['password'];

    $admin = new Admin;
    $admin->logIn($email, $first_name, $last_name, $password, $id);
}

?>
    <h1>Log In</h1>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text"  placeholder="Email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" placeholder="First Name" id="firstName" name="firstName" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" placeholder="Last Name" id="lastName" name="lastName" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" placeholder="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" placeholder="Id" id="id" name="id" required>
        </div>

        <button type="submit" class="btn btn-1">Log IN</button>

    </form>
</div>
</body>
</html>