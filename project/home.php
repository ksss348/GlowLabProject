
<?php

include 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>GlowLab | Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home-modern.css">
<link rel="stylesheet" href="css/header-enhancement.css">
</head>
<body>
   <div class="preloader">
   <div class="preloader-spinner"></div>
</div>
   
<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="home">
   <div class="home-container">
      <div class="content scroll-reveal-left">
         <h3>Glow Your Skin with <span>GlowLab</span></h3>
         <p>
            Personalized skincare solutions, expert consultation,
            and hand-picked products delivered to your door.
         </p>
         <a href="questionnarie.php" class="white-btn">Take Your Skin Quiz</a>
      </div>

      <div class="image scroll-reveal-right">
         <img src="images/hero1.jpg" alt="Skincare illustration">
      </div>
   </div>
</section>


<!-- SKIN CONCERNS -->
<section class="skinConcerns">

   <h1 class="title scroll-reveal">What’s Your Skin Concern?</h1>
   <p class="subtitle scroll-reveal">
      Choose your main concern and let GlowLab recommend the
      best routine, products, and consultants for your skin.
   </p>

   <div class="concern-grid">

      <a href="questionnarie.php?concern=dry" class="concern-card scroll-reveal-scale">
         <img src="images/dryskin.jpg" alt="Dry Skin">
         <h3>Dry Skin</h3>
      </a>

      <a href="questionnarie.php?concern=oily" class="concern-card scroll-reveal-scale">
         <img src="images/oilyskin.jpg" alt="Oily Skin">
         <h3>Oily Skin</h3>
      </a>

      <a href="questionnarie.php?concern=aging" class="concern-card scroll-reveal-scale">
         <img src="images/aging.jpg" alt="Aging Skin">
         <h3>Aging Skin</h3>
      </a>

      <a href="questionnarie.php?concern=hyperpigmentation" class="concern-card scroll-reveal-scale">
         <img src="images/pigmentation.jpg" alt="Hyperpigmentation">
         <h3>Hyperpigmentation</h3>
      </a>

      <a href="questionnarie.php?concern=dark_circles" class="concern-card scroll-reveal-scale">
         <img src="images/darkCircle.jpg" alt="Dark Circles">
         <h3>Dark Circles</h3>
      </a>

      <a href="questionnarie.php?concern=pores" class="concern-card scroll-reveal-scale">
         <img src="images/pore.jpg" alt="Large Pores">
         <h3>Large Pores</h3>
      </a>

      <a href="questionnarie.php?concern=scars" class="concern-card scroll-reveal-scale">
         <img src="images/scar.jpg" alt="Scars">
         <h3>Scars</h3>
      </a>

      <a href="questionnarie.php?concern=acne" class="concern-card scroll-reveal-scale">
         <img src="images/acne.jpg" alt="Acne">
         <h3>Acne</h3>
      </a>

      <a href="questionnarie.php?concern=acne" class="concern-card scroll-reveal-scale">
         <img src="images/redness.jpg" alt="Redness">
         <h3>Redness</h3>
      </a>

      <a href="questionnarie.php?concern=acne" class="concern-card scroll-reveal-scale">
         <img src="images/dull.jpg" alt="Dull">
         <h3>Dull</h3>
      </a>

   </div>

   <div class="concern-cta scroll-reveal">
      <a href="questionnarie.php" class="white-btn">Get Personalized Routine</a>
   </div>

</section>


<!-- HOW GLOWLAB WORKS -->
<section class="how-it-works">

   <h1 class="title scroll-reveal">How GlowLab Works</h1>
   <p class="subtitle scroll-reveal">
      Science-backed skincare, expert guidance, and products designed for your skin.
   </p>

   <!-- STEP INDICATOR -->
   <!-- STEP BAR -->
<div class="step-bar">
   <div class="step-tab active" data-step="0">01</div>
   <div class="step-tab" data-step="1">02</div>
   <div class="step-tab" data-step="2">03</div>
</div>


   <!-- SLIDER -->
   <div class="steps-slider">

      <!-- STEP 1 -->
      <div class="step-card active">
         <span class="step-number">01</span>
         <img src="images/analysis.jpg" alt="Skin Analysis">
         <h3>Analyze Your Skin</h3>
         <p>
            Take a quick skin quiz to identify your skin type,
            concerns, lifestyle, and goals. We build your
            personalized skin profile.
         </p>
      </div>

      <!-- STEP 2 -->
      <div class="step-card">
         <span class="step-number">02</span>
         <h3>Talk to Certified Consultants</h3>

         <div class="consultant-preview">
            <img src="images/consultant1.jpg" alt="Consultant">
            <img src="images/consultant2.jpg" alt="Consultant">
            <img src="images/consultant3.jpg" alt="Consultant">
         </div>

         <p>
            Chat with licensed skincare consultants who review
            your profile and guide you with expert advice.
         </p>
      </div>

      <!-- STEP 3 -->
      <div class="step-card">
         <span class="step-number">03</span>
         <img src="images/products.jpg" alt="Products">
         <h3>Get Products Made for You</h3>
         <p>
            Receive personalized product routines and
            GlowLab-approved skincare delivered to your door.
         </p>
      </div>

   </div>

   <!-- NAV BUTTONS -->
   <div class="step-nav">
      
 <button type="button" class="btn-back">Back</button>
 <button type="button" class="btn-next">Next</button>

   </div>

