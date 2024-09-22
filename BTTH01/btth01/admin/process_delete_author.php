<?php
// Kết nối đến cơ sở dữ liệu
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tgia = $_POST['txtAuthorId'];

    // Thực hiện truy vấn xóa từ cơ sở dữ liệu
    $sql = "DELETE FROM tacgia WHERE ma_tgia = '$ma_tgia'";
    if ($conn->query($sql) === TRUE) {
        header("Location: author.php?success=2"); // Chuyển hướng về danh sách tác giả
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>