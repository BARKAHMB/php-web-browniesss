<?php
// Informasi koneksi ke database
$host = "localhost"; // Host database
$user = "root"; // Username database
$pass = ""; // Password database
$db_name = "penjualan_brownies"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db_name);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah ID telah dikirim melalui parameter GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Query SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM pembelian WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}

// Menutup koneksi
$conn->close();
?>
