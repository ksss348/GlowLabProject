<?php
include 'db.php';
session_start();

if(isset($_POST['update_name'])){
   $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
   $update_phone = mysqli_real_escape_string($conn, $_POST['update_phone']);
   $user_id = $_SESSION['id'];

   // 1. Check if the phone number is already taken by ANOTHER user
   $check_phone = mysqli_query($conn, "SELECT * FROM `users` WHERE phone = '$update_phone' AND id != '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_phone) > 0){
      // Phone is already in use by someone else
      header('location:user.php?error=phone_taken');
      exit();
   }

   // 2. Proceed with update if validation passes
   mysqli_query($conn, "UPDATE `users` SET username = '$update_name', phone = '$update_phone' WHERE id = '$user_id'") or die('query failed');

   // Update sessions so the UI reflects the changes
   $_SESSION['username'] = $update_name;
   $_SESSION['phone'] = $update_phone;

   header('location:user.php?message=profile_updated');
}
?>