<?php
$conn = new mysqli("localhost", "root", "", "healthcare_db");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// ၁။ ပထမဆုံး စမ်းသပ် ဒေတာ တစ်ခု သွင်းကြည့်မယ်
// (မင်းရဲ့ doctor_id တွေထဲက ရှိပြီးသား တစ်ခုကို ပြောင်းပေးပါ ဥပမာ- 1)
$test_dr_id = 1; 
$test_day = "Monday";
$test_time = "10:00 AM";

// ၂။ SQL Query ကို အတိအကျ စမ်းမယ်
$sql = "INSERT INTO doctor_schedules (doctor_id, day_name, time_slot, is_booked) 
        VALUES ('$test_dr_id', '$test_day', '$test_time', 0)";

echo "<h3>Database Debugging Test...</h3>";

if ($conn->query($sql)) {
    echo "<p style='color:green;'>SUCCESS: ဒေတာ ဝင်သွားပါပြီ။ id: " . $conn->insert_id . "</p>";
} else {
    // 🚩 ဒါက အရေးကြီးဆုံးပဲ - ဘာလို့မဝင်လဲ ဒီမှာ ပြောပြလိမ့်မယ်
    echo "<p style='color:red;'>FAILED: Error က - " . $conn->error . "</p>";
}

// ၃။ Table Structure ကိုပါ တစ်ခါတည်း စစ်မယ်
echo "<h4>Table Structure Check:</h4>";
$result = $conn->query("DESCRIBE doctor_schedules");
echo "<table border='1'><tr><th>Field</th><th>Type</th></tr>";
while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row['Field']."</td><td>".$row['Type']."</td></tr>";
}
echo "</table>";
?>