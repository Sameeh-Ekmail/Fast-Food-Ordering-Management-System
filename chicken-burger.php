<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['add_to_cart'])) {
    $price = floatval($_POST['add_to_cart']); 
    if ($price > 0) {
        $update_query = "UPDATE cart_total SET total_price = total_price + $price WHERE id = 1";
        mysqli_query($conn, $update_query);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$res = mysqli_query($conn, "SELECT total_price FROM cart_total WHERE id = 1");
$data = mysqli_fetch_assoc($res);
$total = $data ? $data['total_price'] : 0.00;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicken Burgers - Menu</title>
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
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-size: 28px;
            color: #D32F2F;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 25px;
        }

        /* Product Card */
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #eaeaea;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .price-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #FFB300;
            color: #111;
            padding: 6px 14px;
            font-weight: 700;
            font-size: 13px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .product-img-placeholder {
            text-align: center;
            margin: 20px 0 15px 0;
        }

        .product-img-placeholder img {
            width: 160px;
            height: 160px;
            object-fit: contain;
            transition: transform 0.2s ease;
        }

        .card:hover .product-img-placeholder img {
            transform: scale(1.05);
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card h3 {
            color: #D32F2F;
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .card p {
            color: #666;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .order-btn {
            width: 100%;
            background-color: #D32F2F;
            color: white;
            border: none;
            padding: 10px 0;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .order-btn:hover {
            background-color: #9e1919;
        }

        .order-btn:active {
            transform: scale(0.98);
        }

        @media (max-width: 768px) {
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

    <section class="hero">
        <div class="hero-content">
            <h1>Chicken Burgers</h1>
        </div>
    </section>

    <div class="container">
        <h2 class="section-title">Select Your Meal</h2>

        <div class="menu-grid">

            <div class="card">
                <span class="price-tag">2.25 JD</span>
                <div class="product-img-placeholder">
                    <img src="images/gold.png" alt="Gold Burger">
                </div>
                <div class="card-body">
                    <div>
                        <h3>Gold</h3>
                        <p>Fried chicken burger, lettuce, Swiss cheese, sauce, ketchup</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="add_to_cart" value="2.25" class="order-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <span class="price-tag">3.75 JD</span>
                <div class="product-img-placeholder">
                    <img src="images/crunchy.png" alt="Crunchy Burger">
                </div>
                <div class="card-body">
                    <div>
                        <h3>Crunchy</h3>
                        <p>Fried chicken breast, lettuce, Swiss cheese, crunchy sauce</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="add_to_cart" value="3.75" class="order-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <span class="price-tag">4.00 JD</span>
                <div class="product-img-placeholder">
                    <img src="images/crunchy slaw.png" alt="Crunchy Slaw Burger">
                </div>
                <div class="card-body">
                    <div>
                        <h3>Crunchy Slaw</h3>
                        <p>Fried chicken breast, Coleslaw salad, lettuce, Pickles, Cheddar Cheese, comeback sauce</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="add_to_cart" value="4.00" class="order-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <span class="price-tag">3.75 JD</span>
                <div class="product-img-placeholder">
                    <img src="images/royal.png" alt="Royal Burger">
                </div>
                <div class="card-body">
                    <div>
                        <h3>Royal</h3>
                        <p>Grilled chicken breast, lettuce, pickles, turkey, Swiss cheese, BBQ sauce, mayonnaise</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="add_to_cart" value="3.75" class="order-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <span class="price-tag">3.25 JD</span>
                <div class="product-img-placeholder">
                    <img src="images/spicy.png" alt="Spicy Burger">
                </div>
                <div class="card-body">
                    <div>
                        <h3>Spicy</h3>
                        <p>Fried chicken burger, lettuce, Swiss cheese, spicy sauce, jalapeno</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="add_to_cart" value="3.25" class="order-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>
</html>