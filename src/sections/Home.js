// src/sections/Home.js
  function initHomePage() {
    const hero = document.querySelector('.home-hero');
    if (!hero) return;
  
    // حرکت مردمک چشم
    const eyes = document.querySelectorAll('.eye');
    if (eyes.length > 0) {
      const maxOffset = 9;
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
          const dx = mouseX - centerX;
          const dy = mouseY - centerY;
          const angle = Math.atan2(dy, dx);
          const x = Math.cos(angle) * maxOffset;
          const y = Math.sin(angle) * maxOffset;
          const pupil = eye.querySelector('.pupil');
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
  
          const colors = ['#ffffff', '#ffa500', '#000000'];
          const randomColor = colors[Math.floor(Math.random() * colors.length)];
          letter.style.color = randomColor;
  
          hoverTimer = setTimeout(() => {
            if (letter.matches(':hover')) {
              letter.style.color = '#ffffff';
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

  
