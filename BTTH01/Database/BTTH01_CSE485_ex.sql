/* cau A*/
SELECT *
FROM btth01_cse485.baiviet
JOIN btth01_cse485.theloai ON baiviet.ma_tloai = theloai.ma_tloai
JOIN btth01_cse485.tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE theloai.ten_tloai = 'Nhạc trữ tình';

SELECT b.tieude, b.ten_bhat, b.tomtat, b.ngayviet
FROM baiviet b
JOIN theloai t ON b.ma_tloai = t.ma_tloai
WHERE t.ten_tloai = 'Nhạc trữ tình';

/* cau B*/
SELECT * FROM baiviet JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia WHERE tacgia.ten_tgia = 'Nhacvietplus';


/* cau C*/
SELECT theloai.ten_tloai
FROM theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
WHERE baiviet.ma_bviet IS NULL;


/* cau D*/
SELECT baiviet.ma_bviet, baiviet.tieude AS ten_bviet, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai;


/* cau E*/
SELECT theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM theloai
JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
GROUP BY theloai.ten_tloai
ORDER BY so_bai_viet DESC
LIMIT 1;


/* cau F*/
SELECT tacgia.ten_tgia, COUNT(baiviet.ma_bviet) AS so_bai_viet
FROM tacgia
JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY tacgia.ten_tgia
ORDER BY so_bai_viet DESC
LIMIT 2;

/* cau G*/
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, baiviet.ngayviet
FROM baiviet
WHERE baiviet.ten_bhat LIKE '%yêu%'
   OR baiviet.ten_bhat LIKE '%thương%'
   OR baiviet.ten_bhat LIKE '%anh%'
   OR baiviet.ten_bhat LIKE '%em%';

/* cau H*/
SELECT *
FROM baiviet
WHERE tieude LIKE '%yêu%' 
   OR tieude LIKE '%thương%' 
   OR tieude LIKE '%anh%' 
   OR tieude LIKE '%em%' 
   OR ten_bhat LIKE '%yêu%' 
   OR ten_bhat LIKE '%thương%' 
   OR ten_bhat LIKE '%anh%' 
   OR ten_bhat LIKE '%em%';

/* cau I*/
CREATE VIEW vw_Music AS
SELECT 
    b.ma_bviet,
    b.tieude,
    b.ten_bhat,
    b.tomtat,
    b.ngayviet,
    t.ten_tloai,
    a.ten_tgia
FROM 
    baiviet b
JOIN 
    theloai t ON b.ma_tloai = t.ma_tloai
JOIN 
    tacgia a ON b.ma_tgia = a.ma_tgia;


/* cau J*/
DELIMITER //
CREATE PROCEDURE sp_DSBaiViet(IN ten_the_loai VARCHAR(255))
BEGIN
    DECLARE cnt INT;

    -- Kiểm tra xem thể loại có tồn tại không
    SELECT COUNT(*) INTO cnt
    FROM theloai
    WHERE ten_tloai = ten_the_loai;

    IF cnt = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Thể loại không tồn tại';
    ELSE
        -- Trả về danh sách bài viết của thể loại đó
        SELECT 
            b.ma_bviet,
            b.tieude,
            b.ten_bhat,
            b.tomtat,
            b.ngayviet
        FROM 
            baiviet b
        JOIN 
            theloai t ON b.ma_tloai = t.ma_tloai
        WHERE 
            t.ten_tloai = ten_the_loai;
    END IF;
END //

DELIMITER ;


/* cau K*/

ALTER TABLE theloai
ADD COLUMN SLBaiViet INT DEFAULT 0;

DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

CREATE TRIGGER tg_CapNhatTheLoai_Update
AFTER UPDATE ON baiviet
FOR EACH ROW
BEGIN
    IF NEW.ma_tloai != OLD.ma_tloai THEN
        UPDATE theloai
        SET SLBaiViet = SLBaiViet - 1
        WHERE ma_tloai = OLD.ma_tloai;

        UPDATE theloai
        SET SLBaiViet = SLBaiViet + 1
        WHERE ma_tloai = NEW.ma_tloai;
    END IF;
END //

CREATE TRIGGER tg_CapNhatTheLoai_Delete
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END //

DELIMITER ;

/* cau L*/
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

INSERT INTO Users (username, password, role) VALUES 
('admin', '123', 'admin'),
('user1', '234', 'user'),
('user2', '234', 'user');
