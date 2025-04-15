<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            background-color: #f0f0f0; /* Fallback background color */
            background-image: url('images/payment.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-in-out; /* Fade-in animation for the container */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease; /* Smooth transition for border color */
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #28a745; /* Highlight border on focus */
            outline: none; /* Remove outline */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition for button */
            margin-top: 10px; /* Add space above buttons */
        }

        button:hover {
            background-color: #218838; /* Change background color on hover */
        }

        .back-button {
            background-color: #007bff; /* Blue color for the back button */
        }

        .back-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Confirmation</h1>
        <form id="orderForm">
            <div class="form-group">
                <label for="paymentMethod"><b>Select Payment Method:</b></label>
                <select id="paymentMethod" name="paymentMethod">
                    <option></option>
                    <option value="cash"><b>Cash on Delivery</b></option> <!-- First Option -->
                    <option value="upi"><b>UPI</b></option>
                    <option value="card"><b>Credit Card/Debit Card</b></option>
                </select>
            </div>
            <div id="upiFields" style="display: none;">
                <div class="form-group">
                    <label for="upiId">UPI ID:</label>
                    <input type="text" id="upiId" name="upiId" required>
                </div>
            </div>
            <div id="cardFields" style="display: none;">
                <div class="form-group">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" required>
                </div>
                <div class="form-group">
                    <label for="cardCvv">CVV:</label>
                    <input type="text" id="cardCvv" name="cardCvv" required>
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiry Date (MM/YY):</label>
                    <input type="text" id="expiryDate" name="expiryDate" required placeholder="MM/YY">
                </div>
            </div>
            <button type="button" id="payButton">Pay Now</button>
            <button type="button" id="backButton" class="back-button">Go Back</button> <!-- Go Back Button -->
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const paymentMethod = document.getElementById('paymentMethod');
            const upiFields = document.getElementById('upiFields');
            const cardFields = document.getElementById('cardFields');
            const payButton = document.getElementById('payButton');
            const backButton = document.getElementById('backButton');

            paymentMethod.addEventListener('change', () => {
                // Reset any fields shown
                upiFields.style.display = 'none';
                cardFields.style.display = 'none';

                if (paymentMethod.value === 'cash') {
                    payButton.textContent = 'Order Confirm'; // Change button text
                } else if (paymentMethod.value === 'upi') {
                    upiFields.style.display = 'block'; // Show UPI fields
                    payButton.textContent = 'Pay Now';
                } else if (paymentMethod.value === 'card') {
                    cardFields.style.display = 'block'; // Show Card fields
                    payButton.textContent = 'Pay Now';
                }
            });

            payButton.addEventListener('click', () => {
                if (paymentMethod.value === 'cash') {
                    window.location.href = 'http://localhost/food-order/thankyou.php'; // Redirect for Cash on Delivery
                } else if (paymentMethod.value === 'upi') {
                    window.location.href = 'http://localhost/food-order/thankyou.php';  // Redirect for UPI payment process
                } else if (paymentMethod.value === 'card') {
                    window.location.href = 'http://localhost/food-order/thankyou.php'; // Redirect for Credit Card payment
                }
            });

            backButton.addEventListener('click', () => {
                window.location.href = 'http://localhost/food-order/order.php'; // Redirect to menu page
            });
        });
    </script>
</body>
</html>