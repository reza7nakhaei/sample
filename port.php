<?php
// مسیر صحیح فایل Database.php نسبت به محل این فایل
require_once __DIR__ . '/config/Database.php';

// اتصال به دیتابیس
$db = (new Database())->getConnection();

// دسته فعال (تب انتخاب شده)
$activeCategory = $_GET['category'] ?? 1; // پیشفرض category_id = 1

// گرفتن نمونه کارهای دسته انتخاب شده
$stmt = $db->prepare("SELECT * FROM portfolios WHERE category_id = :category_id");
$stmt->bindParam(":category_id", $activeCategory, PDO::PARAM_INT);
$stmt->execute();
$activeItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>نمونه کارها</title>
<link rel="stylesheet" href="./styles/output.css">
<style>
body { font-family: sans-serif; background:#f0f0f0; margin:0; padding:0;}
header { display:flex; justify-content: space-between; align-items:center; padding:1rem; background:#fff; border-bottom:1px solid #ccc;}
.tab-btn { margin:0 0.5rem; padding:0.5rem 1rem; cursor:pointer; border:none; background:none; font-weight:bold; position:relative;}
.tab-btn.active::after { content:""; position:absolute; bottom:0; left:0; width:100%; height:2px; background:black;}
.gallery-item { position:relative; margin:1rem 0; cursor:pointer;}
.gallery-item img { width:100%; border-radius:5px; transition: transform 0.3s ease;}
.gallery-item:hover img { transform: scale(1.05);}
.overlay { position:absolute; bottom:5px; left:5px; background:rgba(0,0,0,0.5); color:#fff; padding:5px 10px; border-radius:3px;}
#lightbox { position:fixed; inset:0; background:rgba(0,0,0,0.8); display:none; align-items:center; justify-content:center; z-index:1000;}
#lightbox img { max-width:90%; max-height:90%; border-radius:5px;}
#lightbox-close { position:absolute; top:20px; right:20px; font-size:2rem; color:#fff; cursor:pointer;}
</style>
</head>
<body>

<header>
    <div>نمونه کارها</div>
    <div>
        <button class="tab-btn <?= $activeCategory==1?'active':''?>" data-category="1">Logo</button>
        <button class="tab-btn <?= $activeCategory==2?'active':''?>" data-category="2">Social media</button>
        <button class="tab-btn <?= $activeCategory==3?'active':''?>" data-category="3">Banner</button>
    </div>
</header>

<main style="padding:1rem; max-width:900px; margin:auto;">
<?php if(count($activeItems) > 0): ?>
    <?php foreach($activeItems as $item): ?>
    <div class="gallery-item" data-title="<?= htmlspecialchars($item['title']) ?>">
        <img src="./uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="lightbox-img">
        <div class="overlay"><?= htmlspecialchars($item['title']) ?></div>
    </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>هیچ نمونه کاری در این دسته موجود نیست.</p>
<?php endif; ?>
</main>

<div id="lightbox">
    <span id="lightbox-close">&times;</span>
    <img id="lightbox-img" src="" alt="">
</div>

<script>
// مدیریت تب‌ها
const tabs = document.querySelectorAll('.tab-btn');
tabs.forEach(tab=>{
    tab.addEventListener('click', ()=>{
        tabs.forEach(t=>t.classList.remove('active'));
        tab.classList.add('active');
        const category = tab.dataset.category;
        window.location.href = '?category=' + category; // لود دوباره با PHP
    });
});

// لایت‌باکس
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightbox-img');
const closeBtn = document.getElementById('lightbox-close');

document.querySelectorAll('.lightbox-img').forEach(img=>{
    img.addEventListener('click', ()=>{
        lightboxImg.src = img.src;
        lightbox.style.display = 'flex';
    });
});

closeBtn.addEventListener('click', ()=>lightbox.style.display='none');
lightbox.addEventListener('click', e=>{
    if(e.target===lightbox) lightbox.style.display='none';
});
</script>

</body>
</html>
