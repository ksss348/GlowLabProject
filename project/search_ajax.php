<?php
$conn = new mysqli("localhost", "root", "", "healthcare_db");
$query = $_POST['query'];

$sql = "SELECT * FROM consultants WHERE specialty LIKE '%$query%' OR name LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '
        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 p-2 hover:shadow-xl transition-all duration-300">
            <img src="'.$row['image_url'].'" class="w-full h-64 object-cover rounded-[2rem]">
            <div class="p-5 text-center">
                <h3 class="font-black text-gray-800 text-lg mb-1">'.$row['name'].'</h3>
                <p class="text-[11px] font-bold text-blue-500 uppercase tracking-wider mb-4">'.$row['specialty'].'</p>
                <a href="profile.php?id='.$row['id'].'" class="block w-full bg-red-50 text-red-500 font-bold py-3 rounded-2xl text-sm">
                    Book Appointment
                </a>
            </div>
        </div>';
    }
} else {
    echo '<div class="col-span-full py-20 text-gray-400">No doctors specialized in this concern yet.</div>';
}
?>