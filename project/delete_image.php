<?php
include 'db_connect.php';
session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // 1. Fetch the current image filename from the database
    $select_query = mysqli_query($conn, "SELECT image FROM `users` WHERE id = '$user_id'") or die('query failed');
    $fetch_user = mysqli_fetch_assoc($select_query);
    $old_image = $fetch_user['image'];

    // 2. Remove the physical file from the server folder
    if (!empty($old_image) && file_exists('uploaded_img/' . $old_image)) {
        unlink('uploaded_img/' . $old_image);
    }

    // 3. Update the database to clear the image field
    $update_query = mysqli_query($conn, "UPDATE `users` SET image = '' WHERE id = '$user_id'") or die('query failed');

    if ($update_query) {
        // 4. Update the session so the UI shows the default avatar immediately
        unset($_SESSION['image']);
        header('location:user.php?message=image_deleted');
    } else {
        header('location:user.php?error=delete_failed');
    }
} else {
    header('location:registration.php');
}
?>