<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="./style/order.css">
</head>

<?php
    if(isset($_POST['selectedKeyboardSize'])){
        $selectedKeyboardSize = $_POST['selectedKeyboardSize'];
        $selectedKeyboardColor = $_POST['selectedKeyboardColor'];
        $selectedSwitchType = $_POST['selectedSwitchType'];
        $stabilizers = $_POST['stabilizers'];
        $selectedKeycaps = $_POST['selectedKeycaps'];
        $selectedCableColor = $_POST['selectedCableColor'];


        $selectedKeyboardSizePrice = $_POST['selectedKeyboardSizePrice'];
        $selectedKeyboardColorPrice = $_POST['selectedKeyboardColorPrice'];
        $selectedSwitchTypePrice = $_POST['selectedSwitchTypePrice'];
        $stabilizersPrice = $_POST['stabilizersPrice'];
        $selectedKeycapsPrice = $_POST['selectedKeycapsPrice'];
        $selectedCableColorPrice = $_POST['selectedCableColorPrice'];
        $pvm = $_POST['pvm'];



        $KeyboardSizeValue = $_POST['KeyboardSizeValue'];
        $KeyboardColorValue = $_POST['KeyboardColorValue'];
        $SwitchTypeValue = $_POST['SwitchTypeValue'];
        $stabilizersValue = $_POST['stabilizersValue'];
        $KeycapsValue = $_POST['KeycapsValue'];
        $CableColorValue = $_POST['CableColorValue'];


        $total_price = $selectedKeyboardSizePrice + $selectedKeyboardColorPrice + $selectedSwitchTypePrice + $stabilizersPrice + $selectedKeycapsPrice + $selectedCableColorPrice + $pvm + 15;
    } else {
        header('Location: index.php');
    }
?>

<body>

<?php include "./inlcudes/header.php"; ?>

    <div class="container">
        <h1>Checkout</h1>
        <div class="checkout-wrapper">
            <h2>Order Summary</h2>
            <table class="order-summary-table">
                <thead>
                    <tr>
                        <th class="rounded-left">Produktas</th>
                        <th></th>
                        <th class="rounded-right">Kaina</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Klaviatūra</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Klaviaturos dydis:</td>
                        <td><?php echo $selectedKeyboardSize; ?></td>
                        <td><?php echo $selectedKeyboardSizePrice; ?>€</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Klaviaturos spalva:</td>
                        <td><?php echo $selectedKeyboardColor; ?></td>
                        <td><?php echo $selectedKeyboardColorPrice; ?> €</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Switch'ai:</td>
                        <td><?php echo $selectedSwitchType; ?></td>
                        <td><?php echo $selectedSwitchTypePrice; ?> €</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Stabilizatoriai:</td>
                        <td><?php echo $stabilizers; ?></td>
                        <td><?php echo $stabilizersPrice; ?> €</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Keycaps'ai:</td>
                        <td><?php echo $selectedKeycaps; ?></td>
                        <td><?php echo $selectedKeycapsPrice; ?> €</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 70px;"> Laidas:</td>
                        <td><?php echo $selectedCableColor; ?></td>
                        <td><?php echo $selectedCableColorPrice; ?> €</td>
                    </tr>

                    <tr>
                        <td style="padding-left: 70px;"> Montavimas:</td>
                        <td></td>
                        <td>15 €</td>
                    </tr>

                    <tr>
                        <td style="padding-left: 70px;"> PVM:</td>
                        <td></td>
                        <td><?php echo $pvm; ?> €</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="rounded-top">Pristatymas:</th>
                        <td id="shipping">Nemokamas į namus</td>
                    </tr>
                    <tr>
                        <th colspan="2" class="rounded-bottom">Galutine suma:</th>
                        <td id="total"><?php echo $total_price; ?></td>
                    </tr>
                </tfoot>
            </table>

        
            <div id="container" style="width: 65%; margin: auto; border: 3px solid; border-radius: 10px; position: relative; overflow: hidden;">
                <img id="image" src="./img/<?php echo $KeyboardSizeValue.'/'.$KeyboardColorValue; ?>.png" style="z-index: 1; width: 100%; position: absolute;">
                <img src="./img/<?php echo $KeyboardSizeValue.'/'.$SwitchTypeValue; ?>.png" style="z-index: 2; width: 100%; position: absolute;">
                <img src="./img/<?php echo $KeyboardSizeValue.'/'.$KeycapsValue; ?>.png" style="z-index: 3; width: 100%; position: absolute;">
                <img src="./img/<?php echo $KeyboardSizeValue.'/'.$CableColorValue; ?>.png" style="z-index: 0; width: 100%; position: absolute;">
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

            <h2>Siuntimo informacija</h2>
            <form action="/checkout.php" method="post">
                <div class="form-group">
                    <label for="email">El. paštas:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address1">Šalis:</label>
                    Lietuva
                </div>
                <div class="form-group">
                    <label for="firstName">Vardas:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lasttName">Pavardė:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="city">Miestas:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="address">Adresas:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="postal-code">Pašto kodas:</label>
                    <input type="text" id="postal-code" name="postal_code" required>
                </div>

            <h2>Apmokejimas</h2>
                <input type="hidden" name='price' value="<?php echo $total_price; ?>">

                <input type="hidden" name="KeyboardSizeValue" id="KeyboardSizeValue" value="<?php echo $KeyboardSizeValue; ?>">
                <input type="hidden" name="KeyboardColorValue" id="KeyboardColorValue" value="<?php echo $selectedKeyboardColor; ?>">
                <input type="hidden" name="SwitchTypeValue" id="SwitchTypeValue" value="<?php echo $selectedSwitchType; ?>">
                <input type="hidden" name="stabilizersValue" id="stabilizersValue" value="<?php echo $stabilizers; ?>">
                <input type="hidden" name="KeycapsValue" id="KeycapsValue" value="<?php echo $selectedKeycaps; ?>">
                <input type="hidden" name="CableColorValue" id="CableColorValue" value="<?php echo $selectedCableColor; ?>">

                <input type="hidden" name="KeyboardColorImg" id="KeyboardColorImg" value="<?php echo $KeyboardColorValue; ?>">
                <input type="hidden" name="SwitchTypeImg" id="SwitchTypeImg" value="<?php echo $SwitchTypeValue; ?>">
                <input type="hidden" name="KeycapsImg" id="KeycapsImg" value="<?php echo $KeycapsValue; ?>">
                <input type="hidden" name="CableColorImg" id="CableColorImg" value="<?php echo $CableColorValue; ?>">

                <button type="submit" class="btn btn-1">Užsisakyti</button>
            </form>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">Visos teisės saugomos.</p>
    </div>

</body>
</html>
