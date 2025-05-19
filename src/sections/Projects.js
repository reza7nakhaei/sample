document.addEventListener("DOMContentLoaded", () => {
  const projectItems = document.querySelectorAll(".project-item");
  let activeItem = null;

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
        bgTop.style.height = "50%";
        bgBottom.style.height = "50%";
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
        item.classList.remove("bg-[d13318]");
        projectExtra.classList.add("hidden");
        activeItem = null;
      } else {
        if (activeItem) {
          activeItem.classList.remove("bg-[d13318]");
          activeItem.querySelector(".project-extra").classList.add("hidden");
        }
        item.classList.add("bg-[d13318]");
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
  activeItem.classList.remove("bg-[d13318]");
  activeItem.querySelector(".project-extra").classList.add("hidden");
  activeItem = null;
}
});

  const scrollContainer = document.querySelector(".project-extra .overflow-x-auto");
  if (scrollContainer) {
    scrollContainer.addEventListener("wheel", function (e) {
      if (!e.shiftKey) {
        e.preventDefault();
        scrollContainer.scrollLeft += e.deltaY;
      }
    }, { passive: false });
  }

  const imageWrappers = document.querySelectorAll(".project-extra > .overflow-x-auto .grid > div");
  let images = [];
  imageWrappers.forEach(wrapper => {
    const mainImage = wrapper.querySelector("img[data-group]");
    if (mainImage) images.push(mainImage);
    const hiddenImages = wrapper.querySelectorAll(".hidden img[data-group]");
    hiddenImages.forEach(img => images.push(img));
  });
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const closeBtn = document.getElementById("lightbox-close");
  const nextBtn = document.getElementById("lightbox-next");
  const prevBtn = document.getElementById("lightbox-prev");

  let currentGroup = [];
  let currentIndex = 0;

  images.forEach(img => {
    img.addEventListener("click", (e) => {
      e.stopPropagation();
      const group = img.dataset.group;
      currentGroup = Array.from(images).filter(i => i.dataset.group === group);
      currentIndex = parseInt(img.dataset.index);
      lightboxImg.src = currentGroup[currentIndex].src;
      lightbox.classList.remove("hidden");
    });
  });

  nextBtn.addEventListener("click", () => {
    if (currentGroup.length) {
      currentIndex = (currentIndex + 1) % currentGroup.length;
      lightboxImg.src = currentGroup[currentIndex].src;
    }
  });
  prevBtn.addEventListener("click", () => {
      if (currentGroup.length) {
        currentIndex = (currentIndex - 1 + currentGroup.length) % currentGroup.length;
        lightboxImg.src = currentGroup[currentIndex].src;
      }
    });

    closeBtn.addEventListener("click", () => {
      lightbox.classList.add("hidden");
      e.stopPropagation();
    });

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        lightbox.classList.add("hidden");
      }
    });
  });

  document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".project-item");

    items.forEach(item => {
      item.addEventListener("click", () => {
        items.forEach(i => {
          if (i !== item) i.classList.remove("active");
        });
        item.classList.toggle("active");
      });
    });
  });
  const scrollContainers = document.querySelectorAll(".project-extra .overflow-x-auto");

  scrollContainers.forEach(scrollContainer => {
    scrollContainer.addEventListener("wheel", function (e) {
      if (!e.shiftKey) {
        e.preventDefault();
        scrollContainer.scrollLeft += e.deltaY;
      }
    }, { passive: false });
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