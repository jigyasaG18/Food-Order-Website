<?php
// session_start(); // Start the session for session variables

// Include database connection and menu
include('partials-front/menu.php');

// Check if the database connection has been established
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check whether the food id is set in the URL
if (isset($_GET['food_id'])) {
    // Get the food id from the URL and escape it
    $food_id = mysqli_real_escape_string($conn, $_GET['food_id']);
    
    // Get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
    $res = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($res) {
        $count = mysqli_num_rows($res);

        // Check whether the data is available
        if ($count == 1) {
            // We have data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            // Food not available, redirect to home page
            header('Location: ' . SITEURL);
            exit();
        }
    } else {
        // Error in the SQL query
        die("SQL query failed: " . mysqli_error($conn));
    }
} else {
    // Redirect to homepage if food_id is not set
    header('Location: ' . SITEURL);
    exit();
}
?>

<!-- Food Order Section Starts Here -->
<section class="food-order">
    <div class="container">
        <h2 class="text-center text-white">Please confirm to place order</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend style="color:white;">Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    // Check whether the image is available
                    if ($image_name == "") {
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3 style="color:white;"><?php echo htmlspecialchars($title); ?></h3>
                    <input type="hidden" name="food" value="<?php echo htmlspecialchars($title); ?>">
                    <p class="food-price" style="color:white;">₹<?php echo htmlspecialchars($price); ?></p>
                    <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    <div class="order-label" style="color:white;">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                </div>
            </fieldset>

            <fieldset>
                <input type="submit" name="place_order" value="Order Now" class="btn btn-primary">
                <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
            </fieldset>
        </form>

        <?php 
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the user is logged in
            if (empty($_SESSION["u_id"])) {
                // Redirect to login page if the user is not logged in
                header('Location: login.php');
                exit();
            }

            // Get item details from submitted form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            // Initialize cart session if it doesn't exist
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check the action (order or add to cart)
            if (isset($_POST['place_order'])) {
                // Place order logic
                $total = $price * $qty; // Calculate total
                
                // Save the order to database (optional functionality)
                $order_date = date("Y-m-d H:i:s");
                $status = "Ordered"; // Order status
                $u_id = $_SESSION["u_id"];

                $sql_order = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, u_id) VALUES ('$food', $price, $qty, $total, '$order_date', '$status', '$u_id')";
                $res_order = mysqli_query($conn, $sql_order);

                if ($res_order) {
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                } else {
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food. Please try again.</div>";
                }
                header('Location: ' . SITEURL);
                exit();
            } elseif (isset($_POST['add_to_cart'])) {
                // Add item to cart logic
                $item_found = false;

                // Check if the item already exists in the cart
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['food'] === $food) {
                        // Item found, update quantity
                        $item['qty'] += $qty;
                        $item['total'] += $price * $qty;
                        $item_found = true;
                        break;
                    }
                }

                // If item was not found in the cart, add it as a new item
                if (!$item_found) {
                    $new_item = [
                        'food' => $food,
                        'price' => $price,
                        'qty' => $qty,
                        'total' => $price * $qty
                    ];
                    $_SESSION['cart'][] = $new_item;
                }

                // Redirect to the cart page after adding item to cart
                header('Location: cart.php');
                exit();
            }
        }
        ?>
    </div>
</section>
<!-- Food Order Section Ends Here -->

<?php include('partials-front/footer.php'); ?>