<?php include 'settings-core-7189.php'; ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <title>Custom Keyboard Builder | KeysON Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Exo+2:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?php echo BASE_URL ?>/img/favicon.png">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/style/builder.css">
</head>
<body>

<style>
button:hover {
  transform: scale(1.2);
}
</style>


<header>
  <a href="<?php echo BASE_URL; ?>/">
    <div class="logo">
      <img src="<?php echo BASE_URL; ?>/img/logo-no-background-2.png" alt="KeysOn">
    </div>
  </a>

  <!-- Mobile menu toggle -->
  <button class="menu-toggle" aria-label="Toggle menu">☰</button>

  <nav>
    <ul>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/keyboard_builder">Builder</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/products">Accessories</a></li>
      <li><a class="dropbtn" href="<?php echo BASE_URL; ?>/contacts">Contacts</a></li>
    </ul>
  </nav>
</header>


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
                <h2>Keyboard’s Size</h2>
                <br>
                <div class="grid">
                    <button class="component-button" data-price="119.99" data-value="100" value="100%">
                        <p>100%</p>
                    </button>
                    <button class="component-button" data-price="109.99" data-value="80" value="80%">
                        <p>80%</p>
                    </button>
                    <button class="component-button" data-price="109.99" data-value="75" value="75%">
                        <p>75%</p>
                    </button>
                    <button class="component-button" data-price="99.99" data-value="65" value="65%">
                        <p>65%</p>
                    </button>
                    <button class="component-button" data-price="89.99" data-value="60" value="60%">
                        <p>60%</p>
                    </button>

                </div>
            </div>
            <div class="component step-2 required">
                <h2>Keyboard’s Colour</h2>
                <br>
                <div class="grid">
                    <button id="whitebutton" class="component-button white-button" data-value="case-white" data-price="10" value="White"><span style="display: none;">White</span></button>
                    <button class="component-button black-button selected" data-value="case-black" data-price="0" value="Black"><span style="display: none;">Black</span></button>
                    <!-- <button id="pinkButton" class="component-button pink-button" data-price="20" data-value="case-pink" value="Rožinė"><span style="display: none;">Rožinė</span></button> -->
                </div>
            </div>

            <!---------------------------------------------------------------------------------------------------------------------->


            <div class="component step-3 required">
                <h2>Switches</h2>
                <br>


                <div class="color-options">
                    
                    <div class="premade">
                        <h2 style="display: inline; margin-right: 10px;">Linear</h2>
                        <button onclick="playSound('click1')" 
                                style="background-color: #FFA500; color: #fff; border: none; margin: 10px; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: transform 0.2s; vertical-align: middle;">
                                Play Sound
                        </button>
                        <audio id="click1" src="./audio/linear-output.mp3"></audio>

                        <br>
                        <div class="grid">

                            <button class="component-button" data-value="switch-red-2" data-price="40" value="cherry-mx-red"><p>Cherry MX Red</p><img src="/img/swithes/red-2.png"></button>
                            <button class="component-button" data-value="switch-red-2" data-price="40" value="gateron-red-pro"><p>Gateron Red Pro</p><img src="/img/swithes/red-2.png"></button>
                            <button class="component-button" data-value="switch-yellow-2" data-price="40" value="gateron-yellow"><p>Gateron Yellow</p><img src="/img/swithes/yellow-2.png"></button>
                            <button class="component-button" data-value="switch-red-2" data-price="40" value="kailh-box-red"><p>Kailh Box Red</p><img src="/img/swithes/red-2.png"></button>
                            <button class="component-button" data-value="switch-black" data-price="40" value="cherry-mx-black"><p>Cherry MX Black</p><img src="/img/swithes/black.png"></button>
                            <button class="component-button" data-value="switch-oil-king" data-price="40" value="gateron-oil-king"><p>Gateron Oil King</p><img src="/img/swithes/oil-king.png"></button>

                        </div>
                        
                        <h2 style="display: inline; margin-right: 10px;">Tactile</h2>
                        <button onclick="playSound('click2')" 
                                style="background-color: #FFA500; color: #fff; border: none; margin: 10px; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: transform 0.2s; vertical-align: middle;">
                                Play Sound
                        </button>
                        <audio id="click2" src="./audio/tactile-output.mp3"></audio>

                        <br>
                        <div class="grid">

                            <button class="component-button" data-value="switch-brown-2" data-price="40" value="cherry-mx-brown"><p>Cherry MX Brown</p><img src="/img/swithes/brown-2.png"></button>
                            <button class="component-button" data-value="switch-brown-2" data-price="40" value="gateron-brown"><p>Gateron Brown</p><img src="/img/swithes/brown-2.png"></button>
                            <button class="component-button" data-value="switch-yellow-2" data-price="40" value="panda-mx"><p>Panda MX</p><img src="/img/swithes/yellow-2.png"></button>
                            <button class="component-button" data-value="switch-yellow" data-price="40" value="gazzew-boba"><p>GAZZEW Boba U4T</p><img src="/img/swithes/yellow.png"></button>

                        </div>

                        <h2 style="display: inline; margin-right: 10px;">Clicky</h2>
                        <button onclick="playSound('click3')" 
                                style="background-color: #FFA500; color: #fff; border: none; margin: 10px; padding: 10px 20px; border-radius: 5px; cursor: pointer; transition: transform 0.2s; vertical-align: middle;">
                        Play Sound
                        </button>
                        <audio id="click3" src="./audio/clicky-output.mp3"></audio>
                        <br>

                        <div class="grid">
                            <button class="component-button" data-value="switch-blue-2" data-price="40" value="cherry-mx-blue"><p>CHERRY MX Blue</p><img src="./img/swithes/blue-2.png"></button>
                            <button class="component-button" data-value="switch-white" data-price="40" value="kailh-box-white"><p>Kailh Box White</p><img src="./img/swithes/white.png"></button>
                            <button class="component-button" data-value="switch-navy" data-price="40" value="kailh-box-navy"><p>Kailh Box Navy</p><img src="./img/swithes/navy.png"></button>
                            <button class="component-button" data-value="switch-green-2" data-price="40" value="cherry-mx-green"><p>Cherry MX Green</p><img src="./img/swithes/green-2.png"></button>
                        </div>

                    </div>
                    <br>
 
            </div>
             </div>

    <!---------------------------------------------------------------------------------------------------------------------->

            <div class="component step-4 required">
                <h2>Keycaps</h2>
                <br>

                <div class="color-options">
                    <div class="premade grid">

                       
                        
                       <!-- <button class="component-button  gradient-green" data-value="gradient-green"data-price="25">
                            <span style="display: none;">Gradient Green Keycaps</span>
                        </button> 
                             
                        <button class="component-button  gradient-purple" data-value="gradient-purple"data-price="25">
                            <span style="display: none;">Gradient Purple Keycaps</span>
                        </button>
                        -->
                        <button class="component-button  purple-green" data-value="purple-green"data-price="35">
                            <span style="display: none;">Purple and Green Keycaps</span>
                        </button>
                        <button class="component-button  pink-white" data-value="pink-white"data-price="35">
                            <span style="display: none;">Pink and White Keycaps</span>
                        </button>

                        <button class="component-button  matcha" data-value="matcha"data-price="35">
                            <span style="display: none;">Matcha Keycaps</span>
                        </button>

                        <button class="component-button peach-pink" data-value="peach-pink"data-price="35">
                            <span style="display: none;">Peach Pink Keycaps</span>
                        </button>
                        
                        <button class="component-button mint-green-and-dark-blue" data-price="35" data-value="mint-green-and-dark-blue">
                            <span style="display: none;">Mint green and Dark blue Keycaps</span>
                        </button>
                        
                        
                        <button class="component-button blue-starry" data-value="blue-starry" data-price="35">
                            <span style="display: none;">Blue and Starry Keycaps</span>
                        </button>
                        <button class="component-button hhq-cherry" data-value="hhq-cherry"data-price="35">
                            <span style="display: none;">HHQ-Cherry Keycaps</span>
                        </button>
                        
                        <button class="component-button mlv" data-value="mlv"data-price="35">
                            <span style="display: none;">MLV Keycaps</span>
                        </button>
                        <button class="component-button starfall" data-value="starfall"data-price="35">
                            <span style="display: none;">Starfall Keycaps</span>
                        </button>
                        <button class="component-button british-racing" data-value="british-racing"data-price="35">
                            <span style="display: none;">British Racing Keycaps</span>
                        </button>
                        
                        <button class="component-button retro-a" data-value="retro-a"data-price="35">
                            <span style="display: none;">Retro A Keycaps</span>
                        </button>
                        <button class="component-button retro-b" data-value="retro-b"data-price="35">
                            <span style="display: none;">Retro B Keycaps</span>
                        </button>
                        <button class="component-button bhh-backlit" data-value="bhh-backlit"data-price="35">
                            <span style="display: none;">BHH Backlit Keycaps</span>
                        </button>
                         <button class="component-button qkl-backlit" data-value="qkl-backlit"data-price="35">
                            <span style="display: none;">QKL Backlit Keycaps</span>
                        </button>
                         
                        <button class="component-button  blh" data-value="blh"data-price="35">
                            <span style="display: none;">BLH Keycaps</span>
                        </button>
                         <button class="component-button  ml-cherry" data-value="ml-cherry"data-price="35">
                            <span style="display: none;">ML-cherry Keycaps</span>
                        </button>
                         <button class="component-button  bw-cherry" data-value="bw-cherry"data-price="35">
                            <span style="display: none;">BW-cherry Keycaps</span>
                        </button>
                         <button class="component-button  huizong-cherry" data-value="huizong-cherry"data-price="35">
                            <span style="display: none;">Huizong Cherry Keycaps</span>
                        </button>
                         <button class="component-button  hxf-cherry" data-value="hxf-cherry"data-price="35">
                            <span style="display: none;">HXF-Cherry Keycaps</span>
                        </button>


                        <button class="component-button jungle-green" data-value="jungle-green"data-price="35">
                            <span style="display: none;">Jungle Green Keycaps</span>
                        </button>
                        <button class="component-button orange-red" data-value="orange-red"data-price="35">
                            <span style="display: none;">Orange Red Keycaps</span>
                        </button>
                        <button class="component-button mountain-blue" data-price="35" data-value="mountain-blue">
                            <span style="display: none;">Mountain Blue Keycaps</span>
                        </button>
                        <button class="component-button  cyan" data-value="cyan"data-price="35">
                            <span style="display: none;">Cyan Keycaps</span>
                        </button>
                        <button class="component-button  light-blue" data-value="light-blue"data-price="35">
                            <span style="display: none;">Light Blue Keycaps</span>
                        </button>
                        <button class="component-button  lemon-tree" data-value="lemon-tree"data-price="35">
                            <span style="display: none;">Lemon Tree Keycaps</span>
                        </button>

                        <button class="component-button  blue" data-value="blue"data-price="35">
                            <span style="display: none;">Blue Keycaps</span>
                        </button>
                        <button class="component-button  brown" data-value="brown"data-price="35">
                            <span style="display: none;">Brown Keycaps</span>
                        </button>
                        <button class="component-button  berry" data-value="berry"data-price="35">
                            <span style="display: none;">Berry Keycaps</span>
                        </button>
                        <button class="component-button  orange" data-value="orange"data-price="35">
                            <span style="display: none;">Orange Keycaps</span>
                        </button>
                        <button class="component-button  red" data-value="red"data-price="35">
                            <span style="display: none;">Red Keycaps</span>
                        </button>
                        <button class="component-button  pink" data-value="pink"data-price="35">
                            <span style="display: none;">Pink Keycaps</span>
                        </button>

                         

                    </div>
                    
                </div>
            </div>
 
            <!---------------------------------------------------------------------------------------------------------------------->

            <div class="component step-5 required"> 
                <h2>Cable</h2>
                    <div class="grid">
                        <button class="component-button black-button" data-value="cable-black" data-price="30" value="Black"><span style="display: none;">Black</span></button>
                        <button class="component-button white-button" data-value="cable-white" data-price="30" value="White"><span style="display: none;">White</span></button>
                        <button class="component-button blue-button" data-value="cable-sky-blue" data-price="30" value="Sky Blue"><span style="display: none;">Sky Blue</span></button>
                        <button class="component-button pink-button" data-value="cable-pink" data-price="30" value="Pink"><span style="display: none;">Pink</span></button>
                         <button class="component-button red-button" data-value="cable-red" data-price="30" value="Red"><span style="display: none;">Red</span></button>
                        <button class="component-button purple-button" data-value="cable-purple" data-price="30" value="Purple"><span style="display: none;">Purple</span></button>
                        <button class="component-button grey-button" data-value="cable-grey" data-price="30" value="Grey"><span style="display: none;">Grey</span></button>
                        <button class="component-button green-button" data-value="cable-green" data-price="30" value="Green"><span style="display: none;">Green</span></button>
                         <button class="component-button dark-blue-button" data-value="cable-blue" data-price="30" value="Blue"><span style="display: none;">Blue</span></button>
                        <button class="component-button orange-button" data-value="cable-orange" data-price="30" value="Orange"><span style="display: none;">Orange</span></button>
                        <button class="component-button brown-button" data-value="cable-brown" data-price="30" value="Brown"><span style="display: none;">Brown</span></button>

                    </div>
            </div>
            <div class="bottom-text-container">
                <p class="bottom-text">If you don’t see the components you want, you can contact us and order a custom keyboard tailored to your preferences.</p>
            </div>
        </div>
        
        <div class="keyboard-window">
            <div class="keyboard-display">
                <!-- Displayed keyboard goes here -->
            </div>
            <p class="image-disclaimer">Disclaimer: This 3D preview is for reference only. Minor differences may occur in the final product.</p>

            <div class="navigation">
                <button class="btn prev-button">Previous</button>
                <button class="btn next-button">Next</button>
            </div>
        </div>


        <div class="summary-window">
            <h2>Summary</h2>
            <ul id="summary-list">
                <!-- Summary items -->
            </ul>
            <div class="summary-footer">
                <div id="total-price" class="total-price">Total Price: 0.00 €</div>

                <form id="orderForm" action="order.php" method="post">
                   
                    <input type="hidden" name="selectedKeyboardSize" id="selectedKeyboardSize">
                    <input type="hidden" name="selectedKeyboardColor" id="selectedKeyboardColor">
                    <input type="hidden" name="selectedSwitchType" id="selectedSwitchType">
                    <input type="hidden" name="selectedKeycaps" id="selectedKeycaps">
                    <input type="hidden" name="selectedCableColor" id="selectedCableColor">

                    <input type="hidden" name="selectedKeyboardSizePrice" id="selectedKeyboardSizePrice">
                    <input type="hidden" name="selectedKeyboardColorPrice" id="selectedKeyboardColorPrice">
                    <input type="hidden" name="selectedSwitchTypePrice" id="selectedSwitchTypePrice">
                    <input type="hidden" name="selectedKeycapsPrice" id="selectedKeycapsPrice">
                    <input type="hidden" name="selectedCableColorPrice" id="selectedCableColorPrice">
                    <input type="hidden" name="pvm" id="pvm">

                    <input type="hidden" name="KeyboardSizeValue" id="KeyboardSizeValue">
                    <input type="hidden" name="KeyboardColorValue" id="KeyboardColorValue">
                    <input type="hidden" name="SwitchTypeValue" id="SwitchTypeValue">
                    <input type="hidden" name="KeycapsValue" id="KeycapsValue">
                    <input type="hidden" name="CableColorValue" id="CableColorValue">
                </form>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Before placing your order, please select all required components.</p>
                </div>
            </div>

        </div>
        
    </div>

   <div style="text-align:center; padding:20px; font-size:14px; color: white;">
        &copy; 2025 KeysON Lab | 
        <a href="<?php echo BASE_URL ?>/privacy_policy.php" style="color:#4B18D2; text-decoration:none;">Privacy Policy</a>
        <p class="copyright" style="margin-top:5px;">All rights reserved.</p>
    </div>

    <script src="script.js">
        document.querySelector(".menu-toggle").addEventListener("click", () => {
            document.querySelector("header nav").classList.toggle("show");
        });
    </script>
</body>
</html>