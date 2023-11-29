CREATE DATABASE smart_printing;
USE smart_printing;

-- Học sinh
CREATE TABLE NguoiDung (
    ID VARCHAR(16) PRIMARY KEY,
    Ten VARCHAR(255) NOT NULL,
    TenDangNhap VARCHAR(255) NOT NULL,
    SoLuongGiay INT
);

-- Lượt mua giấy
CREATE TABLE LuotMuaGiay (
    ID VARCHAR(16) PRIMARY KEY,
    ThoiGian TIMESTAMP NOT NULL,
    Loai VARCHAR(255) NOT NULL,
    SoLuong INT NOT NULL,
    ID_NguoiDung VARCHAR(16) NOT NULL,
    PhuongThucThanhToan VARCHAR(255) NOT NULL,
    FOREIGN KEY (ID_NguoiDung) REFERENCES NguoiDung(ID)
);

-- Quản trị viên
CREATE TABLE QuanTriVien (
    ID VARCHAR(16) PRIMARY KEY,
    Ten VARCHAR(255) NOT NULL,
    TenDangNhap VARCHAR(255) NOT NULL,
    ChucVu VARCHAR(255) NOT NULL
);

-- Lượt in
CREATE TABLE LuotIn (
    ID VARCHAR(16) PRIMARY KEY,
    ThoiGian TIMESTAMP NOT NULL,
    TinhTrang VARCHAR(255)
);

-- Tài liệu
CREATE TABLE TaiLieu (
    Ten VARCHAR(255),
    ID_LuotIn VARCHAR(16),
    SoTrang INT,
    SoBan INT,
    LoaiGiay VARCHAR(255),
    QRCode VARCHAR(255),
    SttHangDoi INT,
    PRIMARY KEY (Ten, ID_LuotIn),
    FOREIGN KEY (ID_LuotIn) REFERENCES LuotIn(ID) ON DELETE CASCADE
);

-- Máy in
CREATE TABLE MayIn (
    ID VARCHAR(16) PRIMARY KEY,
    Hang VARCHAR(255),
    Model VARCHAR(255),
    KhayGiay VARCHAR(255),
    LoaiMuc VARCHAR(255),
    ViTri VARCHAR(255),
    TinhTrang VARCHAR(255),
    Kieu VARCHAR(255),
    SoGiayA4 INT,
    SoGiayA3 INT
);


-- In: Table giữ mối quan hệ 3 ngôi của học sinh in, máy thực hiện in, lượt in được lưu vào lịch sử
CREATE TABLE InAn (
	STT INT AUTO_INCREMENT PRIMARY KEY,
    ID_LuotIn VARCHAR(16),
    ID_MayIn VARCHAR(16),
    ID_NguoiDung VARCHAR(16),
    FOREIGN KEY (ID_LuotIn) REFERENCES LuotIn(ID) ON DELETE SET NULL,
    FOREIGN KEY (ID_MayIn) REFERENCES MayIn(ID) ON DELETE SET NULL,
    FOREIGN KEY (ID_NguoiDung) REFERENCES NguoiDung(ID) ON DELETE SET NULL
);



-- Quản lý máy in
CREATE TABLE QuanLyMayIn (
    ID_MayIn VARCHAR(16),
    ID_QuanTriVien VARCHAR(16),
    PRIMARY KEY (ID_MayIn, ID_QuanTriVien),
    FOREIGN KEY (ID_MayIn) REFERENCES MayIn(ID),
    FOREIGN KEY (ID_QuanTriVien) REFERENCES QuanTriVien(ID)
);



-- Insert into Người Dùng table
INSERT INTO NguoiDung (ID, Ten, TenDangNhap, SoLuongGiay) VALUES
('ND0001', 'Nguyễn Văn A', 'A.Nguyen', 80),
('ND0002', 'Trần Thị B', 'B.Tran', 120),
('ND0003', 'Lê Văn C', 'C.Le', 90),
('ND0004', 'Phạm Thị D', 'D.Pham', 110),
('ND0005', 'Hoàng Văn E', 'E.Hoang', 70),
('ND0006', 'Ngô Thị F', 'F.Ngo', 130),
('ND0007', 'Đặng Văn G', 'G.Dang', 100),
('ND0008', 'Bùi Thị H', 'H.Bui', 15),
('ND0009', 'Vũ Văn I', 'I.Vu', 85),
('ND0010', 'Trương Thị K', 'K.Truong', 95);
INSERT INTO NguoiDung (ID, Ten, TenDangNhap, SoLuongGiay) VALUES
('ND0000', 'Mọi người', 'everyone', 00);
-- Insert into Quản trị viên table
INSERT INTO QuanTriVien (ID, Ten, TenDangNhap, ChucVu) VALUES
('QT0001', 'Nguyễn Thị L', 'L.Nguyen', 'Officer'),
('QT0002', 'Trần Văn M', 'M.Tran', 'Manager'),
('QT0003', 'Lê Thị N', 'N.Le', ''),
('QT0004', 'Phạm Văn P', 'P.Pham', 'Manager'),
('QT0005', 'Hoàng Thị Q', 'Q.Hoang', 'Officer'),
('QT0006', 'Ngô Văn R', 'R.Ngo', 'Director');


