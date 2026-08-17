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

$stmt = $pdo->query("SELECT total_price FROM cart_total WHERE id = 1");
$cartData = $stmt->fetch();
$totalPrice = $cartData ? (float)$cartData['total_price'] : 0.00;

$categories = [
    ['title' => 'Beef Burger',    'link' => 'beef-burger.php',    'icon' => '🍔'],
    ['title' => 'Chicken Burger', 'link' => 'chicken-burger.php', 'icon' => '🍗'],
    ['title' => 'Snacks',         'link' => 'snacks.php',         'icon' => '🍟'],
    ['title' => 'Side Orders',    'link' => 'side-orders.php',    'icon' => '🥗'],
    ['title' => 'Drinks',         'link' => 'drinks.php',         'icon' => '🥤'],
];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Burger Roots</title>
    
    <!-- ربط خط Cairo لضمان الاتساق التصميمي -->
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
            padding: 50px 20px; 
            color: white;
            text-align: center; 
        }

        .hero-content h1 {
            font-size: 48px; 
            font-weight: 900;
        }

        .menu-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-card {
            background-color: #c51616; 
            border-radius: 10px; 
            transition: transform 0.2s, background-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .category-card:hover {
            background-color: #9e1919;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .category-card a {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 18px;
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 700;
            width: 100%;
            height: 100%;
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
            <h1>Our Menu</h1>
        </div>
    </section>

    <main class="menu-container">
        <?php foreach ($categories as $category): ?>
            <div class="category-card">
                <a href="<?= htmlspecialchars($category['link']); ?>">
                    <span><?= $category['icon']; ?></span>
                    <span><?= htmlspecialchars($category['title']); ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </main>

</body>
</html>