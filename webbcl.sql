-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 30, 2018 at 12:58 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

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
CREATE DATABASE IF NOT EXISTS `webbcl` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `webbcl`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `SP_ADD_CART`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_CART` (IN `accid` INT(11))  BEGIN
	CALL SP_DEACTIVATE_OLD_CARTS(accid);
    INSERT INTO CART(ACCOUNTID) VALUES (accid);
END$$

DROP PROCEDURE IF EXISTS `SP_ADD_CART_DETAIL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_CART_DETAIL` (IN `cartid` INT(11), IN `itemid` INT(11))  NO SQL
BEGIN
	DECLARE cur int(11);
    SET cur = 0;
    
    SELECT cd.quantity into cur 
    from cart_detail cd 
    where cd.cartid = cartid and cd.itemid = itemid;
    
	IF(cur > 0) THEN
    BEGIN
		UPDATE cart_detail cd 
        SET cd.QUANTITY = cur + 1
    	WHERE cd.cartid = cartid and cd.itemid = itemid;
    END;
    ELSE
    BEGIN
    	INSERT INTO cart_detail(cartid, itemid)
        VALUES (cartid, itemid);
    END;
	END IF;    
END$$

DROP PROCEDURE IF EXISTS `SP_ADD_CART_DETAIL_COMBO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_CART_DETAIL_COMBO` (IN `cartid` INT(11), IN `comboid` INT(11))  NO SQL
BEGIN
	DECLARE cur int(11);
    SET cur = 0;
    
    SELECT cd.quantity into cur 
    from cart_detail_combo cd 
    where cd.cartid = cartid and cd.comboid = comboid;
    
	IF(cur > 0) THEN
    BEGIN
		UPDATE cart_detail_combo cd 
        SET cd.QUANTITY = cur + 1
    	WHERE cd.cartid = cartid and cd.comboid = comboid;
    END;
    ELSE
    BEGIN
    	INSERT INTO cart_detail_combo(cartid, comboid)
        VALUES (cartid, comboid);
    END;
	END IF;    
END$$

DROP PROCEDURE IF EXISTS `SP_DEL_ALL_CART_DETAIL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_ALL_CART_DETAIL` (IN `cartid` INT(11))  NO SQL
BEGIN
	DELETE FROM cart_detail
    WHERE cart_detail.cartid = cartid;
    
    DELETE FROM cart_detail_combo
    WHERE cart_detail_combo.cartid = cartid;
    
END$$

DROP PROCEDURE IF EXISTS `SP_DEL_CART_DETAIL`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_CART_DETAIL` (IN `cartid` INT(11), IN `itemid` INT(11))  NO SQL
BEGIN
	DELETE FROM CART_DETAIL
    WHERE CART_DETAIL.CARTID = cartid AND CART_DETAIL.ITEMID = itemid;
END$$

DROP PROCEDURE IF EXISTS `SP_DEL_CART_DETAIL_COMBO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_CART_DETAIL_COMBO` (IN `cartid` INT, IN `comboid` INT)  NO SQL
BEGIN
	DELETE FROM CART_DETAIL_COMBO
    WHERE CART_DETAIL_COMBO.CARTID = cartid AND CART_DETAIL_COMBO.comboid = comboid;
END$$

DROP PROCEDURE IF EXISTS `SP_GET_ACCOUNT_INFO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ACCOUNT_INFO` (IN `accid` INT(11))  NO SQL
SELECT A.* from ACCOUNT A where A.ACCOUNTID = accid$$

DROP PROCEDURE IF EXISTS `SP_GET_ALL_BLOGS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_BLOGS` ()  NO SQL
SELECT BLOGTITLE AS 'Ten', BLOGIMG as 'DuongDan', BLOGCONTENT as 'NoiDung', BLOGDATE as 'Ngay' FROM BLOG$$

DROP PROCEDURE IF EXISTS `SP_GET_ALL_COMBOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_COMBOS` ()  NO SQL
SELECT c.COMBONAME AS 'Ten',
c.COMBOID AS 'Ma',
c.COMBOPRICE AS 'Gia',
c.COMBOIMGURL AS 'DuongDan'
from combo c
WHERE c.COMBOSTATUS = 1$$

DROP PROCEDURE IF EXISTS `SP_GET_ALL_ITEMS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ITEMS` ()  NO SQL
SELECT i.ITEMNAME as 'Ten',
i.ITEMPRICE as 'Gia',
i.ITEMID as 'Ma',
i.ITEMIMGURL as 'DuongDan'
FROM ITEM i
WHERE i.ITEMSTATUS = 1$$

DROP PROCEDURE IF EXISTS `SP_GET_ALL_ITEM_CAT`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ITEM_CAT` ()  NO SQL
SELECT * from item_category$$

DROP PROCEDURE IF EXISTS `SP_GET_ALL_ITEM_TYPES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ALL_ITEM_TYPES` ()  NO SQL
SELECT * FROM ITEM_TYPE$$

DROP PROCEDURE IF EXISTS `SP_GET_CART_DETAILS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_CART_DETAILS` (IN `cartid` INT(11))  NO SQL
SELECT i.ITEMNAME as 'Ten', i.ITEMPRICE as 'Gia', i.ITEMIMGURL as 'DuongDan', cd.QUANTITY as 'SoLuong', i.ITEMID as 'Ma', cd.CARTID as 'Gio'
from cart_detail cd, item i
where cd.CARTID = cartid and cd.ITEMID = i.ITEMID$$

DROP PROCEDURE IF EXISTS `SP_GET_CART_DETAILS_COMBO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_CART_DETAILS_COMBO` (IN `cartid` INT(11))  NO SQL
SELECT i.comboname as 'Ten', i.comboprice as 'Gia', i.comboIMGURL as 'DuongDan', cd.QUANTITY as 'SoLuong', i.comboid as 'Ma', cd.CARTID as 'Gio'
from cart_detail_combo cd, combo i
where cd.CARTID = cartid and cd.comboid = i.comboid$$

DROP PROCEDURE IF EXISTS `SP_GET_COMBO_BY_NAME`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_COMBO_BY_NAME` (IN `keyword` VARCHAR(20))  NO SQL
SELECT i.COMBONAME as 'Ten',
i.COMBOPRICE as 'Gia',
i.COMBOID as 'Ma',
i.COMBOIMGURL as 'DuongDan'
FROM COMBO i
WHERE i.COMBOSTATUS = 1 AND LOWER(i.COMBONAME) LIKE CONCAT('%', CONVERT(LOWER(keyword), BINARY), '%')$$

