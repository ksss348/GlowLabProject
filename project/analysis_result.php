<?php
include 'db_connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
$lang = $_SESSION['lang'] ?? 'en';

$user_id = $_SESSION['id'] ?? null; 

if (!$user_id) {
    header("Location: registration.php");
    exit();
}

$sql = "SELECT u.username, u.skin_type, t.tip_text_en, t.tip_text_mm, t.image_url 
        FROM users u
       LEFT JOIN skincare_tips t ON u.skin_type = t.skin_type
        WHERE u.id = '$user_id'";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $skin = $row['skin_type'];
    $display_image = $row['image_url']; 
} else {
    // This fallback prevents the "Undefined variable $row" error
    $skin = $_SESSION['skin_type'] ?? "Normal Skin";
    $display_image = "normal.png";
    $row = [
        'tip_text_en' => 'Balance your skin with a gentle routine.',
        'tip_text_mm' => 'နူးညံ့သော အသားအရေထိန်းသိမ်းမှုဖြင့် မျှတအောင်ပြုလုပ်ပါ။'
    ];
}

// Motivation Content
$motivation_gift = [
    'Dry Skin' => [
        'mm' => "ခြောက်သွေ့တဲ့အသားအရေဟာ နုနယ်တဲ့ပန်းပွင့်လေးလိုပါပဲ။ ရေဓာတ်လေး နည်းနည်းပိုဖြည့်ပေးလိုက်ရင် ဘယ်သူ့ထက်မဆို ပိုမိုကြည်လင်ဝင်းပလာမှာပါ။",
        'en' => "Dry skin is like a delicate flower. With a little extra hydration, you'll glow brighter than anyone."
    ],
    'Oily Skin' => [
        'mm' => "အဆီပြ န်တာဟာ သင့်အသားအရေက သဘာဝအတိုင်း ငယ်ရွယ်နုပျိုမှုကို ထိန်းသိမ်းဖို့ ကြိုးစားနေတာပါ။ ယုံကြည်မှုကသာ အစစ်အမှန် အလှတရား ဖြစ်ပါတယ်။",
        'en' => "Oily skin is your body's natural way of staying youthful. Your inner confidence is your true beauty."
    ],
    'Combination Skin' => [
        'mm' => "ကွဲပြားတဲ့ အလှတရားနှစ်ခုကို ပိုင်ဆိုင်ထားတာဟာ ထူးခြားမှုတစ်ခုပါပဲ။ ကိုယ့်ရဲ့ ထူးခြားမှုကို လက်ခံလိုက်တဲ့အခါ သင်ဟာ ပိုပြီး လှပလာပါလိမ့်မယ်။",
        'en' => "Owning two unique skin textures is a gift. Embrace your uniqueness to become more radiant."
    ],
    'Normal Skin' => [
        'mm' => "မျှတတဲ့အလှတရားကို ပိုင်ဆိုင်ထားတာဟာ ကံကောင်းခြင်းတစ်ခုပါ။ ဒီအလှတရားကို တန်ဖိုးထားပြီး ဆက်လက်ထိန်းသိမ်းပါ။",
        'en' => "Being perfectly balanced is a blessing. Treasure this harmony and keep your smile glowing."
    ],
    'Sensitive Skin' => [
        'mm' => "သင်ဟာ အရမ်းကို နုညံ့သိမ်မွေ့တဲ့ အသားအရေကို ပိုင်ဆိုင်ထားတာပါ။ ဒါဟာ သင့်ကိုယ်သင် ပိုပြီး ယုယယုယနဲ့ ဂရုစိုက်ပေးဖို့ သတိပေးချက်လေးပါပဲ။",
        'en' => "You possess a delicate skin type. It's a reminder to treat yourself with extra love and care."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlowLab | Your Result</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;600&display=swap');
        
        :root { --beige: #fdf5e6; --pink: #fce4ec; --gold: #d4a373; --dark-rose: #880e4f; }
        body { background: linear-gradient(135deg, var(--beige), var(--pink)); font-family: 'Poppins', 'Pyidaungsu', sans-serif; margin: 0; padding: 40px 20px; display: flex; justify-content: center; }
        
        .lang-link { position: fixed; top: 25px; right: 30px; text-decoration: none; color: #721c24; background: #f8d7da; padding: 10px 20px; border-radius: 25px; font-weight: bold; font-size: 0.85rem; box-shadow: 0 4px 10px rgba(0,0,0,0.1); z-index: 1000; }

        .card { background: white; max-width: 550px; width: 100%; border-radius: 35px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.05); text-align: center; }
        
        .skin-img { width: 100%; height: 280px; object-fit: cover; }
        
        .content { padding: 40px; }
        .intro-text { text-transform: uppercase; letter-spacing: 2px; font-size: 0.75rem; color: #bbb; margin-bottom: 5px; }
        .user-name { font-family: 'Playfair Display', serif; font-style: italic; font-size: 2.5rem; margin: 0 0 25px; color: #444; }
        
        .badge { background: var(--gold); color: white; padding: 10px 30px; border-radius: 50px; display: inline-block; font-weight: bold; margin-bottom: 10px; }
        
        .tips-box { text-align: left; background: #fafafa; padding: 25px; border-radius: 20px; border-left: 6px solid var(--gold); margin: 25px 0; }
        .tips-box h3 { margin-top: 0; color: var(--gold); font-size: 1.1rem; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        
        .gift-section { background: #fff9fa; border: 2px dashed #f1b0b7; border-radius: 20px; padding: 25px; margin: 30px 0; }
        .gift-title { color: var(--dark-rose); font-weight: bold; font-size: 0.95rem; margin-bottom: 12px; display: block; }
        .gift-text { font-style: italic; color: #6d4c41; line-height: 1.6; font-size: 0.95rem; }

        .dashboard-btn { display: block; background: var(--gold); color: white; text-decoration: none; padding: 18px; border-radius: 15px; font-weight: bold; transition: 0.3s; box-shadow: 0 10px 20px rgba(212, 163, 115, 0.2); text-transform: uppercase; letter-spacing: 1px; }
        .dashboard-btn:hover { background: #c38e5b; transform: translateY(-3px); }
        .retake-link { display: inline-block; margin-top: 20px; color: #999; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>

<a href="?lang=<?= $lang == 'en' ? 'mm' : 'en' ?>" class="lang-link">
    <?= $lang == 'en' ? 'Switch to MM' : 'Switch to ENG' ?>
</a>

<div class="card">
    <img src="images/<?= htmlspecialchars(basename($display_image)) ?>" 
     class="skin-img" 
     alt="Skin Analysis"
     onerror="this.src='images/normal.png'">
    
    <div class="content">
        <p class="intro-text">Personal Analysis for</p>
        <h1 class="user-name"><?= htmlspecialchars($_SESSION['username'] ?? 'Beautiful Guest') ?></h1>
        
        <div class="badge"><?= htmlspecialchars($skin) ?></div>

        <div class="tips-box">
            <h3>✨ Recommended Beauty Strategy</h3>
            <p style="line-height: 1.8; color: #6d4c41; margin: 0; white-space: pre-line;">
                <?= $lang == 'mm' ? $row['tip_text_mm'] : $row['tip_text_en'] ?>
            </p>
        </div>

        <div class="gift-section">
            <span class="gift-title">🎁 <?= $lang == 'mm' ? 'ဒါလေးကတော့ GlowLab ရဲ့ လက်ဆောင်လေးပါ' : 'A special gift from GlowLab to you' ?></span>
            <p class="gift-text">" <?= $motivation_gift[$skin][$lang] ?> "</p>
        </div>

        <a href="user.php" class="dashboard-btn">Go To My Dashboard</a>
        <a href="questionnarie.php?reset=true" class="retake-link">← Retake Test</a>
    </div>
</div>

</body>
</html>