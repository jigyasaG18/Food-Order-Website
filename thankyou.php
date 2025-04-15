<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            color: #333;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            background: linear-gradient(135deg,rgb(154, 43, 41) 0%, #c0e0de 100%); /* Gradient background */
            animation: gradientAnimation 6s infinite alternate; /* Fade in/out animation */
            background-image : url(images/ty.png);
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        .container {
            background: rgba(47, 38, 38, 0.9);
            padding: 40px 20px;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(184, 211, 30, 0.2);
            animation: fadeInUp 0.6s ease; /* Fade-in animation for the container */
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 2.5em;
            color: #ff4500; /* Vibrant color for the heading */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Text shadow for depth */
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 15px;
            color: white;
        }

        h3 {
            font-size: 1.5em;
            color:rgb(69, 130, 0); /* Indigo color */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 15px 30px;
            background: #28a745; /* Green color for button */
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s; /* Button animations */
        }

        a:hover {
            background: #218838; /* Darker green on hover */
            transform: scale(1.05); /* Slight zoom on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Order! 🎉</h1>
        <p>Your order has been successfully placed with FOOD HUB! 🍽️</p>
        <p>We appreciate your time to order from us!</p>
        <p>Your food is being prepared and would be soon delivered to you!!!</p>
        <a href="foods.php">Return to Home</a>
    </div>
</body>
</html>