

window.global ||= window;

// ───────────────────────────────────────────────────────────────────────────────
//  لیست سلام‌ها
// ───────────────────────────────────────────────────────────────────────────────
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
  { text: "Ciao", lang: "it" },
  { text: "Hallo", lang: "de" },
  { text: "Konnichiwa", lang: "jp" },
];

// ───────────────────────────────────────────────────────────────────────────────
//  تنظیمات انیمیشن و زمان‌بندی
// ───────────────────────────────────────────────────────────────────────────────
const baseDuration = 100; // مدت زمان نمایش هر سلام
let currentIndex = 0;
let animationTimer = null;

const splashMaxDuration = 6000; // کل زمان اسپلش
let splashTimeout = null;

// ───────────────────────────────────────────────────────────────────────────────
//  توابع کمکی
// ───────────────────────────────────────────────────────────────────────────────

// پیدا کردن ایمن عناصر (ممکنه قبل از لود DOM صداشون کنیم)
function getEl(id) {
  return document.getElementById(id);
}

// 🎵 فید این/اوت ولوم صدا
function fadeAudio(audio, from, to, duration) {
  if (!audio) return null;
  const steps = 20;
  const stepTime = duration / steps;
  let currentStep = 0;
  const volumeStep = (to - from) / steps;
  audio.volume = from;
  const interval = setInterval(() => {
    currentStep++;
    audio.volume = Math.min(1, Math.max(0, audio.volume + volumeStep));
    if (currentStep >= steps) {
      clearInterval(interval);
      audio.volume = to;
    }
  }, stepTime);
  return interval; // اگر لازم شد کنسل کنیم
}

// نمایش/مخفی‌سازی امن دکمه Unmute
function showUnmute() {
  const btn = getEl('unmute-btn');
  if (btn) btn.style.display = 'flex';
}
function hideUnmute() {
  const btn = getEl('unmute-btn');
  if (btn) btn.style.display = 'none';
}

// بررسی اینکه آیا صدا «قابل شنیدن» است (نه mute و نه ولوم صفر)
function isAudible(audio) {
  return audio && !audio.muted && audio.volume > 0 && !audio.paused;
}

