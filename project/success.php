<?php
session_start();
$conn = new mysqli("localhost", "root", "", "skincare_shop");

if(!isset($_GET['order_id'])) {
    header("Location: index.php");
    exit();
}

$order_id = (int)$_GET['order_id'];

// Fetch order info
$order = $conn->query("SELECT * FROM orders WHERE id = $order_id")->fetch_assoc();

// Fetch order items
$items = $conn->query("SELECT oi.*, p.name, p.image_url FROM order_items oi 
                       JOIN products p ON oi.product_id = p.id
                       WHERE order_id = $order_id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success | GLOW SKIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background:#fff9fa; color:#333; padding:50px; }
        .voucher { max-width:700px; margin:auto; background:#fff; padding:30px; border-radius:25px; box-shadow:0 15px 50px rgba(0,0,0,0.05); }
        h1 { color:#ff85a2; text-align:center; margin-bottom:20px; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { padding:12px; text-align:left; border-bottom:1px solid #eee; }
        th { background:#ffedf2; color:#ff85a2; }
        .total { font-size:1.3rem; font-weight:bold; text-align:right; margin-top:20px; }
        .btn { display:inline-block; padding:12px 25px; background:#ff85a2; color:#fff; text-decoration:none; border-radius:20px; margin-top:20px; text-align:center; }
    </style>
</head>
<body>

<div class="voucher">
    <h1>🎉 Order Confirmed!</h1>
    <p><b>Order ID:</b> <?= $order['id'] ?></p>
    <p><b>Customer:</b> <?= htmlspecialchars($order['customer_name']) ?></p>
    <p><b>Payment Method:</b> <?= htmlspecialchars($order['payment_method']) ?></p>
    <p><b>Date:</b> <?= date("d-m-Y H:i", strtotime($order['created_at'] ?? date("Y-m-d H:i:s"))) ?></p>

    <table>
        <tr>
            <th>Product</th>
            <th>Price (MMK)</th>
        </tr>
        <?php 
        $grand_total = 0;
        while($item = $items->fetch_assoc()): 
            $grand_total += $item['price'];
        ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= number_format($item['price']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="total">Total: <?= number_format($grand_total) ?> MMK</div>

    <a href="index.php" class="btn">Back to Shop</a>
</div>

</body>
</html>
