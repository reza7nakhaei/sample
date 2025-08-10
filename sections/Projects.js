document.addEventListener("DOMContentLoaded", () => {
  const projectItems = document.querySelectorAll(".project-item");
  const scrollContainers = document.querySelectorAll(".project-extra .overflow-x-auto");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const closeBtn = document.getElementById("lightbox-close");
  const nextBtn = document.getElementById("lightbox-next");
  const prevBtn = document.getElementById("lightbox-prev");

  let activeItem = null;
  let currentGroup = [];
  let currentIndex = 0;
  const images = [];

  // Hover and click behavior for project items
  projectItems.forEach((item) => {
    const mainText = item.querySelector(".main-text");
    const description = item.querySelector(".project-description");
    const bgTop = item.querySelector(".bg-top");
    const bgBottom = item.querySelector(".bg-bottom");
    const projectExtra = item.querySelector(".project-extra");

    item.addEventListener("mouseenter", () => {
      if (activeItem !== item) {
        mainText.style.opacity = "0";
        description.style.opacity = "1";
        bgTop.style.height = "55%";
        bgBottom.style.height = "55%";
      }
    });

    item.addEventListener("mouseleave", () => {
      if (activeItem !== item) {
        mainText.style.opacity = "1";
        description.style.opacity = "0";
        bgTop.style.height = "0";
        bgBottom.style.height = "0";
      }
    });

    item.addEventListener("click", (e) => {
      e.stopPropagation();

      if (activeItem === item) {
        item.classList.remove("bg-[b3ac9e]", "active");
        projectExtra.classList.add("hidden");
        activeItem = null;
      } else {
        if (activeItem) {
          activeItem.classList.remove("bg-[b3ac9e]", "active");
          activeItem.querySelector(".project-extra").classList.add("hidden");
        }
        item.classList.add("bg-[b3ac9e]", "active");
        projectExtra.classList.remove("hidden");
        mainText.style.opacity = "1";
        description.style.opacity = "0";
        bgTop.style.height = "0";
        bgBottom.style.height = "0";
        activeItem = item;
      }
    });
  });

  document.addEventListener("click", (e) => {
    const isClickInsideProject = e.target.closest('.project-item');
    const isClickInsideLightbox = e.target.closest('#lightbox');

    if (!isClickInsideProject && !isClickInsideLightbox && activeItem) {
      activeItem.classList.remove("bg-[b3ac9e]", "active");
      activeItem.querySelector(".project-extra").classList.add("hidden");
      activeItem = null;
    }
  });

  scrollContainers.forEach(container => {
    container.addEventListener("wheel", (e) => {
      if (!e.shiftKey) {
        e.preventDefault();
        container.scrollLeft += e.deltaY;
      }
    }, { passive: false });
  });

  document.querySelectorAll(".project-extra .overflow-x-auto .grid > div").forEach(wrapper => {
    const mainImage = wrapper.querySelector("img[data-group]");
    if (mainImage) images.push(mainImage);
    wrapper.querySelectorAll(".hidden img[data-group]").forEach(img => images.push(img));
  });

  images.forEach(img => {
    img.addEventListener("click", (e) => {
      e.stopPropagation();
      const group = img.dataset.group;
      currentGroup = images.filter(i => i.dataset.group === group);
      currentIndex = currentGroup.indexOf(img);
      lightboxImg.src = currentGroup[currentIndex].src;
      lightbox.classList.remove("hidden");
    });
  });

  const updateLightbox = () => {
    if (currentGroup.length) {
      lightboxImg.src = currentGroup[currentIndex].src;
    }
  };

  nextBtn.addEventListener("click", () => {
    currentIndex = (currentIndex + 1) % currentGroup.length;
    updateLightbox();
  });

  prevBtn.addEventListener("click", () => {
    currentIndex = (currentIndex - 1 + currentGroup.length) % currentGroup.length;
    updateLightbox();
  });

  closeBtn.addEventListener("click", (e) => {
    e.stopPropagation();
    lightbox.classList.add("hidden");
  });

  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) {
      lightbox.classList.add("hidden");
    }
  });

  // Keyboard navigation inside lightbox
  document.addEventListener("keydown", (e) => {
    if (lightbox.classList.contains("hidden")) return;

    switch (e.key) {
      case "ArrowRight":
        nextBtn.click();
        break;
      case "ArrowLeft":
        prevBtn.click();
        break;
      case "Escape":
        closeBtn.click();
        break;
    }
  });
});

  

  (() => {
    let content = document.querySelector("#scroll-content-project");  // فقط یک عنصر انتخاب می‌کنیم
    let lastScrollY = window.scrollY;
    let targetX = 400;
    let currentX = 0;
    let speed = 0.4;  // سرعت حرکت افقی
    let maxScroll = 1500;  // حداکثر مقدار برای حرکت افقی، می‌توانید تغییر دهید
  
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