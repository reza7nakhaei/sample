const scrollPin = document.getElementById('scrollPinFoter');
const scrollFooter = document.getElementById('scroll-footer');

scrollPin.addEventListener('mouseenter', () => {
  scrollFooter.classList.add('animate-scroll-moving-fotter');
});

scrollPin.addEventListener('mouseleave', () => {
  scrollFooter.classList.remove('animate-scroll-moving-fotter');
});
