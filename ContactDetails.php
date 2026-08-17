<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message_status = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $fname = mysqli_real_escape_string($conn, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($conn, trim($_POST['lname']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));

    if (!empty($fname) && !empty($email) && !empty($message)) {
       
        $message_status = "success";
    } else {
        $message_status = "error";
    }
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
    <title>Contact Us - Restaurant</title>
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
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .contact-wrapper {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .contact-form-container {
            flex: 2;
            min-width: 320px;
            background: #ffffff;
            padding: 35px;
            border-radius: 12px;
            border: 1px solid #eaeaea;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .contact-form-container h2 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #111;
        }

        .red-text {
            color: #D32F2F;
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
        input[type="email"],
        textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: #D32F2F;
            box-shadow: 0 0 0 3px rgba(211, 47, 47, 0.1);
        }

        textarea {
            resize: vertical;
        }

        .btn-send {
            background-color: #D32F2F;
            color: white;
            border: none;
            padding: 12px 35px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-send:hover {
            background-color: #9e1919;
        }

        .btn-send:active {
            transform: scale(0.98);
        }

        .sidebar {
            flex: 1;
            min-width: 280px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #eaeaea;
            border-right: 4px solid #D32F2F;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .info-title {
            font-size: 18px;
            color: #D32F2F;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .info-detail {
            color: #555;
            font-size: 15px;
            line-height: 1.6;
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
        <h1>Get in Touch</h1>
    </div>

    <div class="container">
        <div class="contact-wrapper">
            
            <div class="contact-form-container">
                <h2>Contact <span class="red-text">Us</span></h2>

                <?php if ($message_status === "success"): ?>
                    <div class="alert alert-success">Thank you! Your message has been sent successfully.</div>
                <?php elseif ($message_status === "error"): ?>
                    <div class="alert alert-error">Please fill in all required fields.</div>
                <?php endif; ?>

                <form action="" method="post">
                    <div class="form-row">
                        <div class="field">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" placeholder="John" required>
                        </div>
                        <div class="field">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" placeholder="Doe">
                        </div>
                    </div>

                    <div class="field">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="example@mail.com" required>
                    </div>

                    <div class="field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Write your message or inquiry here..." required></textarea>
                    </div>

                    <button type="submit" name="send_message" class="btn-send">Send Message</button>
                </form>
            </div>

            <div class="sidebar">
                <div class="info-card">
                    <h3 class="info-title">Delivery Hotline</h3>
                    <p class="info-detail"><strong>Phone:</strong> 0700000000</p>
                    <p class="info-detail"><strong>Working Hours:</strong> 11:00 AM - 1:00 AM</p>
                </div>

                <div class="info-card">
                    <h3 class="info-title">Main Branch</h3>
                    <p class="info-detail"><strong>Location:</strong> Amman - Jordan</p>
                    <p class="info-detail">Mecca Street, Building 45</p>
                </div>

                <div class="info-card">
                    <h3 class="info-title">Customer Support</h3>
                    <p class="info-detail"><strong>Email:</strong> support@restaurant.com</p>
                    <p class="info-detail">We usually respond within 24 hours.</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>