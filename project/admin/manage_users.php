<?php
session_start();
// Include your database connection
include '../db.php'; 

// Check if admin is logged in
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../registration.php");
    exit();
}

// Handle User Deletion
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   // Avoid deleting the logged-in admin themselves
   if($delete_id != $_SESSION['id']){
      mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
      header('location: manage_users.php');
   }
}

// Handle Role Update (Toggle between admin and user)
if(isset($_GET['update_role'])){
   $update_id = $_GET['update_role'];
   $new_role = $_GET['current_role'] === 'admin' ? 'user' : 'admin';
   mysqli_query($conn, "UPDATE `users` SET role = '$new_role' WHERE id = '$update_id'") or die('query failed');
   header('location:manage_users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Users | GlowLab Admin</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin.css">
   <style>
      /* Quick style overrides to match your Home/User pages */
      :root {
         --gradient: linear-gradient(135deg, #b76e79 0%, #A495CB 100%);
      }
      body { background: #fdf4f7; }
      
      .container { padding: 4rem 2rem; max-width: 1200px; margin: 0 auto; }
      
      .table-wrapper {
         background: rgba(255, 255, 255, 0.7);
         backdrop-filter: blur(10px);
         border-radius: 30px;
         padding: 2rem;
         box-shadow: 0 20px 50px rgba(0,0,0,0.05);
         overflow-x: auto;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         font-size: 1.6rem;
      }

      thead th {
         text-align: left;
         padding: 1.5rem;
         color: #b76e79;
         border-bottom: 2px solid #f7ecf0;
      }

      tbody td {
         padding: 1.5rem;
         border-bottom: 1px solid #f7ecf0;
         color: #555;
      }

      .role-badge {
         padding: 0.5rem 1.2rem;
         border-radius: 50px;
         font-size: 1.2rem;
         font-weight: 700;
         text-transform: uppercase;
      }

      .role-admin { background: #fdf4f7; color: #b76e79; border: 1px solid #b76e79; }
      .role-user { background: #eee; color: #777; }

      .action-btns a {
         margin-right: 1rem;
         font-size: 1.8rem;
         transition: 0.3s;
      }

      .btn-delete { color: #e74c3c; }
      .btn-edit { color: #A495CB; }

      .back-btn {
         display: inline-block;
         margin-bottom: 2rem;
         color: #b76e79;
         text-decoration: none;
         font-weight: 700;
         font-size: 1.6rem;
      }
   </style>
</head>
<body>

<div class="container">
   <a href="admin_dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
   
   <h2 class="section-title" style="font-size: 3rem; margin-bottom: 2rem;">Registered Users</h2>

   <div class="table-wrapper">
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Username</th>
               <th>Email</th>
               <th>Role</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
               while($fetch_users = mysqli_fetch_assoc($select_users)){
            ?>
            <tr>
               <td>#<?php echo $fetch_users['id']; ?></td>
               <td><strong><?php echo $fetch_users['username']; ?></strong></td>
               <td><?php echo $fetch_users['email']; ?></td>
               <td>
                  <span class="role-badge <?php echo ($fetch_users['role'] == 'admin') ? 'role-admin' : 'role-user'; ?>">
                     <?php echo $fetch_users['role']; ?>
                  </span>
               </td>
              <td class="action-btns">
   <a href="manage_users.php?update_role=<?php echo $fetch_users['id']; ?>&current_role=<?php echo $fetch_users['role']; ?>" 
      title="Toggle Role">
      <img src="../images/edit-icon.jpg" alt="Edit" width="20" style="vertical-align: middle;">
   </a>
   
   <?php if($fetch_users['id'] != $_SESSION['id']): ?>
   <a href="manage_users.php?delete=<?php echo $fetch_users['id']; ?>" 
      onclick="return confirm('Delete this user?');" title="Delete User">
      <img src="../images/delete-icon.jpg" alt="Delete" width="20" style="vertical-align: middle; margin-left: 10px;">
   </a>
   <?php endif; ?>
</td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
</div>

</body>
</html>