
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

// حرکت افقی و نمایش پله‌ای متن برای بخش skills
(() => {
  const content = document.querySelector("#scroll-content-skills");
  if (!content) return; // بررسی وجود عنصر

  let lastScrollY = window.scrollY;
  let targetX = 0;
  let currentX = 0;
  const speed = 0.1;
  const maxScroll = 1000;

  window.addEventListener('scroll', () => {
    const deltaY = window.scrollY - lastScrollY;
    lastScrollY = window.scrollY;
    targetX += deltaY;
    if (targetX > maxScroll) targetX = maxScroll;
    if (targetX < 0) targetX = 0;
  });

  function animate() {
    currentX += (targetX - currentX) * speed;
    content.style.transform = `translateX(-${currentX}px)`;
    requestAnimationFrame(animate);
  }

  animate();
})();

// نمایش پله‌ای متن هنگام ورود به viewport
document.addEventListener('DOMContentLoaded', () => {
  const section = document.getElementById('creative');
  if (!section) return;

  const items = Array.from(section.querySelectorAll('p'));

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        items.forEach((p, idx) => {
          const delay = idx * 400; // 0ms, 100ms, 200ms ...
          p.style.transitionDelay = `${delay}ms`;
          p.classList.add('visible');
        });
      } else {
        items.forEach(p => {
          p.style.transitionDelay = '0ms';
          p.classList.remove('visible');
        });
      }
    });
  }, { root: null, rootMargin: '0px', threshold: 0.5 });

  observer.observe(section);
});
