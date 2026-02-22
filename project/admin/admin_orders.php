<?php
// 1. Database Connection
$conn = new mysqli("localhost", "root", "", "skincare_shop");

// ❌ Column မရှိရင် အလိုအလျောက် ထည့်ခိုင်းမယ့် ကုဒ်
$conn->query("ALTER TABLE orders ADD COLUMN IF NOT EXISTS status VARCHAR(20) DEFAULT 'Pending'");

// ✅ Confirm Logic
if (isset($_GET['confirm_id'])) {
    $c_id = (int)$_GET['confirm_id'];
    $conn->query("UPDATE orders SET status = 'Confirmed' WHERE id = $c_id");
    header("Location: admin_orders.php"); 
    exit();
}

// ❌ Delete Logic
if (isset($_GET['delete_id'])) {
    $d_id = (int)$_GET['delete_id'];
    $conn->query("DELETE FROM order_items WHERE order_id = $d_id");
    $conn->query("DELETE FROM orders WHERE id = $d_id");
    header("Location: admin_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Order History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        :root {
            --pink: #ff85a2;
            --pink-light: #fff0f3;
            --dark: #2d3436;
            --gray: #636e72;
            --green: #2ecc71;
            --red: #ff4757;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        body { font-family: 'Segoe UI', sans-serif; background: #fdf2f4; padding: 40px; color: var(--dark); }
        h2 { color: var(--dark); font-size: 28px; margin-bottom: 30px; animation: fadeInDown 0.8s ease; }

        .order-card { 
            background: #fff; padding: 25px; border-radius: 20px; margin-bottom: 25px; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.03); border: 1px solid rgba(255,133,162,0.1);
            transition: var(--transition); animation: slideUp 0.6s ease-out forwards; opacity: 0;
        }

        .order-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(255,133,162,0.15); border-color: var(--pink); }

        .status-badge { padding: 6px 16px; border-radius: 50px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #fff; }
        .status-pending { background: var(--pink); box-shadow: 0 4px 10px rgba(255,133,162,0.3); }
        .status-confirmed { background: var(--green); box-shadow: 0 4px 10px rgba(46,204,113,0.3); }

        .admin-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
        .btn-action { cursor: pointer; border: none; text-decoration: none; padding: 8px 18px; border-radius: 30px; font-size: 13px; font-weight: bold; transition: var(--transition); display: inline-flex; align-items: center; gap: 5px; }
        .btn-confirm { background: var(--green); color: white; }
        .btn-delete { background: var(--pink-light); color: var(--red); }
        
        .btn-confirm:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(46,204,113,0.3); }
        .btn-delete:hover { background: var(--red); color: white; transform: scale(1.05); }

        .item-row { display: flex; align-items: center; gap: 15px; padding: 12px 10px; border-radius: 12px; transition: var(--transition); }
        .item-row:hover { background: var(--pink-light); padding-left: 20px; }
        .item-row img { border-radius: 10px; object-fit: cover; }
        
        .total-price { text-align: right; margin-top: 15px; color: var(--pink); font-size: 1.3rem; font-weight: bold; }

        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <h2><i class="fa fa-shopping-bag" style="color:var(--pink);"></i> Incoming Orders</h2>

    <?php
    $orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
    $delay = 0;
    while($o = $orders->fetch_assoc()):
        $current_status = isset($o['status']) ? $o['status'] : 'Pending';
        $delay += 0.1;
    ?>
    <div class="order-card" style="animation-delay: <?= $delay ?>s">
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h4 style="font-size: 1.1rem;">
                <span style="color:var(--pink);">Order #<?= $o['id'] ?></span> - <?= htmlspecialchars($o['customer_name']) ?>
            </h4>
            <span class="status-badge <?= (strtolower($current_status) == 'confirmed') ? 'status-confirmed' : 'status-pending' ?>">
                <i class="fa <?= (strtolower($current_status) == 'confirmed') ? 'fa-check-circle' : 'fa-clock' ?>"></i> 
                <?= $current_status ?>
            </span>
        </div>
        
        <p style="color:var(--gray); font-size: 0.95rem; margin: 10px 0;">
            <i class="fa fa-phone" style="width:20px; color:var(--pink);"></i> <?= htmlspecialchars($o['phone']) ?> <br>
            <i class="fa fa-map-marker" style="width:20px; color:var(--pink);"></i> <?= htmlspecialchars($o['address']) ?>
        </p>
        
        <div style="margin-top:20px; border-top: 1px solid #f0f0f0; padding-top: 10px;">
            <?php
            $o_id = $o['id'];
            $items = $conn->query("SELECT oi.*, p.name, p.image_url FROM order_items oi 
                                   JOIN products p ON oi.product_id = p.id 
                                   WHERE oi.order_id = $o_id");
            while($item = $items->fetch_assoc()): ?>
                <div class="item-row">
                    <img src="<?= $item['image_url'] ?>" width="45" height="45">
                    <span style="font-weight: 500;"><?= htmlspecialchars($item['name']) ?></span>
                    <span style="margin-left:auto; font-weight: 600; color:var(--gray);"><?= number_format($item['price']) ?> MMK</span>
                </div>
            <?php endwhile; ?>
        </div>
        
        <div class="total-price"><?= number_format($o['total_price']) ?> MMK</div>

        <div class="admin-actions">
            <?php if(strtolower($current_status) == 'pending'): ?>
                <a href="javascript:void(0)" 
                   onclick="confirmAction('confirm', <?= $o['id'] ?>)" 
                   class="btn-action btn-confirm">
                    <i class="fa fa-check"></i> Confirm Order
                </a>
            <?php endif; ?>
            <a href="javascript:void(0)" 
               onclick="confirmAction('delete', <?= $o['id'] ?>)" 
               class="btn-action btn-delete">
                <i class="fa fa-trash"></i> Delete
            </a>
        </div>
    </div>
    <?php endwhile; ?>

    <script>
    function confirmAction(type, id) {
        let title = type === 'delete' ? 'ဖျက်မှာ သေချာလား?' : 'Order ကို Confirm လုပ်မှာလား?';
        let icon = type === 'delete' ? 'warning' : 'question';
        let confirmColor = type === 'delete' ? '#ff4757' : '#2ecc71';
        let btnText = type === 'delete' ? 'ဖျက်မည်' : 'သေချာသည်';

        Swal.fire({
            title: title,
            text: type === 'delete' ? "ပြန်ယူလို့ ရတော့မှာ မဟုတ်ပါဘူး!" : "Status ကို Confirm ပြောင်းလိုက်ပါမယ်။",
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmColor,
            cancelButtonColor: '#636e72',
            confirmButtonText: btnText,
            cancelButtonText: 'မလုပ်တော့ပါ',
            background: '#fff',
            borderRadius: '20px',
            customClass: {
                popup: 'my-swal-popup'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // PHP သို့ လှမ်းပို့မည့် URL
                window.location.href = `?${type}_id=${id}`;
            }
        })
    }
    </script>

</body>
</html>ss