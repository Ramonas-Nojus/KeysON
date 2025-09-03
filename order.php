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
    $selectedKeycaps = $_POST['selectedKeycaps'];
    $selectedCableColor = $_POST['selectedCableColor'];

    $selectedKeyboardSizePrice = $_POST['selectedKeyboardSizePrice'];
    $selectedKeyboardColorPrice = $_POST['selectedKeyboardColorPrice'];
    $selectedSwitchTypePrice = $_POST['selectedSwitchTypePrice'];
    $selectedKeycapsPrice = $_POST['selectedKeycapsPrice'];
    $selectedCableColorPrice = $_POST['selectedCableColorPrice'];
    $pvm = $_POST['pvm'];

    $KeyboardSizeValue = $_POST['KeyboardSizeValue'];
    $KeyboardColorValue = $_POST['KeyboardColorValue'];
    $SwitchTypeValue = $_POST['SwitchTypeValue'];
    $KeycapsValue = $_POST['KeycapsValue'];
    $CableColorValue = $_POST['CableColorValue'];

    $total_price = $selectedKeyboardSizePrice + $selectedKeyboardColorPrice + $selectedSwitchTypePrice + $selectedKeycapsPrice + $selectedCableColorPrice + $pvm + 30;
} else {
    header('Location: index.php');
}
?>

<body>

<?php include "./inlcudes/header.php"; ?>

<style> 

.styled-select {
    width: 100%;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    font-size: 16px;
    appearance: none; /* Remove default arrow */
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="gray" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.styled-select:focus {
    border-color: #00CED1;
    box-shadow: 0 0 5px rgba(0, 206, 209, 0.5);
    outline: none;
}



</style>

<div class="container">
    <h1>Checkout</h1>
    <div class="checkout-wrapper">
        <h2>Order Summary</h2>
        <table class="order-summary-table">
            <thead>
                <tr>
                    <th class="rounded-left">Product</th>
                    <th></th>
                    <th class="rounded-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Keyboard</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Keyboard Size:</td>
                    <td><?php echo $selectedKeyboardSize; ?></td>
                    <td><?php echo $selectedKeyboardSizePrice; ?>€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Keyboard Color:</td>
                    <td><?php echo $selectedKeyboardColor; ?></td>
                    <td><?php echo $selectedKeyboardColorPrice; ?>€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Switches:</td>
                    <td><?php echo $selectedSwitchType; ?></td>
                    <td><?php echo $selectedSwitchTypePrice; ?>€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Keycaps:</td>
                    <td><?php echo $selectedKeycaps; ?></td>
                    <td><?php echo $selectedKeycapsPrice; ?>€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Cable:</td>
                    <td><?php echo $selectedCableColor; ?></td>
                    <td><?php echo $selectedCableColorPrice; ?>€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">Assembly:</td>
                    <td></td>
                    <td>30€</td>
                </tr>
                <tr>
                    <td style="padding-left: 70px;">VAT:</td>
                    <td></td>
                    <td><?php echo $pvm; ?>€</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="rounded-top">Shipping:</th>
                    <td id="shipping">Free</td>
                </tr>
                <tr>
                    <th colspan="2" class="rounded-bottom">Total Price:</th>
                    <td id="total"><?php echo $total_price; ?>€</td>
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
            window.addEventListener('load', function() {
                document.getElementById('container').style.height = document.getElementById('image').height + 'px';
            });

            window.addEventListener('resize', function() {
                document.getElementById('container').style.height = document.getElementById('image').height + 'px';
            });
        </script>

        <h2>Shipping Information</h2>
        <form action="./checkout.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <select id="country" class="styled-select" name="country" required>
                    <option value="">Select a country</option>
                    <option value="AT">Austria</option>
                    <option value="BE">Belgium</option>
                    <option value="BG">Bulgaria</option>
                    <option value="HR">Croatia</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="EE">Estonia</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                    <option value="GR">Greece</option>
                    <option value="HU">Hungary</option>
                    <option value="IE">Ireland</option>
                    <option value="IT">Italy</option>
                    <option value="LV">Latvia</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MT">Malta</option>
                    <option value="NL">Netherlands</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="RO">Romania</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="ES">Spain</option>
                    <option value="SE">Sweden</option>
                    <option value="GB">United Kingdom</option>
                </select>
            </div>
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="postal-code">Postal Code:</label>
                <input type="text" id="postal-code" name="postal_code" required>
            </div>

            <h2>Payment</h2>
            <input type="hidden" name='price' value="<?php echo $total_price; ?>">

            <input type="hidden" name="KeyboardSizeValue" value="<?php echo $KeyboardSizeValue; ?>">
            <input type="hidden" name="KeyboardColorValue" value="<?php echo $selectedKeyboardColor; ?>">
            <input type="hidden" name="SwitchTypeValue" value="<?php echo $selectedSwitchType; ?>">
            <input type="hidden" name="stabilizersValue" value="<?php echo $stabilizers; ?>">
            <input type="hidden" name="KeycapsValue" value="<?php echo $selectedKeycaps; ?>">
            <input type="hidden" name="CableColorValue" value="<?php echo $selectedCableColor; ?>">

            <input type="hidden" name="KeyboardColorImg" value="<?php echo $KeyboardColorValue; ?>">
            <input type="hidden" name="SwitchTypeImg" value="<?php echo $SwitchTypeValue; ?>">
            <input type="hidden" name="KeycapsImg" value="<?php echo $KeycapsValue; ?>">
            <input type="hidden" name="CableColorImg" value="<?php echo $CableColorValue; ?>">

            <button type="submit" class="btn btn-1">Place Order</button>
        </form>
    </div>
</div>

<div class="footer">
    &copy; 2024 KeyON
    <p class="copyright">All rights reserved.</p>
</div>

</body>
</html>
