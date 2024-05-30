<?php
// Ambil data dari form pembelian
$username = $_POST['username'];
$nama_barang = $_POST['nama_barang'];
$jumlah = (int)$_POST['jumlah'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];

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

// Ambil harga per brownies dari database atau tetapkan nilainya di sini
$harga_per_brownies = 30000; // Misalnya harga satu brownies adalah Rp 30.000

// Hitung total harga berdasarkan jumlah brownies yang dibeli
$total_harga = $harga_per_brownies * $jumlah;

// Tentukan diskon berdasarkan jumlah pembelian
$diskon = 0;
if ($jumlah > 20) {
    $diskon = 0.20; // Diskon 20%
} elseif ($jumlah > 10) {
    $diskon = 0.10; // Diskon 10%
}

// Hitung total harga setelah diskon
$total_diskon = $total_harga * $diskon;
$total_harga_setelah_diskon = $total_harga - $total_diskon;

// Simpan data pembelian ke database
$stmt = $conn->prepare("INSERT INTO pembelian (username, nama_barang, jumlah, total_harga, tanggal_pembelian, alamat, nomor_telepon, diskon) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if ($stmt === false) {
    die("Error prepare statement: " . $conn->error);
}
$stmt->bind_param("ssiisssd", $username, $nama_barang, $jumlah, $total_harga_setelah_diskon, $tanggal_pembelian, $alamat, $nomor_telepon, $total_diskon);

if ($stmt->execute()) {
    $pembelian_berhasil = true;
} else {
    $pembelian_berhasil = false;
    $error_message = $stmt->error;
}

// Tutup koneksi database
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .struk-container {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .struk-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .struk-header h2 {
            margin: 0;
            color: #333;
        }

        .struk-header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

        .detail, .total {
            margin-bottom: 15px;
        }

        .detail p, .total p {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }

        .total p {
            font-weight: bold;
        }

        .kembali-btn {
            background-color: #ff6600;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        .kembali-btn:hover {
            background-color: #e65c00;
        }

        .company-info {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php if (isset($pembelian_berhasil) && $pembelian_berhasil): ?>
        <div class="struk-container">
            <div class="struk-header">
                <h2>Struk Pembelian</h2>
                <p>Penjualan Bolu Brownies</p>
            </div>
            <div class="company-info">
                <p>Alamat Toko: Jl. Perjuangan, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132</p>
                <p>Telepon: 0895341111415</p>
            </div>
            <div class="detail">
                <p><span>Nama:</span> <span><?php echo htmlspecialchars($username); ?></span></p>
                <p><span>Nama Barang:</span> <span><?php echo htmlspecialchars($nama_barang); ?></span></p>
                <p><span>Harga per Brownies:</span> <span><?php echo htmlspecialchars($harga_per_brownies); ?></span></p>
                <p><span>Jumlah:</span> <span><?php echo $jumlah; ?></span></p>
                <p>-------------------------------------------------------------------------------------</p>
                <p><span>Alamat:</span> <span><?php echo htmlspecialchars($alamat); ?></span></p>
                <p><span>Nomor Telepon:</span> <span><?php echo htmlspecialchars($nomor_telepon); ?></span></p>
                <p><span>Tanggal Pembelian:</span> <span><?php echo htmlspecialchars($tanggal_pembelian); ?></span></p>
                <p>-------------------------------------------------------------------------------------</p>
            </div>
            <div class="total">
                <p><span>Harga Sebelum Diskon:</span> <span>Rp <?php echo number_format($total_harga, 2, ',', '.'); ?></span></p>
                <p><span>Diskon:</span> <span>Rp <?php echo number_format($total_diskon, 2, ',', '.'); ?></span></p>
                <p><span>Total Harga:</span> <span>Rp <?php echo number_format($total_harga_setelah_diskon, 2, ',', '.'); ?></span></p>
            </div>
            <button onclick="window.location.href='garis1.html'" class="kembali-btn">Kembali</button>
        </div>
    <?php else: ?>
        <div class="struk-container">
            <div class="struk-header">
                <h2>Kesalahan</h2>
                <p>Penjualan Bolu Brownies</p>
            </div>
            <div class="detail">
                <p>Terjadi kesalahan dalam proses pembelian:</p>
                <p><?php echo htmlspecialchars($error_message); ?></p>
            </div>
            <button onclick="window.location.href='garis1.html'" class="kembali-btn">Kembali</button>
        </div>
    <?php endif; ?>
</body>
</html>
