<?php

include 'database.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ yêu cầu POST từ ứng dụng Android
$query = $_POST['query'];

// Câu lệnh SQL để tìm kiếm sản phẩm dựa trên tên
$sql = "SELECT * FROM meals WHERE strMeal LIKE '%" . $conn->real_escape_string($query) . "%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response = array();

    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    echo json_encode($response);
} else {
    echo json_encode(array()); // Trả về mảng rỗng nếu không tìm thấy kết quả
}

$conn->close();
?>
