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
    DiaChiIP VARCHAR(255),
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
INSERT INTO MayIn (ID, Hang, Model, KhayGiay, LoaiMuc, DiaChiIP, TinhTrang,  Kieu, SoGiayA4, SoGiayA3) VALUES
('MI0001', 'HP', 'MFP M236DW', '150 tờ/1 khay', 'HP 136X W1360X Đen', '202.199.66.211/6', 'Working',  'Laser', 100, 200),
('MI0002', 'Canon', 'GM3055', '100 tờ/2 khay', 'Canon CL-741', '164.247.164.35/21', 'Working',  'Inkjet',  100, 200),
('MI0003', 'Canon', 'GM2070', '150-100 tờ/2 khay', 'Canon CL-222', '235.174.206.149/7', 'Working',  'Laser', 100, 200),
('MI0004', 'HP', 'MFP M435DW', '150 tờ/1 khay', 'HP 134X W1340X Đen', '50.102.77.153/30', 'Disabled',  'Laser', 100, 200),
('MI0005', 'Canon', 'LBP2900', '200 tờ/1 khay', 'Canon K2240X ', '103.230.149.13/8', 'Working',  'Inkjet', 100, 200);


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



-- Insert data into LuotIn table
SOURCE LuotIn.sql;



-- Insert more data into TaiLieu table with 2-3 documents for each ID_LuotIn
SOURCE TaiLieu.sql;



-- Insert data into InAn table with shuffled values for ID_MayIn and ID_NguoiDung
SOURCE InAn.sql;