DROP PROCEDURE IF EXISTS `SP_GET_COMBO_DETAILS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_COMBO_DETAILS` (IN `comboid` INT(11))  NO SQL
SELECT item.ITEMNAME as 'Ten', item.ITEMPRICE as 'Gia', cd.QUANTITY as 'SoLuong', type.UNIT_NAME as 'DonVi' 
from combo cb, combo_detail cd, item, item_type type
      where cb.COMBOID = comboid AND cd.COMBOID = cb.COMBOID
      AND cd.ITEMID = item.ITEMID AND item.ITEM_TYPEID = type.ITEM_TYPEID$$

DROP PROCEDURE IF EXISTS `SP_GET_ITEM_BY_NAME`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ITEM_BY_NAME` (IN `keyword` VARCHAR(20))  NO SQL
SELECT i.ITEMNAME as 'Ten',
i.ITEMPRICE as 'Gia',
i.ITEMID as 'Ma',
i.ITEMIMGURL as 'DuongDan'
FROM ITEM i
WHERE i.ITEMSTATUS = 1 AND LOWER(i.ITEMNAME) LIKE CONCAT('%', CONVERT(LOWER(keyword), BINARY), '%')$$

DROP PROCEDURE IF EXISTS `SP_GET_ITEM_INFO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ITEM_INFO` (IN `itemid` INT(11))  NO SQL
SELECT i.ITEMNAME as 'Ten', i.ITEMPRICE as 'Gia', i.ITEMIMGURL as 'DuongDan', i.ITEMSTATUS as 'TinhTrang', i.ITEMISNEW as 'SanPhamMoi', i.itemliked as 'LuotThich'
FROM item i
where i.itemid = itemid$$

DROP PROCEDURE IF EXISTS `SP_GET_ITEM_PRICE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_ITEM_PRICE` (IN `itemid` INT(11), OUT `oprice` DECIMAL(13,2))  BEGIN
	CALL SP_PROMOTION_UPDSTATUS();
    
	IF EXISTS(SELECT * FROM item_promotion a, item_promotion_detail b WHERE a.STATUS = 1 AND a.ITMPR_ID = b.ITMPR_ID and b.ITEMID = itemid) then
		SELECT IF(d.newprice>0,d.newprice,e.ITEMPRICE*(100-d.PRVALUE)/100) into oprice 
        FROM item_promotion_detail d, ITEM e
        WHERE d.ITEMID = itemid and e.ITEMID = itemid LIMIT 1;
     ELSE
     	SELECT ITEMPRICE INTO oprice FROM ITEM WHERE ITEMID = itemid LIMIT 1;
     END IF;
     
END$$

DROP PROCEDURE IF EXISTS `SP_GET_LIKED_COMBOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_LIKED_COMBOS` (IN `accid` INT(11))  NO SQL
select i.comboid AS 'Ma', i.comboname AS 'Ten', i.comboprice as 'Gia', i.comboimgurl as 'DuongDan', i.combostatus as 'TinhTrang' from combo i, account a
where 
a.ACCOUNTID = accid AND 
(
    (i.comboid = a.ACCOUNTLIKEDCOMBOS) 
    or (LOCATE(CONCAT(',', i.comboid,','),a.ACCOUNTLIKEDCOMBOS) > 0)
    or 
    (
        (LOCATE(CONCAT(',', i.comboid),a.ACCOUNTLIKEDCOMBOS) > 0)
        AND
        (
            (LENGTH(CONCAT(',', i.comboid))
             + (LOCATE(CONCAT(',', i.comboid),a.ACCOUNTLIKEDCOMBOS))
             = (LENGTH(a.ACCOUNTLIKEDCOMBOS)) + 1
            )
        )
    )
)$$

DROP PROCEDURE IF EXISTS `SP_GET_LIKED_ITEMS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_LIKED_ITEMS` (IN `accid` INT(11))  NO SQL
select i.itemid AS 'Ma', i.itemname AS 'Ten', i.ITEMPRICE as 'Gia', i.itemimgurl as 'DuongDan', i.itemstatus as 'TinhTrang' from item i, account a
where a.ACCOUNTID = accid AND 
(i.itemid = a.ACCOUNTLIKEDITEMS 
or LOCATE(CONCAT(',', i.itemid,','),a.ACCOUNTLIKEDITEMS) > 0
or 
 (
     (
         (LOCATE(CONCAT(',', i.itemid),a.ACCOUNTLIKEDITEMS) > 0)
         AND 
         (LENGTH(i.itemid) + 
          LOCATE(CONCAT(',', i.itemid),a.ACCOUNTLIKEDITEMS) 
          = LENGTH(a.ACCOUNTLIKEDITEMS)
         )
     )
 )
)$$

DROP PROCEDURE IF EXISTS `SP_GET_LIST_ITEM_OF_CAT`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_LIST_ITEM_OF_CAT` (IN `item_cat` INT(11))  NO SQL
SELECT i.ITEMNAME as 'Ten',
i.ITEMPRICE as 'Gia',
i.ITEMID as 'Ma',
i.ITEMIMGURL as 'DuongDan' from item i, item_type type, item_category cat
    where cat.ITEM_CATEGORYID = item_cat and type.ITEM_CATEGORYID = cat.ITEM_CATEGORYID
    and i.ITEM_TYPEID = type.ITEM_TYPEID and i.ITEMSTATUS = 1$$

DROP PROCEDURE IF EXISTS `SP_UPD_ACCOUNT_ADD`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_ACCOUNT_ADD` (IN `accid` INT, IN `accadd` VARCHAR(500))  NO SQL
BEGIN
UPDATE account
SET ACCOUNTADD = accadd
where accountid = accid;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_ACCOUNT_INFO`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_ACCOUNT_INFO` (IN `accid` INT(11), IN `name` VARCHAR(30), IN `email` TEXT, IN `phone` VARCHAR(11), IN `dob` TEXT, IN `sex` INT(1), IN `noti` INT(1))  NO SQL
BEGIN
UPDATE ACCOUNT
    SET ACCOUNTNAME = name, ACCOUNTEMAIL = email, ACCOUNTPHONE = phone, ACCOUNTDOB = str_to_date(dob, "%d-%m-%Y"), ACCOUNTSEX = sex, ACCOUNTNOTI = noti
    WHERE ACCOUNTID = accid;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_ACCOUNT_PASS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_ACCOUNT_PASS` (IN `accid` INT(11), IN `pass` TEXT)  NO SQL
