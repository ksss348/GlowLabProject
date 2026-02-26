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

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$items = $conn->query("SELECT oi.*, p.name, p.image_url FROM order_items oi 
                       JOIN products p ON oi.product_id = p.id
                       WHERE order_id = $order_id");

$is_confirmed = (isset($order['status']) && strtolower($order['status']) == 'confirmed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #<?= $order_id ?> | GLOW LAB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pink: #ff85a2;
            --pink-light: #fff0f3;
            --dark: #2d3436;
            --green: #2ecc71;
            --gray: #b2bec3;
        }

        body { 
            font-family: 'Segoe UI', sans-serif; 
            background: #fff9fa; 
            color: var(--dark); 
            padding: 40px 20px;
            line-height: 1.6;
        }

        .voucher { 
            max-width: 600px; 
            margin: auto; 
            background: #fff; 
            padding: 40px; 
            border-radius: 30px; 
            box-shadow: 0 20px 60px rgba(255,133,162,0.1);
            position: relative;
            overflow: hidden;
        }

        /* Status Timeline */
        .status-tracker {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            position: relative;
        }

        .status-tracker::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: #eee;
            z-index: 1;
        }

        .step {
            position: relative;
            z-index: 2;
            background: #fff;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: 2px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: var(--gray);
        }

        .step.active {
            border-color: var(--pink);
            color: var(--pink);
            background: var(--pink-light);
        }

        .step.completed {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        .header-icon {
            font-size: 50px;
            display: block;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 { 
            text-align: center; 
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .order-info {
            background: var(--pink-light);
            padding: 20px;
            border-radius: 20px;
            margin: 25px 0;
            font-size: 14px;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; color: var(--gray); font-size: 12px; text-transform: uppercase; padding: 10px; border-bottom: 2px solid #f9f9f9; }
        td { padding: 15px 10px; border-bottom: 1px solid #f9f9f9; }

        .total-row { font-size: 20px; font-weight: bold; text-align: right; margin-top: 25px; color: var(--pink); }

        .btn-group { display: flex; gap: 10px; margin-top: 30px; }
        .btn { 
            flex: 1;
            padding: 15px; 
            border-radius: 15px; 
            text-decoration: none; 
            text-align: center; 
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
            border: none;
        }
        .btn-main { background: var(--pink); color: #fff; }
        .btn-outline { background: #f1f2f6; color: var(--dark); }
        .btn:hover { transform: translateY(-3px); opacity: 0.9; }

        @media print {
            .btn-group, .status-tracker { display: none; }
            body { padding: 0; background: white; }
            .voucher { box-shadow: none; border: 1px solid #eee; }
        }
    </style>
</head>
<body>

<div class="voucher">
    <?php if ($is_confirmed): ?>
        <i class="fa-solid fa-circle-check header-icon" style="color: var(--green);"></i>
        <h1>Order Confirmed!</h1>
        <p style="text-align:center; color: var(--gray);">Thank you for shopping with GLOW LAB.</p>
    <?php else: ?>
        <i class="fa-solid fa-clock header-icon" style="color: var(--pink);"></i>
        <h1>Order Received</h1>
        <p style="text-align:center; color: var(--gray);">We are verifying your online payment.</p>
    <?php endif; ?>

    <div class="status-tracker">
        <div class="step completed" title="Placed"><i class="fa-solid fa-cart-shopping"></i></div>
        <div class="step <?= $is_confirmed ? 'completed' : 'active' ?>" title="Payment Verification"><i class="fa-solid fa-receipt"></i></div>
        <div class="step <?= $is_confirmed ? 'active' : '' ?>" title="Shipping"><i class="fa-solid fa-truck"></i></div>
        <div class="step" title="Delivered"><i class="fa-solid fa-house-chimney"></i></div>
    </div>

    <div class="order-info">
        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
            <span>Order Number:</span> <b>#<?= $order['id'] ?></b>
        </div>
        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
            <span>Customer:</span> <b><?= htmlspecialchars($order['customer_name']) ?></b>
        </div>
        <div style="display:flex; justify-content:space-between; margin-bottom:8px;">
            <span>Payment Method:</span> <b style="text-transform: uppercase;"><?= htmlspecialchars($order['payment_method']) ?></b>
        </div>
        <div style="display:flex; justify-content:space-between;">
            <span>Date:</span> <b><?= date("d M Y, h:i A", strtotime($order['order_date'] ?? date("Y-m-d H:i:s"))) ?></b>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align:right;">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            while($item = $items->fetch_assoc()): 
                $grand_total += $item['price'];
            ?>
            <tr>
                <td style="display:flex; align-items:center; gap:10px;">
                    <img src="<?= $item['image_url'] ?>" width="40" height="40" style="border-radius:8px; object-fit:cover;">
                    <?= htmlspecialchars($item['name']) ?>
                </td>
                <td style="text-align:right;"><?= number_format($item['price']) ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="total-row">
        <span style="font-size: 14px; color: var(--gray); font-weight: normal;">Total Amount:</span><br>
        <?= number_format($grand_total) ?> MMK
    </div>

    <?php if (!$is_confirmed && !empty($order['payment_proof'])): ?>
        <div style="margin-top:20px; font-size: 13px; color: var(--pink); border: 1px dashed var(--pink); padding: 10px; border-radius: 10px; text-align:center;">
            <i class="fa-solid fa-image"></i> Screenshot uploaded. Waiting for manual verification.
        </div>
    <?php endif; ?>

    <div class="btn-group">
        <button onclick="window.print()" class="btn btn-outline"><i class="fa-solid fa-print"></i> Print Receipt</button>
        <a href="index.php" class="btn btn-main">Back to Shop</a>
    </div>
</div>

</body>
</html>