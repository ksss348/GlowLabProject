<?php
session_start();
include('db.php');

$error_user = $error_email = $error_pass = $error_phone = $error_login = $error_forgot = "";
$success_msg = "";
$u_val = $e_val = $p_val = ""; // $p_val for phone number

// --- REGISTER LOGIC ---
if (isset($_POST['register'])) {
    $u_val = mysqli_real_escape_string($conn, $_POST['user']);
    $e_val = mysqli_real_escape_string($conn, $_POST['email']);
    $p_val = mysqli_real_escape_string($conn, $_POST['phone']); // Phone Number ယူမယ်
    $p_raw = $_POST['pass'];
    $ques = mysqli_real_escape_string($conn, $_POST['security_question']);
    $ans = mysqli_real_escape_string($conn, $_POST['security_answer']);

    if (strlen($u_val) < 4) { $error_user = "Username must be at least 4 characters."; }
    
    if (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $p_raw)) {
        $error_pass = "Password must have 8+ chars, 1 Uppercase & 1 Number.";
    }

    // Phone validation (Optional but recommended)
    if (strlen($p_val) < 7) { $error_phone = "Please enter a valid phone number."; }

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$u_val' OR email='$e_val' OR phone='$p_val'");
    if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        if ($row['username'] == $u_val) $error_user = "Username already exists!";
        if ($row['email'] == $e_val) $error_email = "Email already registered!";
        if ($row['phone'] == $p_val) $error_phone = "Phone number already in use!";
    }

    if (!$error_user && !$error_email && !$error_pass && !$error_phone) {
        $hashed_p = password_hash($p_raw, PASSWORD_DEFAULT);
        // phone ပါ ထည့်သွင်းသိမ်းဆည်းမယ်
        $sql = "INSERT INTO users (username, email, phone, password, security_question, security_answer) 
                VALUES ('$u_val', '$e_val', '$p_val', '$hashed_p', '$ques', '$ans')";
        if (mysqli_query($conn, $sql)) {
            $success_msg = "Account Created Successfully! Please Login.";
            $u_val = $e_val = $p_val = ""; 
        }
    }
}

