<?php
// PHP Logic အပိုင်း - မင်းမူရင်းအတိုင်း ဘာမှမပြင်ထားပါ
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "healthcare_db");

if ($conn->connect_error) {
    die("Database Connection ပျက်စီးနေပါသည်: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);


    $target_dir = "doctors/";
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
    $image_name = time() . "_" . basename($_FILES["doctor_image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["doctor_image"]["tmp_name"], $target_file)) {
        $sql_dr = "INSERT INTO consultants (name, specialty, contact, image_url, bio) 
           VALUES ('$name', '$specialty', '$contact', '$target_file', '$bio')";
;

        if ($conn->query($sql_dr) === TRUE) {
            $new_doctor_id = $conn->insert_id; 

            if (isset($_POST['day_names']) && isset($_POST['time_slots'])) {
                $day_names = $_POST['day_names'];
                $time_slots = $_POST['time_slots'];

                for ($i = 0; $i < count($day_names); $i++) {
                    $day = mysqli_real_escape_string($conn, $day_names[$i]);
                    $time = mysqli_real_escape_string($conn, $time_slots[$i]);

                    if (!empty($day) && !empty($time)) {
                        $sql_sched = "INSERT INTO doctor_schedules (doctor_id, day_name, time_slot, is_booked) 
                                      VALUES ('$new_doctor_id', '$day', '$time', 0)";
                        $conn->query($sql_sched);
                    }
                }
            }
            // SweetAlert2 နဲ့ အောင်မြင်ကြောင်းပြပြီး Dashboard ပြန်သွားမယ်
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Expert နှင့် Schedule အားလုံးကို သိမ်းဆည်းပြီးပါပြီ!',
                            icon: 'success',
                            confirmButtonColor: '#ff85a2'
                        }).then(() => { window.location.href='admin_dashboard.php'; });
                    });
                  </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowLab | Add Expert</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --pink: #ff85a2; --dark: #2c3e50; --bg: #fdf2f4; --soft: #fff9fa; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg); 
            margin: 0; padding: 40px 20px;
            display: flex; flex-direction: column; align-items: center;
        }

        .back-link {
            align-self: flex-start; margin-bottom: 20px; margin-left: auto; margin-right: auto;
            max-width: 650px; width: 100%;
            text-decoration: none; color: var(--dark); font-weight: 600;
        }

        .form-box { 
            background: white; width: 100%; max-width: 650px; 
            padding: 40px; border-radius: 30px; 
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
            border: 1px solid rgba(255,133,162,0.1);
        }

        h2 { text-align: center; color: var(--dark); margin-bottom: 30px; letter-spacing: 1px; font-weight: 800; }
        
        .section-title { font-size: 14px; font-weight: 700; color: #adb5bd; text-transform: uppercase; margin-bottom: 15px; display: block; }

        input, textarea, select { 
            width: 100%; padding: 14px; margin-bottom: 20px; 
            border-radius: 15px; border: 1.5px solid #f1f1f1; 
            box-sizing: border-box; outline: none; background: #fafafa; transition: 0.3s;
        }

        input:focus, textarea:focus { border-color: var(--pink); background: #fff; box-shadow: 0 0 10px rgba(255,133,162,0.1); }

        /* Schedule Row Styling */
        .schedule-container { background: var(--soft); padding: 20px; border-radius: 20px; border: 1px dashed var(--pink); margin-bottom: 20px; }
        .schedule-row { display: flex; gap: 10px; margin-bottom: 12px; align-items: center; }
        .schedule-row select, .schedule-row input { margin-bottom: 0; }

        .btn-add { 
            background: #eef2ff; color: #4f46e5; border: none; padding: 12px; 
            border-radius: 12px; cursor: pointer; width: 100%; font-weight: bold; 
            margin-bottom: 25px; transition: 0.3s;
        }
        .btn-add:hover { background: #4f46e5; color: white; }

        .btn-submit { 
            background: var(--dark); color: white; border: none; padding: 18px; 
            width: 100%; border-radius: 50px; cursor: pointer; font-weight: bold; 
            font-size: 16px; transition: 0.4s; letter-spacing: 1px;
        }
        .btn-submit:hover { background: var(--pink); transform: translateY(-3px); box-shadow: 0 10px 25px rgba(255,133,162,0.3); }

        .remove-btn { background: #ffebee; color: #ff4444; border: none; padding: 12px; border-radius: 12px; cursor: pointer; }
    </style>
</head>
<body>

<a href="admin_dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

<div class="form-box">
    <h2><i class="fas fa-user-md" style="color: var(--pink);"></i> Add New Expert</h2>
    
    <form method="POST" enctype="multipart/form-data">
        <span class="section-title">Basic Information</span>
        <input type="text" name="name" placeholder="Expert Full Name" required>
        <input type="text" name="contact" placeholder="Contact Number (e.g. 09xxxxxxxx)" required>
        <input type="text" name="specialty" placeholder="Specialty (e.g. Dermatologist)" required>
        <textarea name="bio" placeholder="Biography & Details..." rows="3" required></textarea>
        
        <span class="section-title">Profile Photo</span>
        <input type="file" name="doctor_image" accept="image/*" required style="border: 2px dashed #eee; background: #fff;">

        <span class="section-title" style="margin-top: 20px;"><i class="far fa-clock"></i> Set Availability</span>
        <div id="schedule-container" class="schedule-container">
            <div class="schedule-row">
                <select name="day_names[]" required>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                <input type="text" name="time_slots[]" placeholder="e.g. 09:00 AM - 12:00 PM" required>
            </div>
        </div>
        
        <button type="button" class="btn-add" onclick="addRow()">
            <i class="fas fa-plus-circle"></i> Add Another Time Slot
        </button>

        <button type="submit" class="btn-submit">SAVE EXPERT & SCHEDULES</button>
    </form>
</div>

<script>
function addRow() {
    const container = document.getElementById('schedule-container');
    const div = document.createElement('div');
    div.className = 'schedule-row';
    div.innerHTML = `
        <select name="day_names[]" required>
            <option value="Monday">Monday</option><option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option><option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option><option value="Saturday">Saturday</option><option value="Sunday">Sunday</option>
        </select>
        <input type="text" name="time_slots[]" placeholder="e.g. 02:00 PM" required>
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()"><i class="fas fa-trash"></i></button>
    `;
    container.appendChild(div);
}
</script>

</body>
</html>