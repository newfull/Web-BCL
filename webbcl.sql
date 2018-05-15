-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 10:16 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webbcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `ACCOUNTUSER` varchar(20) NOT NULL COMMENT 'Tên đăng nhập',
  `ACCOUNTPASS` varchar(20) NOT NULL COMMENT 'Mật khẩu',
  `ACCOUNTDATE` date NOT NULL COMMENT 'Ngày tạo',
  `ACCOUNTVALID` int(1) NOT NULL DEFAULT '1' COMMENT 'Tình trạng hoạt động',
  `ACCOUNTMODE` int(1) NOT NULL DEFAULT '0' COMMENT 'Cấp độ truy cập',
  `CUSTOMERID` int(11) DEFAULT NULL COMMENT 'Mã khách hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tài khoản đăng nhập';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCOUNTID`, `ACCOUNTUSER`, `ACCOUNTPASS`, `ACCOUNTDATE`, `ACCOUNTVALID`, `ACCOUNTMODE`, `CUSTOMERID`) VALUES
(1, 'newfull', 'dodien', '2018-05-01', 1, 1, NULL),
(2, 'newfull1', 'dodien', '2018-05-03', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `BLOGID` int(11) NOT NULL COMMENT 'Mã bài',
  `BLOGTITLE` varchar(500) NOT NULL COMMENT 'Tựa đề',
  `BLOGCONTENT` varchar(5000) NOT NULL COMMENT 'Nội dung',
  `BLOGDATE` datetime NOT NULL COMMENT 'Ngày tạo',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tin tức khuyến mãi';

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`BLOGID`, `BLOGTITLE`, `BLOGCONTENT`, `BLOGDATE`, `ACCOUNTID`) VALUES
(1, 'Test blog', 'Test tin khuyến mãiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', '2018-05-02 00:00:00', 1),
(2, 'Khuyến mãi ngày hè', 'Khuyến mãi ngày hè\r\nThật ngộ nghĩnh\r\n:D', '2018-05-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `ACCOUNTID` int(11) DEFAULT NULL COMMENT 'Mã tài khoản',
  `CARTTIME` datetime NOT NULL COMMENT 'Thời điểm tạo giỏ',
  `VALUE` decimal(13,2) NOT NULL DEFAULT '0.00' COMMENT 'Tổng giá trị'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Giỏ hàng';

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  `VALUE` decimal(13,2) NOT NULL COMMENT 'Số tiền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết giỏ hàng';

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

CREATE TABLE `combo` (
  `COMBOID` int(11) NOT NULL COMMENT 'Mã Combo',
  `COMBONAME` varchar(30) NOT NULL COMMENT 'Tên Combo',
  `COMBOPRICE` decimal(13,2) NOT NULL COMMENT 'Giá Combo',
  `COMBOLIKE` int(11) NOT NULL DEFAULT '0' COMMENT 'Số lượt thích',
  `COMBOSTATUS` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `COMBOIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Combo';

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`COMBOID`, `COMBONAME`, `COMBOPRICE`, `COMBOLIKE`, `COMBOSTATUS`, `COMBOIMGURL`) VALUES
(1, 'combo test 1', '50000.00', 0, 1, 'combo1.png'),
(2, 'combo test 2', '169000.00', 0, 1, 'combo2.png');

-- --------------------------------------------------------

--
-- Table structure for table `combo_detail`
--

