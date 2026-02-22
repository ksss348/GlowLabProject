<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';
session_start();

// Redirect to login if not logged in
if(!isset($_SESSION['id'])){
   header('location:registration.php');
   exit();
}

// --- CONNECTIONS ---
// Ensure these credentials match your environment
$c_shop = mysqli_connect("localhost", "root", "", "skincare_shop");
$c_health = mysqli_connect("localhost", "root", "", "healthcare_db");

$user_id = $_SESSION['id'];

// SAFETY CHECK: If session data is missing, fetch from main DB
if(!isset($_SESSION['username']) || !isset($_SESSION['phone'])){
    $user_fetch = mysqli_query($conn, "SELECT username, email, phone, image FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($user_fetch);
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['phone'] = $user_data['phone'];
    $_SESSION['image'] = $user_data['image'];
}

$phone = $_SESSION['phone'];
$current_username = $_SESSION['username'];

// --- FETCH SKIN ANALYSIS DATA ---
$skin_query = "SELECT u.skin_type, t.tip_text_en 
               FROM users u 
               LEFT JOIN skincare_tips t ON u.skin_type = t.skin_type 
               WHERE u.id = '$user_id'"; 

$skin_result = mysqli_query($conn, $skin_query);
$user_skin_type = 'Not Analyzed Yet';
$skin_tip = 'Take the analysis to see your personalized tips!';

if ($skin_result && mysqli_num_rows($skin_result) > 0) {
    $skin_data = mysqli_fetch_assoc($skin_result);
    if(!empty($skin_data['skin_type'])) {
        $user_skin_type = $skin_data['skin_type'];
        $skin_tip = $skin_data['tip_text_en']; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Account | GlowLab</title>
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/header-enhancement.css">
   <link rel="stylesheet" href="css/useStyle.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="dashboard">
   <div class="dashboard-container">
      
      <aside class="sidebar">
         <div class="user-info">
            <div class="avatar-wrapper">
               <div class="avatar" onclick="toggleImageOptions()" style="cursor: pointer;">

                  <img src="<?= isset($_SESSION['image']) ? 'uploaded_img/'.$_SESSION['image'] : 'images/user-default.png'; ?>" alt="User">
      <div class="edit-badge"><i class="fas fa-camera"></i></div>
   </div>
            <div id="imageOptions" class="image-options-menu">
                  <a href="#" onclick="document.getElementById('profile_upload').click();">Change Photo</a>
<?php if(isset($_SESSION['image']) && $_SESSION['image'] != ''): ?>  
   <a href="delete_image.php" class="delete-link" onclick="return confirm('Delete profile picture?');">Delete Photo</a>
      <?php endif; ?>
   </div>                  
               <form action="update_image.php" method="POST" enctype="multipart/form-data" id="imageForm">
                  <input type="file" name="update_image" id="profile_upload" style="display:none;" onchange="document.getElementById('imageForm').submit();">
               </form>
            </div>

            <h3><?= htmlspecialchars($_SESSION['username']); ?></h3>
            <p><?= htmlspecialchars($_SESSION['email']); ?></p>
         </div>

         <nav class="side-nav">
            <a href="#profile" class="nav-link active"><i class="fas fa-user"></i> My Profile</a>
            <a href="#skin" class="nav-link"><i class="fas fa-magic"></i> My Skin Profile</a>
            <a href="searchpage.php" class="nav-link"><i class="fas fa-calendar-plus"></i> Book Consultation</a>
            <a href="#appointments" class="nav-link"><i class="fas fa-clock"></i> My Appointments</a>
            <a href="#orders" class="nav-link"><i class="fas fa-shopping-bag"></i> My Orders</a>
            <a href="logout.php" class="nav-link logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
         </nav>
      </aside>

      <main class="main-content">
         <?php
         if(isset($_GET['error'])){
   if($_GET['error'] == 'phone_taken'){
      echo '<p style="color: #e74c3c; font-size: 1.4rem; margin-bottom: 1rem; background: #fff5f5; padding: 10px; border-radius: 10px; border-left: 5px solid #e74c3c;">
            This phone number is already registered to another account.</p>';
   }
}

if(isset($_GET['message'])){
   if($_GET['message'] == 'profile_updated'){
      echo '<p style="color: #27ae60; font-size: 1.4rem; margin-bottom: 1rem; background: #f0fff4; padding: 10px; border-radius: 10px; border-left: 5px solid #27ae60;">
            Profile updated successfully!</p>';
   }
}

         ?>
         
         <div id="profile" class="content-section active">
            <h2 class="section-title">Account Information</h2>
            <div class="info-card">
               <form action="update_profile.php" method="POST">
                  <div class="form-grid">
                     <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="update_name" value="<?= $_SESSION['username']; ?>" placeholder="Enter your name">
                     </div>
                     <div class="input-group">
                        <label>Phone Number</label>
                        <input type="text" name="update_phone" value="<?= $_SESSION['phone'] ?? ''; ?>" placeholder="+95 9xxxxxxx">
                     </div>
                  </div>
                  <div class="input-group">
                     <label>Email Address</label>
                     <input type="email" value="<?= $_SESSION['email']; ?>" readonly style="background: #f9f9f9;">
                  </div>
                  <button type="submit" class="submit-btn">Update Profile</button>
               </form>
            </div>
         </div>


        <div id="skin" class="content-section">
    <h2 class="section-title">My Skin Profile</h2>
    <div class="skin-card" style="background: white; padding: 30px; border-radius: 20px; box-shadow: var(--shadow);">
        
        <p style="font-size: 1.2rem; color: #888; margin-bottom: 5px;">Your Detected Type:</p>
        <div class="skin-badge" style="background: #d4a373; color: white; padding: 12px 25px; border-radius: 50px; display: inline-block; font-size: 1.8rem; font-weight: 600; margin-bottom: 25px;">
            <?= htmlspecialchars($user_skin_type) ?>
        </div>

        <?php if($user_skin_type !== 'Not Analyzed Yet'): ?>
            <div class="tips-box" style="background: #fff9f0; padding: 25px; border-radius: 15px; border-left: 5px solid #d4a373; margin-bottom: 20px;">
                <h3 style="color: #d4a373; font-size: 1.5rem; margin-bottom: 15px;">✨ Expert Recommendations</h3>
                <p style="line-height: 1.8; color: #555; font-size: 1.4rem; white-space: pre-line;">
                    <?= nl2br(htmlspecialchars($skin_tip)) ?>
                </p>
            </div>
            
            <div style="margin-top: 20px;">
                <a href="questionnarie.php" class="submit-btn" style="display: inline-block; width: auto; padding: 12px 30px; text-decoration: none;">
                    Retake Analysis
                </a>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 20px;">
                <p style="font-size: 1.4rem; color: #666;">You haven't completed your skin analysis yet.</p>
                <a href="questionnaire.php" class="submit-btn" style="margin-top: 15px; display: inline-block; text-decoration: none;">Start Quiz Now</a>
            </div>
        <?php endif; ?>
    </div>
</div>


         <div id="appointments" class="content-section">
            <h2 class="section-title">My Appointments</h2>
            <div class="info-card">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Corrected: Using 'consultants' table and selecting 'patient_name'
                        $bk_q = mysqli_query($c_health, "
                            SELECT b.id, b.status, b.patient_name, d.name AS doctor_name 
                            FROM bookings b
                            JOIN consultants d ON b.doctor_id = d.id 
                            WHERE b.phone = '$phone' 
                            ORDER BY b.id DESC
                        ");
                        
                        if($bk_q && mysqli_num_rows($bk_q) > 0) {
                            while($bk = mysqli_fetch_assoc($bk_q)) {
                                echo "<tr>
                                        <td>#{$bk['id']}</td>
                                        <td>".htmlspecialchars($bk['patient_name'])."</td>
                                        <td> ".htmlspecialchars($bk['doctor_name'])."</td>
                                        <td><span class='status-pill'>".htmlspecialchars($bk['status'])."</span></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' style='text-align:center;'>No appointments found for $phone.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
         </div>

         <div id="orders" class="content-section">
            <h2 class="section-title">My Orders</h2>
            <div class="info-card">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $ord_q = mysqli_query($c_shop, "SELECT * FROM orders WHERE phone='$phone' ORDER BY id DESC");
                       if($ord_q && mysqli_num_rows($ord_q) > 0) {
                           while($ord = mysqli_fetch_assoc($ord_q)) {
                               $oid = $ord['id'];
                               // Fetch product names for this order
                               $items_q = mysqli_query($c_shop, "SELECT p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = '$oid'");
                               $items = [];
                               while($i = mysqli_fetch_assoc($items_q)) { $items[] = $i['name']; }
                               $item_list = implode(", ", $items) ?: "No Items";
                               
                               echo "<tr>
                                        <td>#$oid</td>
                                        <td><b>".htmlspecialchars($item_list)."</b></td>
                                        <td>" . number_format($ord['total_price']) . " MMK</td>
                                        <td><span class='status-pill'>".htmlspecialchars($ord['status'])."</span></td>
                                      </tr>";
                           }
                       } else {
                           echo "<tr><td colspan='4' style='text-align:center;'>No orders found.</td></tr>";
                       }
                       ?>
                    </tbody>
                </table>
            </div>
         </div>
      </main>
   </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.content-section');

    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                const targetId = href.substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));

                    this.classList.add('active');
                    targetSection.classList.add('active');
                }
            }
        });
    });
});
function toggleImageOptions() {
    const menu = document.getElementById('imageOptions');
    // Toggle between show and hide
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}

// Close the menu if the user clicks anywhere else on the page
window.onclick = function(event) {
    if (!event.target.matches('.avatar') && !event.target.closest('.avatar')) {
        const menu = document.getElementById('imageOptions');
        if (menu) menu.style.display = 'none';
    }
}

</script>

</body>
</html>