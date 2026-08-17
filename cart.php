<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$status_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['send_order'])) {
        $fname = mysqli_real_escape_string($conn, trim($_POST['fname'] ?? ''));
        $lname = mysqli_real_escape_string($conn, trim($_POST['lname'] ?? ''));
        $phone = mysqli_real_escape_string($conn, trim($_POST['phone'] ?? ''));

        if (!empty($fname) && !empty($phone)) {
            mysqli_query($conn, "UPDATE cart_total SET total_price = 0 WHERE id = 1");
            $status_message = "order_sent";
        } else {
            $status_message = "error_required";
        }
    } elseif (isset($_POST['clear_cart'])) {
        mysqli_query($conn, "UPDATE cart_total SET total_price = 0 WHERE id = 1");
        $status_message = "cart_cleared";
    }
}

$res = mysqli_query($conn, "SELECT total_price FROM cart_total WHERE id = 1");
$data = mysqli_fetch_assoc($res);
$total = $data ? floatval($data['total_price']) : 0.00;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Restaurant</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fcfcfc;
            color: #333;
        }

        .header {
            background-color: #9e1919;
            padding: 15px 0;
            color: white;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: #FFB300;
        }

        .hero {
            background: linear-gradient(135deg, #c51616 0%, #9e1919 100%);
            height: 180px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .cart-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .checkout-form {
            flex: 2;
            min-width: 320px;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            border: 1px solid #eaeaea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .checkout-form h2 {
            font-size: 24px;
            color: #111;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .form-row {
            display: flex;
            gap: 15px;
        }

        .field {
            margin-bottom: 20px;
            flex: 1;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        input[type="text"],
        input[type="tel"] {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus {
            outline: none;
            border-color: #D32F2F;
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
        }

        .summary-card {
            flex: 1;
            min-width: 280px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #eaeaea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            height: fit-content;
        }

        .summary-card h3 {
            font-size: 20px;
            color: #D32F2F;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
        }

        .summary-row.total {
            font-size: 22px;
            font-weight: 700;
            color: #111;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #ddd;
        }

        .total-price {
            color: #D32F2F;
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 25px;
        }

        .btn-send {
            width: 100%;
            background-color: #D32F2F;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-send:hover {
            background-color: #9e1919;
        }

        .btn-clear {
            width: 100%;
            background-color: transparent;
            color: #777;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-clear:hover {
            background-color: #fff0f0;
            color: #D32F2F;
            border-color: #D32F2F;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .alert-info {
            background-color: #e3f2fd;
            color: #1565c0;
            border: 1px solid #bbdefb;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            .nav-links a {
                margin: 0 8px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="Menu.php">Menu</a>
            <a href="ContactDetails.php">Contact us</a>
            <a href="Cart.php">Cart (<?php echo number_format($total, 2); ?> JD)</a>
            <a href="AboutUs.php">About Us</a>
        </nav>
    </header>

    <div class="hero">
        <h1>Your Shopping Cart</h1>
    </div>

    <div class="container">

        <?php if ($status_message === "order_sent"): ?>
            <div class="alert alert-success">Thank you! Your order has been placed successfully.</div>
        <?php elseif ($status_message === "cart_cleared"): ?>
            <div class="alert alert-info">Cart cleared successfully.</div>
        <?php elseif ($status_message === "error_required"): ?>
            <div class="alert alert-error">Please fill in required fields (First Name & Phone Number).</div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="cart-wrapper">
                
                <div class="checkout-form">
                    <h2>Customer Information</h2>

                    <div class="form-row">
                        <div class="field">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="fname" placeholder="John" required>
                        </div>

                        <div class="field">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lname" placeholder="Doe">
                        </div>
                    </div>

                    <div class="field">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="07XXXXXXXX" inputmode="numeric" required>
                    </div>
                </div>

                <div class="summary-card">
                    <h3>Order Summary</h3>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span><?php echo number_format($total, 2); ?> JD</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span class="total-price"><?php echo number_format($total, 2); ?> JD</span>
                    </div>

                    <div class="actions">
                        <button type="submit" name="send_order" class="btn-send" <?php echo ($total == 0) ? 'disabled style="opacity:0.6; cursor:not-allowed;"' : ''; ?>>
                            Confirm & Send Order
                        </button>
                        
                        <button type="submit" name="clear_cart" class="btn-clear" onclick="return confirm('Are you sure you want to clear your cart?');">
                            Clear Cart
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>

</body>
</html>