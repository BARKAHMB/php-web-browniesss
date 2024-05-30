<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sukses Abadi - About</title>
    <!-- Tambahkan fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan stylesheet untuk bagian atas -->
    <link rel="stylesheet" href="atas.css">
    <!-- Masukkan CSS untuk sidebar -->
    <link rel="stylesheet" href="sidebar.css">
    <style>
        .content {
            display: flex;
            align-items: center;
            flex-direction: column; /* Ubah orientasi flex menjadi kolom */
            text-align: center; /* Pusatkan teks */
            margin-top: 50px; /* Tambahkan margin ke atas */
        }

        .content hr {
            width: 50%; /* Atur lebar garis */
            margin-top: 20px; /* Atur jarak antara judul dan garis */
            margin-bottom: 20px; /* Atur jarak antara garis dan deskripsi */
            border-style: solid;
            border-width: 1px;
            border-color: #ccc; /* Warna garis */
        }

        .content h2, .content .text {
            margin-top: 20px; /* Tambahkan jarak antara garis dan teks */
            padding: 20px; /* Tambahkan padding untuk meningkatkan jarak antara border dan teks */
            border-top: 1px solid #ccc; /* Garis di bagian atas */
            border-bottom: 1px solid #ccc; /* Garis di bagian bawah */
            border-left: 1px solid #ccc; /* Garis di bagian kiri */
            border-right: 1px solid #ccc; /* Garis di bagian kanan */
        }

        .content h2 {
            margin-bottom: 0; /* Menghapus margin bawah pada judul */
        }

        .content img {
            max-width: 100%;
            height: auto;
        }

        .price {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <main>
        <div class="sidebar">
            <div class="top">
                Menu
            </div>  
            <ul>
            <ul>
                <li><a href="index.html"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="garis1.html"><i class="fa fa-shopping-basket"></i> Orders</a></li>
                <li><a href="history.php"><i class="fa fa-shopping-bag"></i> History</a></li>
                <li><a href="garis2.php"><i class="fa fa-comment" aria-hidden="true"></i>Opinion</a></li>
                <li><a href="About.php"><i class="fa fa-address-card" aria-hidden="true"></i> About</a></li>
                <li><a href="home.php"><i class="fa fa-user-circle"></i> Profile</a></li>

             </ul></ul>
        </div>
        <div class="content">
            <?php
            // Koneksi ke database
            $koneksi = mysqli_connect("localhost", "root", "", "penjualan_brownies");

            // Cek koneksi
            if (mysqli_connect_errno()) {
                echo "Koneksi database gagal: " . mysqli_connect_error();
            }

            // Query SQL untuk mengambil data dari tabel about_info
            $query = "SELECT * FROM about_info";
            $result = mysqli_query($koneksi, $query);

            // Cek apakah ada data yang ditemukan
            if (mysqli_num_rows($result) > 0) {
                // Ambil data dari setiap baris hasil query
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<h2>" . $row["judul"] . "</h2>";
                    echo "<hr>"; // Tambahkan garis pemisah
                    echo "<p class='text'>" . $row["deskripsi"] . "</p>";
                }
            } else {
                echo "Data about tidak ditemukan";
            }

            // Tutup koneksi database
            mysqli_close($koneksi);
            ?>
        </div>
    </main>
    <!-- Sertakan script untuk toggle sidebar -->
    <script src="sidebar.js"></script>
</body>
</html>
