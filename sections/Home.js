// src/sections/Home.js
  function initHomePage() {
    const hero = document.querySelector('.home-hero');
    if (!hero) return;

    const eyes = document.querySelectorAll('.eye');
    if (eyes.length > 0) {
        const maxOffset = 6;
        const ignoreRadius = 70; // شعاع 60 پیکسل برای ناحیه غیر فعال
        let mouseX = 0, mouseY = 0;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        function updateEyes() {
            eyes.forEach((eye) => {
                const rect = eye.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;

                const dxTotal = mouseX - centerX;
                const dyTotal = mouseY - centerY;
                const distance = Math.sqrt(dxTotal * dxTotal + dyTotal * dyTotal);

                const pupil = eye.querySelector('.pupil');

                // اگر ماوس داخل دایره‌ی شعاع 60 باشد، مردمک را در مرکز نگه‌دار
                if (distance <= ignoreRadius) {
                    if (pupil) {
                        pupil.style.transform = `translate(0px, 0px)`;
                    }
                    return;
                }

                // محاسبه زاویه و جابجایی مردمک در خارج از شعاع
                const angle = Math.atan2(dyTotal, dxTotal);
                const x = Math.cos(angle) * maxOffset;
                const y = Math.sin(angle) * maxOffset;
                if (pupil) {
                    pupil.style.transform = `translate(${x}px, ${y}px)`;
                }
            });
            requestAnimationFrame(updateEyes);
        }

        requestAnimationFrame(updateEyes);
    }
    // افکت تغییر رنگ حروف هنگام هاور
    const letters = document.querySelectorAll('.letterColor');
    if (letters.length > 0) {
      letters.forEach((letter) => {
        let revertTimer = null;
        let hoverTimer = null;
  
        letter.addEventListener('mouseenter', () => {
          clearTimeout(revertTimer);
          clearTimeout(hoverTimer);
  
          const colors = ['#b3ac9e', '#d13318', '#000000'];
          const randomColor = colors[Math.floor(Math.random() * colors.length)];
          letter.style.color = randomColor;
  
          hoverTimer = setTimeout(() => {
            if (letter.matches(':hover')) {
              letter.style.color = '#b3ac9e';
            }
          }, 1500);
  
          revertTimer = setTimeout(() => {
            letter.style.color = 'black';
          }, 3000);
        });
  
        letter.addEventListener('mouseleave', () => {
          clearTimeout(hoverTimer);
        });
      });
    }
  
    // تغییر متن دکمه
    const btn = document.getElementById('myButton');
    if (btn) {
      const span = btn.querySelector('.btnSpan');
      if (span) {
        btn.addEventListener('mouseenter', () => {
          span.textContent = "Let's Go";
        });
        btn.addEventListener('mouseleave', () => {
          span.textContent = "Start a Project";
        });
      }
    }
  }
  
  window.addEventListener('DOMContentLoaded', initHomePage);

  ////////////////////////////////
  const button = document.getElementById("myButton");
const leftEye = document.getElementById("eye--left-gerdab");
const rightEye = document.getElementById("eye--rhite-gerdab");

button.addEventListener("mouseenter", () => {
  leftEye.classList.add("spin");
  rightEye.classList.add("spin");
});

button.addEventListener("mouseleave", () => {
  leftEye.classList.remove("spin");
  rightEye.classList.remove("spin");
});

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


function easeInOutCubic(t) {
  return t < 0.5
    ? 4 * t * t * t
    : 1 - Math.pow(-2 * t + 2, 3) / 2;
}

// تابع اصلی اسکرول
function smoothScrollTo(targetY, duration = 600) {
  const startY = window.pageYOffset;
  const distance = targetY - startY;
  let startTime = null;

  function animation(currentTime) {
    if (!startTime) startTime = currentTime;
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const ease = easeInOutCubic(progress);

    window.scrollTo(0, startY + (distance * ease));

    if (elapsed < duration) {
      requestAnimationFrame(animation);
    }
  }

  requestAnimationFrame(animation);
}

// راه‌اندازی listener روی همه لینک‌های داخلی
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    const targetEl = document.querySelector(href);
    if (targetEl) {
      e.preventDefault();

      // اگر می‌خواهید از یک offset ثابت (مثلاً ارتفاع منو) کسر کنید:
      const headerOffset = 80; // px
      const elementPosition = targetEl.getBoundingClientRect().top;
      const offsetPosition = window.pageYOffset + elementPosition - headerOffset;

      smoothScrollTo(offsetPosition, 1500);  // 800ms duration
    }
  });
});

