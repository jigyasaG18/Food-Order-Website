<?php
session_start();
include('partials-front/menu.php');

if (empty($_SESSION['cart'])) {
    header('location: cart.php');
    exit();
}

// Get user id and prepare to save orders
$u_id = $_SESSION["u_id"];
$order_date = date("Y-m-d h:i:sa");

foreach ($_SESSION['cart'] as $item) {
    $food = htmlspecialchars($item['food']);
    $price = htmlspecialchars($item['price']);
    $qty = htmlspecialchars($item['qty']);
    $total = htmlspecialchars($item['total']);
    $status = "Ordered";

    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, u_id) 
            VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$u_id')";
    mysqli_query($conn, $sql);
}

// Clear the cart after processing the order
unset($_SESSION['cart']);

// Redirect to thank you page or confirmation page
header('location: payment.php'); // You'll create this page to confirm the order
exit();
?>