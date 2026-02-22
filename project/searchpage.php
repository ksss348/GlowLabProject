<?php
$conn = new mysqli("localhost", "root", "", "healthcare_db");

$search_query = "";
if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $sql = "SELECT * FROM consultants WHERE 
            name LIKE '%$search_query%' OR 
            specialty LIKE '%$search_query%'";
} else {
    $sql = "SELECT * FROM consultants";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlowLab - Find Consultants</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #fdf2f8; }
        .text-glow { color: #be185d; }
        .bg-glow { background-color: #be185d; }
        .bg-glow-light { background-color: #fce7f3; }
        .border-glow { border-color: #fbcfe8; }
        
        .gradient-text {
            background: linear-gradient(to right, #be185d, #7e22ce);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Specialty Text Transition */
        .specialty-text {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .home-btn-container {
            display: flex;
            justify-content: center;
            padding-top: 2rem;
            width: 100%;
        }

        /* Fixed Home Button Style */
        .home-btn {
            position: fixed;
            top: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: bold;
            color: #be185d;
            box-shadow: 0 4px 15px rgba(190, 24, 93, 0.15);
            transition: all 0.3s ease;
            z-index: 1000; /* Ensure it stays above everything */
            text-decoration: none;
        }
        .home-btn:hover {
            transform: translateX(-5px);
            background: #be185d;
            color: white;
        }
    </style>
</head>
<body class="font-sans">
    <a href="home.php" class="home-btn">
        <i class="fas fa-chevron-left text-xs"></i>
        <span id="homeText">Home</span>
    </a>

    <div class="max-w-6xl mx-auto py-16 px-4 text-center">
        <div class="flex justify-end mb-4">
            <button onclick="toggleLanguage()" id="langBtn" class="bg-white border border-pink-200 text-glow px-4 py-2 rounded-xl font-bold text-xs shadow-sm hover:bg-pink-50 transition active:scale-95">
                <i class="fas fa-language mr-2"></i> SWITCH TO MM
            </button>
        </div>

        <p class="text-glow font-bold tracking-[0.3em] text-xs uppercase mb-3">Skin & Beauty Experts</p>
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-10">
            Find Your Desired <span class="gradient-text">Glow Consultant</span>
        </h1>

        <div class="relative max-w-2xl mx-auto mb-16">
            <div class="bg-white p-2 pl-6 rounded-full shadow-2xl shadow-pink-200/40 flex items-center gap-2 border border-pink-100">
                <i class="fas fa-search text-pink-300"></i>
                <input type="text" id="live_search" autocomplete="off" 
                       placeholder="Search by name or specialty..." 
                       class="flex-1 px-2 py-3 outline-none text-gray-700 bg-transparent font-medium">
                <button class="bg-glow text-white px-10 py-4 rounded-full font-bold hover:bg-pink-800 transition shadow-lg shadow-pink-200 active:scale-95">
                    Search
                </button>
            </div>
            
            <div id="search_results" class="absolute left-0 right-0 mt-3 bg-white rounded-[2rem] shadow-2xl z-50 overflow-hidden hidden border border-pink-50 text-left">
            </div>
        </div>
<div id="doctor_grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <?php
            // Re-running the query to populate the grid
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()): 
            ?>
                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-pink-100/50 border border-pink-50 transition-all hover:-translate-y-2 p-3">
                    <div class="relative">
                        <img src="<?php echo $row['image_url']; ?>" 
                             class="w-full h-72 object-cover rounded-[2rem] mb-4">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-bold text-gray-800 text-lg mb-1"><?php echo $row['name']; ?></h3>
                        
                        <p class="specialty-text text-[11px] font-bold text-pink-500 uppercase tracking-widest mb-6 italic opacity-80"
                           data-en="<?php echo $row['specialty']; ?>">
                            <?php echo $row['specialty']; ?>
                        </p>
                        
                        <a href="profile.php?id=<?php echo $row['id']; ?>" 
                           class="block w-full bg-glow-light text-glow font-black py-4 rounded-2xl text-xs uppercase tracking-tighter hover:bg-glow hover:text-white transition duration-300">
                            Book Appointment
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
    // Translation Dictionary (Database ထဲကစာသားတွေနဲ့ တိုက်စစ်ဖို့)
    const translateDict = {
    "DERMATOLOGIST (ACNE & SCARS)": "အရေပြားနှင့် ဝက်ခြံအမာရွတ်အထူးကု",
    "AESTHETIC EXPERT (DRY SKIN)": "အသားအရေထိန်းသိမ်းမှု ပညာရှင်",
    "CLINICAL DERMATOLOGIST (OILY SKIN)": "အရေပြားရောဂါ အထူးကုဆရာဝန်",
    "SKIN HEALTH SPECIALIST": "အရေပြားကျန်းမာရေး ကျွမ်းကျင်သူ",
    "COSMETIC LASER SPECIALIST": "အလှအပဆိုင်ရာ လေဆာအထူးကု",
    "PEDIATRIC DERMATOLOGY": "ကလေးအရေပြားရောဂါ အထူးကု",
    "DERMATOPATHOLOGIST": "အရေပြားရောဂါဗေဒ ကျွမ်းကျင်သူ",
    "ALLERGY & IMMUNOLOGY EXPERT": "ဓာတ်မတည့်မှုနှင့် ခုခံအားစနစ်ကျွမ်းကျင်သူ",
    "SURGICAL DERMATOLOGIST": "အရေပြားခွဲစိတ်အထူးကု",
    "ANTI-AGING SPECIALIST": "အိုမင်းရင့်ရော်မှုတားဆီးရေး အထူးကု"
};

    let currentLang = 'en';

    function toggleLanguage() {
        const specialties = document.querySelectorAll('.specialty-text');
        const btn = document.getElementById('langBtn');

        specialties.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(5px)';

            setTimeout(() => {
                if (currentLang === 'en') {
                    const enText = el.getAttribute('data-en').toUpperCase();
                    el.innerText = translateDict[enText] || el.innerText;
                } else {
                    el.innerText = el.getAttribute('data-en');
                }
                el.style.opacity = '0.8';
                el.style.transform = 'translateY(0)';
            }, 300);
        });

        currentLang = (currentLang === 'en') ? 'mm' : 'en';
        btn.innerHTML = (currentLang === 'en') ? 
            '<i class="fas fa-language mr-2"></i> SWITCH TO MM' : 
            '<i class="fas fa-language mr-2"></i> SWITCH TO EN';
    }

    // Original Live Search Logic
    document.getElementById('live_search').addEventListener('input', function() {
        let query = this.value;
        let resultsDiv = document.getElementById('search_results');
if (query.length > 0) {
            fetch('search_ajax.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'query=' + encodeURIComponent(query)
            })
            .then(response => response.text())
            .then(data => {
                resultsDiv.innerHTML = data;
                resultsDiv.classList.remove('hidden');
            });
        } else {
            resultsDiv.classList.add('hidden');
        }
    });

    document.addEventListener('click', function(e) {
        if (!document.getElementById('live_search').contains(e.target)) {
            document.getElementById('search_results').classList.add('hidden');
        }
    });
    </script>
</body>
</html>