CREATE TABLE `combo_detail` (
  `COMBOID` int(11) NOT NULL COMMENT 'Mã Combo',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết combo';

--
-- Dumping data for table `combo_detail`
--

INSERT INTO `combo_detail` (`COMBOID`, `ITEMID`, `QUANTITY`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 3, 1),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CUSTOMERID` int(11) NOT NULL COMMENT 'Mã khách hàng',
  `CUSTOMERNAME` varchar(30) NOT NULL COMMENT 'Họ tên',
  `CUSTOMEREMAIL` varchar(30) NOT NULL COMMENT 'Email',
  `CUSTOMERPHONE` int(11) NOT NULL COMMENT 'Số điện thoại',
  `CUSTOMERDOB` date NOT NULL COMMENT 'Ngày sinh',
  `CUSTOMERSEX` int(1) NOT NULL DEFAULT '1' COMMENT 'Giới tính (1: nam, 0: nữ)',
  `CUSTOMERADD` varchar(500) NOT NULL COMMENT 'Địa chỉ',
  `CUSTOMERNOTI` int(1) NOT NULL DEFAULT '0' COMMENT 'Nhận email từ hệ thống',
  `LIKEDITEMS` text COMMENT 'Các sản phẩm đã thích'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khách hàng';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CUSTOMERID`, `CUSTOMERNAME`, `CUSTOMEREMAIL`, `CUSTOMERPHONE`, `CUSTOMERDOB`, `CUSTOMERSEX`, `CUSTOMERADD`, `CUSTOMERNOTI`, `LIKEDITEMS`) VALUES
