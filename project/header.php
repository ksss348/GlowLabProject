<header class="header">

   <!-- TOP BAR -->
   <div class="header-1">
      <div class="flex">
         <div class="share">
   <a href="#"><img src="images/facebook.png" alt="Facebook" width="24"></a>
   <a href="#"><img src="images/twitter.png" alt="Twitter" width="24"></a>
   <a href="#"><img src="images/instagram.png" alt="Instagram" width="24"></a>
   <a href="#"><img src="images/linkedin.png" alt="LinkedIn" width="24"></a>
         </div>

         <?php if(isset($_SESSION['id'])){ ?>
            <p>Welcome, <strong><?= $_SESSION['username']; ?></strong></p>
         <?php } else { ?>
            <p>
               <a href="registration.php#loginForm">Login</a>
               <a href="registration.php">Register</a>
            </p>
         <?php } ?>
      </div>
   </div>

   <!-- MIDDLE BAR -->
   <div class="header-3">
      <div class="flex">

         <!-- LOGO -->
         <a href="home.php" class="logo">
            <img src="images/logo.png" alt="GlowLab">
         </a>

         <!-- SEARCH -->
         <form action="index.php" method="get" class="search-box">
            <input type="text" name="search" placeholder="Search skincare, products..." required>
           <button type="submit" aria-label="Search">
    <img src="images/search.png" alt="Search" width="20">
</button>
         </form>

         <!-- ICONS -->
         <div class="icons">
           <a href="user.php"><img src="images/user.png" alt="User" width="24"></a>
            <a href="index.php?view=cart" style="position:relative; display:inline-block;">
    <img src="images/cart.png" alt="Cart" width="24">
    <span style="position:absolute; top:-12px; right:-12px; background:var(--main); color:#fff; font-size:10px; padding:4px 8px; border-radius:50%; font-weight:bold;">
        <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
    </span>
</a>

         </div>

      </div>
   </div>

   <!-- USER DROPDOWN -->
   <div class="user-box">
      <?php if(isset($_SESSION['id'])) { ?>
         <p>username : <span><?= $_SESSION['username']; ?></span></p>
         <p>email : <span><?= $_SESSION['email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Logout</a>
      <?php } else { ?>
         <p style="text-align:center;border:none;margin-bottom:1rem;">
            Please login to continue
         </p>
         <a href="registration.php" class="delete-btn">
            Login / Register
         </a>
      <?php } ?>
   </div>

   <!-- MAIN NAV -->
   <div class="header-2">
      <div class="flex">

         <!-- MOBILE TOGGLE -->
         <button class="mobile-menu-toggle" id="mobile-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
         </button>

         <nav class="navbar" id="navbar">
            <a href="home.php">Home</a>

            <?php if(isset($_SESSION['id']) && $_SESSION['username'] === 'admin'){ ?>
               <a href="admin_dashboard.php">Admin Panel</a>
            <?php } ?>

            <a href="questionnarie.php">Skin Analysis</a>
            <a href="searchpage.php">Consultants</a>
            <a href="index.php">Products</a>
            <a href="blogs.php">Tips</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
         </nav>

      </div>
   </div>

</header>

<!-- MOBILE OVERLAY -->
<div class="mobile-overlay" id="mobile-overlay"></div>

<script>
/* ===============================
   USER DROPDOWN
================================ */
const userBtn = document.querySelector('#user-btn');
const userBox = document.querySelector('.user-box');

if (userBtn && userBox) {
   userBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      userBox.classList.toggle('active');
   });

   document.addEventListener('click', (e) => {
      if (!userBox.contains(e.target) && !userBtn.contains(e.target)) {
         userBox.classList.remove('active');
      }
   });
}

/* ===============================
   MOBILE MENU
================================ */
const mobileToggle = document.querySelector('#mobile-toggle');
const navbar = document.querySelector('#navbar');
const mobileOverlay = document.querySelector('#mobile-overlay');

if (mobileToggle && navbar && mobileOverlay) {
   mobileToggle.addEventListener('click', () => {
      navbar.classList.toggle('active');
      mobileOverlay.classList.toggle('active');
      mobileToggle.classList.toggle('active');
      document.body.style.overflow = navbar.classList.contains('active') ? 'hidden' : '';
   });

   mobileOverlay.addEventListener('click', () => {
      navbar.classList.remove('active');
      mobileOverlay.classList.remove('active');
      mobileToggle.classList.remove('active');
      document.body.style.overflow = '';
   });

   navbar.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
         navbar.classList.remove('active');
         mobileOverlay.classList.remove('active');
         mobileToggle.classList.remove('active');
         document.body.style.overflow = '';
      });
   });
}

/* ===============================
   ACTIVE NAV LINK
================================ */
const currentPage = window.location.pathname.split('/').pop();
document.querySelectorAll('.navbar a').forEach(link => {
   const page = link.getAttribute('href');
   if (page === currentPage || (currentPage === '' && page === 'home.php')) {
      link.classList.add('active');
   }
});
</script>
