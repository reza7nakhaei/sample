// src/sections/project.js

  (() => {
    let content = document.querySelector("#scroll-content-project");  // فقط یک عنصر انتخاب می‌کنیم
    let lastScrollY = window.scrollY;
    let targetX = 0;
    let currentX = 0;
    let speed = 0.1;  // سرعت حرکت افقی
    let maxScroll = 1000;  // حداکثر مقدار برای حرکت افقی، می‌توانید تغییر دهید

    // هنگام اسکرول، تغییرات موقعیت افقی را محاسبه می‌کنیم
    window.addEventListener('scroll', () => {
      let deltaY = window.scrollY - lastScrollY;
      lastScrollY = window.scrollY;
      targetX += deltaY;  // تغییر موقعیت هدف
      // محدود کردن حرکت افقی
      if (targetX > maxScroll) targetX = maxScroll;
      if (targetX < 0) targetX = 0;
    });

    function animate() {
      currentX += (targetX - currentX) * speed;  // به‌روزرسانی موقعیت فعلی به‌طور نرم
      content.style.transform = `translateX(-${currentX}px)`;  // اعمال تغییر به عنصر
      requestAnimationFrame(animate);  // ادامه انیمیشن
    }

    animate();  // شروع انیمیشن
  })();



  const items = document.querySelectorAll('.project-item');
  items.forEach(item => {
    const top = item.querySelector('.bg-top');
    const bottom = item.querySelector('.bg-bottom');
    const mainText = item.querySelector('.main-text');
    const desc = item.querySelector('.project-description');

    item.addEventListener('mouseenter', () => {
      top.style.height = "100%";
      bottom.style.height = "100%";
      mainText.style.opacity = "0";
      desc.style.opacity = "1";
    });

    item.addEventListener('mouseleave', () => {
      const delay = 50; // Delay in milliseconds (adjust as needed)

      setTimeout(() => {
        top.style.height = "0";
        bottom.style.height = "0";
        desc.style.opacity = "0";
        mainText.style.opacity = "1";
      }, delay);
    });
  });

  document.addEventListener("DOMContentLoaded", () => {
  const projectItems = document.querySelectorAll(".project-item");

  projectItems.forEach((item) => {
    const mainText = item.querySelector('.main-text');
    const gridContainer = item.querySelector('.grid-container');
    const description = item.querySelector('.project-description');

    item.addEventListener("click", () => {
      const isOpen = item.classList.contains("open");

      // بستن تمام آیتم‌های دیگر
      projectItems.forEach((otherItem) => {
        const otherGrid = otherItem.querySelector('.grid-container');
        const otherMainText = otherItem.querySelector('.main-text');
        const otherDescription = otherItem.querySelector('.project-description');

        otherItem.classList.remove("open");
        otherItem.style.height = ""; // بازگشت به ارتفاع پیش‌فرض
        if (otherMainText) otherMainText.style.opacity = "1"; // نمایش متن اصلی
        if (otherDescription) otherDescription.style.display = "none"; // پنهان کردن توضیحات
        if (otherGrid) {
          otherGrid.style.opacity = "0"; // مخفی کردن گرید
          otherGrid.style.height = "0"; // ارتفاع صفر
        }
      });

      // اگر آیتم کلیک‌شده باز نبود، آن را باز کنید
      if (!isOpen) {
        const viewportHeight = window.innerHeight; // ارتفاع دستگاه
        item.classList.add("open");
        item.style.height = `${viewportHeight / 2}px`; // نصف ارتفاع دستگاه
        if (mainText) mainText.style.opacity = "1"; // نمایش متن اصلی
        if (description) description.style.display = "none"; // پنهان کردن توضیحات
        if (gridContainer) {
          gridContainer.style.opacity = "1"; // نمایش گرید
          gridContainer.style.height = "100%"; // تنظیم ارتفاع گرید
        }
      }
    });

    // بازگشت به حالت اولیه هنگام خروج ماوس
    item.addEventListener("mouseleave", () => {
      item.classList.remove("open");
      item.style.height = ""; // بازگشت به ارتفاع پیش‌فرض
      if (mainText) mainText.style.opacity = "1"; // نمایش متن اصلی
      if (description) description.style.display = "none"; // پنهان کردن توضیحات
      if (gridContainer) {
        gridContainer.style.opacity = "0"; // مخفی کردن گرید
        gridContainer.style.height = "0"; // ارتفاع صفر
      }
    });
  });
});