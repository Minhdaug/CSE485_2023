<?php
// Kết nối đến cơ sở dữ liệu
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tloai = $_POST['txtCatId'];

    // Thực hiện truy vấn xóa từ cơ sở dữ liệu
    $sql = "DELETE FROM theloai WHERE ma_tloai = '$ma_tloai'";
    if ($conn->query($sql) === TRUE) {
        header("Location: category.php?success=2"); // Chuyển hướng về danh sách thể loại
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>