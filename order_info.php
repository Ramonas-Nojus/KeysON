<?php require 'inlcudes/autoload.php'; ?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Užsakymo informacija</title>
    <link rel="stylesheet" href="/style/order_info.css">
</head>

<?php

if(isset($_GET['order_number'])){
    $order_number = $_GET['order_number'];
} else {
    header('Location: index.php');
}

$orders = new Order;

$order = $orders->getOrder($order_number);

$name = $order['customer_name'];
$address = $order['address'];
$price = $order['price'];
$email = $order['email'];
$date = $order['date'];
$status = $order['status'];


$components = explode(",", $order['components']);
$component_images = explode(",", $order['component_images']);

?>

<body>

<?php include "./inlcudes/header.php"; ?>

    <div class="container">
        <h1>Užsakymo informacija</h1>        
        <table>
            <tr>
                <td>Data</td>
                <td class="center"><?php echo $date; ?></td>
            </tr>
            <tr>
                <td>Užsakymo Numeris</td>
                <td class="center">#<?php echo $order_number ?></td>
            </tr>
            <tr>
                <td>Bendra Kaina</td>
                <td class="center"><?php echo $price; ?> €</td>
            </tr>
        </table>
        <div class="status-bar">
            <div class="status">Užsakytas</div>
            <div class="status-line"></div>
            <div class="status">Gaunamos Detalės</div>
            <div class="status-line"></div>
            <div class="status">Užsakymas Renkamas</div>
            <div class="status-line"></div>
            <div class="status">Išsiųstas</div>
            <div class="status-line"></div>
            <div class="status">Pristatytas</div>
        </div>

        <script>
            // Assume you retrieved the status from the database and stored it in a variable
            var status = "<?php echo $status; ?>"; // For example

            var statusElements = document.querySelectorAll('.status');
            var statusLineElements = document.querySelectorAll('.status-line');

            var statusIndex = -1;

            // Loop through all status elements to find the index of the matching status
            for (var i = 0; i < statusElements.length; i++) {
                if (statusElements[i].textContent.trim() === status) {
                    statusIndex = i;
                    break;
                }
            }

            // If a matching status is found
            if (statusIndex !== -1) {
                // Loop through all status elements up to the matched index
                for (var j = 0; j <= statusIndex; j++) {
                    // Add 'active' class to the status element
                    statusElements[j].classList.add('active');

                    // Add 'active' class to the previous status line, if it exists
                    if (j > 0) {
                        statusLineElements[j - 1].classList.add('active');
                    }
                }
            }
        </script>

        <h2>Klaviatūros komponentai</h2>
        <table>
            <tr>
                <td>Klaviaturos dydis</td>
                <td class="center"><?php echo $components[0]; ?>%</td>
            </tr>
            <tr>
                <td>Klaviaturos spalva:</td>
                <td class="center"><?php echo $components[1]; ?></td>
            </tr>
            <tr>
                <td>Switch'ai:</td>
                <td class="center"><?php echo $components[2]; ?></td>
            </tr>
            <tr>
                <td>Stabilizatoriai:</td>
                <td class="center"><?php echo $components[3]; ?></td>
            </tr>
            <tr>
                <td>Keycaps'ai:</td>
                <td class="center"><?php echo $components[4]; ?></td>
            </tr>
            <tr>
                <td>Laidas:</td>
                <td class="center"><?php echo $components[5]; ?></td>
            </tr>
        </table>

        <div id="container" style="width: 65%; margin: auto; border: 3px solid; border-radius: 10px; position: relative; overflow: hidden;">
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

        <h2>Vartotojo informacija</h2>
        <table>
            <tr>
                <td>Vardas Pavardė</td>
                <td class="center"><?php echo $name; ?></td>
            </tr>

            <tr>
                <td>El. Paštas</td>
                <td class="center"><?php echo $email; ?></td>
            </tr>

            <tr>
                <td>Adresas</td>
                <td class="center"><?php echo $address; ?></td>
            </tr>

        </table>
    </div>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">Visos teisės saugomos.</p>
    </div>
</body>
</html>
