<?php
$host    = 'localhost';
$db      = 'restaurant_db';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    
    $price = filter_var($_POST['add_to_cart'], FILTER_VALIDATE_FLOAT);

    if ($price !== false && $price > 0) {
        $stmt = $pdo->prepare("UPDATE cart_total SET total_price = total_price + :price WHERE id = 1");
        $stmt->execute(['price' => $price]);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$stmt = $pdo->query("SELECT total_price FROM cart_total WHERE id = 1");
$cartData = $stmt->fetch();
$totalPrice = $cartData ? (float)$cartData['total_price'] : 0.00;

$products = [
    [
        'id'          => 1,
        'title'       => 'Classic Chicken Burger',
        'description' => 'Fried Crispy Chicken 150 gm, Lettuce, Tomatoes, Cheddar Cheese...',
        'price'       => 5.25,
        'image'       => 'b2.jpeg'
    ],
    [
        'id'          => 2,
        'title'       => 'Italian Beef Burger Sandwich',
        'description' => 'A Slice of Beef Bacon, Smoked Cheese, Fresh Tomato...',
        'price'       => 6.75,
        'image'       => 'b3.jpg'
    ],
    [
        'id'          => 3,
        'title'       => 'Classic Beef Burger Sandwich',
        'description' => 'Fresh Beef Patty (140 gm), Cheddar Cheese, Lettuce...',
        'price'       => 5.50,
        'image'       => 'b4.jpg'
    ]
];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Roots Restaurant</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .header {
            background-color: #9e1919;
            padding: 15px 0;
            text-align: center; 
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin: 0 25px;
            font-weight: 700;
            transition: opacity 0.2s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }
        
        .hero {
            background-color: #c51616;
            padding: 60px 20px; 
            color: white;
            text-align: center; 
        }

        .hero-content h1 {
            font-size: 48px; 
            margin-bottom: 20px;
            font-weight: 900;
        }

        .main-burger-img img {
            width: 280px;
            height: auto;
            border-radius: 8px;
        }

        .bestsellers {
            padding: 50px 20px; 
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .bestsellers h2 {
            font-size: 32px;
            margin-bottom: 40px;
            color: #222;
            text-transform: capitalize;
        }

        .products-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .price-tag {
            background-color: #FFB300;
            color: #111;
            padding: 5px 14px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 20px;
            margin-bottom: 15px;
        }

        .product-img-placeholder img {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #D32F2F;
            font-size: 18px;
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
            padding: 10px 24px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .order-btn:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>

    <header class="header">
        <nav class="nav-links">
            <a href="Home.php">Home</a>
            <a href="Menu.php">Menu</a>
            <a href="ContactDetails.php">Contact us</a>
            <a href="Cart.php">Cart (<?= number_format($totalPrice, 2); ?> JD)</a>
            <a href="AboutUs.php">About Us</a>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Burger Roots Restaurant</h1>
            <div class="main-burger-img">
                <img src="b1.jpeg" alt="Main Burger" />     
            </div>
        </div>
    </section>

    <section class="bestsellers">
        <h2>Choose one of our best sellers</h2>
        
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <div class="price-tag"><?= number_format($product['price'], 2); ?> JD</div>
                    <div class="product-img-placeholder">
                        <img src="<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['title']); ?>">
                    </div>
                    <h3><?= htmlspecialchars($product['title']); ?></h3>
                    <p><?= htmlspecialchars($product['description']); ?></p>
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <button type="submit" name="add_to_cart" value="<?= $product['price']; ?>" class="order-btn">
                            Add to cart
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>
</html>