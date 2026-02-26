<?php
session_start();
$conn = new mysqli("localhost", "root", "", "skincare_shop");

// 🛒 Cart Logic
if (isset($_POST['add_to_cart'])) {
    $p_id = $_POST['product_id'];
    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
    if (!in_array($p_id, $_SESSION['cart'])) { array_push($_SESSION['cart'], $p_id); }
    header("Location: index.php"); exit();
}

// ❌ Cart Item Removal
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    if (($key = array_search($remove_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); 
    }
    header("Location: ?view=cart"); exit();
}

// ✅ Checkout Logic
if (isset($_POST['confirm_order'])) {
    $_SESSION['checkout'] = [
        'name'  => $_POST['cus_name'],
        'phone' => $_POST['cus_phone'],
        'addr'  => $_POST['cus_address'],
        'total' => $_POST['total_amount']
    ];
    header("Location: ?view=payment");
    exit();
}

// ✅ Final Order Insert After Payment
if (isset($_POST['final_confirm']) && isset($_SESSION['checkout'])) {
    $data = $_SESSION['checkout'];
    $name  = $data['name'];
    $phone = $data['phone'];
    $addr  = $data['addr'];
    $total = $data['total'];
    $method = $_POST['pay_method'];

    $payment_proof_path = ""; 
    $order_status = 'Pending'; 

    if ($method === 'ONLINE') {
        if (isset($_FILES['payment_proof']) && $_FILES['payment_proof']['error'] == 0) {
            $ext = pathinfo($_FILES['payment_proof']['name'], PATHINFO_EXTENSION);
            $targetDir = 'uploaded_img/payment_proofs';
            if (!is_dir($targetDir)) { mkdir($targetDir, 0755, true); }
            $fileName = 'proof_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            $fsName = $targetDir . '/' . $fileName;
            if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $fsName)) {
                $payment_proof_path = $fsName;
            }
        }
    }

    // Unified SQL: Always insert the same number of columns
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, address, total_price, payment_method, payment_proof, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsss", $name, $phone, $addr, $total, $method, $payment_proof_path, $order_status);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // Insert order items
    foreach ($_SESSION['cart'] as $pid) {
        $p_data = $conn->query("SELECT price FROM products WHERE id = $pid")->fetch_assoc();
        $price = $p_data['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, price) VALUES ('$order_id', '$pid', '$price')");
    }

    unset($_SESSION['cart']);
    unset($_SESSION['checkout']);

    header("Location: success.php?order_id=$order_id");
    exit();
}

