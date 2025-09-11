document.addEventListener("DOMContentLoaded", () => {
  const cartItems = document.querySelector(".cart-panel .cart-items");
  if (!cartItems) {
    console.error("Cart panel not found (.cart-panel .cart-items)");
    return;
  }

  document.body.addEventListener("submit", async (e) => {
    const form = e.target;
    if (!form.classList.contains("cart-form")) return; // only our cart forms
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const res = await fetch("cart-handler.php", {
        method: "POST",
        body: formData,
      });
      const data = await res.json();
      cartItems.innerHTML = data.cart;
    } catch (err) {
      console.error("Cart update failed:", err);
    }
  });
});
