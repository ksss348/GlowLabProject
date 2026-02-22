<?php 
include 'language.php'; 

if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    unset($_SESSION['username']);
    unset($_SESSION['quiz_answers']); 
}

if (isset($_GET['name'])) {
    $_SESSION['username'] = $_GET['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlowLab Skin Test</title>
    <style>
        :root { 
        /* Added missing semicolons and corrected variable names */
        --primary-glow: #ff85a2; 
        --bg-soft: #fce4ec; /* A softer pink for the background */
        --pink: #e5a9db;
        --text-dark: #4a4a4a;
        --border-light: #f0f0f0;
    }
body { 
        font-family: 'Segoe UI', sans-serif; 
        /* Changed --bg to --bg-soft to match your root */
        background-color: var(--bg-soft); 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 100vh; 
        margin: 0; 
    }        .lang-link { position: fixed; top: 25px; right: 30px; text-decoration: none; color: #721c24; background: var(--pink); padding: 10px 20px; border-radius: 25px; font-weight: bold; z-index: 1000; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s; }
        .lang-link:hover { background: #f1b0b7; transform: scale(1.05); cursor: pointer; }
        .container { background: white; width: 90%; max-width: 500px; padding: 40px; border-radius: 30px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); position: relative; }
        .progress-container { width: 100%; height: 6px; background: #eee; border-radius: 10px; margin-bottom: 30px; }
        .progress-bar { height: 100%; background: var(--primary-glow); width: 0%; transition: 0.3s; border-radius: 10px; }
        .step { display: none; }
        .step.active { display: block; animation: fadeIn 0.4s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .question-text { font-size: 1.2rem; font-weight: bold; margin-bottom: 25px; display: block; color: #444; }
        .option-item { background: #fafafa; border: 2px solid #eee; padding: 15px; border-radius: 12px; margin-bottom: 12px; cursor: pointer; display: flex; align-items: center; transition: 0.2s; }
        .option-item:hover { border-color: var(--primary); background: #dea3d3; }
        .nav-btns { display: flex; justify-content: space-between; margin-top: 30px; }
        .btn { padding: 12px 25px; border-radius: 12px; border: none; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .btn:hover { opacity: 0.9; transform: translateY(-2px); }
        .btn-next { background: var(--primary-glow); color: pink; flex-grow: 1; 
    margin-left: 10px;
    box-shadow: 0 4px 12px rgba(255, 133, 162, 0.3); }
    .btn-next:hover {
    background: #ff6b8e; /* Slightly deeper on hover */
    transform: translateY(-2px);
}
        .btn-prev { background: #ec8de7; color: #666; }
        .home-link { 
    position: fixed; 
    top: 25px; 
    left: 30px; 
    text-decoration: none; 
    color: #721c24; 
    background: var(--pink); 
    padding: 10px 20px; 
    border-radius: 25px; 
    font-weight: bold; 
    z-index: 1000; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
    transition: 0.3s; 
}
.home-link:hover { 
    background: #f1b0b7; 
    transform: scale(1.05); 
}
    </style>
</head>
<body>
<a href="home.php" class="home-link">
    <i class="fa-solid fa-house"></i> Home
</a>
<a href="#" class="lang-link" onclick="changeLanguage(event)">
    <?= $lang == 'en' ? 'Switch to MM' : 'Switch to ENG' ?>
</a>

<div class="container">
    <div class="progress-container"><div class="progress-bar" id="progressBar"></div></div>
    <form id="skinForm" action="analysis.php" method="POST" autocomplete="off" onsubmit="return validateFinalStep()">
        <div class="step active">
            <span class="question-text"><?= $text['name_label'] ?></span>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($_GET['username'] ?? ($_SESSION['username'] ?? '')) ?>" placeholder="Your Name" required style="width: 100%; padding: 15px; border: 2px solid #eee; border-radius: 12px; font-size: 1.1rem; box-sizing: border-box;">
            <div class="nav-btns">
                <button type="button" class="btn btn-next" onclick="nextStep()">Next</button>
            </div>
            <div style="text-align: center; margin-top: 20px;">
        <a href="home.php" style="color: #3f142b; text-decoration: none; font-size: 0.9rem;">← Back to Home</a>
    </div>
        </div>

        <?php foreach ($text['questions'] as $num => $q): ?>
        <div class="step">
            <span class="question-text"><?= $num ?>. <?= $q[0] ?></span>
            <div class="options">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <?php 
                    $saved_val = $_GET["q$num"] ?? ($_SESSION['quiz_answers']["q$num"] ?? '');
                    $is_checked = ($saved_val == $i) ? 'checked' : '';
                ?>
                <label class="option-item">
                    <input type="radio" name="q<?= $num ?>" value="<?= $i ?>" onclick="handleOptionClick()" <?= $is_checked ?>>
                    <span style="margin-left:10px;"><?= ($lang == 'en') ? $q[$i] : $q[$i+4] ?></span>
                </label>
                <?php endfor; ?>
            </div>
            <div class="nav-btns">
                <button type="button" class="btn btn-prev" onclick="prevStep()">Back</button>
                <?php if($num < 8): ?>
                    <button type="button" class="btn btn-next" onclick="nextStep()">Next</button>
                <?php else: ?>
                    <button type="submit" class="btn btn-next" style="background: #67175c;">Finish</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </form>
</div>

<script>
    let currentStep = 0;
    const steps = document.querySelectorAll(".step");
    const progressBar = document.getElementById("progressBar");

    function showStep(n) {
        steps.forEach(s => s.classList.remove("active"));
        steps[n].classList.add("active");
        let totalSteps = steps.length - 1;
        let progressPercentage = (n / totalSteps) * 100;
        progressBar.style.width = progressPercentage + "%";
        //progressBar.style.width = (n / (steps.length - 1)) * 100 + "%";
    }
    

    function nextStep() {
        if (currentStep === 0) {
            const nameInput = document.getElementById("username").value.trim();
            if (nameInput === "") {
                alert("Please enter your name first!");
                return;
            }
        } else {
            const currentOptions = steps[currentStep].querySelectorAll('input[type="radio"]');
            let checked = false;
            currentOptions.forEach(opt => { if(opt.checked) checked = true; });
            
            if (!checked) {
                alert("Please select an option before moving forward!");
                return;
            }
        }

        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function handleOptionClick() {
        setTimeout(nextStep, 300);
    }

    function validateFinalStep() {
        // နောက်ဆုံး step မှာပဲ validation စစ်ဖို့
        if (currentStep < steps.length - 1) return true;

        const lastOptions = steps[currentStep].querySelectorAll('input[type="radio"]');
        let checked = false;
        lastOptions.forEach(opt => { if(opt.checked) checked = true; });
        
        if (!checked) {
            alert("Please select an answer for the final question!");
            return false;
        }
        return true;
    }

    // Enter Key Fix
    document.getElementById("skinForm").onkeypress = function(e) {
        if ((e.charCode || e.keyCode || 0) == 13) {
            e.preventDefault(); 
            if (currentStep < steps.length - 1) {
                nextStep();
            } else {
                if (validateFinalStep()) {
                    document.getElementById("skinForm").submit();
                }
            }
            return false;
        }
    };

    function changeLanguage(e) {
        e.preventDefault();
        let targetLang = "<?= $lang == 'en' ? 'mm' : 'en' ?>";
        const form = document.getElementById("skinForm");
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        const name = document.getElementById("username").value;
        params.set('lang', targetLang);
        params.set('step', currentStep);
        window.location.href = `?${params.toString()}`;
    }

    
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const stepFromUrl = urlParams.get('step');
        if (stepFromUrl) {
            currentStep = parseInt(stepFromUrl);
            showStep(currentStep);
        }
    };
</script>
</body>
</html>