(1, 'công', 'ob@g.com', 123456789, '1997-05-03', 1, 'trị an', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `ITEMNAME` varchar(30) NOT NULL COMMENT 'Tên món',
  `ITEMPRICE` decimal(13,2) NOT NULL COMMENT 'Giá',
  `ITEM_TYPEID` int(11) NOT NULL COMMENT 'Mã loại',
  `ITEMSTOCK` int(11) NOT NULL COMMENT 'Số lượng tồn',
  `ITEMLIKED` int(11) NOT NULL DEFAULT '0' COMMENT 'Số lượt thích',
  `ITEMSTATUS` int(11) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `ITEMIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh',
  `ITEMISNEW` int(1) NOT NULL DEFAULT '1' COMMENT 'Nếu mới bán: 1, còn lại: 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Món ăn';

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEMID`, `ITEMNAME`, `ITEMPRICE`, `ITEM_TYPEID`, `ITEMSTOCK`, `ITEMLIKED`, `ITEMSTATUS`, `ITEMIMGURL`, `ITEMISNEW`) VALUES
(1, 'Gà truyền thống', '20000.00', 12, 1000, 0, 1, '12-1.png', 0),
(2, 'Gà giòn không cay', '25000.00', 12, 1000, 0, 1, '12-2.png', 1),
(3, 'Cơm gà viên', '30000.00', 13, 1000, 0, 1, '13-3.png', 1),
(4, 'Cơm gà giòn cay', '29000.00', 13, 1000, 0, 1, '13-4.png', 1),
(5, 'Khoai tây chiên (Vừa)', '15000.00', 16, 1000, 0, 1, '16-5.png', 1),
(6, 'Khoai tây chiên (Lớn)', '20000.00', 16, 1000, 0, 1, '16-6.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `ITEM_CATEGORYID` int(11) NOT NULL COMMENT 'Mã danh mục',
  `ITEM_CATEGORYNAME` varchar(30) NOT NULL COMMENT 'Tên danh mục',
  `ITEM_CATEGORYIMGNAME` text NOT NULL COMMENT 'Tên hình ảnh hiển thị',
  `ITEM_CATEGORYALIAS` varchar(20) NOT NULL COMMENT 'Id gọi tắt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_category`
--

INSERT INTO `item_category` (`ITEM_CATEGORYID`, `ITEM_CATEGORYNAME`, `ITEM_CATEGORYIMGNAME`, `ITEM_CATEGORYALIAS`) VALUES
(1, 'Gà rán & quay', 'ga-ran-quay.png', 'ga'),
(2, 'Cơm', 'com.png', 'com'),
(3, 'Tráng miệng', 'trang-mieng.png', 'trang-mieng'),
(4, 'Hamburger', 'hamburger.png', 'burger'),
(5, 'Thức uống', 'do-uong.png', 'thuc-uong');

-- --------------------------------------------------------

--
-- Table structure for table `item_promotion`
--

CREATE TABLE `item_promotion` (
  `ITMPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `HOURLYPR` int(1) NOT NULL DEFAULT '0' COMMENT 'Có khung giờ cố định?',
  `STARTHOUR` int(2) DEFAULT NULL COMMENT 'Giờ bắt đầu (24h)',
  `ENDHOUR` int(2) DEFAULT NULL COMMENT 'Giờ kết thúc (24h)',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khuyến mãi theo sản phẩm';

--
-- Dumping data for table `item_promotion`
--

INSERT INTO `item_promotion` (`ITMPR_ID`, `NAME`, `STARTDATE`, `ENDDATE`, `HOURLYPR`, `STARTHOUR`, `ENDHOUR`, `ACCOUNTID`) VALUES
(1, 'khuyến mãi mở quán', '2018-05-01', '2018-05-05', 0, NULL, NULL, 1),
(2, 'khuyến mãi cơm trưa', '2018-05-01', '2018-05-15', 1, 10, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_promotion_detail`
--

CREATE TABLE `item_promotion_detail` (
  `ITMPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `MINQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối thiểu',
  `MAXQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối đa',
  `NEWPRICE` decimal(10,0) DEFAULT NULL COMMENT 'Giá mới (nếu có) [Bỏ trống nếu khuyến mãi %]',
  `PRVALUE` int(2) DEFAULT '5' COMMENT 'Giá trị khuyến mãi (%) [Bỏ trống nếu đổi giá tự do]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết khuyến mãi theo sản phẩm';

--
-- Dumping data for table `item_promotion_detail`
--

INSERT INTO `item_promotion_detail` (`ITMPR_ID`, `ITEMID`, `MINQUANT`, `MAXQUANT`, `NEWPRICE`, `PRVALUE`) VALUES
(1, 1, 1, 1, NULL, 5),
(2, 3, 1, 1, '15000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `ITEM_TYPEID` int(11) NOT NULL COMMENT 'Mã loại',
  `ITEM_TYPENAME` varchar(30) NOT NULL COMMENT 'Tên loại',
  `UNIT_NAME` varchar(20) DEFAULT 'Phần' COMMENT 'Tên đơn vị tính',
  `ITEM_CATEGORYID` int(11) NOT NULL COMMENT 'Mã danh mục'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Loại';

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`ITEM_TYPEID`, `ITEM_TYPENAME`, `UNIT_NAME`, `ITEM_CATEGORYID`) VALUES
(12, 'Gà', 'Miếng', 1),
(13, 'Cơm', 'Phần', 2),
(14, 'Hamburger', 'Cái', 4),
(15, 'Nước', 'Ly', 5),
(16, 'Khoai tây chiên', 'Phần', 3),
(17, 'Bánh', 'Cái', 3),
(18, 'Kem cây', 'Cây', 3),
(19, 'Kem ly', 'Ly', 3),
(22, 'Salad', 'Phần', 3),
(23, 'Mì', 'Dĩa', 2),
(24, 'Canh', 'Phần', 2),
(25, 'Cơm thêm', 'Phần', 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `RECEIPTID` int(11) NOT NULL COMMENT 'Mã hóa đơn',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `RECEIPTTIME` datetime NOT NULL COMMENT 'Thời điểm thanh toán',
  `RECEIPTVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn'
  `RECEIPTADD` varchar(300) NOT NULL COMMENT 'Địa chỉ giao hàng',
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Hóa đơn';

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

CREATE TABLE `receipt_detail` (
  `RECEIPTID` int(11) NOT NULL COMMENT 'Mã hóa đơn',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  `VALUE` decimal(13,2) NOT NULL COMMENT 'Tổng giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết hóa đơn';

-- --------------------------------------------------------

--
-- Table structure for table `receipt_promotion`
--

CREATE TABLE `receipt_promotion` (
  `RCPPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `HOURLYPR` int(1) NOT NULL DEFAULT '0' COMMENT 'Có khung giờ cố định?',
  `STARTHOUR` int(11) DEFAULT NULL COMMENT 'Giờ bắt đầu',
  `ENDHOUR` int(11) DEFAULT NULL COMMENT 'Giờ kết thúc',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khuyến mãi trên hóa đơn';

--
-- Dumping data for table `receipt_promotion`
--

INSERT INTO `receipt_promotion` (`RCPPR_ID`, `NAME`, `STARTDATE`, `ENDDATE`, `HOURLYPR`, `STARTHOUR`, `ENDHOUR`, `ACCOUNTID`) VALUES
(1, 'khuyến mãi 1/5', '2018-05-01', '2018-05-31', 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_promotion_detail`
--

CREATE TABLE `receipt_promotion_detail` (
  `RCPPR_DTLID` int(11) NOT NULL COMMENT 'Mã chi tiết khuyến mãi',
  `RCPPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `MINRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối thiểu',
  `MAXRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối đa',
  `PROVALUE` int(2) NOT NULL DEFAULT '10' COMMENT 'Giá trị khuyến mãi (%)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết khuyến mãi';

--
-- Dumping data for table `receipt_promotion_detail`
--

INSERT INTO `receipt_promotion_detail` (`RCPPR_DTLID`, `RCPPR_ID`, `MINRCPVALUE`, `MAXRCPVALUE`, `PROVALUE`) VALUES
(1, 1, '100000.00', '200000.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_promotion_req`
--

CREATE TABLE `receipt_promotion_req` (
  `RCPPR_DTLID` int(11) NOT NULL COMMENT 'Mã chi tiết khuyến mãi',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `MINQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối thiểu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Điều kiện khuyến mãi';

--
-- Dumping data for table `receipt_promotion_req`
--

INSERT INTO `receipt_promotion_req` (`RCPPR_DTLID`, `ITEMID`, `MINQUANT`) VALUES
(1, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_promotion`
--

CREATE TABLE `user_promotion` (
  `USRPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `VALUE` int(2) NOT NULL COMMENT 'Giá trị khuyến mãi (%)',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `HOURLYPR` int(1) NOT NULL DEFAULT '0' COMMENT 'Có khung giờ cố định?',
  `STARTHOUR` int(11) DEFAULT NULL COMMENT 'Giờ bắt đầu',
  `ENDHOUR` int(11) DEFAULT NULL COMMENT 'Giờ kết thúc',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khuyến mãi cho tài khoản';

-- --------------------------------------------------------

--
-- Table structure for table `user_promotion_detail`
--

CREATE TABLE `user_promotion_detail` (
  `USRPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `BONUS` int(1) NOT NULL DEFAULT '0' COMMENT 'Khuyến mãi phụ (%), <=10%'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết khuyến mãi';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ACCOUNTID`),
  ADD UNIQUE KEY `ACCOUNTUSER` (`ACCOUNTUSER`),
  ADD KEY `CUSTOMERID` (`CUSTOMERID`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`BLOGID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CARTID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`CARTID`,`ITEMID`),
  ADD KEY `ITEMID` (`ITEMID`);

--
-- Indexes for table `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`COMBOID`);

--
-- Indexes for table `combo_detail`
--
ALTER TABLE `combo_detail`
  ADD PRIMARY KEY (`COMBOID`,`ITEMID`),
  ADD KEY `ITEMID` (`ITEMID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMERID`),
  ADD UNIQUE KEY `CUSTOMEREMAIL` (`CUSTOMEREMAIL`),
  ADD UNIQUE KEY `CUSTOMERPHONE` (`CUSTOMERPHONE`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ITEMID`),
  ADD KEY `ITEM_TYPEID` (`ITEM_TYPEID`);

--
-- Indexes for table `item_category`
--
ALTER TABLE `item_category`
  ADD PRIMARY KEY (`ITEM_CATEGORYID`);

--
-- Indexes for table `item_promotion`
--
ALTER TABLE `item_promotion`
  ADD PRIMARY KEY (`ITMPR_ID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `item_promotion_detail`
--
ALTER TABLE `item_promotion_detail`
  ADD PRIMARY KEY (`ITMPR_ID`,`ITEMID`),
  ADD KEY `ITEMID` (`ITEMID`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`ITEM_TYPEID`),
  ADD KEY `ITEM_CATEGORYID` (`ITEM_CATEGORYID`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`RECEIPTID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD PRIMARY KEY (`RECEIPTID`,`ITEMID`),
  ADD KEY `ITEMID` (`ITEMID`);

--
-- Indexes for table `receipt_promotion`
--
ALTER TABLE `receipt_promotion`
  ADD PRIMARY KEY (`RCPPR_ID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  ADD PRIMARY KEY (`RCPPR_DTLID`),
  ADD KEY `RCPPR_ID` (`RCPPR_ID`);

--
-- Indexes for table `receipt_promotion_req`
--
ALTER TABLE `receipt_promotion_req`
  ADD PRIMARY KEY (`RCPPR_DTLID`,`ITEMID`),
  ADD KEY `ITEMID` (`ITEMID`);

--
-- Indexes for table `user_promotion`
--
ALTER TABLE `user_promotion`
  ADD PRIMARY KEY (`USRPR_ID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- Indexes for table `user_promotion_detail`
--
ALTER TABLE `user_promotion_detail`
  ADD PRIMARY KEY (`USRPR_ID`,`ACCOUNTID`),
  ADD KEY `ACCOUNTID` (`ACCOUNTID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ACCOUNTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `BLOGID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã bài', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CARTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã giỏ';

--
-- AUTO_INCREMENT for table `combo`
--
ALTER TABLE `combo`
  MODIFY `COMBOID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Combo', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CUSTOMERID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khách hàng', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ITEMID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã món', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `ITEM_CATEGORYID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã danh mục', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_promotion`
--
ALTER TABLE `item_promotion`
  MODIFY `ITMPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `ITEM_TYPEID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã loại', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `RECEIPTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã hóa đơn';

--
-- AUTO_INCREMENT for table `receipt_promotion`
--
ALTER TABLE `receipt_promotion`
  MODIFY `RCPPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  MODIFY `RCPPR_DTLID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã chi tiết khuyến mãi', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_promotion`
--
ALTER TABLE `user_promotion`
  MODIFY `USRPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`CUSTOMERID`) REFERENCES `customer` (`CUSTOMERID`);

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_ibfk_1` FOREIGN KEY (`CARTID`) REFERENCES `cart` (`CARTID`),
  ADD CONSTRAINT `cart_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`);

--
-- Constraints for table `combo_detail`
--
ALTER TABLE `combo_detail`
  ADD CONSTRAINT `combo_detail_ibfk_1` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`),
  ADD CONSTRAINT `combo_detail_ibfk_2` FOREIGN KEY (`COMBOID`) REFERENCES `combo` (`COMBOID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`ITEM_TYPEID`) REFERENCES `item_type` (`ITEM_TYPEID`);

--
-- Constraints for table `item_promotion`
--
ALTER TABLE `item_promotion`
  ADD CONSTRAINT `item_promotion_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `item_promotion_detail`
--
ALTER TABLE `item_promotion_detail`
  ADD CONSTRAINT `item_promotion_detail_ibfk_1` FOREIGN KEY (`ITMPR_ID`) REFERENCES `item_promotion` (`ITMPR_ID`),
  ADD CONSTRAINT `item_promotion_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`);

--
-- Constraints for table `item_type`
--
ALTER TABLE `item_type`
  ADD CONSTRAINT `item_type_ibfk_1` FOREIGN KEY (`ITEM_CATEGORYID`) REFERENCES `item_category` (`ITEM_CATEGORYID`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD CONSTRAINT `receipt_detail_ibfk_1` FOREIGN KEY (`RECEIPTID`) REFERENCES `receipt` (`RECEIPTID`),
  ADD CONSTRAINT `receipt_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`);

--
-- Constraints for table `receipt_promotion`
--
ALTER TABLE `receipt_promotion`
  ADD CONSTRAINT `receipt_promotion_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  ADD CONSTRAINT `receipt_promotion_detail_ibfk_1` FOREIGN KEY (`RCPPR_ID`) REFERENCES `receipt_promotion` (`RCPPR_ID`);

--
-- Constraints for table `receipt_promotion_req`
--
ALTER TABLE `receipt_promotion_req`
  ADD CONSTRAINT `receipt_promotion_req_ibfk_1` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`),
  ADD CONSTRAINT `receipt_promotion_req_ibfk_2` FOREIGN KEY (`RCPPR_DTLID`) REFERENCES `receipt_promotion_detail` (`RCPPR_DTLID`);

--
-- Constraints for table `user_promotion`
--
ALTER TABLE `user_promotion`
  ADD CONSTRAINT `user_promotion_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`);

--
-- Constraints for table `user_promotion_detail`
--
ALTER TABLE `user_promotion_detail`
  ADD CONSTRAINT `user_promotion_detail_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`),
  ADD CONSTRAINT `user_promotion_detail_ibfk_2` FOREIGN KEY (`USRPR_ID`) REFERENCES `user_promotion` (`USRPR_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




----

-- check account 
DELIMITER $$
	CREATE FUNCTION func_account_chk(in user varchar(20))
    RETURNS int
    BEGIN
    	IF (EXISTS(SELECT * FROM account WHERE accountuser = user)) THEN
        	RETURN 0;
        ELSEIF 
        	RETURN 1;
        END IF;
        
    END;
DELIMITER
-- get last account id
DELIMITER $$
	CREATE FUNCTION func_account_lastID RETURNS int
    BEGIN
    	DECLARE LASTID INT;
        IF(EXISTS(SELECT TOP 1 accountID INTO LASTID FROM account ODER BY DESC accountID))
        	RETURN LASTID;
        ELSE
        	RETURN 1;
        END IF;

    END;
-- GET last customer id
CREATE FUNCTION func_customer_lastID RETURNS int
BEGIN
   	DECLARE LASTID INT;
    IF(EXISTS(SELECT TOP 1 accountID INTO LASTID FROM customer ODER BY DESC accountID))
  	RETURN LASTID;
    ELSE
      	RETURN 1;
    END IF;
END;
-- -x tạo account mới.
DELIMITER $$
	create PROCEDURE sp_account_cre (in username varchar(20),
                                     in pass varchar(20)
                                     )
BEGIN
	
     DECLARE chk int;
     SET chk = CALL func_account_chk(username);
     if(chk==1)
     	ROLLBACK;
     ELSE
     	DECLARE acc_lastID INT;
        SET acc_lastID = FUNC_ACCOUNT_LASTID;
     	INSERT into account VALUES (acc_lastID,USERNAME, PASS,NOW(),1,0,NULL);
        DECLARE cus_lastID int;
        SET cus_lastID = FUNC_customer_LASTID();
        
        
        
     END IF;
END;
                                     
DELIMITER
-- v- lay thong tin nguoi dung: ten, email, phone, dob
DELIMITER $$
create PROCEDURE sp_GetInfoUser (out @name varchar(30), 
                                  out @email varchar(30),
                                  out @phone int(11),
                                  out @dob date)
BEGIN
	SELECT customername, email, phone, dob, sex 
    into @name, @email, @phone, @dob
    from customer;
END
DELIMITER ;

-- x- lay ten va dia chi da giao trong qua khu
DELIMITER $$
create PROCEDURE sp_GetAddress(in @id int(11),
                                out @name varchar(30),
                                out @address varchar(500))
BEGIN
	SELECT CUSTOMERNAME, CUSTOMERADD into @name, @address	
    from account,customer,receipt
    where CUSTOMERID= id
END
DELIMITER ;

-- update thong tin customer
DELIMITER $$
CREATE PROCEDURE proc_UpdateKH(in @id int(11), 
                               in @name varchar(30),
                               in @email varchar(30),
                               in @phone int(11),
                               in @dob date,
                               in @sex int(1),
                               in @address varchar(300)
                               )
BEGIN
	if( EXISTS (select * from customer where CUSTOMERID = @id))  THEN RETURN;
    ELSE
    	UPDATE customer SET (@id, @name, @email,@phone, @dob, @sex, @address,0 ,'')
    end if;    
END
DELIMITER ;
-- them thong tin customer
DELIMITER $$
create PROCEDURE pro_ThemKH(in @id int(11), 
                            in @name varchar(30),
                            in @email varchar(30),
                            in @phone int(11),
                            in @dob date,
                            in @sex int(1),
                            in @address varchar(300)
                            )
BEGIN
	IF(EXISTS( SELECT * FROM CUSTOMER WHERE CUSTOMERID=@ID)) THEN RETURN;
    ELSEIF THEN INSERT INTO CUSTOMER VALUES (@id, @name, @email, @phone, @dob, @sex, @address,0,'');
END
DELIMITER ;

                               
