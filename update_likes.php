<?php
// Check if brownie_id is set and is a number
if (isset($_POST['brownie_id']) && is_numeric($_POST['brownie_id'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "penjualan_brownies";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("UPDATE brownies SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $brownieId);

    // Set parameters and execute
    $brownieId = $_POST['brownie_id'];
    $stmt->execute();

    // Get updated likes count
    $sql = "SELECT likes FROM brownies WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $brownieId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $likes = $row['likes'];

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Return updated likes count as JSON
    echo json_encode(['likes' => $likes]);
} else {
    // If brownie_id is not set or not a number, return error
    echo json_encode(['error' => 'Invalid brownie_id']);
}
?>
