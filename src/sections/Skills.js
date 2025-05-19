
document.querySelectorAll('.magnetic').forEach(el => {
  const maxOffset = 6; // حداکثر جابجایی به پیکسل

  el.addEventListener('mousemove', (e) => {
    const rect = el.getBoundingClientRect();
    // مختصات موس نسبت به مرکز عنصر
    const relX = e.clientX - (rect.left + rect.width / 2);
    const relY = e.clientY - (rect.top + rect.height / 2);
    // نرمال‌سازی با شعاع حداکثر
    const dist = Math.sqrt(relX ** 2 + relY ** 2);
    const factor = dist > maxOffset ? maxOffset / dist : 1;
    const offsetX = relX * factor;
    const offsetY = relY * factor;

    // اعمال جابجایی
    el.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
  });

  el.addEventListener('mouseleave', () => {
    // برگشت نرم به مرکز
    el.style.transition = 'transform 0.4s ease-out';
    el.style.transform = 'translate(0, 0)';
    // بعد از پایان برگشت، transition رو پاک می‌کنیم تا در mousemove بعدی لگ ایجاد نشه
    el.addEventListener('transitionend', function handler() {
      el.style.transition = 'transform 0.1s linear';
      el.removeEventListener('transitionend', handler);
    });
  });
});

(() => {
  let content = document.querySelector("#scroll-content-skills");  // فقط یک عنصر انتخاب می‌کنیم
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