// --- FORGOT PASSWORD LOGIC (မပြောင်းလဲပါ) ---
if (isset($_POST['forgot'])) {
    $email = mysqli_real_escape_string($conn, $_POST['f_email']);
    $ans = mysqli_real_escape_string($conn, $_POST['f_answer']);
    $new_p = $_POST['f_pass'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND security_answer='$ans'");
    if (mysqli_num_rows($check) > 0) {
        $hashed_new_p = password_hash($new_p, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$hashed_new_p' WHERE email='$email'");
        $success_msg = "Password Reset Successful! You can now login.";
    } else {
        $error_forgot = "Incorrect Email or Security Answer!";
    }
}

// --- LOGIN LOGIC ---
if (isset($_POST['login'])) {
    $u = mysqli_real_escape_string($conn, $_POST['user']);
    $p = $_POST['pass'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' OR email='$u' OR phone='$u'");
    $row = mysqli_fetch_assoc($res);

   if ($row && password_verify($p, $row['password'])) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone'] = $row['phone']; // Dashboard မှာ သုံးဖို့ Phone ကို Session ထဲ ထည့်လိုက်ပြီ!
    $_SESSION['image'] = $row['image'];

    // ... password_verify အောင်မြင်ပြီးတဲ့နောက် ...

// မင်းကုဒ်ထဲက $row['username'] === 'admin' နေရာမှာ ဒါလေး အစားထိုးလိုက်
if ($row['role'] === 'admin') { 
    // Role က admin ဖြစ်ရင် Admin Dashboard ဆီသွားမယ်
    header("Location: admin/admin_dashboard.php"); 
} else {
    // Role က customer ဖြစ်ရင် (ဥပမာ phoophoo) Customer Dashboard ဆီသွားမယ်
    header("Location: user.php");
}
exit();
} else {
        $error_login = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlowLab | Authentication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* မင်းရဲ့ CSS မူရင်းအတိုင်းပဲ ထားထားပါတယ် */
        body { font-family: 'Poppins', sans-serif; background: #f4dce3; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(15px); padding: 30px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 380px; text-align: center; }
        .input-box, select { width: 100%; padding: 12px; margin: 8px 0; border: none; border-radius: 12px; background: #fff; box-sizing: border-box; outline: none; }
        .pass-container { position: relative; }
        .pass-container i { position: absolute; right: 15px; top: 20px; cursor: pointer; color: #b0406d; }
        .err { color: #e74c3c; font-size: 11px; display: block; text-align: left; margin-bottom: 5px; }
        .success-box { background: #dff0d8; color: #3c763d; padding: 10px; border-radius: 10px; margin-bottom: 15px; font-size: 13px; border: 1px solid #d6e9c6; }
        .btn { width: 100%; padding: 14px; background: #d64a7c; color: white; border: none; border-radius: 12px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .hidden { display: none; }
        .toggle-link { color: #d64a7c; cursor: pointer; font-size: 13px; margin-top: 15px; display: block; }
    </style>
</head>
<body>

<div class="card">
    <h2 style="color: #b0406d;">GlowLab</h2>

    <?php if($success_msg) echo "<div class='success-box'>$success_msg</div>"; ?>

    <form id="loginForm" method="POST" class="<?php echo (isset($_POST['register']) || isset($_POST['forgot'])) ? 'hidden' : ''; ?>">
        <?php if($error_login) echo "<span class='err'>$error_login</span>"; ?>
        <input type="text" name="user" class="input-box" placeholder="Username / Email / Phone" required>
        <div class="pass-container">
            <input type="password" name="pass" id="logP" class="input-box" placeholder="Password" required>
            <i class="fa fa-eye" onclick="toggle('logP')"></i>
        </div>
        <button type="submit" name="login" class="btn">Login</button>
        <span class="toggle-link" onclick="showForm('forgotForm')">Forgot Password?</span>
        <span class="toggle-link" onclick="showForm('regForm')">Don't have an account? Sign Up</span>
    </form>

    <form id="regForm" method="POST" class="<?php echo !isset($_POST['register']) ? 'hidden' : ''; ?>">
        <input type="text" name="user" class="input-box" placeholder="Username" value="<?php echo $u_val; ?>" required>
        <?php if($error_user) echo "<span class='err'>$error_user</span>"; ?>
        
        <input type="email" name="email" class="input-box" placeholder="Email" value="<?php echo $e_val; ?>" required>
        <?php if($error_email) echo "<span class='err'>$error_email</span>"; ?>

        <input type="text" name="phone" class="input-box" placeholder="Phone Number (09...)" value="<?php echo $p_val; ?>" required>
        <?php if($error_phone) echo "<span class='err'>$error_phone</span>"; ?>
        
        <div class="pass-container">
            <input type="password" name="pass" id="regP" class="input-box" placeholder="Strong Password" required>
            <i class="fa fa-eye" onclick="toggle('regP')"></i>
        </div>
        <p style="font-size: 10px; color: #888; text-align: left; margin: 0 5px 10px;">💡 Min 8 chars, 1 Uppercase & 1 Number</p>
        <?php if($error_pass) echo "<span class='err'>$error_pass</span>"; ?>

        <select name="security_question" class="input-box" required>
            <option value="">Select Security Question</option>
            <option value="pet">What is your pet's name?</option>
            <option value="city">What is your birth city?</option>
        </select>
        <input type="text" name="security_answer" class="input-box" placeholder="Security Answer" required>
        
        <button type="submit" name="register" class="btn">Create Glow Account</button>
        <span class="toggle-link" onclick="showForm('loginForm')">Already a member? Log In</span>
    </form>

    <form id="forgotForm" method="POST" class="<?php echo !isset($_POST['forgot']) ? 'hidden' : ''; ?>">
        <?php if($error_forgot) echo "<span class='err'>$error_forgot</span>"; ?>
        <input type="email" name="f_email" class="input-box" placeholder="Registered Email" required>
        <input type="text" name="f_answer" class="input-box" placeholder="Security Answer" required>
        <input type="password" name="f_pass" class="input-box" placeholder="New Strong Password" required>
        <button type="submit" name="forgot" class="btn">Reset Password</button>
        <span class="toggle-link" onclick="showForm('loginForm')">Back to Login</span>
    </form>
</div>

<script>
    function showForm(formId) {
        document.getElementById('loginForm').classList.add('hidden');
        document.getElementById('regForm').classList.add('hidden');
        document.getElementById('forgotForm').classList.add('hidden');
        document.getElementById(formId).classList.remove('hidden');
    }
    function toggle(id) {
        var x = document.getElementById(id);
        x.type = (x.type === "password") ? "text" : "password";
    }
</script>

</body>
</html>