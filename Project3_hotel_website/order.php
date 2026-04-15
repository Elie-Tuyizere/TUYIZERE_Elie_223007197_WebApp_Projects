<?php
require 'config.php';

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO orders (full_name, email, phone, menu_item, address, order_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['menu_item'],
        $_POST['address'],
        $_POST['order_date']
    ]);
    header("Location: order.php?success=1");
    exit;
}
$showSuccess = isset($_GET['success']) && $_GET['success'] == 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Food - Hotel Serenity</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Additional refined styles – warm, human, non-AI feel */
        .order-hero {
            background: linear-gradient(135deg, #f7f3e8 0%, #fff4e4 100%);
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 2px solid #ffd966;
            margin-bottom: 1rem;
        }
        .order-hero h1 {
            font-size: 2.2rem;
            color: #3b5c3a;
            font-weight: 600;
            letter-spacing: -0.3px;
        }
        .order-hero p {
            color: #7c6b4f;
            font-style: italic;
            margin-top: 0.5rem;
        }
        .order-card {
            background: #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0,0,0,0.02);
            padding: 2rem 1.8rem;
            transition: all 0.2s ease;
            border: 1px solid #fae6c3;
        }
        .order-card:hover {
            box-shadow: 0 25px 40px -14px rgba(0, 0, 0, 0.15);
        }
        .order-form input,
        .order-form select,
        .order-form textarea {
            width: 100%;
            padding: 12px 16px;
            margin: 8px 0 16px 0;
            border: 1.5px solid #eee2d0;
            border-radius: 28px;
            background: #fefcf8;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: inherit;
        }
        .order-form input:focus,
        .order-form select:focus,
        .order-form textarea:focus {
            outline: none;
            border-color: #ffb347;
            box-shadow: 0 0 0 3px rgba(255, 180, 71, 0.2);
            background: #fff;
        }
        .order-form label {
            font-weight: 600;
            color: #4a5b3c;
            margin-left: 8px;
            display: block;
            font-size: 0.9rem;
        }
        .order-form .required-star {
            color: #e67e22;
        }
        .btn-order-submit {
            background: #ff9f4a;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 40px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.2s;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            letter-spacing: 0.5px;
        }
        .btn-order-submit:hover {
            background: #e8882e;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(230, 126, 34, 0.2);
        }
        .success-message-custom {
            background: #e9f7e1;
            border-left: 6px solid #6fbf4c;
            padding: 1rem 1.2rem;
            border-radius: 60px;
            text-align: center;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #2a5e2e;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .menu-select-icon {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%238b7355" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            appearance: none;
        }
        .footer-small {
            margin-top: 2.5rem;
        }
        @media (max-width: 640px) {
            .order-card {
                padding: 1.5rem;
            }
            .order-hero h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>

<!-- NAVBAR (kept consistent) -->
<div class="navbar">
    <div class="logo">🏨 Hotel Serenity</div>
    <div class="nav-links">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="menu.html">Menu</a>
        <a href="gallery.html">Gallery</a>
        <a href="order.php" style="background:#5a7c5e; border-radius:5px;">Order</a>
        <a href="contact.php">Contact</a>
    </div>
</div>

<!-- PERSONALIZED ORDER HEADER -->
<div class="order-hero">
    <h1>📋 Reserve Your Meal</h1>
    <p>Hand‑prepared dishes · Delivered with warmth</p>
</div>

<div class="container">
    <?php if ($showSuccess): ?>
        <div class="success-message-custom">
            <span>✔️</span> Thank you! Your order is confirmed. We'll call you shortly.
        </div>
    <?php endif; ?>

    <div class="order-card" style="max-width: 680px; margin: 0 auto;">
        <form method="POST" class="order-form">
            <label>Full name <span class="required-star">*</span></label>
            <input type="text" name="full_name" placeholder="e.g., Maria Santos" required>

            <label>Email address</label>
            <input type="email" name="email" placeholder="hello@example.com" required>

            <label>Phone number <span class="required-star">*</span></label>
            <input type="tel" name="phone" placeholder="+63 912 345 6789" required>

            <label>Choose your dish <span class="required-star">*</span></label>
            <select name="menu_item" class="menu-select-icon" required>
                <option value="" disabled selected>— Select a delicious option —</option>
                <option value="Grilled Fish">🐟 Grilled Fish – $10</option>
                <option value="Fried Fish">🐟 Fried Fish – $12</option>
                <option value="Soda">🥤 Soda – $5</option>
                <option value="Milkshake">🥛 Milkshake – $6</option>
                <option value="Orange Juice">🍊 Orange Juice – $3</option>
                <option value="Mango Juice">🥭 Mango Juice – $4</option>
            </select>

            <label>Delivery address <span class="required-star">*</span></label>
            <textarea name="address" rows="3" placeholder="Street, city, landmark..." required></textarea>

            <label>Preferred delivery date</label>
            <input type="date" name="order_date" required>

            <button type="submit" class="btn-order-submit">🍽️ Confirm order</button>
        </form>
        <p style="font-size: 0.75rem; text-align: center; margin-top: 1rem; color: #b5956e;">We respect your privacy. Your details are safe with us.</p>
    </div>
</div>

<div class="footer footer-small">
    <p>© 2026 Hotel Serenity | Homemade recipes · Warm service</p>
</div>

</body>
</html>