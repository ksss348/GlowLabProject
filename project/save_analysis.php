<?php
include 'db_connect.php';
session_start();

// Redirect to registration if the session is lost
if(!isset($_SESSION['id'])){
    header('location:registration.php');
    exit();
}

$user_id = $_SESSION['id']; // Use the ID from your main login session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Calculate the score from the questionnaire
    $total_score = 0;
    // If your form uses q1, q2, q3...
    for ($i = 1; $i <= 8; $i++) {
        if (isset($_POST["q$i"])) {
            $total_score += (int)$_POST["q$i"];
        }
    }
    
    // Check if q4 was "Sensitive" (based on your analysis.php logic)
    $q4_value = isset($_POST["q4"]) ? (int)$_POST["q4"] : 0;

    // 2. Determine Skin Type
    if ($q4_value == 4) { 
        $skin_type = "Sensitive Skin"; 
    } elseif ($total_score <= 13) { 
        $skin_type = "Dry Skin"; 
    } elseif ($total_score <= 20) { 
        $skin_type = "Normal Skin"; 
    } elseif ($total_score <= 27) { 
        $skin_type = "Combination Skin"; 
    } else { 
        $skin_type = "Oily Skin"; 
    }

    // 3. UPDATE the existing user in the 'my_website' database
    // We update the same table that handles the login
    $update_query = "UPDATE users SET 
                     skin_type = '$skin_type', 
                     total_score = '$total_score' 
                     WHERE id = '$user_id'";

    if(mysqli_query($conn, $update_query)){
        $_SESSION['skin_type'] = $skin_type; // Store result in session for display
        header('location:analysis_result.php');
        exit();
    } else {
        die("Update failed: " . mysqli_error($conn));
    }
}
?>