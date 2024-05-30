// sidebar.js

// Ambil elemen tombol
const check = document.getElementById('check');

// Ambil elemen sidebar
const sidebar = document.querySelector('.sidebar');

// Ambil elemen konten utama
const content = document.querySelector('.content');

// Ambil elemen gambar
const img = document.querySelector('.content img');

// Saat tombol diubah
check.addEventListener('change', function() {
    // Jika tombol dicentang
    if (this.checked) {
        // Geser konten utama ke kanan
        content.style.marginLeft = '300px'; // Sesuaikan dengan lebar sidebar
        // Ubah lebar gambar untuk tetap muat di dalam area konten
        img.style.maxWidth = 'calc(100% - 340px)'; // Sesuaikan dengan lebar sidebar dan padding konten
        // Tambahkan transisi untuk konten utama
        content.style.transition = 'margin-left 0.3s ease';
    } else {
        // Geser konten utama kembali ke posisi semula
        content.style.marginLeft = '0';
        // Kembalikan lebar gambar ke ukuran semula
        img.style.maxWidth = '100%';
    }
});
