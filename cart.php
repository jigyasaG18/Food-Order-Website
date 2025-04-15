<?php
// session_start(); // Make sure to start the session

include('partials-front/menu.php');
?>

<style>
    body {
        background-color: #f7f7f7;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }
    
    .total-price {
        font-size: 1.5em;
        color: #007bff;
        text-align: right;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .empty-cart {
        text-align: center;
        color: #666;
    }
</style>

<div class="container">
    <?php
    // Handle Quantity Update and Remove Item at the start
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update_qty'])) {
            // Update quantity logic
            $food = $_POST['food'];
            $new_qty = $_POST['qty'];

            foreach ($_SESSION['cart'] as &$item) {
                if ($item['food'] === $food) {
                    $item['qty'] = $new_qty;
                    $item['total'] = $item['price'] * $new_qty; // Update total price
                    break;
                }
            }

            // Redirect back to the same page to show updated cart
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }

        if (isset($_POST['remove_item'])) {
            // Remove item logic
            $food = $_POST['food'];

            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['food'] === $food) {
                    unset($_SESSION['cart'][$key]); // Remove the item from the cart
                    break;
                }
            }

            // Reset array keys to maintain sequential keys
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            
            // Redirect back to the same page to show updated cart
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Render the cart
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<h2>Your Cart</h2>";
        echo "<table class='table'>";
        echo "<tr><th>Food</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>";
        
        $total_price = 0;

        // Loop through each item in the cart
        foreach ($_SESSION['cart'] as $key => $item) {
            $food = htmlspecialchars($item['food']);
            $price = htmlspecialchars($item['price']);
            $qty = htmlspecialchars($item['qty']);
            $total = htmlspecialchars($item['total']);
            
            echo "<tr>
                    <td>$food</td>
                    <td>₹$price</td>
                    <td>
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='food' value='$food'>
                            <input type='number' name='qty' value='$qty' min='1' style='width: 60px;' required>
                            <input type='submit' name='update_qty' value='Update' class='btn btn-primary'>
                        </form>
                    </td>
                    <td>₹$total</td>
                    <td>
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='food' value='$food'>
                            <input type='submit' name='remove_item' value='Remove' class='btn btn-primary'>
                        </form>
                    </td>
                  </tr>";
            $total_price += $item['total'];
        }
        
        echo "</table>";
        echo "<div class='total-price'>Total Price: ₹$total_price</div>";
        
        // Provide a checkout button
        echo '<a href="checkout.php" class="btn btn-primary">Checkout</a>';
    } else {
        echo "<h2 class='empty-cart'>Your cart is empty.</h2>";
    }
    ?>
</div>

<?php include('partials-front/footer.php'); ?>