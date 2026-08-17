<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snacks Menu</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f9f9f9;
        }

        .products-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            
            display: flex;
            flex-wrap: wrap;       
            justify-content: center; 
            gap: 25px;            
        }

        .card {
            width: 280px;         
            background-color: #fff;
            border: 1px solid #e2e2e2;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .price-tag {
            align-self: flex-end;
            background-color: #ff4757;
            color: #fff;
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .product-img-placeholder {
            margin: 15px 0;
        }

        .product-img-placeholder img {
            object-fit: contain;
        }

        .card h3 {
            margin-bottom: 8px;
            color: #333;
        }

        .card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .order-btn {
            background-color: #2ed573;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: background-color 0.2s;
        }

        .order-btn:hover {
            background-color: #26af5f;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center; margin-top: 30px;">Snacks Menu</h1>

    <section class="products-container">

        <div class="card">
            <div class="price-tag">1.50 JD</div>
            <div class="product-img-placeholder">
                <img src="images/fries.png" width="170" height="170" alt="French Fries">
            </div>
            <h3>French Fries</h3>
            <p>Crispy golden potato fries</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="1.50" class="order-btn">add to cart</button>
            </form>
        </div>

        <div class="card">
            <div class="price-tag">2.00 JD</div>
            <div class="product-img-placeholder">
                <img src="images/cheese_fries.png" width="170" height="170" alt="Cheese Fries">
            </div>
            <h3>Cheese Fries</h3>
            <p>Crispy fries with melted cheese</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="2.00" class="order-btn">add to cart</button>
            </form>
        </div>

        <div class="card">
            <div class="price-tag">2.50 JD</div>
            <div class="product-img-placeholder">
                <img src="images/onion_rings.png" width="170" height="170" alt="Onion Rings">
            </div>
            <h3>Onion Rings</h3>
            <p>Crispy battered onion rings</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="2.50" class="order-btn">add to cart</button>
            </form>
        </div>

        <div class="card">
            <div class="price-tag">3.00 JD</div>
            <div class="product-img-placeholder">
                <img src="images/mozzarella_sticks.png" width="170" height="170" alt="Mozzarella Sticks">
            </div>
            <h3>Mozzarella Sticks</h3>
            <p>Fried cheese sticks with marinara</p>
            <form method="POST">
                <button type="submit" name="add_to_cart" value="3.00" class="order-btn">add to cart</button>
            </form>
        </div>

    </section>

</body>
</html>