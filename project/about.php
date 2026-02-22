<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About Us | GlowLab</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-enhancement.css">
   <link rel="stylesheet" href="css/about-style.css">
</head>
<body>

<?php include 'header.php'; ?>

<!-- ABOUT GROUP -->
<section class="about-group">

   <div class="group-header">
      <h2>Group-4 | Section-D</h2>
      <h1>GlowLab</h1>
      <p>
         GlowLab is a skincare consultation and e-commerce website developed
         as a school group project. Our platform helps users analyze their skin,
         consult professionals, and purchase suitable skincare products.
      </p>
   </div>

   <h2 class="team-title">Our Team Members</h2>

   <div class="team-grid">

      <!-- MEMBER 1 -->
      <div class="team-card">
         <img src="images/mya.jpg" alt="Mya Thida">
         <h3>Mya Thida</h3>
         <span class="role">Integration & UI Lead</span>
         <ul>
            <li>System Integration</li>
            <li>Home Page Development</li>
            <li>User Interface (UI)</li>
            <li>Final Testing & Demo</li>
         </ul>
      </div>

      <!-- MEMBER 2 -->
      <div class="team-card">
          <img src="images/kyal.jpg" alt="Kyal Sin Su San">
         <h3>Kyal Sin Su San</h3>
         <span class="role">Skin Analysis Module</span>
         <ul>
            <li>Skin Questionnaire Page</li>
            <li>Auto Skin Analysis Result</li>
            <li>User Skin Profile Generation</li>
            <li>Blog & Skincare Tips Pages</li>
         </ul>
      </div>

      <!-- MEMBER 3 -->
      <div class="team-card">
         <img src="images/phoo.jpg" alt="Phoo Phoo">
         <h3>Phoo Phoo</h3>
         <span class="role">Consultation Module</span>
         <ul>
            <li>Consultant Profile Pages</li>
            <li>Appointment Booking Form</li>
            <li>Consultation Payment Form</li>
         </ul>
      </div>

      <!-- MEMBER 4 -->
      <div class="team-card">
         <img src="images/zin.jpg" alt="Zin Min Thant">
         <h3>Zin Min Thant</h3>
         <span class="role">User Access Module</span>
         <ul>
            <li>Login System</li>
            <li>Registration System</li>
            <li>User Authentication</li>
         </ul>
      </div>

      <!-- MEMBER 5 -->
      <div class="team-card">
         <img src="images/hsu.jpg" alt="Hsu Yi Htet">
         <h3>Hsu Yi Htet</h3>
         <span class="role">Product & Cart Module</span>
         <ul>
            <li>Product Page</li>
            <li>Best Seller Page</li>
            <li>Shopping Cart</li>
            <li>Checkout Functionality</li>
         </ul>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>
