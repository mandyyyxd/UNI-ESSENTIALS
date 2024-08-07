document.addEventListener('DOMContentLoaded', (event) => {
    var modal = document.getElementById("authModal");

    if (modal) {
        var span = document.getElementsByClassName("close")[0];

        window.onload = function() {
            modal.style.display = "block";
        }

        if (span) {
            span.onclick = function() {
                modal.style.display = "none";
            }
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    function calculateTotal() {
        let total = 0;
        const cartItems = document.querySelectorAll('#cart-items li');
        cartItems.forEach(item => {
            const priceElement = item.querySelector('.item-price');
            const quantityElement = item.querySelector('.item-quantity');

            if (priceElement && quantityElement) {
                const price = parseFloat(priceElement.textContent);
                const quantity = parseInt(quantityElement.textContent);
                total += price * quantity;
            }
        });

        if (document.getElementById('coupon').value.trim() !== '') {
            total *= 0.5;
        }

        document.getElementById('total').textContent = total.toFixed(2);
    }

    calculateTotal();

    const observer = new MutationObserver(calculateTotal);
    const config = { childList: true, subtree: true };
    const cartItemsElement = document.getElementById('cart-items');
    if (cartItemsElement) {
        observer.observe(cartItemsElement, config);
    }

    document.getElementById('applyCoupon').addEventListener('click', (event) => {
        event.preventDefault();
        calculateTotal();
    });
});