-- Insert into LuotMuaGiay table
INSERT INTO LuotMuaGiay (ID, ThoiGian, Loai, SoLuong, ID_NguoiDung, PhuongThucThanhToan) VALUES
('MG0001', '2023-04-12 14:00:00', 'A4', 150, 'ND0001', 'BKPay'),
('MG0002', '2023-05-18 10:30:00', 'A3', 80, 'ND0002', 'Momo'),
('MG0003', '2023-06-25 08:45:00', 'A3', 120, 'ND0003', 'OCB'),
('MG0004', '2023-07-02 16:20:00', 'A4', 200, 'ND0004', 'BKPay'),
('MG0005', '2023-08-09 12:15:00', 'A4', 90, 'ND0005', 'Momo'),
('MG0006', '2023-09-14 09:30:00', 'A3', 110, 'ND0006', 'OCB'),
('MG0007', '2023-10-20 11:45:00', 'A4', 180, 'ND0007', 'BKPay'),
('MG0008', '2023-11-27 13:00:00', 'A3', 100, 'ND0008', 'Momo'),
('MG0009', '2023-12-03 14:30:00', 'A3', 130, 'ND0009', 'OCB'),
('MG0010', '2024-01-10 09:00:00', 'A4', 160, 'ND0010', 'BKPay'),
('MG0011', '2024-02-17 15:45:00', 'A4', 120, 'ND0001', 'Momo'),
('MG0012', '2024-03-25 08:30:00', 'A3', 140, 'ND0002', 'OCB'),
('MG0013', '2024-04-01 16:10:00', 'A4', 180, 'ND0003', 'BKPay'),
('MG0014', '2024-05-08 12:00:00', 'A4', 110, 'ND0004', 'Momo'),
('MG0015', '2024-06-14 10:15:00', 'A3', 100, 'ND0005', 'OCB');




-- Insert data into MayIn table
INSERT INTO MayIn (ID, Hang, Model, KhayGiay, LoaiMuc, ViTri, TinhTrang,  Kieu, SoGiayA4, SoGiayA3) VALUES
('MI0001', 'HP', 'MFP M236DW', '150 tờ/1 khay', 'HP 136X W1360X Đen', '302B1', 'Working',  'Laser', 100, 200),
('MI0002', 'Canon', 'GM3055', '100 tờ/2 khay', 'Canon CL-741', '106A5', 'Working',  'Inkjet',  100, 200),
('MI0003', 'Canon', 'GM2070', '150-100 tờ/2 khay', 'Canon CL-222', '101H1', 'Working',  'Laser', 100, 200),
('MI0004', 'HP', 'MFP M435DW', '150 tờ/1 khay', 'HP 134X W1340X Đen', '203H6', 'Disabled',  'Laser', 100, 200),
('MI0005', 'Canon', 'LBP2900', '200 tờ/1 khay', 'Canon K2240X ', '103C6', 'Working',  'Inkjet', 100, 200);


-- Insert data into QuanLyMayIn table
INSERT INTO QuanLyMayIn (ID_MayIn, ID_QuanTriVien) VALUES
('MI0001', 'QT0001'),
('MI0001', 'QT0002'),
('MI0001', 'QT0003'),
('MI0002', 'QT0001'),
('MI0002', 'QT0002'),
('MI0003', 'QT0004'),
('MI0003', 'QT0005'),
('MI0003', 'QT0006'),
('MI0004', 'QT0004'),
('MI0005', 'QT0001'),
('MI0005', 'QT0002'),
('MI0005', 'QT0003'),
('MI0005', 'QT0004'),
('MI0005', 'QT0006');



