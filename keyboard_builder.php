<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>KeyON</title>
    <link rel="stylesheet" href="./style/builder.css">
</head>
<body>

<?php include "./inlcudes/header.php"; ?>


    <div class="status-row">
        <div class="status-bubble active"></div>
        <div class="line unactive"></div>
        <div class="status-bubble"></div>
        <div class="line unactive"></div>
        <div class="status-bubble"></div>
        <div class="line unactive"></div>
        <div class="status-bubble"></div>
        <div class="line unactive"></div>
        <div class="status-bubble"></div>
    </div>

    <div class="container">
        <div class="selection-panel">
            <div class="component step-1 required">
                <h2>Klaviaturos Dydis</h2>
                <br>
                <div class="grid">
                    <button class="component-button" data-price="109.99" data-value="100" value="100%">
                        <p>100%</p>
                    </button>
                    <button class="component-button" data-price="99.99" data-value="80" value="80%">
                        <p>80%</p>
                    </button>
                    <button class="component-button" data-price="89.99" data-value="65" value="65%">
                        <p>65%</p>
                    </button>
                    <!-- <button class="component-button" data-price="89.99" data-value="60" value="60%">
                        <p>60%</p>
                    </button> -->
                </div>
            </div>
            <div class="component step-2 required">
                <h2>Klaviaturos spalva</h2>
                <br>
                <div class="grid">
                    <button id="whitebutton" class="component-button white-button" data-value="case-white" data-price="10" value="Balta"><span style="display: none;">Balta</span></button>
                    <button class="component-button black-button selected" data-value="case-black" data-price="0" value="Juoda"><span style="display: none;">Juoda</span></button>
                    <!-- <button id="pinkButton" class="component-button pink-button" data-price="20" data-value="case-pink" value="Rožinė"><span style="display: none;">Rožinė</span></button> -->
                </div>
            </div>
            <div class="component step-3 required">
                <h2>Switch'ai</h2>
                <br>
                <div class="grid">
                    <button class="component-button" data-value="switch-red" data-price="40" value="Red"><p>Red</p><img src="/img/swithes/red.png"></button>
                    <button class="component-button" data-value="switch-brown" data-price="40" value="Brown"><p>Brown</p><img src="/img/swithes/brown.png"></button>
                    <button class="component-button" data-value="switch-blue" data-price="40" value="Blue"><p>Blue</p><img src="/img/swithes/blue.png"></button>
                    <button class="component-button" data-value="switch-yellow" data-price="40" value="Yellow"><p>Yellow</p><img src="/img/swithes/yellow.png"></button>
                </div>
                <br>
                <h2>Stabilizatoriai</h2>
                <br> 
                <div class="grid">
                    <label class="checkbox-container">
                        <input type="checkbox" id="defaultStabilizer" name="stabilizerType" data-price="0" data-value="default" value="Numatyti" checked>
                        <span class="checkmark"></span>
                        Numatyti stabilizatoriai
                    </label>
                    <label class="checkbox-container">
                        <input type="checkbox" id="improvedStabilizer" name="stabilizerType" data-price="20" data-value="improved" value="Patobulinti">
                        <span class="checkmark"></span>
                        Patobulinti stabilizatoriai
                    </label>
                </div>
            </div>
            <div class="component step-4 required">
                <h2>Keycaps'ai</h2>
                <br>

                <!-- <p>Select Layout:</p>
                <div class="layout-buttons">
                    <button class="layout-button" data-value="premade">Pre Made</button>
                    <button class="layout-button" data-value="custom">Custom</button>
                </div> -->
                <div class="color-options">
                    <div class="premade grid">
                        <button class="component-button retro-dark-blue" data-value="retro-dark-blue"data-price="30">
                            <span style="display: none;">Retro Dark Blue PBT Keycaps</span>
                        </button>

                        <button class="component-button retro-dark-green" data-value="retro-dark-green"data-price="30">
                            <span style="display: none;">Retro Dark Green PBT Keycaps</span>
                        </button>

                        <button class="component-button Royal-Kludge-OEM-Tiffany-PBT-UK" data-price="30" data-value="Royal-Kludge-OEM-Tiffany-PBT-UK">
                            <span style="display: none;">Royal Kludge OEM Tiffany PBT UK</span>
                        </button>
                        <button class="component-button OEM-Dye-Sub-PBT-Iceberg" data-price="50" data-value="OEM-Dye-Sub-PBT-Iceberg">
                            <span style="display: none;">OEM Dye Sub PBT Iceberg</span>
                        </button>
                        <!-- <button class="component-button Royal-Kludge-RK68KC01-Double-Shot-PBT" data-price="35" data-value="Royal-Kludge-RK68KC01-Double-Shot-PBT">
                            <span style="display: none;">Royal Kludge RK68KC01 Double Shot PBT</span>
                        </button> -->
                        <button class="component-button Royal-Kludge-PBT-XDA-15" data-value="Royal-Kludge-PBT-XDA-15" data-price="35">
                            <span style="display: none;">Royal Kludge PBT XDA-15</span>
                        </button>
                        <button class="component-button Royal-Kludge-PBT-XDA-3" data-value="Royal-Kludge-PBT-XDA-3"data-price="35">
                            <span style="display: none;">Royal Kludge PBT XDA-3</span>
                        </button>
                        <button class="component-button Royal-Kludge-PBT-XDA-28" data-value="Royal-Kludge-PBT-XDA-28"data-price="35">
                            <span style="display: none;">Royal Kludge PBT XDA-28</span>
                        </button>
                        <button class="component-button Royal-Kludge-PBT-XDA-116" data-value="Royal-Kludge-PBT-XDA-116"data-price="35">
                            <span style="display: none;">Royal Kludge PBT XDA-116</span>
                        </button>
                <!---------------------------------------------------------------------------------------------------------------------->
                        <button class="component-button brown-milky-yellow" data-value="brown-milky-yellow"data-price="25">
                            <span style="display: none;">Brown Milky Yellow ABS Keycaps</span>
                        </button>

                        <button class="component-button retro-blue-and-white" data-value="retro-blue-and-white"data-price="30">
                            <span style="display: none;">Retro Blue and White PBT Keycaps</span>
                        </button>

                        <button class="component-button retro-white-and-orange" data-value="retro-white-and-orange"data-price="30">
                            <span style="display: none;">Retro White and Orange PBT Keycaps</span>
                        </button>

                        <button class="component-button  pink-barbie" data-value="pink-barbie"data-price="25">
                            <span style="display: none;">Pink Barbie ABS Keycaps</span>
                        </button>

                        <button class="component-button sky-blue" data-value="sky-blue"data-price="30">
                            <span style="display: none;">Sky Blue PBT Keycaps</span>
                        </button>

                        <button class="component-button mojito" data-value="mojito"data-price="30">
                            <span style="display: none;">Mojito PBT Keycaps</span>
                        </button>
