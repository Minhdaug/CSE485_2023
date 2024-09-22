<?php
// Kết nối đến cơ sở dữ liệu
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tgia = $_POST['txtAuthorId'];
    $ten_tgia = $_POST['txtAuthorName'];

    // Thực hiện truy vấn cập nhật vào cơ sở dữ liệu
    $sql = "UPDATE tacgia SET ten_tgia = '$ten_tgia' WHERE ma_tgia = '$ma_tgia'";
    if ($conn->query($sql) === TRUE) {
        header("Location: author.php?success=1");
        exit();
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}
?>