-- Insert data into LuotIn table with administrator IDs in the range (1, 6)
INSERT INTO LuotIn (ID, ThoiGian, TinhTrang) VALUES
('LI0001', '2023-04-10 08:30:00', 'Đang In'),
('LI0002', '2023-05-15 10:00:00', 'Hoàn Thành'),
('LI0003', '2023-06-20 13:45:00', 'Đang In'),
('LI0004', '2023-07-25 15:30:00', 'Chờ Xử Lý'),
('LI0005', '2023-08-30 09:15:00', 'Hoàn Thành'),
('LI0006', '2023-09-05 14:00:00', 'Chờ Xử Lý'),
('LI0007', '2023-10-10 11:45:00', 'Hoàn Thành'),
('LI0008', '2023-11-15 09:30:00', 'Đang In'),
('LI0009', '2023-12-20 12:15:00', 'Chờ Xử Lý'),
('LI0010', '2024-01-25 16:45:00', 'Hoàn Thành'),
('LI0011', '2024-02-29 08:00:00', 'Đang In'),
('LI0012', '2024-03-05 14:30:00', 'Chờ Xử Lý'),
('LI0013', '2024-04-10 10:15:00', 'Hoàn Thành'),
('LI0014', '2024-05-15 13:00:00', 'Chờ Xử Lý'),
('LI0015', '2024-06-20 15:45:00', 'Đang In'),
('LI0016', '2024-07-25 11:30:00', 'Hoàn Thành'),
('LI0017', '2024-08-30 09:00:00', 'Đang In'),
('LI0018', '2024-09-05 14:45:00', 'Chờ Xử Lý'),
('LI0019', '2024-10-10 12:30:00', 'Hoàn Thành'),
('LI0020', '2024-11-15 08:15:00', 'Đang In'),
('LI0021', '2024-12-20 15:30:00', 'Chờ Xử Lý'),
('LI0022', '2025-01-25 13:45:00', 'Hoàn Thành'),
('LI0023', '2025-02-28 10:30:00', 'Đang In'),
('LI0024', '2025-03-05 16:00:00', 'Chờ Xử Lý'),
('LI0025', '2025-04-10 14:15:00', 'Hoàn Thành');


-- Insert more data into TaiLieu table with 2-3 documents for each ID_LuotIn
INSERT INTO TaiLieu (Ten, ID_LuotIn, SoTrang, SoBan, LoaiGiay, QRCode, SttHangDoi) VALUES
-- ID_LuotIn: LI0001
('Document1', 'LI0001', 12, 3, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 1),


-- ID_LuotIn: LI0002
('Document24', 'LI0002', 18, 4, 'A5', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 2),
('Document25', 'LI0002', 20, 3, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 3),


-- ID_LuotIn: LI0003
('Document27', 'LI0003', 8, 1, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 4),
('Document28', 'LI0003', 10, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 5),
('Document29', 'LI0003', 12, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 6),

