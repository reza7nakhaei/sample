<?php
// مسیر صحیح فایل Database.php نسبت به محل این فایل
require_once __DIR__ . '/config/Database.php';


// اتصال به دیتابیس
$db = (new Database())->getConnection();


// دسته فعال (تب انتخاب شده)
$activeCategory = $_GET['category'] ?? 1; // پیشفرض category_id = 1


// گرفتن اطلاعات دسته (برای نمایش نامش)
$stmtCat = $db->prepare("SELECT name FROM categories WHERE id = :id LIMIT 1");
$stmtCat->bindParam(":id", $activeCategory, PDO::PARAM_INT);
$stmtCat->execute();
$categoryRow = $stmtCat->fetch(PDO::FETCH_ASSOC);


// عنوان دسته فعال (اگر نبود، پیشفرض Logo)
$selectedTitle = $categoryRow['name'] ?? 'Logo';


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
  <link rel="stylesheet" href="./styles/output.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <style>
    .active-tab::after {
      width: 100% !important;
    }

    .tab-btn.active::after {
      width: 100% !important;
    }

    /* استایل گالری */
    .gallery-item {
      position: relative;
      cursor: pointer;
      overflow: hidden;
    }

    .gallery-item img {
      display: block;
      width: 100%;
      transition: transform 0.3s ease;
    }

    /* افکت هاور روی عکس */
    .gallery-item:hover img {
      transform: scale(1.05);
    }

    /* استایل اولیه overlay */
    .overlay {
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6);
      color: white;
      opacity: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      transition: opacity 0.3s ease;
      text-align: center;
      padding: 10px;
      pointer-events: none;
      /* اجازه می‌ده کلیک روی عکس رد بشه */
    }

    /* وقتی هاور میشه فقط نمایش پیدا می‌کنه */
    .gallery-item:hover .overlay {
      opacity: 1;
    }

    /* ===============================
   انیمیشن‌ها
   =============================== */

    /* انیمیشن نمایش لایت‌باکس */
    #lightbox.show {
      display: flex !important;
      /* فقط وقتی کلاس show هست نمایش داده شود */
      animation: fadeIn 0.8s ease forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    /* انیمیشن روی عکس */
    #lightbox-image {
      animation: zoomIn 0.8s ease;
      /* سرعت نمایش کمتر */
    }

    @keyframes zoomIn {
      from {
        transform: scale(0.9);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* انیمیشن زوم اوت برای عکس هنگام خروج */
    #lightbox-image.zoomOut {
      animation: zoomOut 0.6s ease forwards;
    }

    @keyframes zoomOut {
      from {
        transform: scale(1);
        opacity: 1;
      }

      to {
        transform: scale(0.8);
        opacity: 0;
      }
    }

    /* ===============================
   استایل کلی لایت‌باکس
   =============================== */
    #lightbox {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(1px);
      display: none;
      /* پیش‌فرض مخفی */
      align-items: center;
      justify-content: center;
      z-index: 50;
    }

    /* ===============================
   استایل عکس
   =============================== */
    #lightbox-image {
      max-width: 90%;
      max-height: 90%;
      object-fit: contain;
      border-radius: 1px;
      box-shadow: 0 10px 30px rgba(51, 51, 51, 0.1);
    }

    /* ===============================
   دکمه‌ها
   =============================== */
    /* انیمیشن دکمه‌ها Prev و Next با تاخیر */
    #lightbox-prev.show {
      animation: slideInLeft 1s ease 0.1s forwards;
    }

    #lightbox-next.show {
      animation: slideInRight 1s ease 0.1s forwards;
    }

    @keyframes slideInLeft {
      from {
        transform: translateX(-80px);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideInRight {
      from {
        transform: translateX(80px);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    /* انیمیشن خروج دکمه‌ها Prev و Next */
    #lightbox-prev.hide {
      animation: slideOutLeft 0.5s ease forwards;
    }

    #lightbox-next.hide {
      animation: slideOutRight 0.5s ease forwards;
    }

    @keyframes slideOutLeft {
      from {
        transform: translateX(0);
        opacity: 1;
      }

      to {
        transform: translateX(-80px);
        opacity: 0;
      }
    }

    @keyframes slideOutRight {
      from {
        transform: translateX(0);
        opacity: 1;
      }

      to {
        transform: translateX(80px);
        opacity: 0;
      }
    }

    /* موقعیت دکمه‌ها نزدیک‌تر به عکس */
    #lightbox-prev {
      left: 20%;
    }

    #lightbox-next {
      right: 20%;
    }

    /* دکمه بستن */
    #lightbox-close {
      top: 20px;
      right: 20px;
      font-size: 1.2rem;
      padding: 8px 14px;
    }
  </style>
</head>

