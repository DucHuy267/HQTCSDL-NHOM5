<?php
include 'database.php';
include 'Model.php';

$iduser = $_POST['iduser'];
$amount = $_POST['amount'];
$total = $_POST['total'];
$detail = $_POST['detail'];
$model = new Model();

try {
    // Bắt đầu một giao dịch
    $model->query('START TRANSACTION');

    // Thêm vào bảng ordercart
    $query = 'INSERT INTO `ordercart`(`iduser`, `amount`, `total`) VALUES (' . $iduser . ',' . $amount . ',' . $total . ')';
    $result = $model->query($query);

    if (empty($result)) {
        throw new Exception("Đặt hàng thất bại");
    }

    // Lấy ID đơn hàng mới nhất
    $query = 'SELECT id FROM `ordercart` WHERE `iduser` = ' . $iduser . ' ORDER BY id DESC LIMIT 1';
    $idorder = $model->fetchAll($query);

    if (empty($idorder)) {
        throw new Exception("Lấy ID đơn hàng mới nhất thất bại");
    }

    // Giải mã chi tiết đơn hàng
    $detail = json_decode($detail, true);

    foreach ($detail as $key => $value) {
        $mealId = $value["mealDetail"]["id"];
        $orderedAmount = $value["amount"];

        // Kiểm tra xem còn đủ hàng trước khi cập nhật
        $checkStockQuery = 'SELECT `amount` FROM `mealDetail` WHERE `id` = ' . $mealId . ' FOR UPDATE';
        $stockData = $model->fetchAll($checkStockQuery);

        if (empty($stockData) || $stockData[0]['amount'] < $orderedAmount) {
            throw new Exception("Không đủ hàng cho món ăn có ID " . $mealId);
        }

        // Thêm vào bảng orderdetail
        $query = 'INSERT INTO `orderdetail`(`idorder`, `idMeal`, `amount`, `price`) VALUES (' . $idorder[0]["id"] . ',' . $mealId . ',' . $orderedAmount . ',' . $value["mealDetail"]["price"] . ')';
        $result = $model->query($query);

        if (empty($result)) {
            throw new Exception("Thêm chi tiết đơn hàng thất bại");
        }

        // Giảm số lượng của món ăn trong kho sau khi đặt hàng
        $updateQuery = 'UPDATE `mealDetail` SET `amount` = `amount` - ' . $orderedAmount . ' WHERE `id` = ' . $mealId;
        $updateResult = $model->query($updateQuery);

        if (empty($updateResult)) {
            throw new Exception("Cập nhật số lượng sản phẩm thất bại cho món ăn có ID " . $mealId);
        }
    }

    // Xác nhận giao dịch nếu tất cả thành công
    $model->query('COMMIT');

    $arr = [
        'success' => true,
        'message' => "Đặt hàng thành công và số lượng sản phẩm đã được cập nhật",
    ];

} catch (Exception $e) {
    // Hủy giao dịch nếu có lỗi xảy ra
    $model->query('ROLLBACK');

    $arr = [
        'success' => false,
        'message' => $e->getMessage(),
    ];
}

// Ghi lại log để kiểm tra lỗi
error_log(json_encode($arr));
echo json_encode($arr);
?>
