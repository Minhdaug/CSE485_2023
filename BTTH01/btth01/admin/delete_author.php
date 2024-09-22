<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Administration</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="./">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="../index.php">Trang ngoài</a></li>
                        <li class="nav-item"><a class="nav-link" href="category.php">Thể loại</a></li>
                        <li class="nav-item"><a class="nav-link active fw-bold" href="author.php">Tác giả</a></li>
                        <li class="nav-item"><a class="nav-link" href="article.php">Bài viết</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Xác nhận xóa tác giả</h3>
                <?php
                // Kết nối đến cơ sở dữ liệu
                include '../db.php';

                // Kiểm tra nếu có mã tác giả được truyền vào
                if (isset($_GET['id'])) {
                    $ma_tgia = $_GET['id'];

                    // Lấy thông tin tác giả từ cơ sở dữ liệu
                    $sql = "SELECT * FROM tacgia WHERE ma_tgia = '$ma_tgia'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $ten_tgia = $row['ten_tgia'];
                    } else {
                        echo "<p class='text-danger'>Không tìm thấy tác giả với mã: $ma_tgia</p>";
                        exit;
                    }
                } else {
                    echo "<p class='text-danger'>Mã tác giả không được cung cấp.</p>";
                    exit;
                }
                ?>
                <form action="process_delete_author.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthorId">Mã tác giả</span>
                        <input type="text" class="form-control" name="txtAuthorId" value="<?php echo $ma_tgia; ?>" readonly>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblAuthorName">Tên tác giả</span>
                        <input type="text" class="form-control" name="txtAuthorName" value="<?php echo $ten_tgia; ?>" readonly>
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" value="Xóa" class="btn btn-danger">
                        <a href="author.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>