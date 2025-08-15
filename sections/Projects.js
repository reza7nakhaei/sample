document.addEventListener("DOMContentLoaded", () => {
  const projectItems = document.querySelectorAll(".project-item");
  const scrollContainers = document.querySelectorAll(".project-extra .overflow-x-auto");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const closeBtn = document.getElementById("lightbox-close");
  const nextBtn = document.getElementById("lightbox-next");
  const prevBtn = document.getElementById("lightbox-prev");

  let currentGroup = [];
  let currentIndex = 0;
  const images = [];

  // Hover behavior for project items
  projectItems.forEach((item) => {
    const mainText = item.querySelector(".main-text");
    const description = item.querySelector(".project-description");
    const bgTop = item.querySelector(".bg-top");
    const bgBottom = item.querySelector(".bg-bottom");

    item.addEventListener("mouseenter", () => {
      mainText.style.opacity = "0";
      description.style.opacity = "1";
      if(bgTop) bgTop.style.height = "55%";
      if(bgBottom) bgBottom.style.height = "55%";
    });

    item.addEventListener("mouseleave", () => {
      mainText.style.opacity = "1";
      description.style.opacity = "0";
      if(bgTop) bgTop.style.height = "0";
      if(bgBottom) bgBottom.style.height = "0";
    });
  });

  // Lightbox setup
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

  // Horizontal scroll animation on page scroll
  (() => {
    let content = document.querySelector("#scroll-content-project");
    if (!content) return;

    let lastScrollY = window.scrollY;
    let targetX = 400;
    let currentX = 0;
    let speed = 0.4;
    let maxScroll = 1500;

    window.addEventListener('scroll', () => {
      let deltaY = window.scrollY - lastScrollY;
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
});
