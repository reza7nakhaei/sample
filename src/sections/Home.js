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
  
          const colors = ['#e5e8cf', '#ffa500', '#000000'];
          const randomColor = colors[Math.floor(Math.random() * colors.length)];
          letter.style.color = randomColor;
  
          hoverTimer = setTimeout(() => {
            if (letter.matches(':hover')) {
              letter.style.color = '#e5e8cf';
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

  
