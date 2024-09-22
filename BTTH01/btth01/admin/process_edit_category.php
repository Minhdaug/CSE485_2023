<?php
// Kết nối đến cơ sở dữ liệu
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tloai = $_POST['txtCatId'];
    $ten_tloai = $_POST['txtCatName'];

    // Thực hiện truy vấn cập nhật vào cơ sở dữ liệu
    $sql = "UPDATE theloai SET ten_tloai = '$ten_tloai' WHERE ma_tloai = '$ma_tloai'";
    if ($conn->query($sql) === TRUE) {
        header("Location: category.php?success=1");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>