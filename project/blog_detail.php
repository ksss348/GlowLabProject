<?php 
include 'db_connect.php';
session_start();

// Language Logic
if (isset($_GET['lang'])) { $_SESSION['lang'] = $_GET['lang']; }
$lang = $_SESSION['lang'] ?? 'en';

$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM blogs WHERE id = $blog_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $blog = $result->fetch_assoc();
} else {
    die("Blog post not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang == 'en' ? $blog['title_en'] : $blog['title_mm'] ?></title>
    <style>
        :root { --beige: #a4698f; --pink: #fce4ec; --gold: #9c1f59; --dark: #730959; }
        body { font-family: 'Pyidaungsu', sans-serif; background: white; margin: 0; color: var(--dark); line-height: 1.8; }
        
        /* Language Link */
        .lang-link { position: fixed; top: 20px; right: 20px; text-decoration: none; color: #c93785; background: var(--pink); padding: 8px 15px; border-radius: 20px; font-weight: bold; font-size: 0.8rem; z-index: 1000; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }

        .container { max-width: 800px; margin: 0 auto; padding: 40px 20px; }
        .back-btn { text-decoration: none; color: var(--gold); font-weight: bold; display: inline-block; margin-bottom: 20px; }
        
        .featured-img { width: 100%; height: 400px; object-fit: cover; border-radius: 30px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        
        .category { background: var(--pink); color: #880e4f; padding: 5px 15px; border-radius: 50px; font-size: 0.8rem; font-weight: bold; text-transform: uppercase; }
        
        .post-title { font-size: 2.5rem; margin: 20px 0; color: #333; line-height: 1.3; }
        
        .post-content { font-size: 1.1rem; color: #555; white-space: pre-line; margin-top: 20px; }
        
        .footer-note { margin-top: 50px; padding-top: 30px; border-top: 1px solid #eee; text-align: center; color: #bbb; font-style: italic; }

        @media (max-width: 600px) {
            .post-title { font-size: 1.8rem; }
            .featured-img { height: 250px; }
        }
    </style>
</head>
<body>

<a href="?id=<?= $blog_id ?>&lang=<?= $lang == 'en' ? 'mm' : 'en' ?>" class="lang-link">
    <?= $lang == 'en' ? 'Switch to MM' : 'Switch to ENG' ?>
</a>

<div class="container">
    <a href="blogs.php" class="back-btn">← <?= $lang == 'en' ? 'Back to Blogs' : 'ဆောင်းပါးများသို့ ပြန်သွားရန်' ?></a>
    
    <img src="images/<?= $blog['image_url'] ?>" class="featured-img" alt="Featured Image">
    
    <span class="category"><?= $blog['category'] ?></span>
    
    <h1 class="post-title">
        <?= $lang == 'en' ? $blog['title_en'] : $blog['title_mm'] ?>
    </h1>
    
    <div class="post-content">
        <?= $lang == 'en' ? $blog['content_en'] : $blog['content_mm'] ?>
    </div>

    <div class="footer-note">
        — Thank you for reading GlowLab Beauty Tips —
    </div>
</div>

</body>
</html>