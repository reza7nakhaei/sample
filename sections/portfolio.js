
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