BEGIN
UPDATE account
SET ACCOUNTPASS = pass 
WHERE ACCOUNTID = accid;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_CART_VALUE`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_CART_VALUE` (IN `cart_id` INT(11), IN `detail_val` DECIMAL(13,2))  BEGIN
	DECLARE curval decimal(13,2);
    	DECLARE proval int(2);
	call SP_PROMOTION_UPDSTATUS();
    SELECT x.VALUE into curval FROM cart x where x.CARTID = cart_id;
set curval = curval + detail_val;
    IF EXISTS(SELECT * FROM receipt_promotion a WHERE a.STATUS = 1) then
		BEGIN
	Set proval = 0;
	        SELECT Y.PROVALUE INTO proval FROM receipt_promotion_detail Y, receipt_promotion X 
                WHERE X.STATUS = 1 AND Y.RCPPR_ID = X.RCPPR_ID AND curval >= Y.MINRCPVALUE AND curval <= Y.MAXRCPVALUE;

IF EXISTS(SELECT * FROM receipt_promotion_req O, receipt_promotion_detail M, receipt_promotion N
            WHERE N.STATUS = 1 AND M.RCPPR_ID = N.RCPPR_ID AND O.RCPPR_DTLID = M.RCPPR_DTLID) THEN
            begin
                if not exists(select distinct t.ITEMID from cart_detail t, receipt_promotion_req e
                where t.ITEMID = e.ITEMID and t.QUANTITY >= e.MINQUANT) THEN
                	SET proval = 0;
                 END IF;
            END;  
            END IF;
            set curval = curval*(100-proval)/100;
END;
    END IF;
    update cart v set v.VALUE = curval where v.CARTID = cart_id;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_DEACTIVATE_OLD_CARTS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_DEACTIVATE_OLD_CARTS` (IN `acc_id` INT(11))  BEGIN
	UPDATE CART
    SET CART.ACTIVE = 0
    WHERE CART.ACCOUNTID = acc_id;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_LIKED_COMBOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_LIKED_COMBOS` (IN `accid` INT(11), IN `likedcombos` TEXT)  NO SQL
BEGIN
	UPDATE ACCOUNT
    SET ACCOUNT.ACCOUNTLIKEDCOMBOS = likedcombos
    WHERE ACCOUNT.ACCOUNTID = accid;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_LIKED_ITEMS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_LIKED_ITEMS` (IN `accid` INT(11), IN `likeditems` TEXT)  NO SQL
BEGIN
	UPDATE ACCOUNT
    SET ACCOUNT.ACCOUNTLIKEDITEMS = likeditems
    WHERE ACCOUNT.ACCOUNTID = accid;
END$$

DROP PROCEDURE IF EXISTS `SP_UPD_PROMOTION_STT`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPD_PROMOTION_STT` ()  BEGIN
	UPDATE item_promotion SET STATUS = 0
    WHERE DATEDIFF(ENDDATE, CURDATE())  < 0;
UPDATE RECEIPT_promotion SET STATUS = 0
    WHERE DATEDIFF(ENDDATE, CURDATE())  < 0;

END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `FN_CHANGE_CART_DETAIL_COMBO_QUANT`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_CHANGE_CART_DETAIL_COMBO_QUANT` (`cartid` INT(11), `comboid` INT(11), `val` INT(11)) RETURNS INT(11) NO SQL
BEGIN
	DECLARE result int(11);
    SET result = "0";
    
    SELECT QUANTITY into result
    FROM CART_DETAIL_COMBO cd
    WHERE cd.CARTID = cartid AND cd.comboid = comboid;
    
    IF(result != "0") THEN
    BEGIN
    	SET result = result + val;
        UPDATE CART_DETAIL_COMBO cd
        SET cd.QUANTITY = result
        WHERE cd.CARTID = cartid AND cd.comboid = comboid;
	END;
    END IF;
    
    RETURN result;
END$$

DROP FUNCTION IF EXISTS `FN_CHANGE_CART_DETAIL_QUANT`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_CHANGE_CART_DETAIL_QUANT` (`cartid` INT(11), `itemid` INT(11), `val` INT(11)) RETURNS INT(11) NO SQL
BEGIN
	DECLARE result int(11);
    SET result = "0";
    
    SELECT QUANTITY into result
    FROM CART_DETAIL cd
    WHERE cd.CARTID = cartid AND cd.ITEMID = itemid;
    
    IF(result != "0") THEN
    BEGIN
    	SET result = result + val;
        UPDATE CART_DETAIL cd
        SET cd.QUANTITY = result
        WHERE cd.CARTID = cartid AND cd.ITEMID = itemid;
	END;
    END IF;
    
    RETURN result;
END$$

DROP FUNCTION IF EXISTS `FN_CHECK_PASS`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_CHECK_PASS` (`accid` INT(11), `pass` TEXT) RETURNS INT(1) NO SQL
BEGIN
 	DECLARE result int(1);
    SET result = "0";
    
    SELECT COUNT(*) into result
    FROM ACCOUNT
    WHERE ACCOUNTID = accid AND ACCOUNTPASS = pass;
    
    RETURN result;
END$$

DROP FUNCTION IF EXISTS `FN_GET_CARTID`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_GET_CARTID` (`accid` INT(11)) RETURNS INT(11) BEGIN
	DECLARE cartid int(11);
	SET cartid = "-1";
	SELECT C.cartid into cartid
    FROM CART C 
    WHERE C.accountid = accid and C.active = 1;
    
    RETURN cartid;
END$$

