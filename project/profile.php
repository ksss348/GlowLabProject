<?php
// ၁။ Database ချိတ်ဆက်ခြင်း
$conn = new mysqli("localhost", "root", "", "healthcare_db");

// ၂။ ဆရာဝန် ID ဖမ်းယူခြင်း
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ၃။ ဆရာဝန် အချက်အလက် ဆွဲထုတ်ခြင်း
$dr_res = $conn->query("SELECT * FROM consultants WHERE id = $id");
$doctor = $dr_res->fetch_assoc();

if (!$doctor) { die("Doctor not found."); }

// ၄။ အချိန်ဇယား (Time Slots) ဆွဲထုတ်ခြင်း
$sched_res = $conn->query("SELECT * FROM doctor_schedules WHERE doctor_id = $id ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $doctor['name']; ?> - GlowLab Consultant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #fdf2f8; } /* GlowLab Light Pink */
        .glow-text { color: #be185d; } 
        .bg-glow { background-color: #be185d; }
        
        /* Time Slot Selection Logic */
        .peer:checked + .slot-box {
            background-color: #be185d !important;
            border-color: #be185d !important;
            color: white !important;
            box-shadow: 0 10px 15px -3px rgba(190, 24, 93, 0.3);
        }
        
        .peer:checked + .slot-box p {
            color: white !important;
        }

        .btn-hover:hover { 
            background-color: #9d174d; 
            transform: translateY(-2px); 
        }

        /* Custom Scrollbar for better aesthetic */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #fdf2f8; }
        ::-webkit-scrollbar-thumb { background: #fbcfe8; border-radius: 10px; }
    </style>
</head>
<body class="font-sans min-h-screen text-gray-800">

    <div class="max-w-6xl mx-auto py-12 px-6">
        <a href="searchpage.php" class="inline-flex items-center glow-text font-bold mb-8 hover:gap-2 transition-all group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Back to Consultants
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <div class="lg:col-span-4">
                <div class="bg-white rounded-[3rem] p-10 shadow-2xl shadow-pink-200/50 border border-pink-50 text-center lg:sticky lg:top-10">
                    <div class="relative inline-block mb-6">
                        <img src="<?php echo $doctor['image_url']; ?>" 
                             onerror="this.src='https://via.placeholder.com/200?text=No+Photo'"
                             class="w-48 h-48 rounded-[2.5rem] mx-auto object-cover shadow-xl border-4 border-pink-50">
                    </div>
                    
                    <h2 class="text-2xl font-black text-gray-800"><?php echo $doctor['name']; ?></h2>
                    <p class="glow-text font-bold uppercase text-xs tracking-[0.2em] mt-2 mb-6 italic">
                        <?php echo $doctor['specialty']; ?>
                    </p>
                    
                    <div class="bg-pink-50/50 p-5 rounded-[2rem] text-left space-y-3 border border-pink-100">
                        <div class="flex items-center text-sm text-pink-600 font-medium">
                            <i class="fas fa-magic mr-3"></i> Beauty Consultant
                        </div>
                        <div class="flex items-center text-sm text-pink-600 font-medium">
                            <i class="fas fa-sparkles mr-3"></i> Skincare Expert
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white rounded-[3rem] p-10 shadow-2xl shadow-pink-200/50 border border-pink-50">
                    
                    <form action="process_booking.php" method="POST">
                        <input type="hidden" name="doctor_id" value="<?php echo $id; ?>">

                        <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center">
                            <i class="far fa-calendar-check glow-text mr-3"></i> Available Time Slots
                        </h3>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-10">
                            <?php if ($sched_res->num_rows > 0): ?>
                                <?php while($s = $sched_res->fetch_assoc()): ?>
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="schedule_id" value="<?php echo $s['id']; ?>" 
                                               class="peer hidden" <?php echo ($s['is_booked'] == 1) ? 'disabled' : ''; ?> required>
                                        
                                        <div class="slot-box p-5 rounded-2xl border-2 border-pink-50 bg-white transition-all text-center
                                            <?php echo ($s['is_booked'] == 1) ? 'opacity-30 cursor-not-allowed bg-gray-100' : 'hover:border-pink-300 active:scale-95'; ?>">
                                            
                                            <p class="text-[10px] font-bold uppercase text-pink-300">
                                                <?php echo $s['day_name']; ?>
                                            </p>
                                            <p class="font-black text-gray-700">
                                                <?php echo $s['time_slot']; ?>
                                            </p>
                                            
                                            <?php if($s['is_booked'] == 1): ?>
                                                <span class="block text-[9px] text-gray-400 font-bold italic mt-1 uppercase tracking-widest">Full</span>
                                            <?php endif; ?>
                                        </div>
                                    </label>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="col-span-3 text-pink-300 italic">No slots available right now.</p>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-xl font-black text-gray-800 mb-6 flex items-center pt-8 border-t border-pink-50">
                            <i class="far fa-user glow-text mr-3"></i> Patient Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-pink-300 ml-4 uppercase tracking-widest">Full Name</label>
                                <input type="text" name="patient_name" placeholder="Phoo Phoo" required
                                       class="w-full px-6 py-4 bg-pink-50/30 rounded-2xl border border-pink-50 focus:ring-2 focus:ring-pink-200 outline-none font-bold text-gray-700 placeholder-pink-200 transition-all">
                            </div>
                            
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-pink-300 ml-4 uppercase tracking-widest">Phone Number</label>
                                <input type="tel" name="phone" placeholder="09xxxxxxxxx" required
                                       class="w-full px-6 py-4 bg-pink-50/30 rounded-2xl border border-pink-50 focus:ring-2 focus:ring-pink-200 outline-none font-bold text-gray-700 placeholder-pink-200 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-pink-300 ml-4 uppercase tracking-widest">Age</label>
                                <input type="number" name="age" placeholder="25" required
                                       class="w-full px-6 py-4 bg-pink-50/30 rounded-2xl border border-pink-50 focus:ring-2 focus:ring-pink-200 outline-none font-bold text-gray-700 placeholder-pink-200 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-bold text-pink-300 ml-4 uppercase tracking-widest">Gender</label>
                                <div class="relative">
                                    <select name="gender" required
                                            class="w-full px-6 py-4 bg-pink-50/30 rounded-2xl border border-pink-50 focus:ring-2 focus:ring-pink-200 outline-none font-bold text-gray-700 transition-all cursor-pointer appearance-none">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-pink-200 pointer-events-none text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-glow text-white font-black py-5 rounded-[2rem] shadow-xl shadow-pink-200/50 btn-hover transition-all text-sm uppercase tracking-[0.2em]">
                            Confirm Appointment
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>