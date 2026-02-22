<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(isset($_POST['send'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message sent successfully!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact Us - GlowLab</title>
   
   <script src="https://cdn.tailwindcss.com"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
      body { background-color: #fdf2f8; }
      .text-glow { color: #be185d; }
      .bg-glow { background-color: #be185d; }
      
      /* Centered Home Button Style */
      .home-btn-container {
         display: flex;
         justify-content: center;
         padding-top: 2rem;
         width: 100%;
      }
      .home-btn {
         display: flex;
         align-items: center;
         gap: 10px;
         background: white;
         padding: 10px 30px;
         border-radius: 50px;
         font-weight: 800;
         color: #be185d;
         box-shadow: 0 10px 20px rgba(190, 24, 93, 0.1);
         transition: all 0.3s ease;
         text-decoration: none;
         border: 1px solid #fce7f3;
      }
      .home-btn:hover {
         transform: scale(1.05);
         background: #be185d;
         color: white;
      }

      /* Form Styling */
      .contact-card {
         background: white;
         border-radius: 2.5rem;
         box-shadow: 0 25px 50px -12px rgba(190, 24, 93, 0.15);
         border: 1px solid #fbcfe8;
      }
      .input-box {
         width: 100%;
         background-color: #fdf2f8;
         border: 2px solid transparent;
         padding: 1rem 1.5rem;
         border-radius: 1rem;
         margin-bottom: 1.5rem;
         outline: none;
         transition: all 0.3s ease;
      }
      .input-box:focus {
         border-color: #be185d;
         background-color: white;
         box-shadow: 0 0 0 4px rgba(190, 24, 93, 0.05);
      }
      .gradient-text {
         background: linear-gradient(to right, #be185d, #7e22ce);
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
      }
   </style>
</head>
<body class="font-sans">

<div class="home-btn-container">
    <a href="home.php" class="home-btn">
        <i class="fas fa-home"></i>
        <span>BACK TO HOME</span>
    </a>
</div>

<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="max-w-md mx-auto mt-5 bg-pink-100 border border-pink-400 text-pink-700 px-4 py-3 rounded-xl relative text-center font-bold" role="alert">
         <span>'.$msg.'</span>
         <i class="fas fa-times cursor-pointer ml-4" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="max-w-4xl mx-auto py-16 px-4">
   
   <div class="text-center mb-12">
      <p class="text-glow font-bold tracking-[0.3em] text-xs uppercase mb-3">Get in Touch</p>
      <h1 class="text-4xl md:text-5xl font-black text-gray-900">
         Have Questions? <span class="gradient-text">Say Something!</span>
      </h1>
   </div>

   <section class="contact-card p-8 md:p-12">
      <form action="" method="post">
         <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
               <label class="block ml-2 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Full Name</label>
               <input type="text" name="name" required placeholder="Glow User" class="input-box">
            </div>
            <div>
               <label class="block ml-2 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Email Address</label>
               <input type="email" name="email" required placeholder="example@glow.com" class="input-box">
            </div>
         </div>

         <label class="block ml-2 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Phone Number</label>
         <input type="number" name="number" required placeholder="09xxxxxxxxx" class="input-box">

         <label class="block ml-2 mb-2 text-xs font-bold text-gray-500 uppercase tracking-widest">Your Message</label>
         <textarea name="message" class="input-box" placeholder="How can we help you glow today?" cols="30" rows="6"></textarea>

         <button type="submit" name="send" class="w-full bg-glow text-white font-black py-5 rounded-2xl text-sm uppercase tracking-widest hover:bg-pink-800 transition shadow-lg shadow-pink-200 active:scale-95">
            Send Message <i class="fas fa-paper-plane ml-2"></i>
         </button>
      </form>
   </section>

</div>

<?php include 'footer.php'; ?>

</body>
</html>