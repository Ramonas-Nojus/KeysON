document.addEventListener("DOMContentLoaded", function () {
    const components = document.querySelectorAll(".component");
    const statusBubbles = document.querySelectorAll(".status-bubble");
    const statusLine = document.querySelectorAll(".line");
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");
    const orderButton = document.querySelector("#order-button");
    const keyboardDisplay = document.querySelector(".keyboard-display");
    const layoutButtons = document.querySelectorAll(".layout-button");
    const totalPriceElement = document.getElementById("total-price");

    let totalPrice = 0;
    let currentStep = 0;
    let keyboardSize;
    let selections = {};

    const switchPrices = {
        '60': {
        'gateron-oil-king': 50,   // ~$0.82 × 61
        'cherry-mx-black': 28,    // ~$0.46 × 61
        'kailh-box-red': 25,      // ~$0.35 × 61
        'gateron-yellow': 20,     // ~$0.30 × 61
        'gateron-red-pro': 20,
        'cherry-mx-red': 60,
        'gazzew-boba': 67,        // ~$1.00 × 61
        'panda-mx': 80,           // ~$1.05 × 61
        'zealios-v2': 61,         // ~$1.00 × 61
        'gateron-brown': 18,
        'cherry-mx-brown': 28,
        'cherry-mx-green': 34,    // ~$0.55 × 61
        'kailh-box-navy': 27,     // ~$0.45 × 61
        'kailh-box-white': 24,    // ~$0.40 × 61
        'cherry-mx-blue': 28
    },
    '65': {
        'gateron-oil-king': 55,
        'cherry-mx-black': 31,
        'kailh-box-red': 25,
        'gateron-yellow': 20,
        'gateron-red-pro': 20,
        'cherry-mx-red': 60,
        'gazzew-boba': 67,
        'panda-mx': 80,
        'zealios-v2': 67,
        'gateron-brown': 20,
        'cherry-mx-brown': 31,
        'cherry-mx-green': 37,
        'kailh-box-navy': 30,
        'kailh-box-white': 27,
        'cherry-mx-blue': 31
    },
    '75': {
        'gateron-oil-king': 69,
        'cherry-mx-black': 39,
        'kailh-box-red': 30,
        'gateron-yellow': 25,
        'gateron-red-pro': 25,
        'cherry-mx-red': 60,
        'gazzew-boba': 85,
        'panda-mx': 120,
        'zealios-v2': 84,
        'gateron-brown': 25,
        'cherry-mx-brown': 39,
        'cherry-mx-green': 46,
        'kailh-box-navy': 38,
        'kailh-box-white': 34,
        'cherry-mx-blue': 39
    },
    '80': {
        'gateron-oil-king': 71,
        'cherry-mx-black': 40,
        'kailh-box-red': 30,
        'gateron-yellow': 25,
        'gateron-red-pro': 25,
        'cherry-mx-red': 60,
        'gazzew-boba': 85,
        'panda-mx': 120,
        'zealios-v2': 87,
        'gateron-brown': 26,
        'cherry-mx-brown': 40,
        'cherry-mx-green': 48,
        'kailh-box-navy': 39,
        'kailh-box-white': 35,
        'cherry-mx-blue': 40
    },
    '100': {
        'gateron-oil-king': 75,
        'cherry-mx-black': 70,
        'kailh-box-red': 35,
        'gateron-yellow': 30,
        'gateron-red-pro': 30,
        'cherry-mx-red': 60,
        'gazzew-boba': 104,
        'panda-mx': 120,
        'zealios-v2': 104,
        'gateron-brown': 31,
        'cherry-mx-brown': 48,
        'cherry-mx-green': 57,
        'kailh-box-navy': 47,
        'kailh-box-white': 42,
        'cherry-mx-blue': 48
    }
    };

    // ===== Set default selections =====
    const defaultSelections = [
        { step: 1, value: 'case-black' } // keyboard color default
    ];
    defaultSelections.forEach(def => {
        const btn = components[def.step].querySelector(`.component-button[data-value="${def.value}"]`);
        if(btn) btn.classList.add('selected');
    });

    // ===== Show current step =====
    function showStep(step) {
        components.forEach((component, i) => {
            component.style.display = (i === step) ? "block" : "none";
        });
    }
    showStep(currentStep);

    // ===== Status updates =====
    function updateStatus() {
        statusBubbles.forEach((bubble, index) => {
            bubble.classList.toggle("active", index <= currentStep);
        });
        statusLine.forEach((line, index) => {
            line.classList.toggle("active", index < currentStep);
            line.classList.toggle("unactive", index >= currentStep);
        });
    }

    // ===== Summary =====
    function updateSummary() {
        const summaryList = document.getElementById("summary-list");
        summaryList.innerHTML = "";
        totalPrice = 0;

        components.forEach((component, index) => {
            const selectedButton = component.querySelector(".component-button.selected");
            if(selectedButton){
                const componentName = component.querySelector('h2').textContent;
                const value = selectedButton.textContent;
                const price = parseFloat(selectedButton.getAttribute('data-price'));

                totalPrice += price;

                const li = document.createElement('li');
                li.textContent = `${componentName}: ${value} + ${price} €`;
                summaryList.appendChild(li);
            }
        });

        const assemblyPrice = 30;
        totalPrice += assemblyPrice;
        const liAssembly = document.createElement('li');
        liAssembly.textContent = `Assembly: ${assemblyPrice} €`;
        summaryList.appendChild(liAssembly);

        displayTotalPrice();
    }

    function displayTotalPrice() {
        const VAT = 0.21;
        const totalWithVAT = (totalPrice * (1 + VAT)).toFixed(2);
        totalPriceElement.textContent = `Total Price (with VAT): ${totalWithVAT} €`;
    }

    // ===== Navigation =====
    nextButton.addEventListener("click", function(e) {
        e.preventDefault();

        const currentComponent = components[currentStep];
        const selectedButton = currentComponent.querySelector(".component-button.selected");

        if (!selectedButton) {
            modal.querySelector("p").textContent = "Please select a component before proceeding.";
            modal.style.display = "block";
            return;
        }

        // Last step → submit form
        if (currentStep === components.length - 1) {

            // ===== Fill all hidden inputs =====
            const selectedKeyboardSizeElement = document.querySelector('.component.step-1 .selected');
            if (selectedKeyboardSizeElement) {
                const KeyboardSize = selectedKeyboardSizeElement.textContent;
                const KeyboardSizePrice = selectedKeyboardSizeElement.getAttribute('data-price');
                const KeyboardSizeValue = selectedKeyboardSizeElement.getAttribute('data-value');
                document.getElementById("selectedKeyboardSizePrice").value = KeyboardSizePrice;
                document.getElementById("selectedKeyboardSize").value = KeyboardSize;
                document.getElementById("KeyboardSizeValue").value = KeyboardSizeValue;
            }

            const selectedKeyboardColorElement = document.querySelector('.component.step-2 .selected');
            if (selectedKeyboardColorElement) {
                const KeyboardColor = selectedKeyboardColorElement.textContent;
                const KeyboardColorPrice = selectedKeyboardColorElement.getAttribute('data-price');
                const KeyboardColorValue = selectedKeyboardColorElement.getAttribute('data-value');
                document.getElementById("selectedKeyboardColorPrice").value = KeyboardColorPrice;
                document.getElementById("selectedKeyboardColor").value = KeyboardColor;
                document.getElementById("KeyboardColorValue").value = KeyboardColorValue;
            }

            const selectedSwitchType = document.querySelector('.component.step-3  .selected');
            if (selectedSwitchType) {
                const SwitchType = selectedSwitchType.textContent;
                const SwitchTypePrice = selectedSwitchType.getAttribute('data-price');
                const SwitchTypeValue = selectedSwitchType.getAttribute('data-value');
                document.getElementById("selectedSwitchTypePrice").value = SwitchTypePrice;
                document.getElementById("selectedSwitchType").value = SwitchType;
                document.getElementById("SwitchTypeValue").value = SwitchTypeValue;
            }

            const selectedKeycaps = document.querySelector('.component.step-4  .selected');
            if (selectedKeycaps) {
                const Keycaps = selectedKeycaps.textContent;
                const KeycapsPrice = selectedKeycaps.getAttribute('data-price');
                const KeycapsValue = selectedKeycaps.getAttribute('data-value');
                document.getElementById("selectedKeycapsPrice").value = KeycapsPrice;
                document.getElementById("selectedKeycaps").value = Keycaps;
                document.getElementById("KeycapsValue").value = KeycapsValue;
            }

            const selectedCableColor = document.querySelector('.component.step-5 .selected');
            if (selectedCableColor) {
                const CableColor = selectedCableColor.textContent;
                const CableColorPrice = selectedCableColor.getAttribute('data-price');
                const CableColorValue = selectedCableColor.getAttribute('data-value');
                document.getElementById("selectedCableColorPrice").value = CableColorPrice;
                document.getElementById("selectedCableColor").value = CableColor;
                document.getElementById("CableColorValue").value = CableColorValue;
            }

            // VAT
            document.getElementById("pvm").value = (totalPrice * 0.21).toFixed(2);

            // Submit form
            document.getElementById("orderForm").submit();
            return;
        }

        // ===== Normal next step =====
        currentStep++;
        showStep(currentStep);
        updateStatus();
        updateSummary();

         // Update button text
        if (currentStep === components.length - 1) {
            nextButton.textContent = "Place Order";
        } else {
            nextButton.textContent = "Next";
        }
    });



prevButton.addEventListener("click", () => {
    if (currentStep > 0) {
        // Remove image for visual step
        const currentImage = document.getElementById(`step-${currentStep}`);
        if (currentImage) currentImage.remove();

        // Only clear selection if step is NOT a default step
        if (currentStep !== 1) { // 1 = keyboard color black
            const selectedBtn = components[currentStep].querySelector('.component-button.selected');
            if (selectedBtn) selectedBtn.classList.remove('selected');
        }

        // Go back
        currentStep--;
        showStep(currentStep);
        updateStatus();
        updateSummary();

        // Update next button text
        if (currentStep === components.length - 1) {
            nextButton.textContent = "Place Order";
        } else {
            nextButton.textContent = "Next";
        }
    }
});


    // ===== Component buttons =====
    components.forEach((component, index) => {
    const buttons = component.querySelectorAll('.component-button');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Deselect all buttons in this step
            buttons.forEach(b => b.classList.remove('selected'));
            button.classList.add('selected');

            if(index === 0){ // Step 0 = keyboard size
                keyboardSize = button.getAttribute('data-value');

                // Example: hide some keycaps when 65% selected
                const keycapButtons = document.querySelectorAll('#step-1 .component-button'); 
                keycapButtons.forEach(kb => {
                    kb.style.display = "inline-block"; // reset all visible first
                });

                
            }

            // Save keyboardSize if step 0
            if(index === 0) keyboardSize = button.getAttribute('data-value');

            // Handle switch prices for step 3
            if(index === 2){ // step 3 = switches
                const switchType = button.getAttribute('value');
            

                // Update price attribute dynamically
                if(switchPrices[keyboardSize] && switchPrices[keyboardSize][switchType]){
                    button.setAttribute('data-price', switchPrices[keyboardSize][switchType]);
                }
            }

            // Update keyboard display for steps 0-4
            if(index < 5){
                const imgId = `step-${index}`;
                let existingImg = document.getElementById(imgId);
                if(existingImg) existingImg.remove();

                const img = document.createElement('img');
                img.setAttribute('id', imgId);
                img.setAttribute('class', 'kbrd-img');
                img.src = `img/${keyboardSize}/${button.getAttribute('data-value')}.png`;
                img.style.zIndex = index === 4 ? 0 : index + 1;
                keyboardDisplay.appendChild(img);
            }

            updateSummary();
        });
    });
});



    // ===== Layout buttons =====
    layoutButtons.forEach(button => {
        button.addEventListener('click', () => {
            const selected = button.getAttribute('data-value');
            document.querySelector('.premade').classList.toggle('non-display', selected !== 'premade');
            document.querySelector('.custom').classList.toggle('non-display', selected !== 'custom');
        });
    });

    // ===== Modal =====
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];
    span.onclick = () => modal.style.display = "none";
    window.onclick = e => { if(e.target === modal) modal.style.display = "none"; };

    
});



// ===== Sound =====
function playSound(id){
    document.querySelectorAll('audio').forEach(a=>{ a.pause(); a.currentTime=0; });
    document.getElementById(id).play();
}

document.querySelector(".menu-toggle").addEventListener("click", () => {
    document.querySelector("header nav").classList.toggle("show");
  });