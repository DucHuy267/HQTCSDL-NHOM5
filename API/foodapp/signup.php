<?php
include 'database.php';
// Kết nối tới cơ sở dữ liệu
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die(json_encode(array("success" => 0, "message" => "Connection failed: " . $conn->connect_error)));
}

// Lấy dữ liệu từ yêu cầu
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Kiểm tra xem email đã tồn tại chưa
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(array("success" => 0, "message" => "Email already exists"));
} else {
    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Thêm người dùng mới vào cơ sở dữ liệu
    $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => 1, "message" => "Registration successful"));
    } else {
        echo json_encode(array("success" => 0, "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
?>
?>
