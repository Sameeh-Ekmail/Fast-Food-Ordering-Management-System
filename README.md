#  Burger Restaurant Web Application

A full-stack web application for a burger restaurant that allows users to browse the menu, add items to their shopping cart, and view delivery details and restaurant information.

---

##  Features

* **Categorized Menu:** Organized sections for Beef Burgers, Snacks & Sides, and Drinks.
* **Dynamic Shopping Cart:** Real-time total price updates upon adding items to the cart.
* **Responsive Design:** Mobile-friendly and clean layout built with **CSS Flexbox**.
* **MySQL Integration:** Database backend managing cart state and price calculations.

---

##  Tech Stack

* **Backend:** PHP
* **Database:** MySQL
* **Server Environment:** XAMPP (Apache & MySQL)
* **Frontend:** HTML5, CSS3 (Cairo Font, Custom Flexbox Layout)
* **Version Control:** Git & GitHub

---

##  How to Run Locally

### 1. Prerequisites
* Install [XAMPP](https://www.apachefriends.org/index.html) or any local server stack supporting PHP and MySQL.

### 2. Database Setup
1. Open the **XAMPP Control Panel** and start **Apache** and **MySQL**.
2. Open your web browser and navigate to: `http://localhost/phpmyadmin`.
3. Create a new database named **`restaurant_db`**.
4. Create the `cart_total` table and insert an initial record (`id = 1`, `total_price = 0`).

### 3. Execution
1. Place the project folder in the following directory:
   `C:\xampp\htdocs\restaurant-app`
2. Open your browser and navigate to:
   `http://localhost/restaurant-app/Home.php`

---

##  Project Structure

```text
├── images/             # Product images and assets
├── Home.php            # Main landing page
├── Menu.php            # Full food menu page
├── Snacks.php          # Snacks and sides page
├── Drinks.php          # Beverages page
├── Cart.php            # Shopping cart overview
├── AboutUs.php         # Restaurant overview & delivery details
└── .gitignore          # Git exclusion rules