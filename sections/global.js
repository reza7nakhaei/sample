// ✅ هدف: نمایش سریع صفحه Splash و اجرای انیمیشن سلام‌ها در حین لود شدن سایت

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
  { text: "привет", lang: "ru" },
];

const baseDuration = 100;
let currentIndex = 0;
let animationTimer = null;

function showSplash() {
  const splashEl = document.getElementById('splash');
  const greetingEl = document.getElementById('greeting');
  const mainContent = document.getElementById('main-content');

  if (!splashEl || !greetingEl || !mainContent) return;

  mainContent.style.display = 'none';
  greetingEl.innerHTML = '<span id="greeting-text"></span><span id="dot" style="color: white; font-weight: bold; margin-left: 5px;">.</span>';
  const greetingTextEl = document.getElementById('greeting-text');

  function showNextGreeting() {
    const { text, lang } = greetings[currentIndex];
    greetingTextEl.textContent = text;
    greetingTextEl.classList.toggle('font-semibold', lang === 'fa');

    const duration = (currentIndex === 0 || currentIndex === greetings.length - 1) ? 700 : baseDuration;
    currentIndex++;

    if (currentIndex < greetings.length) {
      animationTimer = setTimeout(showNextGreeting, duration);
    } else {
      animationTimer = setTimeout(() => {
        splashEl.classList.add('slide-up');
        splashEl.addEventListener('animationend', () => {
          document.documentElement.style.scrollBehavior = 'auto';
          window.scrollTo(0, 0);
          mainContent.style.display = 'block';
          setTimeout(() => {
            document.documentElement.style.scrollBehavior = 'smooth';
          }, 50);
          splashEl.remove();
        });
      }, duration);
    }
  }

  showNextGreeting();
}

// ✅ اجرا بلافاصله بعد از اینکه DOM بخش splash آماده شد، نه منتظر کل صفحه
(function startSplashEarly() {
  if (sessionStorage.getItem('splashSeen')) {
    document.addEventListener('DOMContentLoaded', () => {
      const splashEl = document.getElementById('splash');
      const mainContent = document.getElementById('main-content');
      splashEl?.remove();
      if (mainContent) {
        mainContent.style.display = 'block';
        window.scrollTo(0, 0);
      }
    });
    return;
  }

  const checkDOMReady = setInterval(() => {
    const splashEl = document.getElementById('splash');
    const greetingEl = document.getElementById('greeting');
    const mainContent = document.getElementById('main-content');

    if (splashEl && greetingEl && mainContent) {
      clearInterval(checkDOMReady);
      showSplash();
      sessionStorage.setItem('splashSeen', 'true');
    }
  }, 10);
})();
