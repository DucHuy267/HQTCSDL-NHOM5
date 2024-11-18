<?php 
include 'database.php';
include 'Model.php' ;

$model = new Model;
$id = $_POST['id'];

$query ='SELECT * FROM `mealdetail` WHERE `id`='.$id;
$result = $model -> fetchAll($query);
if (!empty($result)) {
    $arr = [
        'success' => true,
        'message' => "Thành công",
        'result' => $result
    ];
} else {
    $arr = [
        'success' => false,
        'message' => "không thành công kiểm tra lại",
    ];

}
print_r(json_encode($arr));

?>