<?php
include 'db_connect.php';
session_start();

if (isset($_FILES['update_image'])) {
    $user_id = $_SESSION['id'];
    
    // File details
    $image_name = $_FILES['update_image']['name'];
    $image_size = $_FILES['update_image']['size'];
    $image_tmp_name = $_FILES['update_image']['tmp_name'];
    
    // 1. Setup naming and paths
    $extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $new_image_name = 'user_' . $user_id . '_' . time() . '.' . $extension; // Unique name
    $image_folder = 'uploaded_img/' . $new_image_name;

    // 2. Constraints & Validation
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
    
    if (!in_array(strtolower($extension), $allowed_extensions)) {
        header('location:user.php?error=invalid_type');
        exit();
    }

    if ($image_size > 2000000) { // 2MB Limit
        header('location:user.php?error=image_too_large');
        exit();
    }

    // 3. Cleanup: Get the old image to delete it from the folder
    $select_old = mysqli_query($conn, "SELECT image FROM `users` WHERE id = '$user_id'") or die('query failed');
    $fetch_old = mysqli_fetch_assoc($select_old);
    $old_image = $fetch_old['image'];

    // 4. Update Database
    $update_query = mysqli_query($conn, "UPDATE `users` SET image = '$new_image_name' WHERE id = '$user_id'") or die('query failed');

    if ($update_query) {
        // Create folder if it doesn't exist
        if (!is_dir('uploaded_img')) {
            mkdir('uploaded_img', 0777, true);
        }

        // Upload new file
        if (move_uploaded_file($image_tmp_name, $image_folder)) {
            // Delete old file from server if it exists and isn't empty
            if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
                unlink('uploaded_img/' . $old_image);
            }
            
            // Update Session
            $_SESSION['image'] = $new_image_name;
            header('location:user.php?message=image_updated');
        } else {
            header('location:user.php?error=upload_failed');
        }
    }
} else {
    header('location:user.php');
}
?>