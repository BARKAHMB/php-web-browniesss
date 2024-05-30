<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sukses Abadi - History</title>
    <!-- Tambahkan fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Tambahkan stylesheet untuk bagian atas -->
    <link rel="stylesheet" href="atas.css">
    <!-- Masukkan CSS untuk sidebar -->
    <link rel="stylesheet" href="sidebar.css">
    <!-- Tambahkan CSS untuk tampilan history -->
    <style>
        /* CSS untuk tampilan history */
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
            height: 100%;
        }

        .sidebar {
            flex: 0 0 250px;
            background-color: #333;
            color: #fff;
            padding-top: 60px;
            box-sizing: border-box;
        }

        .content {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th, .history-table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .history-table th {
            background-color: #f2f2f2;
            color: #333;
        }

        .history-table td {
            color: #666;
        }

        .delete-btn {
            background-color: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #ff4830;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <div class="top">
                Menu
            </div>  
            <ul>
                <li><a href="index.html"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="garis1.html"><i class="fa fa-shopping-basket"></i> Orders</a></li>
                <li><a href="history.php"><i class="fa fa-shopping-bag"></i> History</a></li>
                <li><a href="garis2.php"><i class="fa fa-comment" aria-hidden="true"></i>Opinion</a></li>
                <li><a href="About.php"><i class="fa fa-address-card" aria-hidden="true"></i> About</a></li>
                <li><a href="home.php"><i class="fa fa-user-circle"></i> Profile</a></li>
            </ul>
        </div>
        <div class="content">
            <h1 class="page-title">History Pembelian</h1>
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pembelian</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Query SQL untuk menampilkan data dari tabel pembelian
                    $sql = "SELECT id, username, nama_barang, jumlah, total_harga, tanggal_pembelian, alamat, nomor_telepon FROM pembelian";
                    $result = $conn->query($sql);

                    // Memeriksa apakah ada hasil yang ditemukan
                    if ($result->num_rows > 0) {
                        // Output data dari setiap baris
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["nama_barang"] . "</td>";
                            echo "<td>" . $row["jumlah"] . "</td>";
                            echo "<td>" . number_format($row["total_harga"], 2, ',', '.') . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row["tanggal_pembelian"])) . "</td>"; // Ubah format tanggal di sini
                            echo "<td>" . $row["alamat"] . "</td>";
                            echo "<td>" . $row["nomor_telepon"] . "</td>";
                            echo "<td><button class='delete-btn' data-id='" . $row["id"] . "'>Delete</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Tidak ada data pembelian.</td></tr>";
                    }
                    

                    // Menutup koneksi
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Sertakan script untuk handle delete -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    fetch(`delete_purchase.php?id=${id}`, { method: 'GET' })
                        .then(response => response.text())
                        .then(data => {
                            if (data === 'success') {
                                alert('Data berhasil dihapus.');
                                location.reload();
                            } else if (data === 'error') {
                                alert('Gagal menghapus data.');
                            } else {
                                alert('Data tidak valid.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan.');
                        });
                }
            });
        });
    </script>
</body>
</html>
