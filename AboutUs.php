<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

$res = mysqli_query($conn, "SELECT total_price FROM cart_total WHERE id = 1");
$data = mysqli_fetch_assoc($res);
$total = $data['total_price'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Burger Restaurant</title>
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
            color: #333;
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
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #FFB300;
        }

        .hero {
            background-color: #c51616;
            padding: 60px 20px;
            color: white;
            text-align: center; 
        }

        .hero h1 {
            font-size: 48px; 
            font-weight: 900;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .about-text p {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 16px;
        }

        .about-text p.highlight {
            font-size: 18px;
            font-weight: bold;
            color: #111;
        }

        .delivery-box {
            margin-top: 35px;
            padding: 20px;
            background-color: #fff8e1;
            border-left: 4px solid #FFB300;
            border-radius: 4px;
        }

        .delivery-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            margin-bottom: 5px;
        }

        .phone {
            font-size: 20px;
            font-weight: 700;
            color: #D32F2F;
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
        <h1>About Us</h1>
    </section>

    <main class="container">
        <div class="about-text">
            <p class="highlight">We Are The Best Place To Go When You're Looking For Delicious Mouthwatering Burgers And Hotdogs!</p>
            <p>Our Specialty Is The Flavors Starting From The North To The South, And West To The East!</p>
            <p>We Are The Diner Where You Find Amazing Combinations, An Unexpectedly Great Atmosphere, Endless Joy, Magnificent Tastes, And Affordable Prices!</p>
            <p class="highlight" style="color: #D32F2F;">To Sum Up, Best Burgers In Town.</p>
        </div>

        <div class="delivery-box">
            <div class="delivery-title">Delivery Service Is Available At:</div>
            <div class="phone">📞 0700000000</div>
        </div>
    </main>

</body>
</html>