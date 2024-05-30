<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Sukses Abadi - About</title>
    <!-- Add fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add stylesheet for the top section -->
    <link rel="stylesheet" href="atas.css">
    <!-- Add CSS for the sidebar -->
    <link rel="stylesheet" href="sidebar.css">
    <style>
        /* Your CSS styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .main-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            background-color: #f0f0f0;
        }

        .gallery-item {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .gallery-item img {
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .like-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .like-btn:hover {
            background-color: #45a049;
        }

        .comment-form {
            margin-top: 10px;
            display: flex;
            align-items: center;
            flex-direction: column; /* Ubah orientasi menjadi kolom */
        }

        .comment-form input[type="text"],
        .comment-form textarea {
            margin-bottom: 10px; /* Tambahkan margin-bottom untuk jarak antara input dan textarea */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        .comment-form button {
            margin-top: 10px; /* Tambahkan margin-top agar tombol Submit dan History terpisah */
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #45a049;
        }

        .comment-buttons {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        /* New styles for centering */
        .comment-form input[type="text"],
        .comment-form textarea,
        .comment-form button {
            width: 100%;
            box-sizing: border-box;
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
            <h2>Berikan Pendapat Anda Mengenai Brownies Kami Dan Like Jika Suka Dengan Brownies Kami</h2>
            <div class="gallery-container">
                <!-- PHP code to retrieve and display brownies data -->
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

                // Retrieve brownies data from database
                $sql = "SELECT * FROM brownies";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='gallery-item'>";
                        echo "<img src='" . $row["image_url"] . "' alt='Brownies'>";
                        echo "<button class='like-btn' data-brownie-id='" . $row["id"] . "' data-liked='" . ($row["likes"] > 0 ? "true" : "false") . "'><i class='fas fa-thumbs-up'></i> <span>" . $row["likes"] . "</span></button>"; // Tombol like
                        echo "<div class='comment-form'>";
                        echo "<form method='POST' action='".$_SERVER["PHP_SELF"]."'>";
                        echo "<input type='hidden' name='brownie_id' value='" . $row["id"] . "'>";
                        echo "<input type='text' name='commenter_name' placeholder='Your Name'>";
                        echo "<textarea name='comment_text' placeholder='Write your comment'></textarea>";
                        echo "<div class='comment-buttons'>";
                        echo "<button type='submit' name='submit'>Submit</button>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No brownies found.";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <!-- Include script for toggling sidebar -->
    <script src="sidebar.js"></script>
    <!-- Include JavaScript code for handling like button clicks -->
    <script>
    document.querySelectorAll('.like-btn').forEach(item => {
        item.addEventListener('click', event => {
            const brownieId = item.getAttribute('data-brownie-id');
            const liked = item.getAttribute('data-liked') === 'true';
            const formData = new FormData();
            formData.append('brownie_id', brownieId);

            fetch('update_likes.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Update jumlah like pada tombol
                const likeCountElement = item.querySelector('span');
                let likeCount = parseInt(likeCountElement.textContent);
                
                if (!liked) {
                    // Increment like count if not liked
                    likeCount++;
                    item.setAttribute('data-liked', 'true');
                } else {
                    // Decrement like count if already liked
                    likeCount = Math.max(0, likeCount - 1);
                    item.setAttribute('data-liked', 'false');
                }

                // Update like count display
                likeCountElement.textContent = likeCount;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>


    <?php
    // PHP code for inserting comments into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form data has been submitted
        if(isset($_POST['commenter_name']) && isset($_POST['comment_text']) && isset($_POST['brownie_id'])) {
            $commenterName = $_POST['commenter_name'];
            $commentText = $_POST['comment_text'];
            $brownieId = $_POST['brownie_id'];

            // Database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL INSERT statement
            $sql = "INSERT INTO comments (brownie_id, commenter_name, comment_text) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iss", $brownieId, $commenterName, $commentText);

            if ($stmt->execute()) {
                // Changed the alert message
                echo "<script>alert('Terimakasih Masukannya :');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Invalid data submitted!');</script>";
        }
    }
    ?>
</body>
</html>
