<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sync the session keys (Use 'id' or 'user_id' consistently)
    $user_id = $_SESSION['id'] ?? $_SESSION['user_id'] ?? null;
    
    if (!$user_id) {
        die("Error: No user ID found. Please make sure you are logged in.");
    }

    $total_score = 0;
    $answered_count = 0;

    // Loop through questions 1 to 8
    for ($i = 1; $i <= 8; $i++) {
        if (isset($_POST["q$i"])) {
            $total_score += (int)$_POST["q$i"];
            $answered_count++;
        }
    }
    if ($answered_count === 0) {
        die("Error: No answers were received. Please go back and complete the quiz.");
    }

    // Specialized Logic for Sensitive Skin
    $q4_value = isset($_POST["q4"]) ? (int)$_POST["q4"] : 0;

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
    // Secure the update query
    $stmt = $conn->prepare("UPDATE users SET skin_type = ?, total_score = ? WHERE id = ?");
    $stmt->bind_param("sii", $skin_type, $total_score, $user_id);

    if ($stmt->execute()) {
        $_SESSION['skin_type'] = $skin_type; 
        $_SESSION['id'] = $user_id; // Ensure this is set
        
        if(isset($_POST['username'])) {
            $_SESSION['username'] = $_POST['username'];
        }
        header("Location: analysis_result.php");
        exit();
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>