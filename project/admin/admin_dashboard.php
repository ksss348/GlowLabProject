<?php

$conn_health = new mysqli("localhost", "root", "", "healthcare_db");
$conn_skincare = new mysqli("localhost", "root", "", "skincare_shop");

// --- Actions Logic ---
if (isset($_GET['delete_book'])) {
    $id = intval($_GET['delete_book']);
    $conn_health->query("DELETE FROM bookings WHERE id = $id");
    header("Location: admin_dashboard.php?view=bookings");
}
if (isset($_GET['confirm_book'])) {
    $id = intval($_GET['confirm_book']);
    $conn_health->query("UPDATE bookings SET status = 'Verified' WHERE id = $id");
    header("Location: admin_dashboard.php?view=bookings");
}
if (isset($_GET['delete_dr'])) {
    $id = intval($_GET['delete_dr']);
    $conn_health->query("DELETE FROM consultants WHERE id = $id");
    header("Location: admin_dashboard.php?view=doctors");
}
if (isset($_GET['delete_sched'])) {
    $id = intval($_GET['delete_sched']);
    $conn_health->query("DELETE FROM doctor_schedules WHERE id = $id");
    header("Location: admin_dashboard.php?view=schedules");
}
if (isset($_GET['delete_prod'])) {
    $id = intval($_GET['delete_prod']);
    $conn_skincare->query("DELETE FROM products WHERE id = $id");
    header("Location: admin_dashboard.php?view=products");
}

// --- New Orders Logic ---
// --- New Orders Logic ---
if (isset($_GET['delete_order'])) {
    $id = intval($_GET['delete_order']);
    
    // ၁။ အရင်ဆုံး order_items ထဲမှာ ရှိနေတဲ့ ဒီ order နဲ့ ဆိုင်တဲ့ ပစ္စည်းတွေကို အရင်ဖျက်မယ်
    $conn_skincare->query("DELETE FROM order_items WHERE order_id = $id");
    
    // ၂။ ပြီးမှ orders table ထဲက data ကို ဖျက်မယ်
    if ($conn_skincare->query("DELETE FROM orders WHERE id = $id")) {
        header("Location: admin_dashboard.php?view=orders");
        exit();
    } else {
        die("Error deleting order: " . $conn_skincare->error);
    }
}

// ၂။ Order Confirm လုပ်တဲ့အပိုင်း
if (isset($_GET['confirm_order'])) {
    $id = intval($_GET['confirm_order']);
    $conn_skincare->query("UPDATE orders SET status = 'Confirmed' WHERE id = $id");
    header("Location: admin_dashboard.php?view=orders");
    exit();
}

// Counts
$dr_count = $conn_health->query("SELECT COUNT(*) as total FROM consultants")->fetch_assoc()['total'];
$book_count = $conn_health->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$prod_count = $conn_skincare->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$sched_count = $conn_health->query("SELECT COUNT(*) as total FROM doctor_schedules")->fetch_assoc()['total'];
$order_count = $conn_skincare->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];

