// src/global.js
// مثال: قرار دادن window.global شبیه webpack
// <!-- سلام اول سایت  -->


window.global ||= window;
const greetings = [
  { text: "hello", lang: "en" },
  { text: "olá", lang: "pt" },
  { text: "Bonjour", lang: "fr" },
  { text: "你好", lang: "zh" },
  { text: "مرحبًا", lang: "ar" },
  { text: "Hola", lang: "es" },
  { text: "नमस्ते", lang: "hi" },
  { text: "سلام", lang: "fa" },
  { text: "привет ", lang: "ru" },
];
const totalDuration = 2500;
// مدت زمان پایه برای کلمات وسطی (سرعت بیشتر)
const baseDuration = 100; 
const splashEl = document.getElementById('splash');
const greetingEl = document.getElementById('greeting');
const mainContent = document.getElementById('main-content');
let currentIndex = 0;
let animationTimer;
function showSplash() {
  mainContent.style.display = 'none';

  // اضافه کردن نقطه سفید رنگ ثابت کنار متن
  greetingEl.innerHTML = '<span id="greeting-text"></span><span id="dot" style="color: white; font-weight: bold; margin-left: 5px;">•</span>';
  const greetingTextEl = document.getElementById('greeting-text');

  function showNext() {
    const { text, lang } = greetings[currentIndex];
    greetingTextEl.textContent = text;
    greetingTextEl.classList.toggle('font-semibold', lang === 'fa');

    // تعیین مدت زمان نمایش کلمه فعلی
    let duration;
    if (currentIndex === 0 || currentIndex === greetings.length - 1) {
      // مکث بیشتر برای اولین و آخرین کلمه
      duration = 700; 
    } else {
      // سرعت بیشتر برای کلمات وسطی
      duration = baseDuration;
    }

    currentIndex++;

    if (currentIndex < greetings.length) {
      animationTimer = setTimeout(showNext, duration);
    } else {
      // وقتی آخرین کلمه نمایش داده شد، بعد از مکث انیمیشن slide-up را اجرا کن
      animationTimer = setTimeout(() => {
        splashEl.classList.add('slide-up');
        splashEl.addEventListener('animationend', () => {
          splashEl.remove();
          mainContent.style.display = 'block';
        });
      }, duration);
    }
  }

  showNext();
}
window.addEventListener('load', () => {
  if (!sessionStorage.getItem('splashSeen')) {
    showSplash();
    sessionStorage.setItem('splashSeen', 'true');
  } else {
    splashEl.remove();
    mainContent.style.display = 'block';
  }
});
////////////////////////////

window.scrollTo({
  top: document.querySelector("#contact").offsetTop,
  behavior: "smooth"
});

// نقطه نارنجی موس////////////////////////////////////////////
const followerCursor = document.getElementById('cursor-follower');
let mouseX = 0, mouseY = 0;
let currentX = 0, currentY = 0;
const speed = 0.1;

document.addEventListener('mousemove', (e) => {
  mouseX = e.clientX;
  mouseY = e.clientY;
});

function animate() {
  currentX += (mouseX - currentX) * speed;
  currentY += (mouseY - currentY) * speed;
  followerCursor.style.transform = `translate(${currentX}px, ${currentY}px)`;
  requestAnimationFrame(animate);
}

animate();

// سایر تنظیمات یا فانکشن‌های سراسری
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
