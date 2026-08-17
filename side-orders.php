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

$sideOrders = [
    ['title' => 'Ketchup',        'desc' => '50 ml ketchup',            'price' => 0.25, 'image' => 'images/ketchup.webp'],
    ['title' => 'Garlic Sauce',   'desc' => '50 ml garlic sauce',       'price' => 0.25, 'image' => 'images/garlic sauce.png'],
    ['title' => 'BBQ Sauce',      'desc' => '50 ml BBQ sauce',          'price' => 0.25, 'image' => 'images/bbq sauce.png'],
    ['title' => 'Mustard',        'desc' => '50 ml mustard',            'price' => 0.25, 'image' => 'images/mustard.png'],
    ['title' => 'Honey Mustard',  'desc' => '50 ml honey mustard',      'price' => 0.25, 'image' => 'images/honey mustard.png'],
    ['title' => 'Melted Cheese',  'desc' => '50 ml melted cheese',     'price' => 0.25, 'image' => 'images/melted cheese.png'],
    ['title' => 'Comeback Sauce', 'desc' => '50 ml comeback sauce',     'price' => 0.25, 'image' => 'images/comeback-sauce.png'],
    ['title' => 'Coleslaw Salad', 'desc' => '100 gm coleslaw salad',    'price' => 0.50, 'image' => 'images/coleslaw salad.webp'],
    ['title' => 'Salad',          'desc' => 'Tomato, lettuce, cucumber','price' => 0.75, 'image' => 'images/salad.png'],
];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Orders - Burger Roots</title>
    
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
            padding: 40px 20px; 
            color: white;
            text-align: center; 
        }

        .hero-content h1 {
            font-size: 48px; 
            font-weight: 900;
        }

        .products-section {
            padding: 50px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 25px;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }
        
        .price-tag {
            background-color: #FFB300;
            color: #111;
            padding: 4px 12px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 15px;
            margin-bottom: 15px;
        }

        .product-img-placeholder img {
            width: 140px;
            height: 140px;
            object-fit: contain;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #D32F2F;
            font-size: 18px;
            margin-bottom: 8px;
            text-align: center;
        }

        .card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
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
            <h1>Our Side Orders</h1>
        </div>
    </section>

    <main class="products-section">
        <div class="products-grid">
            <?php foreach ($sideOrders as $item): ?>
                <div class="card">
                    <div class="price-tag"><?= number_format($item['price'], 2); ?> JD</div>
                    <div class="product-img-placeholder">
                        <img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['title']); ?>">
                    </div>
                    <h3><?= htmlspecialchars($item['title']); ?></h3>
                    <p><?= htmlspecialchars($item['desc']); ?></p>
                    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="width: 100%;">
                        <button type="submit" name="add_to_cart" value="<?= $item['price']; ?>" class="order-btn">
                            Add to cart
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>