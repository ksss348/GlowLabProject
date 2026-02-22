<?php
// Error ရှာဖို့အတွက် debug mode ဖွင့်မယ်
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "healthcare_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Confirm လုပ်ခြင်း
if (isset($_GET['confirm_id'])) {
    $c_id = intval($_GET['confirm_id']);
    $conn->query("UPDATE appointments SET status = 'Confirmed' WHERE id = $c_id");
    header("Location: admin_bookings.php");
    exit();
}

// Delete လုပ်ခြင်း
if (isset($_GET['delete_id'])) {
    $d_id = intval($_GET['delete_id']);
    
    // Schedule ကို ပြန်ဖွင့်ပေးမယ်
    $res = $conn->query("SELECT schedule_id FROM appointments WHERE id = $d_id");
    if ($res && $row = $res->fetch_assoc()) {
        $sched_id = $row['schedule_id'];
        $conn->query("UPDATE doctor_schedules SET is_booked = 0 WHERE id = $sched_id");
    }
    
    $conn->query("DELETE FROM appointments WHERE id = $d_id");
    header("Location: admin_bookings.php");
    exit();
}

// Booking စာရင်း ဆွဲထုတ်ခြင်း
// Table ၃ ခုကို Join ထားပါတယ်
$sql = "SELECT a.*, d.name as doctor_name, s.day_name, s.time_slot 
        FROM appointments a
        LEFT JOIN consultants d ON a.doctor_id = d.id
        LEFT JOIN doctor_schedules s ON a.schedule_id = s.id
        ORDER BY a.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Management</title>
    <style>
        body { font-family: sans-serif; background: #fdf2f4; padding: 20px; }
        .table-box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #ff85a2; color: white; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 5px; font-size: 12px; }
        .btn-confirm { background: #28a745; }
        .btn-delete { background: #dc3545; }
    </style>
</head>
<body>

<div class="table-box">
    <h2>Doctor Bookings</h2>
    <table>
        <tr>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Time Slot</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['patient_name']) ?> (<?= $row['phone'] ?>)</td>
                <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                <td><?= $row['day_name'] ?> - <?= $row['time_slot'] ?></td>
                <td><strong><?= $row['status'] ?></strong></td>
                <td>
                    <a href="?confirm_id=<?= $row['id'] ?>" class="btn btn-confirm">Confirm</a>
                    <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-delete" onclick="return confirm('ဖျက်မှာလား?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5">Booking မရှိသေးပါ။</td></tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>