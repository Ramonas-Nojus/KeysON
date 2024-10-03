document.addEventListener("DOMContentLoaded", function () {
    const components = document.querySelectorAll(".component");
    const statusBubbles = document.querySelectorAll(".status-bubble");
    const statusLine = document.querySelectorAll(".line");
    const componentButtons = document.querySelectorAll(".component-button");
    const prevButton = document.querySelector(".prev-button");
    const nextButton = document.querySelector(".next-button");
    const keyboardDisplay = document.querySelector(".keyboard-display");
    const layoutButtons = document.querySelectorAll(".layout-button");
    const totalPriceElement = document.getElementById("total-price");
    const defaultStabilizerCheckbox = document.getElementById("defaultStabilizer");
    const improvedStabilizerCheckbox = document.getElementById("improvedStabilizer");

    let totalPrice = 0;
    let currentStep = 0;
    let keyboardSize;

    // Function to show the current step's selection and hide others
    function showStep(step) {
        components.forEach((component) => {
            if (component.classList.contains(`step-${step}`)) {
                component.style.display = "block";
            } else {
                component.style.display = "none";
            }
        });
    }

    // Initial step (e.g., Step 1)
    showStep(currentStep + 1);

    // Function to update the active status bubble and line
    function updateStatus() {
        statusBubbles.forEach((bubble, index) => {
            if (index <= currentStep) {
                bubble.classList.add("active");
            } else {
                bubble.classList.remove("active");
            }
        });

        statusLine.forEach((line, index) => {
            if (index < currentStep) {
                line.classList.add("active");
                line.classList.remove("unactive");
            } else {
                line.classList.add("unactive");
                line.classList.remove("active");
            }
        });
    }

    function areAllStepsCompleted() {
        const steps = document.querySelectorAll('.component');
        for (let i = 0; i < steps.length; i++) {
            const step = steps[i];
            if (!step.querySelector('.component-button.selected')) {
                return false; // If any step is incomplete, return false
            }
        }
        return true; // All steps are completed
    }

   // Update the "Next" button event listener
    nextButton.addEventListener("click", function () {
        const currentComponent = document.querySelector(`.component.step-${currentStep + 1}`);
        const selectedButton = currentComponent.querySelector(".component-button.selected");

        if (selectedButton) {
            if (currentStep < components.length - 1) {
                currentStep++;
                showStep(currentStep + 1);
                updateStatus();
                if (currentStep === 5) {
                    updateSummary(); // Add Montavimas to the summary on step 5
                }
            }

        }
    });




    // Event listener for component selection using buttons
    componentButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const selectedValue = button.getAttribute("data-value");

            zIndex = currentStep+1;


            if(currentStep === 0) {  keyboardSize = selectedValue;}

            if(currentStep === 4) {  zIndex = 0;}

            if(currentStep < 5) {

                const img = document.createElement('img');
                img.setAttribute('style', `z-index: ${zIndex}; `);
                img.setAttribute('src', `img/${keyboardSize}/${selectedValue}.png`);
                img.setAttribute('class', `kbrd-img`);
                img.setAttribute('id', currentStep);

                existingImg = document.getElementById(currentStep);

                if (existingImg) {
                    existingImg.remove();
                }

                keyboardDisplay.append(img);

            }   

            // Deselect all buttons in the current step
            const currentComponent = document.querySelector(`.component.step-${currentStep + 1}`);
            const allButtons = currentComponent.querySelectorAll(".component-button");
            allButtons.forEach(btn => btn.classList.remove("selected"));

            // Select the clicked button
            button.classList.add("selected");
        });
    });

    // Update the "Previous" button event listener
    prevButton.addEventListener("click", function () {
        if (currentStep > 0) {
            const currentComponent = document.querySelector(`.component.step-${currentStep + 1}`);
            const allButtons = currentComponent.querySelectorAll(".component-button");
            allButtons.forEach(btn => btn.classList.remove("selected"));

            currentStep--;
            showStep(currentStep + 1);
            updateStatus();

            // Remove improved stabilizers from the summary if moving back to step-3
            if (currentStep === 1) {
                defaultStabilizerCheckbox.checked = true;
                improvedStabilizerCheckbox.checked = false;
                removeImprovedStabilizers();
            }

            // Remove the last item from the summary
            removeLastItem();

            Img = document.getElementById(currentStep + 1).remove();


            updateSummary();
        }
    });


    const premadeLayout = document.querySelector(".premade");
    const customLayout = document.querySelector(".custom");

    // Event listener for layout buttons
    layoutButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const selectedLayout = button.getAttribute("data-value");

            // Check if the selected layout is premade or custom
            if (selectedLayout === "premade") {
                // Apply styles for premade layout
                premadeLayout.classList.remove("non-display");
                customLayout.classList.add("non-display");
            } else if (selectedLayout === "custom") {
                // Apply styles for custom layout
                premadeLayout.classList.add("non-display");
                customLayout.classList.remove("non-display");
            }
        });
    });


    let VATFormatted = 0;

    function updateSummary() {
        const summaryList = document.getElementById("summary-list");
        summaryList.innerHTML = ""; // Clear previous content
        totalPrice = 0; // Reset total price
    
        // Get selected components from each step
        const selectedComponents = document.querySelectorAll(".component");
    
        // Loop through selected components and add them to the summary list
        selectedComponents.forEach((component) => {
            const selectedButton = component.querySelector(".component-button.selected");
    
            if (selectedButton) {
                if (currentStep !== 2 || !selectedButton.classList.contains("improved-stabilizers")) {
                    // Display components other than improved stabilizers in the summary
                    addComponentToSummary(component);
                }
            }
        });
    
        // Display improved stabilizers in the summary if the checkbox is checked
        if (document.getElementById("improvedStabilizer").checked) {
            addImprovedStabilizersToSummary();
        }

        addAssemblyToSummary();
    
        // Calculate and add VAT amount to the summary
        const VATRate = 0.21; // Example VAT rate (21%)
        const VATAmount = totalPrice * VATRate;
        VATFormatted = VATAmount.toFixed(2); // Format VAT amount to two decimal places
    
        const VATListItem = document.createElement("li");
        VATListItem.textContent = `PVM: ${VATFormatted} €`;


        summaryList.appendChild(VATListItem);

        displayTotalPrice();
    }
    
    
    function addComponentToSummary(component) {
        const summaryList = document.getElementById("summary-list");
        const componentName = component.querySelector("h2").textContent;
        const selectedButton = component.querySelector(".component-button.selected");
        const componentValue = selectedButton.textContent;
        const componentPrice = selectedButton.getAttribute("data-price");
        const componentTitle = `${componentName}: ${componentValue} + ${componentPrice} €`;


        
        
        
        // Create a new list item for the summary
        const listItem = document.createElement("li");
        listItem.textContent = componentTitle;
        
        summaryList.appendChild(listItem);
        
        totalPrice += parseFloat(componentPrice);
    }

    // Display the total price
    function displayTotalPrice() {
        const VATRate = 0.21; // Example VAT rate (21%)
        const VATAmount = totalPrice * VATRate;
        const totalPriceWithVAT = totalPrice + VATAmount;
        const totalPriceFormatted = totalPriceWithVAT.toFixed(2); // Format total price to two decimal places
    
        const totalPriceElement = document.getElementById("total-price");
        totalPriceElement.textContent = `Bendra kaina (su PVM): ${totalPriceFormatted} €`;
    }
    
    

    // Event listener for component selection
    componentButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const currentComponent = button.closest(".component");
            const allButtons = currentComponent.querySelectorAll(".component-button");

            // Deselect all buttons in the current step
            allButtons.forEach(btn => btn.classList.remove("selected"));

            // Select the clicked button
            button.classList.add("selected");

            // Update the summary window
            updateSummary();
        });
    });


    // Function to remove the last item from the summary window
    function removeLastItem() {
        const summaryList = document.getElementById("summary-list");
        const items = summaryList.querySelectorAll("li");

        if (items.length > 0) {
            const items = summaryList.querySelectorAll("li");
            const lastItem = items[items.length-1];
            const lastItemPrice = parseFloat(lastItem.textContent.split(" + ")[1]) || 0;
            summaryList.removeChild(lastItem);
            totalPrice -= lastItemPrice;
            totalPriceElement.textContent = `Bendra kaina (su PVM): ${totalPrice.toFixed(2)} €`;
        }
    }



    // Function to remove improved stabilizers from the summary window
    function removeImprovedStabilizers() {
        const summaryList = document.getElementById("summary-list");
        const items = summaryList.querySelectorAll("li");
    
        items.forEach(item => {
            if (item.textContent.includes("Patobulinti stabilizatoriai")) {
                const itemPrice = parseFloat(item.textContent.split(" + ")[1]) || 0;
                summaryList.removeChild(item);
                totalPrice -= itemPrice;
            }
        });
    
        totalPriceElement.textContent = `Bendra kaina (su PVM): ${totalPrice.toFixed(2)} €`;
    }



    // Event listener for the default stabilizer checkbox
    defaultStabilizerCheckbox.addEventListener("click", function () {
        improvedStabilizerCheckbox.checked = false; // Uncheck the improved stabilizer checkbox when default is checked
        updateSummary(); // Trigger the updateSummary function
    });

    // Event listener for the improved stabilizer checkbox
    improvedStabilizerCheckbox.addEventListener("click", function () {
        defaultStabilizerCheckbox.checked = false; // Uncheck the default stabilizer checkbox when improved is checked
        updateSummary(); // Trigger the updateSummary function
        if (!improvedStabilizerCheckbox.checked) {
            removeImprovedStabilizers(); 
        }
    });

    // Prevent unchecking of the checked checkbox
    defaultStabilizerCheckbox.addEventListener("change", function () {
        if (!this.checked) {
            this.checked = true;
        }
    });

    improvedStabilizerCheckbox.addEventListener("change", function () {
        if (!this.checked) {
            this.checked = true;
        }
    });


    // Function to add improved stabilizers to the summary
    function addImprovedStabilizersToSummary() {
        const improvedCheckbox = document.getElementById("improvedStabilizer");
        if (improvedCheckbox.checked) {
            const summaryList = document.getElementById("summary-list");
            const improvedStabilizersPrice = parseFloat(improvedCheckbox.getAttribute("data-price")) || 0;

            const listItem = document.createElement("li");
            listItem.textContent = `Patobulinti stabilizatoriai + ${improvedStabilizersPrice} €`;

            summaryList.appendChild(listItem);

            totalPrice += improvedStabilizersPrice;
        }
    }

       // Event listener for Klaviaturos Dydis buttons
    const klaviaturosDydisButtons = document.querySelectorAll(".component.step-1 .component-button");
    klaviaturosDydisButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const selectedValue = button.getAttribute("data-value");

            // Toggle visibility of the pink button based on the selected value
            const whitebutton = document.getElementById("whitebutton");

            if(selectedValue === "100"){
                whitebutton.style.display = "none";
            } else {
                whitebutton.style.display = "block";
            }

        });
    });





    document.getElementById("order-button").addEventListener("click", function () {
                    
        const form = document.getElementById("orderForm");
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            

            if (areAllStepsCompleted()) {
        
                const selectedKeyboardSizeElement = document.querySelector('.component.step-1 .selected');
                if (selectedKeyboardSizeElement) {
                    KeyboardSize = selectedKeyboardSizeElement.textContent;
                    KeyboardSizePrice = selectedKeyboardSizeElement.getAttribute('data-price');
                    KeyboardSizeValue = selectedKeyboardSizeElement.getAttribute('data-value');
                    document.getElementById("selectedKeyboardSizePrice").value = KeyboardSizePrice;
                    document.getElementById("selectedKeyboardSize").value = KeyboardSize;
                    document.getElementById("KeyboardSizeValue").value = KeyboardSizeValue;

                }

                const selectedKeyboardColorElement = document.querySelector('.component.step-2 .selected');
                if (selectedKeyboardColorElement) {
                    KeyboardColor = selectedKeyboardColorElement.textContent;
                    KeyboardColorPrice = selectedKeyboardColorElement.getAttribute('data-price');
                    KeyboardColorValue = selectedKeyboardColorElement.getAttribute('data-value');
                    document.getElementById("selectedKeyboardColorPrice").value = KeyboardColorPrice;
                    document.getElementById("selectedKeyboardColor").value = KeyboardColor;
                    document.getElementById("KeyboardColorValue").value = KeyboardColorValue;

                }

                const selectedSwitchType = document.querySelector('.component.step-3  .selected');
                if (selectedSwitchType) {
                    SwitchType = selectedSwitchType.textContent;
                    SwitchTypePrice = selectedSwitchType.getAttribute('data-price');
                    SwitchTypeValue = selectedSwitchType.getAttribute('data-value');
                    document.getElementById("selectedSwitchTypePrice").value = SwitchTypePrice;
                    document.getElementById("selectedSwitchType").value = SwitchType;
                    document.getElementById("SwitchTypeValue").value = SwitchTypeValue;

                }

                const selectedKeycaps = document.querySelector('.component.step-4  .selected');
                if (selectedKeycaps) {
                    keycaps = selectedKeycaps.textContent;
                    keycapsPrice = selectedKeycaps.getAttribute('data-price');
                    KeycapsValue = selectedKeycaps.getAttribute('data-value');
                    document.getElementById("selectedKeycapsPrice").value = keycapsPrice;
                    document.getElementById("selectedKeycaps").value = keycaps;
                    document.getElementById("KeycapsValue").value = KeycapsValue;

                }

                const selectedCableColor = document.querySelector('.component.step-5 .selected');
                if (selectedCableColor) {
                    CableColor = selectedCableColor.textContent;
                    CableColorPrice = selectedCableColor.getAttribute('data-price');
                    CableColorValue = selectedCableColor.getAttribute('data-value');
                    document.getElementById("selectedCableColorPrice").value = CableColorPrice;
                    document.getElementById("selectedCableColor").value = CableColor;
                    document.getElementById("CableColorValue").value = CableColorValue;
                }



                    const isImprovedStabilizerSelected = improvedStabilizerCheckbox.checked ;


                    if (isImprovedStabilizerSelected) {
                        selectedStabilizerType = improvedStabilizerCheckbox.value;
                        selectedStabilizerTypePrice = improvedStabilizerCheckbox.getAttribute('data-price');
                        stabilizersValue = improvedStabilizerCheckbox.getAttribute('data-value');
                    } else {
                        selectedStabilizerType = defaultStabilizerCheckbox.value;
                        selectedStabilizerTypePrice = defaultStabilizerCheckbox.getAttribute('data-price');
                        stabilizersValue = defaultStabilizerCheckbox.getAttribute('data-value');
                    }

                    document.getElementById("stabilizers").value = selectedStabilizerType;
                    document.getElementById("stabilizersPrice").value = selectedStabilizerTypePrice;
                    document.getElementById("stabilizersValue").value = stabilizersValue;
                    document.getElementById("pvm").value = VATFormatted;



                    form.submit();

            } else {
                modal.style.display = "block";
            }

        });
    });


    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }


      function addAssemblyToSummary() {
        const summaryList = document.getElementById("summary-list");
        const montavimasListItem = document.createElement("li");
        montavimasListItem.textContent = "Montavimas: 15 €"; // Add the Montavimas item
        summaryList.appendChild(montavimasListItem); // Append to the summary list
        totalPrice += 15; // Add 20 to the total price
    }

});