$view = isset($_GET['view']) ? $_GET['view'] : 'bookings';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowLab | Premium Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --primary: #ff85a2; --dark: #2c3e50; --bg: #f8f9fa; --glass: rgba(255, 255, 255, 0.9); }
        body { font-family: 'Inter', sans-serif; background: var(--bg); margin: 0; display: flex; color: #333; }
        
        /* Sidebar Design */
        .sidebar { width: 280px; height: 100vh; background: var(--dark); color: white; position: fixed; transition: 0.4s; z-index: 1000; }
        .logo-area { padding: 30px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .logo-area h2 { color: var(--primary); margin: 0; font-size: 24px; letter-spacing: 1px; }
        .nav-links { padding: 20px 0; }
        .nav-links a { display: flex; align-items: center; color: #bdc3c7; padding: 15px 30px; text-decoration: none; transition: 0.3s; font-size: 15px; }
        .nav-links a i { margin-right: 15px; width: 20px; text-align: center; }
        .nav-links a:hover, .nav-links a.active { background: rgba(255,133,162,0.1); color: var(--primary); border-left: 4px solid var(--primary); }

        /* Main Content */
        .main { margin-left: 280px; padding: 40px; width: calc(100% - 280px); transition: 0.4s; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Stat Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; margin-bottom: 40px; }
        .card { background: white; padding: 20px; border-radius: 20px; text-decoration: none; color: inherit; box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: 0.4s; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(255,133,162,0.15); }
        .card i { font-size: 22px; color: var(--primary); margin-bottom: 12px; display: block; }
        .card h3 { font-size: 24px; margin: 5px 0; }
        .card p { color: #888; margin: 0; font-size: 12px; font-weight: 600; }

        /* Data Section */
        .content-box { background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); animation: fadeIn 0.6s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0 12px; }
        th { padding: 15px 20px; text-align: left; color: #1f1e1e; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
        td { padding: 20px; background: #fff; border-top: 1px solid #f1f1f1; border-bottom: 1px solid #f1f1f1; font-size: 16px; color: #333; }
        tr td:first-child { border-left: 1px solid #f1f1f1; border-radius: 15px 0 0 15px; }
        tr td:last-child { border-right: 1px solid #f1f1f1; border-radius: 0 15px 15px 0; }
        
        /* Badges & Buttons */
        .status { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .verified, .confirmed { background: #e8f5e9; color: #2e7d32; }
        .pending { background: #fff3e0; color: #ef6c00; }
        
        .action-btns { display: flex; gap: 8px; }
        .btn { border: none; padding: 8px 12px; border-radius: 10px; cursor: pointer; transition: 0.2s; font-size: 12px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; }
        .btn-check { background: #e3f2fd; color: #1976d2; }
        .btn-trash { background: #ffebee; color: #c62828; }
        .btn:hover { filter: brightness(0.95); transform: translateY(-2px); }

        h3.view-title { font-size: 22px; margin-bottom: 25px; display: flex; align-items: center; color: var(--dark); }
        h3.view-title::before { content: ''; width: 4px; height: 20px; background: var(--primary); margin-right: 12px; border-radius: 10px; }

        /* Specific sub-text sizing (IDs, Specialty, etc) */
td div[style*="font-size:11px"], 
td div[style*="font-size:12px"] { 
    font-size: 13px !important; 
    margin-top: 5px;
    color: #777 !important;
}

/* Column Width Control to stop text from flying apart */
table thead th:nth-child(1) { width: 20%; } /* Patient */
table thead th:nth-child(2) { width: 25%; } /* Doctor */
table thead th:nth-child(3) { width: 15%; } /* Age/Sex */
table thead th:nth-child(4) { width: 15%; } /* Contact */
table thead th:nth-child(5) { width: 10%; } /* Status */
table thead th:nth-child(6) { width: 15%; } /* Actions */

/* Row Hover Effect */
tr:hover td {
    background-color: #fff9fa; 
    border-color: var(--primary);
}
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-area"><h2>GLOWLAB</h2></div>
    <div class="nav-links">
        <a href="?view=bookings" class="<?= $view=='bookings'?'active':'' ?>"><i class="fas fa-calendar-check"></i> Bookings</a>
        <a href="?view=orders" class="<?= $view=='orders'?'active':'' ?>"><i class="fas fa-shopping-bag"></i> Orders List</a>
        <a href="?view=doctors" class="<?= $view=='doctors'?'active':'' ?>"><i class="fas fa-user-md"></i> Doctors</a>
        <a href="?view=schedules" class="<?= $view=='schedules'?'active':'' ?>"><i class="fas fa-clock"></i> Schedules</a>
        <a href="?view=products" class="<?= $view=='products'?'active':'' ?>"><i class="fas fa-box"></i> Products</a>
        
        <div style="margin-top: 25px; padding: 0 30px; font-size: 11px; color: #666; font-weight: 800; text-transform: uppercase;">Manage Store</div>
        <a href="admin_add_consultant.php"><i class="fas fa-plus-circle"></i> Add Consultant</a>
        <a href="admin_add_product.php"><i class="fas fa-plus-square"></i> Add Skincare</a>
        <div style="margin-top: 30px; padding: 0 30px; font-size: 11px; color: #666; font-weight: 800; text-transform: uppercase;">Account</div>
<a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>

    </div>
</div>

<div class="main">
    <div class="header">
        <h1>Dashboard Overview</h1>
        <div style="color: #888; font-weight: 500;"><i class="far fa-calendar-alt"></i> <?php echo date('F d, Y'); ?></div>
    </div>

    <div class="stats-grid">
        <a href="?view=bookings" class="card"><i class="fas fa-file-invoice"></i><h3><?= $book_count ?></h3><p>Bookings</p></a>
        <a href="?view=orders" class="card"><i class="fas fa-shopping-cart"></i><h3><?= $order_count ?></h3><p>Total Orders</p></a>
        <a href="?view=doctors" class="card"><i class="fas fa-stethoscope"></i><h3><?= $dr_count ?></h3><p>Specialists</p></a>
        <a href="?view=schedules" class="card"><i class="fas fa-hourglass-half"></i><h3><?= $sched_count ?></h3><p>Slots</p></a>
        <a href="?view=products" class="card"><i class="fas fa-magic"></i><h3><?= $prod_count ?></h3><p>Store Items</p></a>
    </div>

    <div class="content-box">
        <?php if($view == 'orders'): ?>
            <h3 class="view-title">Customer Orders</h3>
            <table>
                <thead><tr><th>ID</th><th>Customer Name</th><th>Contact & Address</th><th>Total Price</th><th>Order Date</th><th>Actions</th></tr></thead>
                <tbody>
                <?php $res = $conn_skincare->query("SELECT * FROM orders ORDER BY id DESC");
                while($row = $res->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td style="font-weight:600;"><?= $row['customer_name'] ?></td>
                    <td>
                        <div style="font-size:13px;"><i class="fas fa-phone" style="font-size:10px;"></i> <?= $row['phone'] ?></div>
                        <div style="font-size:12px; color:#888; margin-top:4px;"><i class="fas fa-map-marker-alt" style="font-size:10px;"></i> <?= $row['address'] ?></div>
                    </td>
                    <td style="font-weight:700; color:var(--primary);"><?= number_format($row['total_price']) ?> MMK</td>
                    <td style="font-size:12px; color:#666;"><?= date('M d, Y', strtotime($row['order_date'])) ?></td>
                    <td><div class="action-btns">
                        <a href="?confirm_order=<?= $row['id'] ?>" class="btn btn-check" title="Confirm Order"><i class="fas fa-check"></i></a>
                        <button onclick="confirmDelete('?delete_order=<?= $row['id'] ?>')" class="btn btn-trash"><i class="fas fa-trash"></i></button>
                    </div></td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif($view == 'bookings'): ?>
            <h3 class="view-title">Patient Bookings</h3>
            <table>
                <thead><tr><th>Patient</th>
<th>Doctor</th>
<th>Age/Sex</th>
<th>Patient Contact</th>
<th>Status</th>
<th>Actions</th>
</tr></thead>
                <tbody>
                <?php $res = $conn_health->query("
    SELECT bookings.*, consultants.name AS doctor_name, consultants.specialty
    FROM bookings
    LEFT JOIN consultants ON bookings.doctor_id = consultants.id
    ORDER BY bookings.id DESC
");
?>
               <?php while($row = $res->fetch_assoc()): ?>
<tr>
    <td>
        <div style="font-weight:700; color:#2c3e50; font-size:17px;"><?= $row['patient_name'] ?></div>
        <div style="color:#ff85a2;">ID: #<?= $row['id'] ?></div>
    </td>

    <td>
        <div style="font-weight:600;">
            <?= $row['doctor_name'] ?? 'Not Assigned' ?>
        </div>
       <div><i class="fas fa-certificate" style="margin-right:8px; color:#adb5bd;"></i><?= $row['specialty'] ?></div>
    </td>

    <td style="font-weight:500;">
        <i class="fas fa-venus-mars" style="margin-right:5px; color:#adb5bd;"></i> <?= $row['age'] ?> Yrs • <?= $row['gender'] ?>
    </td>
    <td>
        <i class="fas fa-phone-alt" style="margin-right:5px; color:#adb5bd;"></i> <?= $row['phone'] ?>
    </td>
    <td>
        <span class="status <?= strtolower($row['status']) ?>" style="padding: 8px 15px; font-size: 12px;">
            <?= $row['status'] ?>
        </span>
    </td>
    <td>
        <div class="action-btns">
            <a href="?confirm_book=<?= $row['id'] ?>" class="btn btn-check" title="Verify"><i class="fas fa-check"></i></a>
            <button onclick="confirmDelete('?delete_book=<?= $row['id'] ?>')" class="btn btn-trash" title="Delete"><i class="fas fa-trash"></i></button>
        </div>
    </td>
</tr>
<?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif($view == 'doctors'): ?>
            <h3 class="view-title">Our Specialists</h3>
            <table>
                <thead><tr><th>Doctor ID</th>
<th>Name</th>
<th>Specialty</th>
<th>Contact</th>
<th>Action</th>
</tr></thead>
                <tbody>
                <?php $res = $conn_health->query("SELECT * FROM consultants");
                while($row = $res->fetch_assoc()): ?>
                <tr>
    <td>#<?= $row['id'] ?></td>
    <td style="font-weight:600;"><?= $row['name'] ?></td>
    <td><span style="background:#f0f0f0; padding:4px 10px; border-radius:8px;"><?= $row['specialty'] ?></span></td>
    <td><?= $row['contact'] ?></td>
    <td>
        <button onclick="confirmDelete('?delete_dr=<?= $row['id'] ?>')" class="btn btn-trash">
            <i class="fas fa-trash"></i> Delete
        </button>
    </td>
</tr>

                <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif($view == 'schedules'): ?>
            <h3 class="view-title">Time Schedules</h3>
            <table>
                <thead><tr><th>Dr ID</th><th>Doctor</th><th>Contact</th><th>Day</th><th>Time Slot</th><th>Action</th></tr></thead>
                <tbody>
                <?php $res = $conn_health->query("
    SELECT doctor_schedules.*, consultants.name, consultants.contact
    FROM doctor_schedules
    LEFT JOIN consultants ON doctor_schedules.doctor_id = consultants.id
");


                while($row = $res->fetch_assoc()): ?>
                <tr>
                    <td>Doctor #<?= $row['doctor_id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['contact'] ?></td>

                    <td><?= $row['day_name'] ?></td>
                    <td><strong><?= $row['time_slot'] ?></strong></td>
                    <td><button onclick="confirmDelete('?delete_sched=<?= $row['id'] ?>')" class="btn btn-trash"><i class="fas fa-trash"></i></button></td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif($view == 'products'): ?>
            <h3 class="view-title">Skincare Products</h3>
            <table>
                <thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr></thead>
                <tbody>
                <?php 
                $res = $conn_skincare->query("SELECT * FROM products ORDER BY id DESC");
                while($row = $res->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td style="font-weight:600;"><?= $row['name'] ?></td>
                    <td style="font-weight:700; color:var(--primary);"><?= number_format($row['price']) ?> MMK</td>
                    <td><button onclick="confirmDelete('?delete_prod=<?= $row['id'] ?>')" class="btn btn-trash"><i class="fas fa-trash"></i> Delete</button></td>
                </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
function confirmDelete(deleteUrl) {
    Swal.fire({
        title: 'ဖျက်မှာ သေချာလား?',
        text: "ဒီဒေတာကို ပြန်ယူလို့ရမှာ မဟုတ်ဘူးနော်!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff85a2',
        cancelButtonColor: '#2c3e50',
        confirmButtonText: 'ဟုတ်ကဲ့၊ ဖျက်မယ်!',
        cancelButtonText: 'မဖျက်တော့ဘူး'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    })
}
</script>

</body>
</html>