</section>

<section class="routine-preview">

   <h1 class="title scroll-reveal">Your Personalized Skin Routine</h1>
   <p class="subtitle scroll-reveal">
      After analyzing your skin, GlowLab creates a routine designed
      specifically for your needs — morning, night, and weekly care.
   </p>

   <div class="routine-grid">

      <!-- Morning -->
      <div class="routine-card scroll-reveal-left">
         <span class="routine-icon">🌞</span>
         <h3>Morning Routine</h3>
         <ul>
            <li>Gentle Cleanser</li>
            <li>Vitamin C Serum</li>
            <li>Moisturizer</li>
            <li>SPF Protection</li>
         </ul>
      </div>

      <!-- Night -->
      <div class="routine-card featured scroll-reveal-scale">
         <span class="routine-icon">🌙</span>
         <h3>Night Routine</h3>
         <ul>
            <li>Deep Cleanse</li>
            <li>Repair Serum</li>
            <li>Target Treatment</li>
            <li>Hydrating Cream</li>
         </ul>
      </div>

      <!-- Weekly -->
      <div class="routine-card scroll-reveal-right">
         <span class="routine-icon">🧴</span>
         <h3>Weekly Care</h3>
         <ul>
            <li>Exfoliation</li>
            <li>Face Mask</li>
            <li>Barrier Repair</li>
         </ul>
      </div>

   </div>

   <div class="routine-cta scroll-reveal">
      <a href="questionnarie.php" class="white-btn">
         Get My Personalized Routine
      </a>
   </div>

</section>

<section class="best-sellers">

   <h1 class="title scroll-reveal">Best-Selling Products</h1>
   <p class="subtitle scroll-reveal">
      GlowLab favorites trusted by thousands of happy skin journeys.
   </p>

   <div class="product-grid">

      <!-- Product 1 -->
      <div class="product-card scroll-reveal-scale">
         <img src="images/product1.jpg" alt="Product">
         <h3>HydraGlow Cleanser</h3>
         <span class="price">50,000 Ks</span>
         <a href="index.php?view=detail&id=26" class="product-btn">View Details</a>
      </div>

      <!-- Product 2 -->
      <div class="product-card featured scroll-reveal-scale">
         <img src="images/product2.jpg" alt="Product">
         <h3>Radiance Serum</h3>
         <span class="price">45,000 Ks</span>
         <a href="index.php?view=detail&id=27" class="product-btn">View Details</a>
      </div>

      <!-- Product 3 -->
      <div class="product-card scroll-reveal-scale">
         <img src="images/product3.jpg" alt="Product">
         <h3>Soothing Moisturizer</h3>
         <span class="price">35,000 Ks</span>
         <a href="index.php?view=detail&id=28" class="product-btn">View Details</a>
      </div>

      <!-- Product 4 -->
      <div class="product-card scroll-reveal-scale">
         <img src="images/product4.jpg" alt="Product">
         <h3>ClearSkin Toner</h3>
         <span class="price">30,000 Ks</span>
         <a href="index.php?view=detail&id=29" class="product-btn">View Details</a>
      </div>

   </div>

</section>

<section class="testimonials">

   <h1 class="title scroll-reveal">Real Results. Real Confidence.</h1>
   <p class="subtitle scroll-reveal">
      See how GlowLab transformed real skin journeys.
   </p>

   <div class="testimonial-grid">

      <!-- Testimonial 1 -->
      <div class="testimonial-card scroll-reveal-left">
         <div class="before-after">
            <img src="images/before1.jpg" alt="Before">
            <img src="images/after1.jpg" alt="After">
         </div>
         <p class="quote">
            “My acne cleared in just 6 weeks. The consultant truly understood my skin.”
         </p>
         <h4>— Emily, 22</h4>
      </div>

      <!-- Testimonial 2 -->
      <div class="testimonial-card featured scroll-reveal-scale">
         <div class="before-after">
            <img src="images/before2.jpg" alt="Before">
            <img src="images/after2.jpg" alt="After">
         </div>
         <p class="quote">
            “GlowLab gave me confidence again. My skin feels healthy and radiant.”
         </p>
         <h4>— Sarah, 29</h4>
      </div>

      <!-- Testimonial 3 -->
      <div class="testimonial-card scroll-reveal-left">
         <div class="before-after">
            <img src="images/before3.jpg" alt="Before">
            <img src="images/after3.jpg" alt="After">
         </div>
         <p class="quote">
            “Personalized products actually work. Worth every penny.”
         </p>
         <h4>— May, 25</h4>
      </div>

   </div>

</section>



<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="js/home-animations.js"></script>
</body>
</html>

