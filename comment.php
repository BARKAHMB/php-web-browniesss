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
        .comment-history {
    width: 80%; /* Lebar kontainer komentar */
    margin: 0 auto; /* Pusatkan kontainer komentar di tengah */
}

.comment {
    border: 1px solid #ccc; /* Tambahkan border untuk setiap komentar */
    padding: 10px; /* Berikan ruang di sekitar komentar */
    margin-bottom: 20px; /* Tambahkan jarak antara komentar */
}

.comment p {
    margin: 5px 0; /* Atur margin antara paragraf dalam komentar */
}

.comment p:first-child {
    margin-top: 0; /* Hapus margin atas dari paragraf pertama */
}

.comment p:last-child {
    margin-bottom: 0; /* Hapus margin bawah dari paragraf terakhir */
}

.commenter-name {
    font-weight: bold; /* Beri teks nama pengomentar ke tebal */
}

.comment-text {
    color: #333; /* Atur warna teks komentar */
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
                <li><a href="index.html"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="garis1.html"><i class="fa fa-shopping-basket"></i> Orders</a></li>
                <!--maksud dari garis1 adalah tempat pembelian brownies tersebut-->
                <li><a href="history.php"><i class="fa fa-shopping-bag"></i> History</a></li>
                <li><a href="#"><i class="fa fa-user-circle"></i> Profile</a></li>
                <li><a href="About.php"><i class="fa fa-address-card" aria-hidden="true"></i> About</a></li>
            </ul>
        </div>
        <div class="content">
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment History</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <h1>Comment History</h1>
    <div class="comment-history">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "penjualan_brownies";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve comments from the database
        $sql = "SELECT * FROM comments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p><strong>Commenter Name:</strong> " . $row["commenter_name"] . "</p>";
                echo "<p><strong>Comment:</strong> " . $row["comment_text"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No comments found.";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>

        </div>
    </main>
    <!-- Sertakan script untuk toggle sidebar -->
    <script src="sidebar.js"></script>
</body>
</html>
