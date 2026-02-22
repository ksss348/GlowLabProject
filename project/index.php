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

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, address, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $name, $phone, $addr, $total, $method);
    $stmt->execute();

    $order_id = $stmt->insert_id;
    $stmt->close();

    foreach ($_SESSION['cart'] as $pid) {
        $p_data = $conn->query("SELECT price FROM products WHERE id = $pid")->fetch_assoc();
        $price = $p_data['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, price) VALUES ('$order_id', '$pid', '$price')");
    }

    unset($_SESSION['cart']);
    unset($_SESSION['checkout']);

    // Redirect to success page with order ID
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
        /* --- YOUR ORIGINAL CSS HERE --- */
        :root { --main: #ff85a2; --bg: #fff9fa; --dark: #333; --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: var(--bg); color: var(--dark); overflow-x: hidden; }
        header { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); padding: 15px 5%; box-shadow: 0 2px 20px rgba(0,0,0,0.03); position: sticky; top: 0; z-index: 1000; transition: var(--transition); }
        nav { display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: auto; }
        .logo { font-size: 26px; font-weight: bold; text-decoration: none; color: var(--dark); transition: 0.3s; }
        .logo:hover { transform: scale(1.05); }
        .logo span { color: var(--main); }
        .search-box { flex: 1; max-width: 400px; position: relative; margin: 0 20px; transition: var(--transition); }
        .search-box input { width: 100%; padding: 12px 25px; border-radius: 30px; border: 1px solid #f0f0f0; outline: none; transition: var(--transition); background: #fdfdfd; }
        .search-box input:focus { border-color: var(--main); width: 105%; box-shadow: 0 5px 15px rgba(255,133,162,0.15); }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .tabs { display: flex; justify-content: center; gap: 12px; margin-bottom: 40px; flex-wrap: wrap; }
        .tab { text-decoration: none; padding: 10px 28px; border-radius: 30px; background: #fff; border: 1px solid #eee; color: var(--dark); transition: var(--transition); font-weight: 500; }
        .tab.active, .tab:hover { background: var(--main); color: #fff; border-color: var(--main); transform: translateY(-3px); box-shadow: 0 5px 15px rgba(255,133,162,0.3); }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; }
        .card { background: #fff; border-radius: 25px; padding: 20px; text-align: center; transition: var(--transition); border: 1px solid rgba(0,0,0,0.02); position: relative; overflow: hidden; }
        .card:hover { transform: translateY(-12px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .card img { width: 100%; height: 230px; object-fit: cover; border-radius: 20px; transition: var(--transition); }
        .card:hover img { transform: scale(1.03); }
        .btn { background: var(--dark); color: #fff; padding: 14px; border: none; border-radius: 30px; cursor: pointer; width: 100%; font-weight: bold; transition: var(--transition); text-transform: uppercase; letter-spacing: 1px; }
        .btn:hover { background: var(--main); transform: scale(1.02); box-shadow: 0 10px 20px rgba(255,133,162,0.2); }
        .fa-cart-shopping { transition: 0.3s; }
        a[href="?view=cart"]:hover .fa-cart-shopping { transform: rotate(-15deg) scale(1.2); color: var(--main); }
        h3.section-title { font-size: 0.85rem; color: #bbb; letter-spacing: 2px; margin-bottom: 8px; text-transform: uppercase; border-left: 3px solid var(--main); padding-left: 10px; }
        .detail-img { transition: var(--transition); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .detail-img:hover { transform: scale(1.02); }
        .live-results { position: absolute; top: 55px; left: 0; width: 105%; background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); display: none; z-index: 9999; overflow: hidden; }
        .live-item { display: flex; align-items: center; padding: 12px 15px; text-decoration: none; color: #333; border-bottom: 1px solid #f9f9f9; transition: 0.2s; }
        .live-item:hover { background: #fff0f3; transform: translateX(5px); }
        .live-item img { width: 45px; height: 45px; object-fit: cover; border-radius: 8px; margin-right: 15px; }
        .live-item .info { display: flex; flex-direction: column; text-align: left; }
        .live-item .name { font-weight: 600; font-size: 14px; }
        .live-item .price { color: var(--main); font-size: 12px; font-weight: bold; }
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
        <a href="home.php" class="tab" style="margin-right: 15px; border-radius: 30px; font-size: 14px;">
            <i class="fa-solid fa-house"></i> Home
        </a>
        <a href="?view=cart" style="text-decoration:none; color:var(--dark); position:relative; display:flex; align-items:center;">
            <i class="fa-solid fa-cart-shopping fa-lg"></i>
            <span style="position:absolute; top:-12px; right:-12px; background:var(--main); color:#fff; font-size:10px; padding:4px 8px; border-radius:50%; font-weight:bold; box-shadow: 0 3px 10px rgba(255,133,162,0.4);"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
        </a>
</div>
    </nav>
</header>

<div class="container">

<?php if ($view == 'detail' && isset($_GET['id'])): 
    $id = (int)$_GET['id'];
    $p = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
?>
    <a href="index.php" style="color:var(--main); text-decoration:none; font-weight:bold; display:inline-block; margin-bottom:20px; transition:0.3s;" class="back-link">← BACK TO SHOP</a>
    <div style="display:flex; gap:60px; background:#fff; padding:50px; border-radius:35px; flex-wrap:wrap; box-shadow: 0 20px 60px rgba(0,0,0,0.05);" data-aos="fade-up">
        <img src="<?= $p['image_url'] ?>" class="detail-img" style="width:450px; border-radius:25px; object-fit:cover;" data-aos="zoom-in" data-aos-delay="200">
        <div style="flex:1; min-width:320px;" data-aos="fade-left" data-aos-delay="400">
            <h1 style="font-size: 3rem; margin-bottom:10px; letter-spacing:-1px;"><?= $p['name'] ?></h1>
            <h2 style="color:var(--main); font-size: 2rem; margin-bottom:30px;"><?= number_format($p['price']) ?> MMK</h2>
            <div style="display: grid; gap: 30px;">
                <div><h3 class="section-title">Description</h3><p style="color:#666; line-height:1.8;"><?= $p['description'] ?></p></div>
                <div style="display:flex; gap:20px;">
                    <div style="flex:1;"><h3 class="section-title">Results</h3><p style="color:#666;"><?= $p['results'] ?></p></div>
                    <div style="flex:1;"><h3 class="section-title">How to Use</h3><p style="color:#666;"><?= $p['how_to_use'] ?></p></div>
                </div>
                <div><h3 class="section-title">Ingredients</h3><p style="font-style:italic; color:#888; font-size:0.95rem;"><?= $p['ingredients'] ?></p></div>
            </div>
            <form method="POST" style="margin-top: 40px;">
                <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                <button type="submit" name="add_to_cart" class="btn" style="height:60px; font-size:1.1rem;">ADD TO CART</button>
            </form>
        </div>
    </div>

<?php elseif ($view == 'cart'): ?>
    <div style="background:#fff; padding:40px; border-radius:30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03);" data-aos="fade-up">
        <h2 style="font-size:2rem; margin-bottom:30px;">Your Shopping Bag</h2>
        
        <?php if(!empty($_SESSION['cart'])): 
            // Get unique IDs and counts for each product in cart
            $cart_counts = array_count_values($_SESSION['cart']);
            $ids = implode(',', array_keys($cart_counts));
            $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
            $total = 0;
            
            while($item = $res->fetch_assoc()): 
                $qty = $cart_counts[$item['id']];
                $subtotal = $item['price'] * $qty;
                $total += $subtotal; 
        ?>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:20px 0; border-bottom:1px solid #f9f9f9;" data-aos="fade-right">
                    <div style="display:flex; align-items:center; gap:20px;">
                        <img src="<?= $item['image_url'] ?>" width="100" height="100" style="object-fit:cover; border-radius:15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                        <div>
                            <b style="font-size:1.2rem;"><?= $item['name'] ?></b><br>
                            <span style="color:var(--main); font-weight:600;"><?= number_format($item['price']) ?> MMK</span>
                            <p style="font-size: 0.9rem; color: #888;">Qty: <?= $qty ?></p>
                        </div>
                    </div>
                    
                    <div style="display:flex; align-items:center; gap:20px;">
                        <div style="font-weight: bold; font-size: 1.1rem; margin-right: 20px;">
                            <?= number_format($subtotal) ?> MMK
                        </div>
                        <a href="?remove=<?= $item['id'] ?>" style="background: #fff0f3; color:#ff4d4d; width: 45px; height: 45px; display: flex; align-items:center; justify-content:center; border-radius: 12px; text-decoration: none; transition: 0.3s;">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>

            <div style="text-align:right; margin:40px 0;">
                <h3 style="font-size:1.8rem;">Total: <span style="color:var(--main);"><?= number_format($total) ?> MMK</span></h3>
                <a href="index.php" style="text-decoration: none; color: #888; font-weight: 600;">+ Add more items</a>
            </div>

            <form method="POST" style="margin-top:30px; background:#fff9fa; padding:35px; border-radius:25px; border: 1px dashed #ffcad6;">
                <h4 style="margin-bottom:20px; font-size:1.3rem;"><i class="fa-solid fa-truck-fast"></i> Checkout Information</h4>
                <input type="hidden" name="total_amount" value="<?= $total ?>">
                
                <div style="display: grid; gap: 15px;">
                    <input type="text" name="cus_name" placeholder="Receiver Name" required style="width:100%; padding:15px; border-radius:12px; border:1px solid #eee; outline-color: var(--main);">
                    <input type="text" name="cus_phone" placeholder="Phone Number" required style="width:100%; padding:15px; border-radius:12px; border:1px solid #eee; outline-color: var(--main);">
                    <textarea name="cus_address" placeholder="Shipping Address" required style="width:100%; padding:15px; border-radius:12px; border:1px solid #eee; height:90px; outline-color: var(--main);"></textarea>
                </div>

                <button type="submit" name="confirm_order" class="btn" style="background:#28a745; margin-top: 20px; height: 55px;">
                    PROCEED TO PAYMENT
                </button>
            </form>
            
        <?php else: ?>
            <div style="text-align:center; padding:100px 20px;">
                <i class="fa-solid fa-bag-shopping" style="font-size: 4rem; color: #eee; margin-bottom: 20px;"></i>
                <p style='color:#999; font-size: 1.2rem;'>Your cart is lonely. Let's find some glow!</p>
                <a href="index.php" class="btn" style="display:inline-block; width: auto; margin-top: 25px; padding: 15px 40px;">Back to Shop</a>
            </div>
        <?php endif; ?>
    </div>

<?php elseif ($view == 'payment' && isset($_SESSION['checkout'])): 
    $data = $_SESSION['checkout'];
?>
    <div style="max-width:1000px; margin:auto; display:flex; gap:40px; flex-wrap:wrap; justify-content:space-between; padding:40px;">

        <!-- Left: COD -->
        <div style="flex:1; min-width:300px; background:#fff; border-radius:25px; padding:40px 30px; text-align:center; box-shadow:0 10px 40px rgba(0,0,0,0.05); transition:0.3s; cursor:pointer;">
            <h2 style="color:#ff85a2; margin-bottom:20px;"><i class="fa-solid fa-money-bill-wave"></i> Cash On Delivery</h2>
            <p>Pay when your order arrives at your doorstep. Safe & Convenient!</p>
            <form method="POST">
                <input type="hidden" name="pay_method" value="COD">
                <button type="submit" name="final_confirm" class="btn" style="margin-top:20px;">Pay COD</button>
            </form>
        </div>

        <!-- Right: Online Payment -->
        <!-- Right: Online Payment -->
<div style="flex:1; min-width:300px; background:#fff; border-radius:25px; padding:40px 30px; text-align:center; box-shadow:0 10px 40px rgba(0,0,0,0.05); transition:0.3s; cursor:pointer;">
    <h2 style="color:#ff85a2; margin-bottom:20px;"><i class="fa-solid fa-qrcode"></i> Online Payment</h2>
    <p>Scan the QR to pay using KPay or Wave.</p>
    
    <div style="display:flex; justify-content:center; gap:30px; margin-top:20px;">
        <!-- KPay QR + Logo -->
        <div style="display:flex; flex-direction:column; align-items:center;">
            <img src="images/kpayQR.jpg" alt="KPay QR" width="120" style="border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
            <img src="images/kpay.jpg" alt="KPay Logo" width="60" style="margin-top:10px;">
        </div>

        <!-- Wave QR + Logo -->
        <div style="display:flex; flex-direction:column; align-items:center;">
            <img src="images/waveQR.jpg" alt="Wave QR" width="120" style="border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.05);">
            <img src="images/wavepay.png" alt="Wave Logo" width="60" style="margin-top:10px;">
        </div>
    </div>

    <form method="POST" style="margin-top:20px;">
        <input type="hidden" name="pay_method" value="ONLINE">
        <button type="submit" name="final_confirm" class="btn" style="background:#28a745;">I Have Paid</button>
    </form>
</div>



<?php else: ?>
    <div class="tabs" data-aos="fade-down">
        <?php foreach(['All','Toner', 'Cleanser', 'Serum', 'Sunscreen', 'Moisturizer', 'Lipstick'] as $c): ?>
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
                <img src="<?= $p['image_url'] ?>" alt="<?= $p['name'] ?>">
                <h3 style="margin:15px 0;"><?= $p['name'] ?></h3>
                <p style="color:var(--main); font-weight:bold;"><?= number_format($p['price']) ?> MMK</p>
                <div style="display:flex; gap:10px; margin-top:15px;">
                    <a href="?view=detail&id=<?= $p['id'] ?>" class="btn" style="flex:1;">View</a>
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
    AOS.init({ duration: 1000, once: true, easing: 'ease-in-out' });

    document.getElementById('live_search').addEventListener('input', function() {
        let q = this.value;
        let res = document.getElementById('results');
        if(q.length > 0) {
            fetch('fetch_products.php?search=' + q)
            .then(r => r.text())
            .then(data => { res.innerHTML = data; res.style.display = 'block'; });
        } else { res.style.display = 'none'; }
    });

    document.addEventListener('click', function(e) {
        if (!document.querySelector('.search-box').contains(e.target)) {
            document.getElementById('results').style.display = 'none';
        }
    });
</script>

</body>
</html>
