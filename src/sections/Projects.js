// src/sections/project.js

  // (() => {
  //   let content = document.querySelector("#scroll-content-project");  // فقط یک عنصر انتخاب می‌کنیم
  //   let lastScrollY = window.scrollY;
  //   let targetX = 0;
  //   let currentX = 0;
  //   let speed = 0.1;  // سرعت حرکت افقی
  //   let maxScroll = 1000;  // حداکثر مقدار برای حرکت افقی، می‌توانید تغییر دهید

  //   // هنگام اسکرول، تغییرات موقعیت افقی را محاسبه می‌کنیم
  //   window.addEventListener('scroll', () => {
  //     let deltaY = window.scrollY - lastScrollY;
  //     lastScrollY = window.scrollY;
  //     targetX += deltaY;  // تغییر موقعیت هدف
  //     // محدود کردن حرکت افقی
  //     if (targetX > maxScroll) targetX = maxScroll;
  //     if (targetX < 0) targetX = 0;
  //   });

  //   function animate() {
  //     currentX += (targetX - currentX) * speed;  // به‌روزرسانی موقعیت فعلی به‌طور نرم
  //     content.style.transform = `translateX(-${currentX}px)`;  // اعمال تغییر به عنصر
  //     requestAnimationFrame(animate);  // ادامه انیمیشن
  //   }

  //   animate();  // شروع انیمیشن
  // })();



 

/////////////////////////////////////////////////////////////////
// document.addEventListener("DOMContentLoaded", () => {
//   const projectItems = document.querySelectorAll(".project-item");

//   projectItems.forEach(item => {
//     const grid = item.querySelector('.grid-container');

//     item.addEventListener('click', () => {
//       // بستن سایر آیتم‌ها
//       projectItems.forEach(other => {
//         if (other !== item) {
//           other.classList.remove('open');
//           const otherGrid = other.querySelector('.grid-container');
//           if (otherGrid) otherGrid.classList.remove('open');
//         }
//       });

//       // باز/بسته کردن خود آیتم
//       const isNowOpen = item.classList.toggle('open');
//       if (grid) grid.classList.toggle('open', isNowOpen);

//       // نیازی به دستکاری extra-content نیست؛ CSS از کلاس .open استفاده می‌کند
//     });
//   });
// });
