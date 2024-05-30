<?php
// Ambil data dari form pembelian
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$jumlah = $_POST['jumlah'];
$total_harga = $_POST['harga'];

// Anda perlu menyesuaikan koneksi database sesuai dengan konfigurasi Anda
$host = "localhost"; // Host database
$user = "root"; // Username database
$pass = ""; // Password database
$db_name = "penjualan_brownies"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $pass, $db_name);

// Check koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Simpan data pembelian ke tabel history
$sql = "INSERT INTO purchases (username, password, email, jumlah, total_harga) 
        VALUES ('$username', '$password', '$email', '$jumlah', '$total_harga')";

if ($conn->query($sql) === TRUE) {
    // Cetak pesan pembelian berhasil
    echo "<script>alert('Pembelian berhasil!');</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>