DROP FUNCTION IF EXISTS `FN_GET_CART_VALUE`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_GET_CART_VALUE` (`cartid` INT(11)) RETURNS DECIMAL(13,2) NO SQL
BEGIN
	DECLARE total decimal(13,2);
    DECLARE total_combo decimal(13,2);
    SET total = "0";
    SET total_combo = "0";
    
    SELECT SUM(i.ITEMPRICE*cd.QUANTITY) into total
    from cart_detail cd, item i
    where cd.CARTID = cartid and cd.ITEMID = i.ITEMID
    group by cd.CARTID;
    
    SELECT SUM(i.comboprice*cd.QUANTITY) into total_combo
    from cart_detail_combo cd, combo i
    where cd.CARTID = cartid and cd.comboid = i.comboid
    group by cd.CARTID;

	SET total = total + total_combo;
    
	RETURN total;
END$$

DROP FUNCTION IF EXISTS `FN_LOGIN`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `FN_LOGIN` (`username` VARCHAR(20), `password` VARCHAR(100)) RETURNS INT(11) NO SQL
BEGIN
	DECLARE accid int(11);
    SET accid = 0;
    
	SELECT a.accountid INTO accid
    FROM account a
    WHERE a.accountuser = username AND a.accountpass = password;
    
    RETURN accid;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `ACCOUNTUSER` varchar(20) NOT NULL COMMENT 'Tên đăng nhập',
  `ACCOUNTPASS` text NOT NULL COMMENT 'Mật khẩu',
  `ACCOUNTNAME` varchar(30) NOT NULL COMMENT 'Tên người dùng',
  `ACCOUNTEMAIL` text NOT NULL COMMENT 'Email',
  `ACCOUNTPHONE` varchar(11) NOT NULL COMMENT 'Điện thoại',
  `ACCOUNTDOB` date NOT NULL COMMENT 'Sinh nhật',
  `ACCOUNTSEX` int(1) NOT NULL COMMENT 'Giới tính (1- Nam, 0- Nữ)',
  `ACCOUNTADD` varchar(500) NOT NULL COMMENT 'Địa chỉ',
  `ACCOUNTDATE` date NOT NULL COMMENT 'Ngày tạo',
  `ACCOUNTVALID` int(1) NOT NULL DEFAULT '1' COMMENT 'Tình trạng hoạt động',
  `ACCOUNTLIKEDITEMS` text COMMENT 'Sản phẩm đang thích',
  `ACCOUNTLIKEDCOMBOS` text COMMENT 'Combo đang thích',
  `ACCOUNTNOTI` int(1) NOT NULL DEFAULT '1' COMMENT 'Nhận thông báo từ website'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tài khoản đăng nhập';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCOUNTID`, `ACCOUNTUSER`, `ACCOUNTPASS`, `ACCOUNTNAME`, `ACCOUNTEMAIL`, `ACCOUNTPHONE`, `ACCOUNTDOB`, `ACCOUNTSEX`, `ACCOUNTADD`, `ACCOUNTDATE`, `ACCOUNTVALID`, `ACCOUNTLIKEDITEMS`, `ACCOUNTLIKEDCOMBOS`, `ACCOUNTNOTI`) VALUES
(4, 'kaito', 'pass', 'Bien', 'Bien@gmail.com', '1234567891', '1997-01-01', 1, 'Quang Nam', '0000-00-00', 1, NULL, NULL, 0),
(5, 'newfull', '0ede32830053dc3d1a9dbdd98e71dea4', 'Nguyễn Thành Công', 'obmega3@gmail.com', '0911111112', '1997-01-02', 1, 'KTX Khu B ĐHQG TPHCM, Phường Linh Trung, Quận Thủ Đức, Thành phố Hồ Chí Minh', '2018-05-15', 1, '2,26,1', '3', 0);

