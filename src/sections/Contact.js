(() => {
  const content   = document.querySelector("#scroll-content");
  let   lastY     = window.scrollY;
  let   targetX   = 0;
  let   currentX  = 0;
  const speed     = 0.1;
  let   maxScroll = content.scrollWidth - content.clientWidth;

  // به‌روزرسانی maxScroll هنگام Resize
  window.addEventListener('resize', () => {
    maxScroll = content.scrollWidth - content.clientWidth;
  });

  // روی اسکرول عمودی، هدف افقی را تغییر بده
  window.addEventListener('scroll', () => {
    const deltaY = window.scrollY - lastY;
    lastY = window.scrollY;
    targetX += deltaY;
    // محدودسازی بین 0 و maxScroll
    targetX = Math.max(0, Math.min(targetX, maxScroll));
  });

  // انیمیشن نرم به سمت targetX
  function animate() {
    currentX += (targetX - currentX) * speed;
    content.style.transform = `translateX(-${currentX}px)`;
    requestAnimationFrame(animate);
  }

  requestAnimationFrame(animate);
})();



///////////////////////////////
  document.querySelectorAll('.magnetic').forEach(el => {
    const maxOffset = 6; // حداکثر جابجایی به پیکسل
  
    el.addEventListener('mousemove', (e) => {
      const rect = el.getBoundingClientRect();
      // مختصات موس نسبت به مرکز عنصر
      const relX = e.clientX - (rect.left + rect.width / 2);
      const relY = e.clientY - (rect.top + rect.height / 2);
      // نرمال‌سازی با شعاع حداکثر
      const dist = Math.sqrt(relX**2 + relY**2);
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