<body>

  <header class="flex flex-row-reverse sm:flex sm:flex-row items-center justify-between p-4" style="
        border-bottom: 1px solid black; /* ضخامت و رنگ خط */
        border-image: repeating-linear-gradient(
            to right,
            black 0 4px,
            transparent 4px 10px
          )
          1;
      ">
    <!-- سمت چپ: نام سایت -->
    <div class="font-bold text-lg">MySite</div>
    <!-- وسط: تب‌ها -->
    <div id="tabs" class="flex gap-2 hidden sm:block">
      <button
        class="tab-btn <?= $activeCategory==1?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Logo" data-category="1">
        Logo
      </button>

      <button
        class="tab-btn <?= $activeCategory==2?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Social media" data-category="2">
        Social media
      </button>

      <button
        class="tab-btn <?= $activeCategory==3?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Banner and Billboard" data-category="3">
        Banner and Billboard
      </button>

      <button
        class="tab-btn <?= $activeCategory==4?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Ui / UX design" data-category="4">
        Ui / UX design
      </button>

      <button
        class="tab-btn <?= $activeCategory==5?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Office set" data-category="5">
        Office set
      </button>

      <button
        class="tab-btn <?= $activeCategory==6? 'active' : '' ?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Poster" data-category="6">
        Poster
      </button>

      <button
        class="tab-btn <?= $activeCategory==7?'active':''?> relative font-bold text-black px-2 py-1 after:content-[''] after:absolute after:right-0 after:bottom-0 after:h-[2px] after:bg-black after:w-0 hover:after:w-full after:transition-[width] after:duration-300"
        data-title="Packaging" data-category="7">
        Packaging
      </button>
    </div>


    <!-- سمت راست: دکمه برگشت -->
    <button class="font-bold text-black px-2 py-1 hidden sm:block">
      back
    </button>
    <!-- Wrapper -->
    <div class="relative">
      <!-- دکمه همبرگری -->
      <button id="menu-btn" class="sm:hidden flex flex-col gap-1 p-2">
        <span class="w-6 h-[2px] bg-black"></span>
        <span class="w-6 h-[2px] bg-black"></span>
        <span class="w-6 h-[2px] bg-black"></span>
      </button>

      <!-- منوی همبرگری راست‌به‌چپ -->
      <div id="menu"
        class="hidden absolute top-8 left-0 w-64 bg-white shadow-lg rounded-lg flex-col content-start p-2 z-50"
        dir="ltr">
        <!-- Logo -->
        <button class="tab-btn <?= $activeCategory==1?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Logo" data-category="1">
          Logo
        </button>
        <!-- Social media -->
        <button class="tab-btn <?= $activeCategory==2?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Social media" data-category="2">
          Social media
        </button>
        <!-- Banner and Billboard -->
        <button class="tab-btn <?= $activeCategory==3?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Banner and Billboard" data-category="3">
          Banner and Billboard
        </button>
        <!-- Ui / UX design -->
        <button class="tab-btn <?= $activeCategory==4?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Ui / UX design" data-category="4">
          Ui / UX design
        </button>
        <!-- Office set -->
        <button class="tab-btn <?= $activeCategory==5?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Office set" data-category="5">
          Office set
        </button>
        <!-- Poster -->
        <button class="tab-btn <?= $activeCategory==6?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Poster" data-category="6">
          Poster
        </button>
        <!-- Packaging -->
        <button class="tab-btn <?= $activeCategory==7?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Packaging" data-category="7">
          Packaging
        </button>
        <!-- Back -->
        <button class="tab-btn <?= $activeCategory==8?'active':''?> w-full px-3 py-2 text-left hover:bg-gray-100"
          data-title="Back" data-category="8">
          Back
        </button>
      </div>
  </header>

 <!-- نام نمونه‌کار انتخاب شده -->
<div id="selected-title" class="border-b border-gray-300 pb-5 text-4xl md:text-7xl font-bold text-left" style="
border-bottom: 1px solid black;
border-image: repeating-linear-gradient(
to right,
black 0 4px,
transparent 4px 10px
)
1;">
<?= htmlspecialchars($selectedTitle) ?>
</div>

  <main class="p-4 columns-3 md:columns-5 gap-2 [column-fill:_balance] mx-auto">
    <?php if(count($activeItems) > 0): ?>
    <?php foreach($activeItems as $item): ?>
    <div class="gallery-item relative cursor-pointer" data-title="<?= htmlspecialchars($item['title']) ?>">
      <img src="./uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"
        class=" mb-2 w-full break-inside-avoid lightbox-img">
      <div class="overlay absolute bottom-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">
        <?= htmlspecialchars($item['title']) ?>
      </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p>هیچ نمونه کاری در این دسته موجود نیست.</p>
    <?php endif; ?>
  </main>

  <!-- لایت‌باکس خوشگل‌تر -->
  <div id="lightbox" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm">
    <!-- دکمه بستن -->
    <button id="lightbox-close " class="absolute top-6 right-6 text-white text-4xl">
      &times;
    </button>

    <!-- دکمه قبلی -->
    <button id="lightbox-prev" class="show hide absolute left-6 bg-black p-2 rounded-full text-white text-3xl">
      prev
    </button>

    <!-- عکس اصلی -->
    <img id="lightbox-image"
      class="zoomOut max-h-[85%] max-w-[85%] rounded-xl shadow-2xl border border-white/30 object-contain" src=""
      alt="" />

    <!-- دکمه بعدی -->
    <button id="lightbox-next" class="show hide absolute right-6 bg-black p-2 rounded-full text-white text-3xl">
      next
    </button>
  </div>

  <div id="cursor-follower"
    class="fixed top-0 left-0 w-2 h-2 bg-orange-500 rounded-full pointer-events-none -translate-x-1/2 -translate-y-1/2 z-[9999]">
  </div>
  <script type="module" src="./sections/portfolio.js"></script>


  <script>
    // مدیریت تب‌ها
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        const category = tab.dataset.category;
        window.location.href = '?category=' + category; // لود دوباره با PHP
      });
    });


  </script>

</body>

</html>