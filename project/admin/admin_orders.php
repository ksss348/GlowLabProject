<?php
// 1. Database Connection
$conn = new mysqli("localhost", "root", "", "skincare_shop");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// 2. Ensure required columns exist (in case DB was not updated)
$schemaMessages = [];
$check = $conn->query("SHOW COLUMNS FROM orders LIKE 'payment_proof'");
if ($check->num_rows === 0) {
    $conn->query("ALTER TABLE orders ADD COLUMN payment_proof VARCHAR(255) NULL");
    $schemaMessages[] = 'Added payment_proof column';
}
$check = $conn->query("SHOW COLUMNS FROM orders LIKE 'status'");
if ($check->num_rows === 0) {
    $conn->query("ALTER TABLE orders ADD COLUMN status VARCHAR(20) DEFAULT 'Pending'");
    $schemaMessages[] = 'Added status column';
}

// 2. Action Logic (Confirm / Delete)
if (isset($_GET['confirm_order'])) {
    $id = (int)$_GET['confirm_order'];
    $conn->query("UPDATE orders SET status = 'Confirmed' WHERE id = $id");
    header("Location: admin_orders.php"); // Refresh to see changes
    exit();
}

if (isset($_GET['delete_order'])) {
    $id = (int)$_GET['delete_order'];
    $conn->query("DELETE FROM orders WHERE id = $id"); // Note: You might need to delete order_items too
    header("Location: admin_orders.php");
    exit();
}

// 3. (not needed) the stored payment_proof field already contains the relative/absolute path
// $img_base_path = "uploaded_img/payment_proofs/"; // no longer used
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
        :root { --primary: #ff85a2; --dark: #2c3e50; --bg: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); margin: 0; display: flex; color: #333; }
        
        /* Sidebar Styles */
        .sidebar { width: 280px; height: 100vh; background: var(--dark); color: white; position: fixed; z-index: 1000; }
        .logo-area { padding: 30px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .logo-area h2 { color: var(--primary); margin: 0; }
        .nav-links a { display: flex; align-items: center; color: #bdc3c7; padding: 15px 30px; text-decoration: none; transition: 0.3s; }
        .nav-links a.active { background: rgba(255,133,162,0.1); color: var(--primary); border-left: 4px solid var(--primary); }

        /* Main Content */
        .main { margin-left: 280px; padding: 40px; width: calc(100% - 280px); }
        .content-box { background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); }

        /* Table Design */
        table { width: 100%; border-collapse: separate; border-spacing: 0 12px; }
        th { padding: 15px 20px; text-align: left; color: #888; font-size: 12px; text-transform: uppercase; }
        td { padding: 15px 20px; background: #fff; border-top: 1px solid #f1f1f1; border-bottom: 1px solid #f1f1f1; }
        tr td:first-child { border-left: 1px solid #f1f1f1; border-radius: 15px 0 0 15px; }
        tr td:last-child { border-right: 1px solid #f1f1f1; border-radius: 0 15px 15px 0; }

        /* Image & Badge Styles */
        .proof-img { width: 50px; height: 50px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 1px solid #eee; }
        .status-badge { padding: 5px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .confirmed { background: #e8f5e9; color: #2e7d32; }
        .pending { background: #fff3e0; color: #ef6c00; }
        
        .btn { border: none; padding: 8px 12px; border-radius: 10px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; }
        .btn-check { background: #e3f2fd; color: #1976d2; }
        .btn-trash { background: #ffebee; color: #c62828; margin-left: 5px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-area"><h2>GLOWLAB</h2></div>
    <div class="nav-links">
        <a href="?view=bookings"><i class="fas fa-calendar-check"></i> Bookings</a>
        <a href="?view=orders" class="active"><i class="fas fa-shopping-bag"></i> Orders List</a>
        <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<div class="main">
    <div class="header">
        <h1>Dashboard Overview</h1>
        <p style="color: #888;"><?php echo date("F d, Y"); ?></p>
        <?php if (!empty($schemaMessages)): ?>
            <div style="margin-top:10px; padding:8px 12px; background:#fff3cd; border:1px solid #ffeeba; border-radius:6px; color:#856404; font-size:14px;">
                <?php echo implode(' · ', $schemaMessages); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="content-box">
        <h3 class="view-title">Customer Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Contact & Address</th>
                    <th>Proof</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch REAL data from your table
                $orders = $conn->query("SELECT * FROM orders ORDER BY id DESC");
                while($o = $orders->fetch_assoc()):
                    $status = $o['status'] ?? 'Pending';
                    $img_name = $o['payment_proof'];
                ?>
                <tr>
                    <td>#<?php echo $o['id']; ?></td>
                    <td style="font-weight:600;"><?php echo htmlspecialchars($o['customer_name']); ?></td>
                    <td>
                        <div style="font-size:13px;"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($o['phone']); ?></div>
                        <div style="font-size:12px; color:#888;"><?php echo htmlspecialchars($o['address']); ?></div>
                    </td>
                    <td>
    <?php if(!empty($img_name)): 
        // If the path in DB is "uploaded_img/...", we add "../" to go up from the admin folder
        $final_path = (strpos($img_name, 'uploaded_img') === 0) ? '../' . $img_name : $img_name;
    ?>
        <img src="<?php echo htmlspecialchars($final_path); ?>" 
             class="proof-img" 
             onclick="viewImage('<?php echo htmlspecialchars($final_path); ?>')"
             onerror="this.src='https://via.placeholder.com/50?text=Missing'">
    <?php else: ?>
        <span style="color:#bbb; font-size:11px;"><i class="fas fa-hand-holding-dollar"></i> COD</span>
    <?php endif; ?>
</td>
                    <td style="font-weight:700; color:var(--primary);"><?php echo number_format($o['total_price']); ?> MMK</td>
                    <td><span class="status-badge <?php echo strtolower($status); ?>"><?php echo $status; ?></span></td>
                    <td>
                        <div class="action-btns">
                            <?php if($status !== 'Confirmed'): ?>
                                <a href="?confirm_order=<?php echo $o['id']; ?>" class="btn btn-check" title="Confirm Order"><i class="fas fa-check"></i></a>
                            <?php endif; ?>
                            <button onclick="confirmDelete('admin_orders.php?delete_order=<?php echo $o['id']; ?>')" class="btn btn-trash"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function viewImage(url) {
    Swal.fire({
        imageUrl: url,
        imageAlt: 'Payment Proof',
        showConfirmButton: false,
        showCloseButton: true
    });
}

function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This order will be removed permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff85a2',
        confirmButtonText: 'Yes, Delete!'
    }).then((result) => {
        if (result.isConfirmed) { window.location.href = url; }
    });
}
</script>
</body>
</html>