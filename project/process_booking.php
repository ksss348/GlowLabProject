<?php
$conn = new mysqli("localhost", "root", "", "healthcare_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dr_id    = $_POST['doctor_id'];
    $sched_id = $_POST['schedule_id'];
    $p_name   = $_POST['patient_name'];
    $phone    = $_POST['phone'];
    $age      = $_POST['age'];
    $gender   = $_POST['gender'];
    $check_sql = "SELECT is_booked FROM doctor_schedules WHERE id = $sched_id AND doctor_id = $dr_id";
$check_res = $conn->query($check_sql);

if ($check_res && $check_res->num_rows > 0) {
    $row = $check_res->fetch_assoc();
    if ($row['is_booked'] == 1) {
        echo "<h2>Sorry, this time slot for the doctor is already booked. Please choose another slot.</h2>";
        exit; // Stop execution here
    }
}

    $sql = "INSERT INTO bookings (doctor_id, schedule_id, patient_name, phone, age, gender) 
            VALUES ('$dr_id', '$sched_id', '$p_name', '$phone', '$age', '$gender')";

    if ($conn->query($sql)) {
        $booking_id = $conn->insert_id;
        $conn->query("UPDATE doctor_schedules SET is_booked = 1 WHERE id = $sched_id");

        $info_res = $conn->query("SELECT c.name as dr_name, s.time_slot, s.day_name 
                                  FROM consultants c, doctor_schedules s 
                                  WHERE c.id = $dr_id AND s.id = $sched_id");
        $info = $info_res->fetch_assoc();
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmed - GlowLab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #fdf2f8; }
        .glow-gradient { background: linear-gradient(135deg, #be185d 0%, #7e22ce 100%); }
        @media print { .no-print { display: none; } body { background-color: white; } }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-[3rem] shadow-2xl shadow-pink-200/50 overflow-hidden border border-pink-100">
        
        <div class="glow-gradient p-10 text-center text-white relative">
            <div class="bg-white/20 backdrop-blur-md w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                <i class="fas fa-check text-3xl"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tight">Booking Success!</h1>
            <p class="text-pink-100 text-xs font-bold uppercase tracking-[0.2em] mt-2 opacity-90">GlowLab Aesthetic</p>
        </div>

        <div class="p-8 space-y-6">
            <div class="flex justify-between items-center pb-5 border-b border-dashed border-pink-100">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Appointment ID</p>
                    <p class="font-black text-pink-600 text-xl">#<?php echo $booking_id; ?></p>
                </div>
                <div class="text-right">
                    <span class="bg-pink-50 text-pink-600 text-[10px] px-4 py-1.5 rounded-full font-black uppercase tracking-widest border border-pink-100">Verified</span>
                </div>
            </div>

            <div class="space-y-5">
                <div class="flex items-start">
                    <div class="bg-pink-50 p-3.5 rounded-2xl mr-4 text-pink-500 shadow-sm"><i class="fas fa-user-md text-lg"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Consultant</p>
                        <p class="font-bold text-gray-800"><?php echo $info['dr_name']; ?></p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-purple-50 p-3.5 rounded-2xl mr-4 text-purple-500 shadow-sm"><i class="fas fa-magic text-lg"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Patient Name</p>
                        <p class="font-bold text-gray-800">
                            <?php echo htmlspecialchars($p_name); ?> 
                            <span class="text-pink-300 font-medium">(<?php echo $gender; ?>, <?php echo $age; ?> yrs)</span>
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <div class="bg-pink-50 p-3.5 rounded-2xl mr-4 text-pink-500 shadow-sm"><i class="fas fa-phone text-lg"></i></div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Contact</p>
                            <p class="font-bold text-gray-800 text-sm"><?php echo $phone; ?></p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-purple-50 p-3.5 rounded-2xl mr-4 text-purple-500 shadow-sm"><i class="fas fa-sparkles text-lg"></i></div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Schedule</p>
                            <p class="font-bold text-gray-800 text-sm"><?php echo $info['day_name']; ?> <br> <?php echo $info['time_slot']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 pt-0 space-y-3 no-print">
            <button onclick="window.print()" class="w-full bg-gray-900 text-white font-black py-4 rounded-2xl shadow-xl hover:bg-black transition active:scale-95 flex items-center justify-center uppercase tracking-[0.2em] text-xs">
                <i class="fas fa-print mr-2"></i> Print Ticket (PDF)
            </button>
            <a href="searchpage.php" class="block w-full text-center text-pink-500 font-bold py-2 rounded-2xl hover:text-pink-700 transition text-xs uppercase tracking-widest">
                Back To Home
            </a>
        </div>

        <div class="bg-pink-50/50 p-4 text-center">
            <p class="text-[9px] text-pink-300 font-bold uppercase tracking-[0.4em]">GlowLab Digital Receipt</p>
        </div>
    </div>

</body>
</html>

<?php
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>