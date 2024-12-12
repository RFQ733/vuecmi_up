<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cmi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT organism FROM linking";
$sql = "SELECT organism FROM organism";
$result = $conn->query($sql);

$organisms = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $organisms[] = $row["organism"];
        // unique the organisms
        $organisms = array_unique($organisms);
    }
} else {
    echo "0 results";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($organisms);
?>