-- ID_LuotIn: LI0004
('Document30', 'LI0004', 14, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 7),
('Document31', 'LI0004', 16, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 8),
('Document32', 'LI0004', 20, 1, 'B3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 9),

-- ID_LuotIn: LI0005
('Document33', 'LI0005', 22, 2, 'C4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 10);

-- Insert more data into TaiLieu table with 2-3 documents for each ID_LuotIn
INSERT INTO TaiLieu (Ten, ID_LuotIn, SoTrang, SoBan, LoaiGiay, QRCode, SttHangDoi) VALUES
-- ID_LuotIn: LI0006
('Document36', 'LI0006', 18, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 11),
('Document38', 'LI0006', 15, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 12),

-- ID_LuotIn: LI0007
('Document39', 'LI0007', 8, 1, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 13),
('Document40', 'LI0007', 10, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 14),
('Document41', 'LI0007', 12, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 15),

-- ID_LuotIn: LI0008
('Document42', 'LI0008', 14, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 16),


-- ID_LuotIn: LI0009
('Document45', 'LI0009', 22, 2, 'C4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 17),


-- ID_LuotIn: LI0010
('Document48', 'LI0010', 30, 2, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 18),
('Document49', 'LI0010', 35, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 19),
('Document50', 'LI0010', 40, 4, 'B5', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 20),

-- ID_LuotIn: LI0011
('Document51', 'LI0011', 28, 1, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 21),
('Document52', 'LI0011', 32, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 22),


-- ID_LuotIn: LI0012
('Document54', 'LI0012', 38, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 23),
('Document55', 'LI0012', 40, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 24),
('Document56', 'LI0012', 45, 2, 'B4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 25),

-- ID_LuotIn: LI0013
('Document57', 'LI0013', 26, 1, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 26),
('Document58', 'LI0013', 30, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 27),


-- ID_LuotIn: LI0014
('Document60', 'LI0014', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 28),
('Document61', 'LI0014', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 29),
('Document62', 'LI0014', 50, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 30),

-- ID_LuotIn: LI0015
('Document63', 'LI0015', 28, 1, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 31),
('Document64', 'LI0015', 32, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 32),
('Document65', 'LI0015', 36, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 33),

-- ID_LuotIn: LI0016
('Document66', 'LI0016', 38, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 34),


-- ID_LuotIn: LI0017
('Document69', 'LI0017', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 35),
('Document70', 'LI0017', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 36),

-- ID_LuotIn: LI0018
('Document72', 'LI0018', 42, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 37),
('Document73', 'LI0018', 46, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 38),


-- ID_LuotIn: LI0019
('Document75', 'LI0019', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 39),
('Document76', 'LI0019', 46, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 40),
('Document77', 'LI0019', 50, 2, 'B4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 41),
('Document22', 'LI0019', 50, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 42),
-- ID_LuotIn: LI0020
('Document78', 'LI0020', 42, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 43),
('Document79', 'LI0020', 46, 3, 'A3', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 44),
('Document80', 'LI0020', 50, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 45),
('Document77', 'LI0020', 50, 2, 'B4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 46),
-- ID_LuotIn: LI0021
('Document81', 'LI0021', 42, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 47),

-- ID_LuotIn: LI0022
('Document84', 'LI0022', 42, 4, 'A4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing',48),


-- ID_LuotIn: LI0023
('Document87', 'LI0023', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 49),
('Document88', 'LI0023', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 50),
('Document89', 'LI0023', 50, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 51),
('Document85', 'LI0022', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 52),
('Document86', 'LI0022', 50, 2, 'B4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 53),
-- ID_LuotIn: LI0024
('Document90', 'LI0024', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 54),
('Document91', 'LI0024', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 55),
('Document92', 'LI0024', 50, 2, 'B4', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 56),

-- ID_LuotIn: LI0025
('Document93', 'LI0025', 42, 4, 'A4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 57),
('Document94', 'LI0025', 46, 3, 'A3', 'https://drive.google.com/file/d/12AiWS8-BvyYpuKWfoJNDUcNLLKChh_tl/view?usp=sharing', 58),
('Document95', 'LI0025', 50, 2, 'B4', 'https://drive.google.com/file/d/15LzjQeoaKsAWClzEvk7g5XkFst3GsChy/view?usp=sharing', 59);


-- Insert data into InAn table with shuffled values for ID_MayIn and ID_NguoiDung
INSERT INTO InAn (ID_LuotIn, ID_MayIn, ID_NguoiDung) VALUES
('LI0001', 'MI0004', 'ND0001'),
('LI0002', 'MI0002', 'ND0009'),
('LI0003', 'MI0001', 'ND0004'),
('LI0004', 'MI0005', 'ND0005'),
('LI0005', 'MI0003', 'ND0008'),
('LI0006', 'MI0001', 'ND0002'),
('LI0007', 'MI0005', 'ND0003'),
('LI0008', 'MI0003', 'ND0007'),
('LI0009', 'MI0002', 'ND0006'),
('LI0010', 'MI0004', 'ND0010'),
('LI0011', 'MI0002', 'ND0005'),
('LI0012', 'MI0004', 'ND0008'),
('LI0013', 'MI0001', 'ND0003'),
('LI0014', 'MI0003', 'ND0001'),
('LI0015', 'MI0005', 'ND0009'),
('LI0016', 'MI0004', 'ND0002'),
('LI0017', 'MI0003', 'ND0004'),
('LI0018', 'MI0001', 'ND0006'),
('LI0019', 'MI0005', 'ND0007'),
('LI0020', 'MI0002', 'ND0010'),
('LI0021', 'MI0005', 'ND0001'),
('LI0022', 'MI0003', 'ND0002'),
('LI0023', 'MI0002', 'ND0008'),
('LI0024', 'MI0001', 'ND0004'),
('LI0025', 'MI0004', 'ND0003');
