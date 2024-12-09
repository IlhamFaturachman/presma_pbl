document.getElementById('btnMasuk').addEventListener('click', function() {
    window.location.href = '/presma_pbl/public/auth/login';
});

document.getElementById('btnCatatPrestasi').addEventListener('click', function() {
    window.location.href = '/presma_pbl/public/auth/login';
});

// Animasi gambar pada Hero Section saat kursor bergerak
document.addEventListener('mousemove', (e) => {
    const heroImage = document.querySelector('.hero img');
    const mouseX = e.pageX / window.innerWidth - 0.5;  // Normalize X
    const mouseY = e.pageY / window.innerHeight - 0.5; // Normalize Y

    heroImage.style.transform = `translate(-${mouseX * 30}px, -${mouseY * 30}px) scale(1.05)`;
});

// Fungsi untuk membuat gelembung pada halaman kontak
const createBubbles = () => {
    for (let i = 0; i < 10; i++) {
        let bubble = document.createElement('div');
        bubble.classList.add('bubble');
        document.querySelector('.contact-section').appendChild(bubble);
    }
};

createBubbles();

document.addEventListener("DOMContentLoaded", function () {
    const alurCards = document.querySelectorAll('.alur-card');

    // Menggunakan IntersectionObserver untuk memantau elemen
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Tambahkan kelas animasi ketika elemen terlihat
                    entry.target.classList.add('animate');
                }
            });
        },
        { threshold: 0.5 } // Memulai animasi ketika elemen 50% terlihat
    );

    // Terapkan observer ke semua elemen alur-card
    alurCards.forEach((card) => observer.observe(card));
});