$view = isset($_GET['view']) ? $_GET['view'] : 'home';
$cat_filter = isset($_GET['cat']) ? $conn->real_escape_string($_GET['cat']) : "All";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GLOWLAB | Official Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --main: #ff85a2; --bg: #fff9fa; --dark: #333; --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: var(--bg); color: var(--dark); overflow-x: hidden; }
        header { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 15px 5%; box-shadow: 0 2px 20px rgba(0,0,0,0.03); position: sticky; top: 0; z-index: 1000; }
        nav { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: auto; }
        .logo { font-size: 26px; font-weight: bold; text-decoration: none; color: var(--dark); }
        .logo span { color: var(--main); }
        .search-box { flex: 1; max-width: 400px; position: relative; margin: 0 20px; }
        .search-box input { width: 100%; padding: 12px 25px; border-radius: 30px; border: 1px solid #f0f0f0; outline: none; }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .tabs { display: flex; justify-content: center; gap: 12px; margin-bottom: 40px; flex-wrap: wrap; }
        .tab { text-decoration: none; padding: 10px 28px; border-radius: 30px; background: #fff; border: 1px solid #eee; color: var(--dark); transition: var(--transition); }
        .tab.active { background: var(--main); color: #fff; border-color: var(--main); }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; }
        .card { background: #fff; border-radius: 25px; padding: 20px; text-align: center; transition: var(--transition); border: 1px solid rgba(0,0,0,0.02); }
        .card img { width: 100%; height: 230px; object-fit: cover; border-radius: 20px; }
        .btn { background: var(--dark); color: #fff; padding: 14px; border: none; border-radius: 30px; cursor: pointer; width: 100%; font-weight: bold; transition: var(--transition); }
        .btn:disabled { background: #ccc; cursor: not-allowed; }
        .live-results { position: absolute; top: 55px; left: 0; width: 100%; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: none; z-index: 9999; }
        .section-title { font-size: 0.85rem; color: #bbb; letter-spacing: 2px; margin-bottom: 8px; text-transform: uppercase; border-left: 3px solid var(--main); padding-left: 10px; }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="index.php" class="logo">GLOW<span>LAB</span></a>
        <div class="search-box">
            <input type="text" id="live_search" placeholder="Find your glow..." autocomplete="off">
            <div id="results" class="live-results"></div>
        </div>
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="home.php" class="tab" style="font-size: 14px;"><i class="fa-solid fa-house"></i> Home</a>
            <a href="?view=cart" style="text-decoration:none; color:var(--dark); position:relative;">
                <i class="fa-solid fa-cart-shopping fa-lg"></i>
                <span style="position:absolute; top:-12px; right:-12px; background:var(--main); color:#fff; font-size:10px; padding:4px 8px; border-radius:50%; font-weight:bold;">
                    <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                </span>
            </a>
        </div>
    </nav>
</header>

<div class="container">

<?php if ($view == 'detail' && isset($_GET['id'])): 
    $id = (int)$_GET['id'];
    $p = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
?>
    <a href="index.php" style="color:var(--main); text-decoration:none; font-weight:bold;">← BACK TO SHOP</a>
    <div style="display:flex; gap:60px; background:#fff; padding:50px; border-radius:35px; margin-top:20px; box-shadow: 0 20px 60px rgba(0,0,0,0.05);" data-aos="fade-up">
        <img src="<?= $p['image_url'] ?>" style="width:400px; border-radius:25px; object-fit:cover;">
        <div style="flex:1;">
            <h1 style="font-size: 2.5rem;"><?= $p['name'] ?></h1>
            <h2 style="color:var(--main); margin: 20px 0;"><?= number_format($p['price']) ?> MMK</h2>
            <h3 class="section-title">Description</h3><p style="margin-bottom:20px;"><?= $p['description'] ?></p>
            <h3 class="section-title">How to Use</h3><p><?= $p['how_to_use'] ?></p>
            <form method="POST" style="margin-top: 30px;">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                <button type="submit" name="add_to_cart" class="btn">ADD TO CART</button>
            </form>
        </div>
    </div>

<?php elseif ($view == 'cart'): ?>
    <div style="background:#fff; padding:40px; border-radius:30px;" data-aos="fade-up">
        <h2 style="margin-bottom:30px;">Your Shopping Bag</h2>
        <?php if(!empty($_SESSION['cart'])): 
            $cart_counts = array_count_values($_SESSION['cart']);
            $ids = implode(',', array_keys($cart_counts));
            $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
            $total = 0;
            while($item = $res->fetch_assoc()): 
                $qty = $cart_counts[$item['id']];
                $subtotal = $item['price'] * $qty;
                $total += $subtotal; 
        ?>
            <div style="display:flex; justify-content:space-between; align-items:center; padding:15px 0; border-bottom:1px solid #eee;">
                <div style="display:flex; align-items:center; gap:20px;">
                    <img src="<?= $item['image_url'] ?>" width="80" height="80" style="border-radius:10px;">
                    <div><b><?= $item['name'] ?></b><br>Qty: <?= $qty ?></div>
                </div>
                <div>
                    <b><?= number_format($subtotal) ?> MMK</b>
                    <a href="?remove=<?= $item['id'] ?>" style="margin-left:20px; color:red;"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        <?php endwhile; ?>
        <div style="text-align:right; margin-top:30px;">
            <h3>Total: <?= number_format($total) ?> MMK</h3>
            <form method="POST" style="margin-top:20px; text-align:left; background:#fff9fa; padding:20px; border-radius:20px;">
                <input type="hidden" name="total_amount" value="<?= $total ?>">
                <input type="text" name="cus_name" placeholder="Name" required style="width:100%; padding:12px; margin-bottom:10px; border-radius:10px; border:1px solid #eee;">
                <input type="text" name="cus_phone" placeholder="Phone" required style="width:100%; padding:12px; margin-bottom:10px; border-radius:10px; border:1px solid #eee;">
                <textarea name="cus_address" placeholder="Address" required style="width:100%; padding:12px; border-radius:10px; border:1px solid #eee;"></textarea>
                <button type="submit" name="confirm_order" class="btn" style="background:#28a745; margin-top:10px;">PROCEED TO PAYMENT</button>
            </form>
        </div>
        <?php else: echo "<p>Cart is empty</p>"; endif; ?>
    </div>

<?php elseif ($view == 'payment' && isset($_SESSION['checkout'])): ?>
    <div style="display:flex; gap:30px; justify-content:center; flex-wrap:wrap;">
        <div style="flex:1; max-width:400px; background:#fff; padding:40px; border-radius:25px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
            <h2 style="color:var(--main);"><i class="fa-solid fa-truck"></i> COD</h2>
            <p style="margin:20px 0;">Cash on Delivery</p>
            <form method="POST">
                <input type="hidden" name="pay_method" value="COD">
                <button type="submit" name="final_confirm" class="btn">Confirm Order</button>
            </form>
        </div>

        <div style="flex:1; max-width:400px; background:#fff; padding:40px; border-radius:25px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
            <h2 style="color:var(--main);"><i class="fa-solid fa-qrcode"></i> Online Pay</h2>
            <div style="display:flex; justify-content:center; gap:10px; margin:20px 0;">
                <img src="images/kpayQR.jpg" width="100" style="border-radius:10px;">
                <img src="images/waveQR.jpg" width="100" style="border-radius:10px;">
            </div>
            <form method="POST" enctype="multipart/form-data" id="onlinePaymentForm">
                <input type="hidden" name="pay_method" value="ONLINE">
                <p style="font-size:12px; color:#666; margin-bottom:10px;">Please upload screenshot to enable button</p>
                <input type="file" name="payment_proof" id="payment_proof_input" accept="image/*" required style="margin-bottom:20px; width:100%;">
                <button type="submit" name="final_confirm" class="btn" id="iPaidBtn" style="background:#28a745;" disabled>I Have Paid</button>
            </form>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('payment_proof_input');
        const paidBtn = document.getElementById('iPaidBtn');
        fileInput.addEventListener('change', function() {
            paidBtn.disabled = !this.files.length;
        });
    </script>

<?php else: ?>
    <div class="tabs">
        <?php foreach(['All','Toner', 'Cleanser', 'Serum', 'Sunscreen', 'Moisturizer'] as $c): ?>
            <a href="?cat=<?= $c ?>" class="tab <?= $cat_filter == $c ? 'active' : '' ?>"><?= $c ?></a>
        <?php endforeach; ?>
    </div>
    <div class="grid">
        <?php
        $sql = $cat_filter == 'All' ? "SELECT * FROM products" : "SELECT * FROM products WHERE category='$cat_filter'";
        $res = $conn->query($sql);
        while($p = $res->fetch_assoc()):
        ?>
            <div class="card" data-aos="fade-up">
                <img src="<?= $p['image_url'] ?>">
                <h3 style="margin:15px 0; font-size:16px;"><?= $p['name'] ?></h3>
                <p style="color:var(--main); font-weight:bold;"><?= number_format($p['price']) ?> MMK</p>
                <div style="display:flex; gap:10px; margin-top:15px;">
                    <a href="?view=detail&id=<?= $p['id'] ?>" class="btn" style="flex:1; text-decoration:none; text-align:center;">View</a>
                    <form method="POST" style="flex:1;">
                        <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                        <button type="submit" name="add_to_cart" class="btn" style="background:#28a745;">Add</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
    // Live Search
    document.getElementById('live_search')?.addEventListener('input', function() {
        let q = this.value;
        let res = document.getElementById('results');
        if(q.length > 0) {
            fetch('fetch_products.php?search=' + q)
            .then(r => r.text())
            .then(data => { res.innerHTML = data; res.style.display = 'block'; });
        } else { res.style.display = 'none'; }
    });
</script>
</body>
</html>