<!-- 
                        <button class="component-button black-Sugar" data-value="black-Sugar"data-price="35">
                            <span style="display: none;">Black Sugar ABS Keycaps</span>
                        </button> -->

                        <!-- <button class="component-button gradient-retro-purple" data-value="gradient-retro-purple"data-price="35">
                            <span style="display: none;">Gradient Retro Purple ABS Keycaps</span>
                        </button> -->

                        <!-- <button class="component-button retro-mixed-green" data-value="retro-mixed-green"data-price="35">
                            <span style="display: none;">Retro Mixed Green ABS Keycaps</span>
                        </button> -->

                        <button class="component-button pink-and-retro-green" data-value="pink-and-retro-green"data-price="30">
                            <span style="display: none;">Pink And Retro Green PBT Keycaps</span>
                        </button>

                    </div>
                    <!-- <div class="custom non-display">
                        <button class="component-button white-button" data-value="keycaps-2-white" data-price="50"><span style="display: none;">White</span></button>
                        <button class="component-button black-button" data-value="keycaps-2-black" data-price="50"><span style="display: none;">black</span></button>
                        <button class="component-button green-button" data-value="keycaps-2-green" data-price="50"><span style="display: none;">green</span></button>
                        <button class="component-button red-button" data-value="keycaps-2-red" data-price="50"><span style="display: none;">red</span></button>
                        <button class="component-button blue-button" data-value="keycaps-2-blue" data-price="50"><span style="display: none;">blue</span></button>
                        <button class="component-button purple-button" data-value="keycaps-2-purple" data-price="50"><span style="display: none;">purple</span></button>
                    </div> -->
                </div>
            </div>
 
            <div class="component step-5 required"> 
                <h2>Laidas</h2>
                    <div class="grid">
                        <button class="component-button black-button" data-value="cable-black" data-price="25" value="Juodas"><span style="display: none;">Juodas</span></button>
                        <button class="component-button white-button" data-value="cable-white" data-price="25" value="Baltas"><span style="display: none;">Baltas</span></button>
                        <button class="component-button blue-button" data-value="cable-blue" data-price="40" value="Mėlynas"><span style="display: none;">Mėlynas</span></button>
                        <button class="component-button pink-button" data-value="cable-pink" data-price="40" value="Rožinė"><span style="display: none;">Rožinis</span></button>

                    </div>
            </div>
            <div class="bottom-text-container">
                <p class="bottom-text">Jei nepamatote norimų komponentų, galite susisiekti su mumis ir užsakyti asmeniškai pritaikytą klaviatūrą pagal jūsų pageidavimus.</p>
            </div>
        </div>
        
        <div class="keyboard-window">
            <div class="keyboard-display">
                <!-- Displayed keyboard goes here -->
            </div>
            <p class="image-disclaimer">Prašome atkreipti dėmesį: Tikrasis produktas gali nedideliais skirtumais skirtis nuo vaizdo.</p>

            <div class="navigation">
                <button class="btn prev-button">Ankstesnis</button>
                <button class="btn next-button">Kitas</button>
            </div>
        </div>


        <div class="summary-window">
            <h2>Santrauka</h2>
            <ul id="summary-list">
                <!-- Summary items will be added dynamically here -->
            </ul>
            <div class="summary-footer">
                <div id="total-price" class="total-price">Bendra kaina: 0.00 €</div>
                <!-- <button id="order-button" class="order-button">Užsisakyti</button> -->
                <form id="orderForm" action="order.php" method="post">
                    <!-- Hidden input fields to store selected component values -->
                    <input type="hidden" name="selectedKeyboardSize" id="selectedKeyboardSize">
                    <input type="hidden" name="selectedKeyboardColor" id="selectedKeyboardColor">
                    <input type="hidden" name="selectedSwitchType" id="selectedSwitchType">
                    <input type="hidden" name="stabilizers" id="stabilizers">
                    <input type="hidden" name="selectedKeycaps" id="selectedKeycaps">
                    <input type="hidden" name="selectedCableColor" id="selectedCableColor">

                    <input type="hidden" name="selectedKeyboardSizePrice" id="selectedKeyboardSizePrice">
                    <input type="hidden" name="selectedKeyboardColorPrice" id="selectedKeyboardColorPrice">
                    <input type="hidden" name="selectedSwitchTypePrice" id="selectedSwitchTypePrice">
                    <input type="hidden" name="stabilizersPrice" id="stabilizersPrice">
                    <input type="hidden" name="selectedKeycapsPrice" id="selectedKeycapsPrice">
                    <input type="hidden" name="selectedCableColorPrice" id="selectedCableColorPrice">
                    <input type="hidden" name="pvm" id="pvm">


                    <input type="hidden" name="KeyboardSizeValue" id="KeyboardSizeValue">
                    <input type="hidden" name="KeyboardColorValue" id="KeyboardColorValue">
                    <input type="hidden" name="SwitchTypeValue" id="SwitchTypeValue">
                    <input type="hidden" name="stabilizersValue" id="stabilizersValue">
                    <input type="hidden" name="KeycapsValue" id="KeycapsValue">
                    <input type="hidden" name="CableColorValue" id="CableColorValue">


                    <button type="submit" id="order-button" class="btn">Užsisakyti</button>
                </form>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Prieš užsakydami, prašome pasirinkti visus būtinus komponentus.</p>
                </div>
            </div>

        </div>
        
    </div>

    <div class="footer">
        &copy; 2024 KeyON
        <p class="copyright">Visos teisės saugomos.</p>
    </div>

    <script src="script.js"></script>
</body>
</html>