// ───────────────────────────────────────────────────────────────────────────────
//  تابع اصلی اسپلش
// ───────────────────────────────────────────────────────────────────────────────
function showSplash() {
  const splashEl = getEl('splash');
  const greetingEl = getEl('greeting');
  const mainContent = getEl('main-content');
  const splashAudio = getEl('splash-audio'); // ⚠️ داخل تابع می‌گیریم تا مطمئن باشیم در DOM موجوده

  if (!splashEl || !greetingEl || !mainContent) return;

  // محتوای اصلی مخفی شود
  mainContent.style.display = 'none';

  // ساختار سلام‌ها + نقطه سفید کناری
  greetingEl.innerHTML = '<span id="greeting-text"></span><span id="dot" style="color: white; font-weight: bold; margin-left: 5px;">.</span>';
  const greetingTextEl = getEl('greeting-text');

  // 🎵 تلاش برای شروع موزیک با سازگاری بیشتر با مرورگرها
  // الگو: ابتدا به صورت mute پلی می‌کنیم (در اکثر مرورگرها مجازه)، سپس سریع unmute + فیداین.
  if (splashAudio) {
    try {
      splashAudio.volume = 0;        // برای فید-این
      splashAudio.muted = true;      // ابتدا بی‌صدا پلی می‌کنیم
      const playPromise = splashAudio.play();

      if (playPromise && typeof playPromise.then === 'function') {
        playPromise.then(() => {
          // پلی شد (ولی بی‌صدا). تلاش برای audible کردن + فیداین
          // بعضی مرورگرها اجازه unmute بدون جسچر رو می‌دهند؛ اگر نداد، دکمه را نشان می‌دهیم.
          requestAnimationFrame(() => {
            splashAudio.muted = false; // تلاش برای audible
            const targetVol = 0.7;
            fadeAudio(splashAudio, 0, targetVol, 2000);

            // اگر ظرف 500ms هنوز قابل شنیدن نشد، دکمه Unmute را نمایش بده
            setTimeout(() => {
              if (!isAudible(splashAudio)) showUnmute();
            }, 500);
          });
        }).catch(() => {
          // Autoplay کاملاً بلاک شد (مثلاً iOS Safari)
          showUnmute();
        });
      } else {
        // مرورگر promise برنمی‌گردونه:fallback
        setTimeout(() => {
          if (!isAudible(splashAudio)) showUnmute();
        }, 500);
      }
    } catch (e) {
      // هر خطایی => دکمه نمایان شود
      showUnmute();
    }
  }

  // تابع داخلی برای نمایش سلام‌ها
  function showNextGreeting() {
    const { text, lang } = greetings[currentIndex];
    greetingTextEl.textContent = text;
    greetingTextEl.classList.toggle('font-semibold', lang === 'fa');

    currentIndex = (currentIndex + 1) % greetings.length;
    animationTimer = setTimeout(showNextGreeting, baseDuration);
  }

  // شروع نمایش سلام‌ها
  showNextGreeting();

  // ✅ پایان اسپلش بعد از 6 ثانیه
  splashTimeout = setTimeout(() => {
    splashEl.classList.add('slide-up');

    splashEl.addEventListener('animationend', () => {
      document.documentElement.style.scrollBehavior = 'auto';
      window.scrollTo(0, 0);
      mainContent.style.display = 'block';

      setTimeout(() => {
        document.documentElement.style.scrollBehavior = 'smooth';
      }, 50);

      splashEl.remove();

      // 🎵 فید-اوت و توقف موزیک
      const audio = getEl('splash-audio');
      if (audio) {
        fadeAudio(audio, audio.volume, 0, 2000);
        setTimeout(() => {
          audio.pause();
          audio.currentTime = 0;
        }, 2000);
      }

      clearTimeout(animationTimer);
    });
  }, splashMaxDuration);

  // 🎵 وصل کردن رویداد دکمه Unmute (اینجا که DOM آماده است)
  const unmuteBtn = getEl('unmute-btn');
  if (unmuteBtn) {
    unmuteBtn.addEventListener('click', () => {
      const audio = getEl('splash-audio');
      if (!audio) return;
      try {
        audio.muted = false;
        audio.volume = 0;
        const p = audio.play();
        if (p && typeof p.then === 'function') {
          p.then(() => {
            fadeAudio(audio, 0, 0.7, 2000);
            hideUnmute();
          }).catch(() => {
            // اگر حتی با کلیک هم نشد، چیزی را لاگ کن
            console.warn('Play still blocked after user gesture');
          });
        } else {
          fadeAudio(audio, 0, 0.7, 2000);
          hideUnmute();
        }
      } catch (e) {
        console.warn('Error while trying to unmute/play', e);
      }
    }, { once: false });
  }
}

// ───────────────────────────────────────────────────────────────────────────────
//  اجرای زودهنگام اسپلش
// ───────────────────────────────────────────────────────────────────────────────
(function startSplashEarly() {
  if (sessionStorage.getItem('splashSeen')) {
    document.addEventListener('DOMContentLoaded', () => {
      const splashEl = getEl('splash');
      const mainContent = getEl('main-content');
      splashEl?.remove();
      if (mainContent) {
        mainContent.style.display = 'block';
        window.scrollTo(0, 0);
      }
    });
    return;
  }

  const checkDOMReady = setInterval(() => {
    const splashEl = getEl('splash');
    const greetingEl = getEl('greeting');
    const mainContent = getEl('main-content');

    if (splashEl && greetingEl && mainContent) {
      clearInterval(checkDOMReady);
      showSplash();
      sessionStorage.setItem('splashSeen', 'true');
    }
  }, 10);
})();
