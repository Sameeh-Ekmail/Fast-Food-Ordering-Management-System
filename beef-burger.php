<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

if (isset($_POST['add_to_cart'])) {
    $price = (float)$_POST['add_to_cart']; 
    
    $stmt = mysqli_prepare($conn, "UPDATE cart_total SET total_price = total_price + ? WHERE id = 1");
    mysqli_stmt_bind_param($stmt, "d", $price);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$res = mysqli_query($conn, "SELECT total_price FROM cart_total WHERE id = 1");
$data = mysqli_fetch_assoc($res);
$total = $data['total_price'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beef Burgers</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #9e1919;
            padding: 15px 0;
            color: white;
            font-size: 14px; 
            text-align: center; 
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 20px;
            font-weight: 600;
        }

        .nav-links a:hover {
            color: #FFB300;
        }

        .hero {
            background-color: #c51616;
            height: 200px; 
            color: white;
            text-align: center; 
            padding-top: 60px;
        }

        .hero-content h1 {
            font-size: 48px; 
            font-weight: 900;
        }

        .products-grid {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            border: 1px solid #eee;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .price-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: #FFB300;
            color: white;
            padding: 5px 12px;
            font-weight: bold;
            font-size: 13px;
            border-radius: 4px;
        }

        .product-img-placeholder img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #D32F2F;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .order-btn {
            background-color: #D32F2F;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }

        .order-btn:hover {
            background-color: #9e1919;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-links">
            <a href="Home.php">Home</a>
            <a href="Menu.php">Menu</a>
            <a href="ContactDetails.php">Contact us</a>
            <a href="Cart.php">Cart (<?php echo number_format($total, 2); ?> JD)</a>
            <a href="AboutUs.php">About Us</a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Beef Burgers</h1>
        </div>
    </section>

    <main class="products-grid">
        <div class="card">
            <div class="price-tag">2.25 JD</div>
            <div class="product-img-placeholder">
                <img src="images/classic.png" alt="Classic Burger" width="170" height="170">
            </div>
            <h3>Classic</h3>
            <p>Fried beef burger, lettuce, Swiss cheese, ketchup</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="2.25" class="order-btn">add to cart</button>
            </form>
        </div>

        <div class="card">
            <div class="price-tag">4.00 JD</div>
            <div class="product-img-placeholder">
                <img src="images/jambo.png" alt="Jambo Burger" width="170" height="170">
            </div>
            <h3>Jambo</h3>
            <p>200gm beef burger, lettuce, Swiss cheese, crunchysauce</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="4.00" class="order-btn">add to cart</button>
            </form>
        </div>
        
        <div class="card">
            <div class="price-tag">3.00 JD</div>
            <div class="product-img-placeholder">
                <img src="images/double beef.png" alt="Double Beef Burger" width="170" height="170">
            </div>
            <h3>Double Beef</h3>
            <p>Two 150gm beef burgers, lettuce, pickles, Cheddar Cheese, comeback sauce</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="3.00" class="order-btn">add to cart</button>
            </form>
        </div>
        
        <div class="card">
            <div class="price-tag">3.00 JD</div>
            <div class="product-img-placeholder">
                <img src="images/cheese burger.png" alt="Cheese Burger" width="170" height="170">
            </div>
            <h3>Cheese Burger</h3>
            <p>150gm beef burger, lettuce, Swiss cheese, cheddar cheese, ketchup</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="3.00" class="order-btn">add to cart</button>
            </form>
        </div>
        
        <div class="card">
            <div class="price-tag">4.25 JD</div>
            <div class="product-img-placeholder">
                <img src="images/smoke.png" alt="Smoke Burger" width="170" height="170">
            </div>
            <h3>Smoke</h3>
            <p>150gm beef burger, lettuce, cheddar cheese, BBQ sauce, jalapeno</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="4.25" class="order-btn">add to cart</button>
            </form>
        </div>

        <div class="card">
            <div class="price-tag">3.50 JD</div>
            <div class="product-img-placeholder">
                <img src="images/mashroom.png" alt="Mushroom Burger" width="170" height="170">
            </div>
            <h3>Mashroom</h3>
            <p>150gm beef burger, lettuce, mozzarella cheese, mushrooms, mushroom sauce</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="3.50" class="order-btn">add to cart</button>
            </form>
        </div>
    </main>
</body>
</html>