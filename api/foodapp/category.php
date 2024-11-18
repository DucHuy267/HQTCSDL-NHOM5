<?php 
include 'database.php';
include 'Model.php' ;

$model = new Model;

$query =' SELECT * FROM `category`';
$result = $model -> fetchAll($query);
if (!empty($result)) {
    $arr = [
        'success' => true,
        'message' => "thanh cong",
        'result' => $result
    ];
} else {
    $arr = [
        'success' => false,
        'message' => "khong thanh cong",
    ];

}
print_r(json_encode($arr));

?>