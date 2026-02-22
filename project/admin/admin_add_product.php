<?php
$conn = new mysqli("localhost", "root", "", "skincare_shop");

if (isset($_POST['upload'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $desc = $conn->real_escape_string($_POST['desc']);
    $res = $conn->real_escape_string($_POST['res']);
    $how = $conn->real_escape_string($_POST['how']);
    $ingre = $conn->real_escape_string($_POST['ingre']);

    $upload_dir = "../uploads/"; 
    if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
    
    $file_name = time() . "_" . basename($_FILES["image_file"]["name"]);
    $physical_target = $upload_dir . $file_name;

    $db_image_path = "uploads/" . $file_name;

    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $physical_target)) {
        $sql = "INSERT INTO products (name, category, price, image_url, description, results, how_to_use, ingredients) 
                VALUES ('$name', '$cat', '$price', '$db_image_path', '$desc', '$res', '$how', '$ingre')";
        
        if ($conn->query($sql)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            title: 'Success!',
                            text: 'ပစ္စည်းအသစ် ထည့်သွင်းပြီးပါပြီ!',
                            icon: 'success',
                            confirmButtonColor: '#ff85a2'
                        }).then(() => { 
                            // Dashboard ဆီကို ပြန်ပို့မယ် (မင်း Dashboard Link နဲ့ ညှိထားတယ်)
                            window.location='admin_dashboard.php?view=products'; 
                        });
                    });
                  </script>";
        }
    } else {
        echo "<script>alert('Error: ပုံတင်လို့မရပါ (uploads folder ဆောက်ထားလား စစ်ပါ)');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlowLab | Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary: #ff85a2; 
            --dark: #2c3e50; 
            --bg: #f8f9fa; 
            --input-bg: #fcfcfc;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg); 
            display: flex; justify-content: center; align-items: center; 
            min-height: 100vh; margin: 0; padding: 40px 20px;
        }

        .form-container { 
            background: #ffffff; 
            padding: 40px; border-radius: 30px; 
            box-shadow: 0 15px 50px rgba(0,0,0,0.05); 
            width: 100%; max-width: 600px;
            border: 1px solid rgba(255,133,162,0.1);
        }

        h2 { 
            text-align: center; color: var(--dark); 
            margin-bottom: 35px; text-transform: uppercase; 
            letter-spacing: 2px; font-weight: 800; font-size: 1.6rem;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        h2 i { color: var(--primary); font-size: 1.2rem; }

        .input-group { margin-bottom: 22px; }
        label { 
            display: block; margin-bottom: 8px; font-weight: 600; 
            color: #adb5bd; font-size: 11px; text-transform: uppercase; 
            letter-spacing: 1px;
        }

       /* Update the existing rule to ensure font-size is clear */
input,  textarea { 
    width: 100%; 
    padding: 14px 18px; 
    border: 1.5px solid #f1f1f1; 
    border-radius: 15px; 
    font-size: 16px; /* Increased from 15px for better readability */
    box-sizing: border-box; 
    outline: none; 
    transition: 0.3s; 
    background: var(--input-bg);
    color: var(--dark);
    appearance: none; /* Helps with custom styling on some browsers */
}
        input:focus, textarea:focus, select:focus { 
            border-color: var(--primary); background: #fff;
            box-shadow: 0 8px 20px rgba(255,133,162,0.08);
        }

        textarea { height: 100px; resize: none; }

        .row { display: flex; gap: 20px; }

        /* File Input Custom Style */
        input[type="file"] { 
            padding: 12px; background: #fff; border: 2px dashed #eee; 
            cursor: pointer; font-size: 13px;
        }
        input[type="file"]:hover { border-color: var(--primary); }

        .up-btn { 
            background: var(--dark); color: #fff; border: none; 
            padding: 18px; width: 100%; border-radius: 18px; 
            cursor: pointer; font-weight: 700; font-size: 16px; 
            margin-top: 20px; transition: 0.4s; 
            box-shadow: 0 10px 25px rgba(44, 62, 80, 0.15);
            text-transform: uppercase; letter-spacing: 1px;
        }

        .up-btn:hover { 
            background: var(--primary); 
            transform: translateY(-5px); 
            box-shadow: 0 15px 30px rgba(255,133,162,0.3);
        }

        .back-link {
            display: block; text-align: center; margin-top: 20px;
            color: #adb5bd; text-decoration: none; font-size: 14px;
            transition: 0.3s;
        }
        .back-link:hover { color: var(--primary); }

        select { 
    width: 100%; 
    padding: 14px 18px; 
    border: 1.5px solid #f1f1f1; 
    border-radius: 15px; 
    font-size: 16px !important; /* Forces the display text to be larger */
    background: var(--input-bg);
    color: var(--dark);
    cursor: pointer;
}
        /* Specifically target the dropdown options */
select option {
    font-size: 20px;
    padding: 25px;
    background: #ffffff;
    color: #333;
}
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-magic"></i> Add New Product</h2>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <label>Product Name</label>
            <input type="text" name="name" placeholder="e.g. CeraVe Foaming Cleanser" required>
        </div>

        <div class="row">
            <div class="input-group" style="flex: 1.2;">
                <label>Category</label>
                <input list="categories" name="cat" placeholder="Click to select..." required>
    <datalist id="categories">
        <option value="Toner">
        <option value="Cleanser">
        <option value="Serum">
        <option value="Sunscreen">
        <option value="Moisturizer">
        <option value="Lipstick">
    </datalist>
            </div>
            <div class="input-group" style="flex: 1;">
                <label>Price (MMK)</label>
                <input type="number" name="price" placeholder="15000" required>
            </div>
        </div>

        <div class="input-group">
            <label>Product Image</label>
            <input type="file" name="image_file" accept="image/*" required>
        </div>

        <div class="input-group">
            <label>Description</label>
            <textarea name="desc" placeholder="What are the main benefits?"></textarea>
        </div>

        <div class="row">
            <div class="input-group">
                <label>Results</label>
                <input type="text" name="res" placeholder="e.g. Glowing skin">
            </div>
            <div class="input-group">
                <label>How to Use</label>
                <input type="text" name="how" placeholder="e.g. Apply twice daily">
            </div>
        </div>

        <div class="input-group">
            <label>Key Ingredients</label>
            <textarea name="ingre" placeholder="List key ingredients..." style="height: 70px;"></textarea>
        </div>

        <button type="submit" name="upload" class="up-btn">
            <i class="fas fa-cloud-upload-alt" style="margin-right: 8px;"></i> Upload to Shop
        </button>
        
        <a href="admin_dashboard.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </form>
</div>

</body>
</html>