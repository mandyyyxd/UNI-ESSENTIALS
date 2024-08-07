document.getElementById('checkoutButton').addEventListener('click', function(event) {
    if (!validateCheckout()) {
        event.preventDefault();
    }
    else {
        window.location.href = '../html/checkout.php';
    }
});

function validateCheckout() {
    var cardNumber = document.getElementById('cardNumber').value.trim();
    var cardName = document.getElementById('cardName').value.trim();
    var expDate = document.getElementById('expDate').value.trim();
    var cvv = document.getElementById('cvv').value.trim();

    var cardNumberError = document.getElementById('cardNumberError');
    var cardNameError = document.getElementById('cardNameError');
    var expDateError = document.getElementById('expDateError');
    var cvvError = document.getElementById('cvvError');

    cardNumberError.textContent = '';
    cardNameError.textContent = '';
    expDateError.textContent = '';
    cvvError.textContent = '';

    var isValid = true;


    if (cardNumber === '' || !/^\d{16}$/.test(cardNumber)) {
        cardNumberError.textContent = 'Card number must be 16 digits.';
        isValid = false;
    }

    if (cardName === '') {
        cardNameError.textContent = 'Name on card is required.';
        isValid = false;
    }

    if (expDate === '' || !/^(0[1-9]|1[0-2])\/\d{2}$/.test(expDate)) {
        expDateError.textContent = 'Expiry date must be in MM/YY format.';
        isValid = false;
    }

    if (cvv === '' || !/^\d{3}$/.test(cvv)) {
        cvvError.textContent = 'CVV must be 3 digits.';
        isValid = false;
    }

    return isValid;
}