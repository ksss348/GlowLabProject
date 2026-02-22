<?php 
include 'language.php'; 
include 'db_connect.php';

$lang = $_SESSION['lang'] ?? 'en';

// Search & Filter Logic
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

$sql = "SELECT * FROM blogs WHERE 1=1";

if ($search != '') {
    $sql .= " AND (title_en LIKE '%$search%' OR title_mm LIKE '%$search%')";
}

if ($category != '') {
    $sql .= " AND category = '$category'";
}

$sql .= " ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlowLab | Beauty Blogs & Tips</title>
    <style>
        :root { 
            --beige: #fdf5e6; 
            --pink: #fce4ec; 
            --gold: #d4a373; 
            --text: #5d4037; 
            --main-pink: #ff85a2;
        }
        body { background: var(--beige); font-family: 'Pyidaungsu', sans-serif; margin: 0; color: var(--text); }
        
        /* Floating Buttons (Home & Language) */
        .home-link { 
            position: fixed; top: 20px; left: 20px; 
            text-decoration: none; color: #721c24; background: #f8d7da; 
            padding: 8px 15px; border-radius: 20px; font-weight: bold; 
            font-size: 0.8rem; z-index: 1000; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .lang-link { 
            position: fixed; top: 20px; right: 20px; 
            text-decoration: none; color: #721c24; background: #f8d7da; 
            padding: 8px 15px; border-radius: 20px; font-weight: bold; 
            font-size: 0.8rem; z-index: 1000; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .home-link:hover, .lang-link:hover { background: #f1b0b7; transform: scale(1.05); }

        .header { text-align: center; padding: 60px 20px; background: white; margin-bottom: 40px; border-bottom: 5px solid var(--pink); }
        .header h1 { margin: 0; color: var(--gold); font-size: 2.5rem; }

        /* Search Filter Styling */
        .filter-container { max-width: 1000px; margin: -30px auto 40px; text-align: center; padding: 0 20px; }
        .search-form { display: flex; gap: 10px; justify-content: center; background: white; padding: 15px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .search-form input, .search-form select { padding: 10px 20px; border: 1px solid var(--pink); border-radius: 25px; outline: none; }
        .search-form button { background: var(--gold); color: white; border: none; padding: 10px 25px; border-radius: 25px; cursor: pointer; transition: 0.3s; }
        .search-form button:hover { background: #b88a5d; }

        .blog-container { max-width: 1000px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; padding: 0 20px 50px; }
        .blog-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); transition: 0.3s; display: flex; flex-direction: column; }
        .blog-card:hover { transform: translateY(-10px); }
        .blog-img { width: 100%; height: 200px; object-fit: cover; background: #eee; }
        .blog-content { padding: 25px; flex-grow: 1; }
        .category-tag { font-size: 0.7rem; background: var(--pink); color: #880e4f; padding: 5px 12px; border-radius: 50px; text-transform: uppercase; font-weight: bold; }
        .blog-title { margin: 15px 0; font-size: 1.3rem; color: #333; line-height: 1.4; }
        .blog-excerpt { font-size: 0.9rem; color: #777; margin-bottom: 20px; line-height: 1.6; }
        .read-more { text-decoration: none; color: var(--gold); font-weight: bold; font-size: 0.9rem; }
    </style>
</head>
<body>

<a href="home.php" class="home-link">
    <?= $lang == 'en' ? '← Home' : '← ပင်မစာမျက်နှာ' ?>
</a>

<a href="?lang=<?= $lang == 'en' ? 'mm' : 'en' ?>" class="lang-link">
    <?= $lang == 'en' ? 'Switch to MM' : 'Switch to ENG' ?>
</a>

<div class="header">
    <h1><?= $lang == 'en' ? 'Beauty Tips & Insights' : 'အလှအပနှင့် အသားအရေဆိုင်ရာ ဆောင်းပါးများ' ?></h1>
    <p><?= $lang == 'en' ? 'Expert advice for your daily glow.' : 'သင့်အသားအရေအတွက် ကျွမ်းကျင်သူများ၏ အကြံပြုချက်များ' ?></p>
</div>

<div class="filter-container">
    <form action="blogs.php" method="GET" class="search-form">
        <input type="text" name="search" placeholder="<?= $lang == 'en' ? 'Search topics...' : 'ခေါင်းစဉ်ဖြင့်ရှာရန်...' ?>" 
               value="<?= htmlspecialchars($search) ?>">

        <select name="category">
            <option value=""><?= $lang == 'en' ? 'All Categories' : 'ကဏ္ဍအားလုံး' ?></option>
            <option value="Routine" <?= $category == 'Routine' ? 'selected' : '' ?>>Routine</option>
            <option value="Ingredients" <?= $category == 'Ingredients' ? 'selected' : '' ?>>Ingredients</option>
            <option value="Protection" <?= $category == 'Protection' ? 'selected' : '' ?>>Protection</option>
            <option value="Lifestyle" <?= $category == 'Lifestyle' ? 'selected' : '' ?>>Lifestyle</option>
            <option value="Sensitive" <?= $category == 'Sensitive' ? 'selected' : '' ?>>Sensitive Skin Tips</option>
        </select>

        <button type="submit"><?= $lang == 'en' ? 'Filter' : 'ရှာဖွေမည်' ?></button>
    </form>
</div>

<div class="blog-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="blog-card">
            <img src="images/<?= $row['image_url'] ?>" class="blog-img" alt="Blog Image">
            <div class="blog-content">
                <span class="category-tag"><?= $row['category'] ?></span>
                <h2 class="blog-title"><?= $lang == 'en' ? $row['title_en'] : $row['title_mm'] ?></h2>
                <p class="blog-excerpt">
                    <?= $lang == 'en' ? substr($row['content_en'], 0, 100) : mb_substr($row['content_mm'], 0, 100) ?>...
                </p>
                <a href="blog_detail.php?id=<?= $row['id'] ?>&lang=<?= $lang ?>" class="read-more">
                    <?= $lang == 'en' ? 'Read Full Article →' : 'အပြည့်အစုံဖတ်ရန် →' ?>
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; grid-column: 1/-1; padding: 50px;">
            <?= $lang == 'en' ? 'No blog posts found.' : 'ရှာဖွေမှုမရှိပါ။' ?>
        </p>
    <?php endif; ?>
</div>

</body>
</html>