--
-- Triggers `account`
--
DROP TRIGGER IF EXISTS `trig_account_insertAFTER`;
DELIMITER $$
CREATE TRIGGER `trig_account_insertAFTER` AFTER INSERT ON `account` FOR EACH ROW BEGIN   
	INSERT INTO CART(ACCOUNTID) VALUES (NEW.ACCOUNTID);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `EMPID` int(11) NOT NULL COMMENT 'Mã nhân viên',
  `EMPNAME` varchar(30) NOT NULL COMMENT 'Tên nhân viên',
  `EMPDOB` date NOT NULL COMMENT 'Ngày sinh',
  `EMPADD` varchar(500) NOT NULL COMMENT 'Địa chỉ',
  `EMPPHONE` varchar(11) NOT NULL COMMENT 'Số điện thoại',
  `EMPSAL` decimal(13,2) NOT NULL COMMENT 'Lương nhân viên',
  `EMPLVL` int(1) NOT NULL DEFAULT '1' COMMENT '1 - quản lý, 2 - nhân viên',
  `EMPPAYRATE` decimal(2,0) NOT NULL DEFAULT '1' COMMENT 'Hệ số lương'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Bảng tài khoản Admin';

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`EMPID`, `EMPNAME`, `EMPDOB`, `EMPADD`, `EMPPHONE`, `EMPSAL`, `EMPLVL`, `EMPPAYRATE`) VALUES
(1, 'Công', '2018-06-05', 'Địa chỉ', '0123456789', '20000.00', 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `BLOGID` int(11) NOT NULL COMMENT 'Mã bài',
  `BLOGTITLE` varchar(500) NOT NULL COMMENT 'Tựa đề',
  `BLOGIMG` text NOT NULL COMMENT 'Đường dẫn tới ảnh hiển thị',
  `BLOGCONTENT` varchar(5000) NOT NULL COMMENT 'Nội dung',
  `BLOGDATE` datetime NOT NULL COMMENT 'Ngày tạo',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tin tức khuyến mãi';

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`BLOGID`, `BLOGTITLE`, `BLOGIMG`, `BLOGCONTENT`, `BLOGDATE`, `EMPID`) VALUES
(1, 'KHUẤY ĐỘNG HÈ CÙNG BÉ TẠI KFC! GIẢM NGAY 25% CHO HÓA ĐƠN TỪ 120.000 ĐỒNG!', '1.png', 'Một mùa hè sôi động lại đến, các anh chị phụ huynh hãy thưởng cho các bé iu nhà mình bằng một bữa tiệc “Gà Rán KFC” hoành tráng để khích lệ tinh thần của các bé iu đi nào.\r\n\r\nNhân dịp Quốc Tế Thiếu Nhi 1.6 và để khởi đầu một mùa hè tràn đầy năng lượng, KFC giảm ngay 25% trên tổng giá trị hóa đơn khi dùng bữa tại các nhà hàng KFC trên toàn quốc với đơn hàng từ 120.000 đồng trở lên, có ít nhất 1 Combo Kiddie 55k.\r\n\r\nChương trình này áp dụng tại tất cả các nhà hàng KFC trên toàn quốc đến hết ngày 31/7/2018.\r\n\r\nKhông áp dụng cho thẻ giảm giá, dịch vụ tiệc sinh nhật, đơn hàng trên 2.000.000 đồng, giao hàng tận nơi và các chương trình khuyến mãi khác.\r\n\r\nCả nhà hãy kéo ngay đến KFC để mở tiệc ăn mừng hè đi nào!!!\r\n\r\n#KFCVietNam#QuocTeThieuNhi#1.6#Uudai25%', '2018-06-04 00:00:00', 1),
(2, 'GÀ KẸP ZINBO - BURGER KHÔNG BÁNH CHỈ GÀ!', '2.png', 'KFC vừa trình làng một siêu phẩm mới Gà Kẹp Zinbo mới, burger không bánh chỉ gà, đang làm “xôn xao\" các tín đồ ẩm thực.\r\n\r\nGà kẹp Zinbo với 2 miếng thịt ức Gà giòn cay được thay cho 2 lớp bánh burger truyền thống, kẹp giữa là rau xà-lách tươi và lát thơm ngọt thanh được phủ thêm 2 lớp sốt Mayonnaise thơm béo và sốt gà nướng hương chanh, tạo nên món burger Gà Kẹp Zinbo KFC độc đáo với hương vị thơm ngon mới lạ mang lại trải nghiệm ẩm thực thật thú vị. Giá cực hợp lý chỉ 59.000đ/cái đảm bảo vừa ăn no say luôn vửa ngon không thể tả. Hoặc các fans có thể chọn ngay những combo giá cực ưu đãi sau:\r\n\r\nCombo Zinbo 1: gồm 1 Gà Kẹp Zinbo + 1 Khoai Tây Chiên (vừa) + 1 Pepsi (vừa) với giá siêu hợp lý chỉ 79.000đ\r\nCombo Zinbo 2: gồm 1 Gà Kẹp Zinbo + 1 miếng Gà Giòn Cay/Gà Giòn Không Cay/Truyền Thống + 1 Khoai Tây Chiên (vừa) + 1 Pepsi (vừa) chỉ 109.000đ cho phần ăn siêu ngon no căng bụng.\r\nSản phẩm hiện đang được bán tại tất cả nhà hàng KFC trên toàn quốc. Áp dụng cho cả Giao hàng tận nơi.\r\n\r\nHãy đến và dùng thử siêu phẩm Gà Kẹp Zinbo cùng KFC nhé!\r\n\r\n#KFC #KFCVietnam #GaKepZinbo #Zinbo', '2018-06-03 00:00:00', 1),
(3, 'VUI ĂN GÀ - CÙNG KFC DỰ ĐOÁN BÓNG ĐÁ!', '3.png', 'Hòa mình cùng bầu không khí cực kì sôi động của môn thể thao vua với Giải Vô Địch Bóng Đá Thế Giới lần thứ 21 đang diễn ra tưng bừng trên khắp hành tinh và đánh dấu bước ngoặt của năm thứ 21 KFC có mặt tại Việt Nam. Chương trình “Vui ăn gà - Cùng KFC dự đoán bóng đá” là câu chuyện song hành giữa niềm đam mê ẩm thực cùng tình yêu bóng đá nồng cháy của mùa bóng năm nay. Hãy cùng KFC vừa thưởng thức những trận đấu sôi nổi, kịch tính, vừa dự đoán kết quả của những vòng đấu để nhận ngay những phần quà cực chất.\r\n\r\n1. Cách thức tham gia dễ dàng và trúng ngay vô vàn những giải thưởng hấp dẫn:\r\n\r\n- Bước 1: Chọn mua Combo “KFC Foodball 21” để nhận ngay phiếu tham gia dự  đoán bóng đá sau:\r\n\r\nCombo KFC Foodball 21 84k giá 84.000đ (gồm 3 miếng Gà Giòn Cay/Gà Truyền Thống/Gà Giòn Không Cay + 2 Pepsi (vừa) để NHẬN NGAY 1 Phiếu cào tham gia dự đoán.\r\nCombo KFC Foodball 21 184k giá 184.000đ (gồm 6 miếng Gà Giòn Cay/Gà Truyền Thống/ Gà Giòn Không Cay + 3 Pepsi (LỚN) để NHẬN NGAY 3 Phiếu cào tham gia dự đoán. Phần ăn đủ cho cả nhà vừa ăn vừa xem bóng đá.\r\n- Bước 2: Cào vào phần cào trên Phiếu để lấy mã số tham gia dự đoán. Lưu ý: mỗi mã số tham gia dự đoán chỉ áp dụng cho 1 lần tham gia. Khách hàng có thể tham gia dự đoán nhiều lần với nhiều mã số khác nhau\r\n\r\n- Bước 3: Truy cập trang web: www.kfcvietnam.com.vn/dudoanbongda để tham gia dự đoán kết quả các vòng đấu để nhận những giải thưởng vô cùng hấp dẫn.\r\n\r\n2. Danh sách giải thưởng của mỗi vòng:\r\n\r\nSố lượng giải\r\n\r\nCơ cấu giải thưởng mỗi vòng\r\n\r\nTrận Chung Kết\r\n\r\n21 Giải Nhất\r\n\r\nGift Voucher KFC 4.000.000 đồng & 1 Loa Pepsi cực chất\r\n\r\n21 Giải Nhì\r\n\r\nGift Voucher KFC 2.000.000 đồng & 1 Tai Nghe Pepsi cực ngầu\r\n\r\n21 Giải Ba\r\n\r\nGift Voucher KFC 1.000.000 đồng & 1 Ba-lô Pepsi cực cool\r\n\r\nVòng 16 Đội, Vòng Tứ Kết, Vòng Bán Kết, Vòng Chung Kết\r\n\r\nMỗi vòng 21 Giải Nhất\r\n\r\nGift Voucher KFC 2.000.000 đồng & 1 Loa Pepsi cực chất\r\n\r\nMỗi vòng 21 Giải Nhì\r\n\r\nGift Voucher KFC 1.000.000 đồng & 1 Tai Nghe Pepsi cực ngầu\r\n\r\nMỗi vòng 21 Giải Ba\r\n\r\nGift Voucher KFC 500.000 đồng & 1 Ba-lô Pepsi cực cool\r\n\r\n3. Thời gian tham gia dự đoán cho các vòng:\r\n\r\nVòng 16 Đội: từ 0h ngày 01/06/2018 đến 22h00 ngày 27/06/2018\r\nVòng Tứ Kết: từ 0h ngày 28/06/2018 đến 22h00 ngày 02/07/2018\r\nVòng Bán Kết: từ 0h ngày 03/07/2018 đến 22h00 ngày 07/07/2018\r\nVòng Chung Kết: từ 0h ngày 08/07/2018 đến 22h00 ngày 11/07/2018\r\nTrận Chung Kết: từ 0h ngày 12/07/2018 đến 17h00 ngày 15/07/2018\r\n4. Thời gian công bố kết quả trúng thưởng:\r\n\r\nVòng 16 Đội: ngày 04/07/2018\r\nVòng Tứ Kết: ngày 07/07/2018\r\nVòng Bán Kết: ngày 11/07/2018\r\nVòng Chung Kết: ngày 14/07/2018\r\nTrận Chung Kết: ngày 19/07/2018\r\nChương trình kéo dài từ ngày 01/06/2018 đến hết ngày 15/07/2018 tại tất cả các nhà hàng KFC trên toàn quốc, áp dụng cho cả giao hàng tận nơi.\r\n\r\nKhông áp dụng cho thẻ giảm giá và đơn hàng trên 2.000.000 đồng.\r\n\r\nTHAM GIA NGAY TẠI:  www.kfcvietnam.com.vn/dudoanbongda\r\n\r\n#KFC #KFCVietnam #DuDoanBongDa', '2018-06-02 00:00:00', 1),
(4, '“NHẮM MẮT THẤY MÙA HÈ – TƯƠI TRẺ CÙNG TRÀ NHIỆT ĐỚI HẠT CHIA KFC”', '4.png', 'Trà Nhiệt Đới Hạt Chia, món nước uống mùa hè vừa được KFC ra mắt là sự kết hợp hài hòa giữa trà chanh mát lạnh, hạt chia 100% organic từ Anh và các loại trái cây vùng nhiệt đới tươi mới, cùng tạo nên một thức uống vừa dinh dưỡng tốt cho sức khỏe vừa thanh mát nhẹ nhàng có tác dụng giải nhiệt giúp xoa dịu đi cái nóng oi bức của mùa hè. Giá một ly Trà Nhiệt Đới Hạt Chia cũng rất mát chỉ 24.000 đồng (hoặc đổi từ Pepsi (vừa) với giá chỉ 12.000 đồng).\r\n\r\nCòn gì tuyệt vời hơn khi vừa măm măm gà rán giòn cay vừa thưởng thức từng ngụm trà mát lạnh!\r\n\r\nGhé KFC ngay các fans nhé!', '2018-06-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `ACCOUNTID` int(11) DEFAULT NULL COMMENT 'Mã tài khoản',
  `CARTTIME` datetime NOT NULL COMMENT 'Thời điểm tạo giỏ',
  `ACTIVE` int(1) NOT NULL DEFAULT '1' COMMENT 'Đang kích hoạt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Giỏ hàng';

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CARTID`, `ACCOUNTID`, `CARTTIME`, `ACTIVE`) VALUES
(1, 4, '2018-06-05 00:00:00', 0),
(2, 4, '2018-06-06 00:00:00', 0),
(3, 4, '2018-06-16 23:56:59', 1),
(7, 5, '2018-06-21 00:41:36', 1);

--
-- Triggers `cart`
--
DROP TRIGGER IF EXISTS `trig_cart_insert`;
DELIMITER $$
CREATE TRIGGER `trig_cart_insert` BEFORE INSERT ON `cart` FOR EACH ROW BEGIN   
    SET NEW.CARTTIME = NOW();
    SET NEW.ACTIVE = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

DROP TABLE IF EXISTS `cart_detail`;
CREATE TABLE `cart_detail` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết giỏ hàng';

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`CARTID`, `ITEMID`, `QUANTITY`) VALUES
(1, 4, 20),
(2, 1, 1),
(7, 1, 5),
(7, 2, 2),
(7, 3, 1),
(7, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail_combo`
--

DROP TABLE IF EXISTS `cart_detail_combo`;
CREATE TABLE `cart_detail_combo` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `COMBOID` int(11) NOT NULL COMMENT 'Mã combo',
  `QUANTITY` int(2) NOT NULL DEFAULT '1' COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_detail_combo`
--

INSERT INTO `cart_detail_combo` (`CARTID`, `COMBOID`, `QUANTITY`) VALUES
(7, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE `combo` (
  `COMBOID` int(11) NOT NULL COMMENT 'Mã Combo',
  `COMBONAME` varchar(30) NOT NULL COMMENT 'Tên Combo',
  `COMBOPRICE` decimal(13,2) NOT NULL COMMENT 'Giá Combo',
  `COMBOSTATUS` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `COMBOIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Combo';

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`COMBOID`, `COMBONAME`, `COMBOPRICE`, `COMBOSTATUS`, `COMBOIMGURL`) VALUES
(1, 'combo test 1', '50000.00', 0, 'combo1.png'),
(2, 'combo test 2', '169000.00', 0, 'combo2.png'),
(3, 'Combo mùa hè', '52000.00', 1, ''),
(4, 'Combo C1', '120000.00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `combo_detail`
--

DROP TABLE IF EXISTS `combo_detail`;
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
(2, 5, 1),
(3, 4, 1),
(3, 5, 1),
(4, 1, 2),
(4, 2, 1),
(4, 3, 1),
(4, 4, 2),
(4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `ITEMNAME` varchar(30) NOT NULL COMMENT 'Tên món',
  `ITEMPRICE` decimal(13,2) NOT NULL COMMENT 'Giá',
  `ITEM_TYPEID` int(11) NOT NULL COMMENT 'Mã loại',
  `ITEMSTOCK` int(11) NOT NULL COMMENT 'Số lượng tồn',
  `ITEMSTATUS` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `ITEMIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh',
  `ITEMISNEW` int(1) NOT NULL DEFAULT '1' COMMENT 'Nếu mới bán: 1, còn lại: 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Món ăn';

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEMID`, `ITEMNAME`, `ITEMPRICE`, `ITEM_TYPEID`, `ITEMSTOCK`, `ITEMSTATUS`, `ITEMIMGURL`, `ITEMISNEW`) VALUES
(1, 'Gà truyền thống', '20000.00', 12, 1000, 1, '12-1.png', 0),
(2, 'Gà giòn không cay', '25000.00', 12, 1000, 1, '12-2.png', 1),
(3, 'Cơm gà viên', '30000.00', 13, 1000, 1, '13-3.png', 1),
(4, 'Cơm gà giòn cay', '29000.00', 13, 1000, 1, '13-4.png', 1),
(5, 'Khoai tây chiên (Vừa)', '15000.00', 16, 1000, 1, '16-5.png', 1),
(6, 'Khoai tây chiên (Lớn)', '20000.00', 16, 1000, 1, '16-6.png', 1),
(7, 'Bánh mật ong', '10000.00', 17, 1111, 1, 'item test.png', 1),
(8, 'Canh củ cải', '23000.00', 24, 1111, 1, 'item test 2.png', 1),
(9, 'Canh bào ngư', '50000.00', 24, 1111, 1, 'canh bào ngư.png', 1),
(10, 'Cơm hải sản', '40000.00', 13, 1111, 1, '', 1),
(11, 'Mì ý (Vừa)', '23000.00', 23, 1111, 1, 'Mì ý (Vừa).png', 1),
(12, 'Cơm gà phủ bông', '51000.00', 13, 2222, 1, 'Cơm gà phủ bông.png', 1),
(13, 'Burger Bò Teriyaki', '25000.00', 14, 1000, 1, 'Burger Bò Teriyaki.png', 1),
(14, 'Burger Tôm', '26000.00', 14, 1000, 1, 'Burger Tôm.png', 1),
(15, 'Burger Gà', '23000.00', 14, 1000, 1, 'Burger Gà.png', 1),
(16, 'Burger thịt xông khói', '22000.00', 14, 2000, 1, 'Burger thịt xông khói.png', 1),
(17, 'Rau trộn (Nhỏ)', '15000.00', 22, 1000, 1, 'Rau trộn (Nhỏ).png', 1),
(18, 'Rau trộn (Vừa)', '20000.00', 22, 222, 1, 'Rau trộn (Vừa).png', 1),
(19, 'Kem Vani', '3000.00', 18, 2222, 1, 'Kem vani.png', 1),
(20, 'Kem Chocolate', '6000.00', 18, 2000, 1, 'Kem Chocolate.png', 1),
(21, 'Kem Sundae', '15000.00', 19, 1111, 0, 'Kem Sundae.png', 1),
(22, 'Kem Tornado', '20000.00', 19, 1111, 1, 'Kem Tornado.png', 1),
(23, 'Pepsi (Vừa)', '10000.00', 15, 1111, 1, 'Pepsi (Vừa).png', 1),
(24, 'Pepsi (Đại)', '20000.00', 15, 1111, 1, 'Pepsi (Đại).png', 1),
(25, '7up (Vừa)', '10000.00', 15, 1111, 1, '7up (Vừa).png', 1),
(26, '7up (Đại)', '20000.00', 15, 1111, 1, '7up (Đại).png', 1),
(27, 'Hot Pack', '15000.00', 17, 1111, 1, 'Hot Pack.png', 1),
(28, 'Khoanh mực nướng (3 miếng)', '25000.00', 17, 1000, 1, 'Khoanh mực nướng (3 miếng).png', 1),
(29, 'Burger Gà giòn cay', '32000.00', 14, 1111, 1, 'Burger Gà giòn cay.png', 1),
(30, 'Gà phủ bông', '32000.00', 12, 1111, 1, 'Gà phủ bông.png', 1);

--
-- Triggers `item`
--
DROP TRIGGER IF EXISTS `trig_item_insert`;
DELIMITER $$
CREATE TRIGGER `trig_item_insert` BEFORE INSERT ON `item` FOR EACH ROW BEGIN   
	SET NEW.ITEMIMGURL = CONCAT(NEW.ITEMNAME, '.png');
	IF NEW.ITEMSTOCK <0 THEN
		SET NEW.ITEMSTOCK = 0;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

DROP TABLE IF EXISTS `item_category`;
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

DROP TABLE IF EXISTS `item_promotion`;
CREATE TABLE `item_promotion` (
  `ITMPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STATUS` int(1) NOT NULL COMMENT 'Trạng thái của mã giảm giá',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khuyến mãi theo sản phẩm';

--
-- Triggers `item_promotion`
--
DROP TRIGGER IF EXISTS `trig_itempromotion_insert`;
DELIMITER $$
CREATE TRIGGER `trig_itempromotion_insert` BEFORE INSERT ON `item_promotion` FOR EACH ROW BEGIN
    IF NEW.HOURLYPR = 0 THEN
        SET NEW.STARTHOUR =null;
        SET NEW.ENDHOUR =null;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_promotion_detail`
--

DROP TABLE IF EXISTS `item_promotion_detail`;
CREATE TABLE `item_promotion_detail` (
  `ITMPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `MINQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối thiểu',
  `MAXQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối đa',
  `NEWPRICE` decimal(10,0) DEFAULT NULL COMMENT 'Giá mới (nếu có) [Bỏ trống nếu khuyến mãi %]',
  `PRVALUE` int(2) DEFAULT '5' COMMENT 'Giá trị khuyến mãi (%) [Bỏ trống nếu đổi giá tự do]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết khuyến mãi theo sản phẩm';

--
-- Triggers `item_promotion_detail`
--
DROP TRIGGER IF EXISTS `trig_itempromotiondetail_insert`;
DELIMITER $$
CREATE TRIGGER `trig_itempromotiondetail_insert` BEFORE INSERT ON `item_promotion_detail` FOR EACH ROW BEGIN
    DECLARE SWAPQUANT INT(11);
    DECLARE diff_date INT(11);
    
    IF NEW.MINQUANT < 0 THEN
        SET NEW.MINQUANT =0;
    END IF;
    
    IF NEW.MAXQUANT < NEW.MINQUANT THEN
        SET SWAPQUANT = NEW.MINQUANT;
        SET NEW.MINQUANT = NEW.MAXQUANT;
        SET NEW.MAXQUANT= SWAP;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
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

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE `receipt` (
  `RECEIPTID` int(11) NOT NULL COMMENT 'Mã hóa đơn',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `RECEIPTTIME` datetime NOT NULL COMMENT 'Thời gian tạo hoá đơn',
  `RECEIPTADD` text NOT NULL COMMENT 'Địa chỉ nhận hàng',
  `RECEIPTVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Hóa đơn';

--
-- Triggers `receipt`
--
DROP TRIGGER IF EXISTS `trig_receipt_insert`;
DELIMITER $$
CREATE TRIGGER `trig_receipt_insert` BEFORE INSERT ON `receipt` FOR EACH ROW BEGIN   
    SET NEW.RECEIPTTIME = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_detail`
--

DROP TABLE IF EXISTS `receipt_detail`;
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

DROP TABLE IF EXISTS `receipt_promotion`;
CREATE TABLE `receipt_promotion` (
  `RCPPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STATUS` int(1) NOT NULL COMMENT 'Trạng thái của mã giảm giá',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Khuyến mãi trên hóa đơn';

--
-- Triggers `receipt_promotion`
--
DROP TRIGGER IF EXISTS `trig_receiptpromotion_insert`;
DELIMITER $$
CREATE TRIGGER `trig_receiptpromotion_insert` BEFORE INSERT ON `receipt_promotion` FOR EACH ROW BEGIN
    DECLARE diff_date int(11);
    DECLARE SWAP DATE;
    IF NEW.HOURLYPR = 0 THEN
        SET NEW.STARTHOUR =null;
        SET NEW.ENDHOUR =null;
    END IF;
    SELECT DATEDIFF(NEW.STARTDATE,NEW.ENDDATE) INTO diff_date;
    IF diff_date > 0 THEN
        SET SWAP = NEW.STARTDATE;
        SET NEW.STARTDATE = NEW.ENDDATE;
        SET NEW.ENDDATE= SWAP;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_promotion_detail`
--

DROP TABLE IF EXISTS `receipt_promotion_detail`;
CREATE TABLE `receipt_promotion_detail` (
  `RCPPR_DTLID` int(11) NOT NULL COMMENT 'Mã chi tiết khuyến mãi',
  `RCPPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `MINRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối thiểu',
  `MAXRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối đa',
  `PROVALUE` int(2) NOT NULL DEFAULT '10' COMMENT 'Giá trị khuyến mãi (%)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết khuyến mãi';

--
-- Triggers `receipt_promotion_detail`
--
DROP TRIGGER IF EXISTS `trig_receiptpromotiondetail_insert`;
DELIMITER $$
CREATE TRIGGER `trig_receiptpromotiondetail_insert` BEFORE INSERT ON `receipt_promotion_detail` FOR EACH ROW BEGIN
    DECLARE SWAP INT(11);
    IF(NEW.MINRCPVALUE < 0) THEN
        SET NEW.MINRCPVALUE =0;
    END IF;
    IF(NEW.MAXRCPVALUE < NEW.MINRCPVALUE) THEN
        SET SWAP = NEW.MINRCPVALUE;
        SET NEW.MINRCPVALUE = NEW.MAXRCPVALUE;
        SET NEW.MINRCPVALUE= SWAP;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reg-email`
--

DROP TABLE IF EXISTS `reg-email`;
CREATE TABLE `reg-email` (
  `EMAIL` text NOT NULL COMMENT 'Email đăng ký nhận tin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ACCOUNTID`),
  ADD UNIQUE KEY `ACCOUNTUSER` (`ACCOUNTUSER`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`EMPID`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`BLOGID`),
  ADD KEY `EMPID` (`EMPID`) USING BTREE;

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
-- Indexes for table `cart_detail_combo`
--
ALTER TABLE `cart_detail_combo`
  ADD PRIMARY KEY (`CARTID`,`COMBOID`),
  ADD KEY `COMBOID` (`COMBOID`);

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
  ADD KEY `ACCOUNTID` (`EMPID`);

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
  ADD KEY `ACCOUNTID` (`EMPID`);

--
-- Indexes for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  ADD PRIMARY KEY (`RCPPR_DTLID`),
  ADD KEY `RCPPR_ID` (`RCPPR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `ACCOUNTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `EMPID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhân viên', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `BLOGID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã bài', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CARTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã giỏ', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `combo`
--
ALTER TABLE `combo`
  MODIFY `COMBOID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Combo', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ITEMID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã món', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `item_category`
--
ALTER TABLE `item_category`
  MODIFY `ITEM_CATEGORYID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã danh mục', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_promotion`
--
ALTER TABLE `item_promotion`
  MODIFY `ITMPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi';

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
  MODIFY `RCPPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi';

--
-- AUTO_INCREMENT for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  MODIFY `RCPPR_DTLID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã chi tiết khuyến mãi';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`EMPID`) REFERENCES `admin` (`EMPID`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`) ON DELETE CASCADE;

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_ibfk_1` FOREIGN KEY (`CARTID`) REFERENCES `cart` (`CARTID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`);

--
-- Constraints for table `cart_detail_combo`
--
ALTER TABLE `cart_detail_combo`
  ADD CONSTRAINT `cart_detail_combo_ibfk_1` FOREIGN KEY (`CARTID`) REFERENCES `cart` (`CARTID`),
  ADD CONSTRAINT `cart_detail_combo_ibfk_2` FOREIGN KEY (`COMBOID`) REFERENCES `combo` (`COMBOID`);

--
-- Constraints for table `combo_detail`
--
ALTER TABLE `combo_detail`
  ADD CONSTRAINT `combo_detail_ibfk_1` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`) ON DELETE CASCADE,
  ADD CONSTRAINT `combo_detail_ibfk_2` FOREIGN KEY (`COMBOID`) REFERENCES `combo` (`COMBOID`) ON DELETE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`ITEM_TYPEID`) REFERENCES `item_type` (`ITEM_TYPEID`) ON DELETE CASCADE;

--
-- Constraints for table `item_promotion`
--
ALTER TABLE `item_promotion`
  ADD CONSTRAINT `item_promotion_ibfk_1` FOREIGN KEY (`EMPID`) REFERENCES `admin` (`EMPID`);

--
-- Constraints for table `item_promotion_detail`
--
ALTER TABLE `item_promotion_detail`
  ADD CONSTRAINT `item_promotion_detail_ibfk_1` FOREIGN KEY (`ITMPR_ID`) REFERENCES `item_promotion` (`ITMPR_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_promotion_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`) ON DELETE CASCADE;

--
-- Constraints for table `item_type`
--
ALTER TABLE `item_type`
  ADD CONSTRAINT `item_type_ibfk_1` FOREIGN KEY (`ITEM_CATEGORYID`) REFERENCES `item_category` (`ITEM_CATEGORYID`) ON DELETE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`ACCOUNTID`) REFERENCES `account` (`ACCOUNTID`) ON DELETE CASCADE;

--
-- Constraints for table `receipt_detail`
--
ALTER TABLE `receipt_detail`
  ADD CONSTRAINT `receipt_detail_ibfk_1` FOREIGN KEY (`RECEIPTID`) REFERENCES `receipt` (`RECEIPTID`) ON DELETE CASCADE,
  ADD CONSTRAINT `receipt_detail_ibfk_2` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`) ON DELETE CASCADE;

--
-- Constraints for table `receipt_promotion`
--
ALTER TABLE `receipt_promotion`
  ADD CONSTRAINT `receipt_promotion_ibfk_1` FOREIGN KEY (`EMPID`) REFERENCES `admin` (`EMPID`) ON DELETE CASCADE;

--
-- Constraints for table `receipt_promotion_detail`
--
ALTER TABLE `receipt_promotion_detail`
  ADD CONSTRAINT `receipt_promotion_detail_ibfk_1` FOREIGN KEY (`RCPPR_ID`) REFERENCES `receipt_promotion` (`RCPPR_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
