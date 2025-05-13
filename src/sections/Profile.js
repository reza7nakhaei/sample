//   document.addEventListener("DOMContentLoaded", () => {
//     const projectItems = document.querySelectorAll(".project-item");
//     let activeItem = null;

//     projectItems.forEach((item) => {
//       const mainText = item.querySelector(".main-text");
//       const description = item.querySelector(".project-description");
//       const bgTop = item.querySelector(".bg-top");
//       const bgBottom = item.querySelector(".bg-bottom");
//       const projectExtra = item.querySelector(".project-extra");

//       item.addEventListener("mouseenter", () => {
//         if (activeItem !== item) {
//           mainText.style.opacity = "0";
//           description.style.opacity = "1";
//           bgTop.style.height = "50%";
//           bgBottom.style.height = "50%";
//         }
//       });

//       item.addEventListener("mouseleave", () => {
//         if (activeItem !== item) {
//           mainText.style.opacity = "1";
//           description.style.opacity = "0";
//           bgTop.style.height = "0";
//           bgBottom.style.height = "0";
//         }
//       });

//       item.addEventListener("click", (e) => {
//         e.stopPropagation();

//         if (activeItem === item) {
//           item.classList.remove("bg-red-600");
//           projectExtra.classList.add("hidden");
//           activeItem = null;
//         } else {
//           if (activeItem) {
//             activeItem.classList.remove("bg-red-600");
//             activeItem.querySelector(".project-extra").classList.add("hidden");
//           }
//           item.classList.add("bg-red-600");
//           projectExtra.classList.remove("hidden");
//           mainText.style.opacity = "1";
//           description.style.opacity = "0";
//           bgTop.style.height = "0";
//           bgBottom.style.height = "0";
//           activeItem = item;
//         }
//       });
//     });

//     document.addEventListener("click", () => {
//       if (activeItem) {
//         activeItem.classList.remove("bg-red-600");
//         activeItem.querySelector(".project-extra").classList.add("hidden");
//         activeItem = null;
//       }
//     });

//     const scrollContainer = document.querySelector(".project-extra .overflow-x-auto");
//     if (scrollContainer) {
//       scrollContainer.addEventListener("wheel", function (e) {
//         if (!e.shiftKey) {
//           e.preventDefault();
//           scrollContainer.scrollLeft += e.deltaY;
//         }
//       }, { passive: false });
//     }

//     const images = document.querySelectorAll(".project-extra img");
//     const lightbox = document.getElementById("lightbox");
//     const lightboxImg = document.getElementById("lightbox-img");
//     const closeBtn = document.getElementById("lightbox-close");
//     const nextBtn = document.getElementById("lightbox-next");
//     const prevBtn = document.getElementById("lightbox-prev");

//     let currentGroup = [];
//     let currentIndex = 0;

//     images.forEach(img => {
//       img.addEventListener("click", () => {
//         const group = img.dataset.group;
//         currentGroup = Array.from(images).filter(i => i.dataset.group === group);
//         currentIndex = parseInt(img.dataset.index);
//         lightboxImg.src = currentGroup[currentIndex].src;
//         lightbox.classList.remove("hidden");
//       });
//     });

//     nextBtn.addEventListener("click", () => {
//       if (currentGroup.length) {
//         currentIndex = (currentIndex + 1) % currentGroup.length;
//         lightboxImg.src = currentGroup[currentIndex].src;
//       }
//     });

//     prevBtn.addEventListener("click", () => {
//       if (currentGroup.length) {
//         currentIndex = (currentIndex - 1 + currentGroup.length) % currentGroup.length;
//         lightboxImg.src = currentGroup[currentIndex].src;
//       }
//     });

//     closeBtn.addEventListener("click", () => {
//       lightbox.classList.add("hidden");
//     });

//     lightbox.addEventListener("click", (e) => {
//       if (e.target === lightbox) {
//         lightbox.classList.add("hidden");
//       }
//     });
//   });
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
          item.classList.remove("bg-red-600");
          projectExtra.classList.add("hidden");
          activeItem = null;
        } else {
          if (activeItem) {
            activeItem.classList.remove("bg-red-600");
            activeItem.querySelector(".project-extra").classList.add("hidden");
          }
          item.classList.add("bg-red-600");
          projectExtra.classList.remove("hidden");
          mainText.style.opacity = "1";
          description.style.opacity = "0";
          bgTop.style.height = "0";
          bgBottom.style.height = "0";
          activeItem = item;
        }
      });
    });

    document.addEventListener("click", () => {
      if (activeItem) {
        activeItem.classList.remove("bg-red-600");
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

    const images = document.querySelectorAll(".project-extra img");
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const closeBtn = document.getElementById("lightbox-close");
    const nextBtn = document.getElementById("lightbox-next");
    const prevBtn = document.getElementById("lightbox-prev");

    let currentGroup = [];
    let currentIndex = 0;

    images.forEach(img => {
      img.addEventListener("click", () => {
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
    });

    lightbox.addEventListener("click", (e) => {
      if (e.target === lightbox) {
        lightbox.classList.add("hidden");
      }
    });
  });
