

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="Checkout.css">
</head>
<body>
    <div class="container">
        <h2>Checkout</h2>
        <div class="summary">
            <h3>Order Summary</h3>
            <p>Item 1: $19.99</p>
            <p>Item 2: $29.99</p>
            <p>Item 3: $39.99</p>
            <p><strong>Total: $89.97</strong></p>
        </div>
        <form id="checkoutForm" onsubmit="return validateForm()">
            <h3>Payment Information</h3>
            <label for="card_name">Name on Card</label>
            <input type="text" id="card_name" name="card_name" required>

            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" required>

            <label for="exp_month">Expiration Month</label>
            <select id="exp_month" name="exp_month" required>
                <option value="">Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <label for="exp_year">Expiration Year</label>
            <select id="exp_year" name="exp_year" required>
                <option value="">Year</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
            </select>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required>

            <button type="submit">Place Order</button>
        </form>
    </div>
    <script src="js/checkout.js"></script>
    <script>
        
        function displayOrderSummary() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let summaryDiv = document.querySelector('.summary');
            let total = 0;

            summaryDiv.innerHTML = '<h3>Order Summary</h3>';

            cart.forEach((item, index) => {
                let itemName = `Item ${index + 1}`;
                let itemPrice = `OM${item.price.toFixed(2)}`;
                total += item.price;

                let itemHtml = `<p>${itemName}: ${itemPrice}</p>`;
                summaryDiv.innerHTML += itemHtml;
            });

            let totalHtml = `<p><strong>Total: OM${total.toFixed(2)}</strong></p>`;
            summaryDiv.innerHTML += totalHtml;
        }

     
        displayOrderSummary();

    </script>
</body>
</html>
