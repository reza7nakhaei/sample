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


});
