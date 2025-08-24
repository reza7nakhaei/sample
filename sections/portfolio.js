document.addEventListener("DOMContentLoaded", () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-image");
    const closeBtn = document.getElementById("lightbox-close");
    const nextBtn = document.getElementById("lightbox-next");
    const prevBtn = document.getElementById("lightbox-prev");

    const images = Array.from(document.querySelectorAll(".lightbox-img"));
    let currentIndex = 0;

    function openLightbox(index) {
        currentIndex = index;
        lightboxImg.src = images[currentIndex].src;
        lightbox.classList.add("show");
        lightboxImg.classList.remove("zoomOut");
        nextBtn.classList.remove("hide");
        prevBtn.classList.remove("hide");
        nextBtn.classList.add("show");
        prevBtn.classList.add("show");
    }

    function closeLightbox() {
        // اضافه کردن کلاس zoomOut برای عکس
        lightboxImg.classList.add("zoomOut");

        // خروج دکمه‌ها
        nextBtn.classList.remove("show");
        prevBtn.classList.remove("show");
        nextBtn.classList.add("hide");
        prevBtn.classList.add("hide");

        // صبر برای پایان انیمیشن عکس قبل از مخفی کردن لایت‌باکس
        setTimeout(() => {
            lightbox.classList.remove("show");
            lightboxImg.src = "";
            lightboxImg.classList.remove("zoomOut");
        }, 600); // طول انیمیشن زوم اوت
    }

    images.forEach((img, index) => {
        img.addEventListener("click", (e) => {
            e.preventDefault();
            openLightbox(index);
        });
    });

    if (closeBtn) closeBtn.addEventListener("click", closeLightbox);
    if (nextBtn) nextBtn.addEventListener("click", () => openLightbox((currentIndex + 1) % images.length));
    if (prevBtn) prevBtn.addEventListener("click", () => openLightbox((currentIndex - 1 + images.length) % images.length));

    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    document.addEventListener("keydown", (e) => {
        if (!lightbox.classList.contains("show")) return;
        if (e.key === "Escape") closeLightbox();
        if (e.key === "ArrowRight") openLightbox((currentIndex + 1) % images.length);
        if (e.key === "ArrowLeft") openLightbox((currentIndex - 1 + images.length) % images.length);
    });
});


// توپ نارنجی

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

const tabs = document.querySelectorAll('[data-tab]');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active-tab'));
        tab.classList.add('active-tab');
    });
});

const tabButtons = document.querySelectorAll('.tab-btn');
const selectedTitle = document.getElementById('selected-title');

tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active', 'after:w-full'));
        btn.classList.add('active', 'after:w-full');
        selectedTitle.textContent = btn.dataset.title;
    });
});

const menuBtn = document.getElementById("menu-btn");
  const menu = document.getElementById("menu");

  menuBtn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
    menu.classList.toggle("flex");
  });