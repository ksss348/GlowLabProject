<?php
$conn = new mysqli("localhost", "root", "", "skincare_shop");
$q = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT * FROM products WHERE name LIKE '%$q%' LIMIT 5";
$res = $conn->query($sql);

if($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        echo "<a href='?view=detail&id=".$row['id']."' class='live-item'>
                <img src='".$row['image_url']."' alt='product'>
                <div class='info'>
                    <span class='name'>".$row['name']."</span>
                    <span class='price'>".number_format($row['price'])." MMK</span>
                </div>
              </a>";
    }
} else {
    echo "<div style='padding:15px; text-align:center; color:#999; font-size:13px;'>No products found</div>";
}
?>