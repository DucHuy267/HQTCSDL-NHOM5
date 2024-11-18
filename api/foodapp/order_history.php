<?php
include 'database.php';

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die(json_encode(array("success" => 0, "message" => "Connection failed: " . $conn->connect_error)));
}

$iduser = $_POST['iduser'];

$sql = "SELECT id, iduser, amount, total, date FROM ordercart WHERE iduser = '$iduser'";
$result = $conn->query($sql);

$orderHistory = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($orderHistory, $row);
    }
}

echo json_encode($orderHistory);

$conn->close();
?>
