<?php
include 'database.php';

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die(json_encode(array("success" => 0, "message" => "Connection failed: " . $conn->connect_error)));
}

$idorder = $_POST['idorder'];

if (empty($idorder)) {
    die(json_encode(array("success" => 0, "message" => "idorder is required")));
}

$sql = "SELECT idorder, idMeal, amount, price FROM orderdetail WHERE idorder = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idorder);
$stmt->execute();
$result = $stmt->get_result();

$orderDetails = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orderDetails[] = $row;
    }
    echo json_encode(array("success" => 1, "data" => $orderDetails));
} else {
    echo json_encode(array("success" => 0, "message" => "No order details found"));
}

$stmt->close();
$conn->close();
?>
