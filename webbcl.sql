-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2018 at 04:57 AM
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
SELECT * FROM BLOG$$

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

DROP PROCEDURE IF EXISTS `SP_GET_COMBO_DETAILS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GET_COMBO_DETAILS` (IN `comboid` INT(11))  NO SQL
SELECT item.ITEMNAME as 'Ten', item.ITEMPRICE as 'Gia', cd.QUANTITY as 'SoLuong', type.UNIT_NAME as 'DonVi' 
from combo cb, combo_detail cd, item, item_type type
      where cb.COMBOID = comboid AND cd.COMBOID = cb.COMBOID
      AND cd.ITEMID = item.ITEMID AND item.ITEM_TYPEID = type.ITEM_TYPEID$$

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
CREATE TABLE IF NOT EXISTS `account` (
  `ACCOUNTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã tài khoản',
  `ACCOUNTUSER` varchar(20) NOT NULL COMMENT 'Tên đăng nhập',
  `ACCOUNTPASS` varchar(20) NOT NULL COMMENT 'Mật khẩu',
  `ACCOUNTNAME` varchar(30) NOT NULL COMMENT 'Tên người dùng',
  `ACCOUNTEMAIL` varchar(30) NOT NULL COMMENT 'Email',
  `ACCOUNTPHONE` varchar(11) NOT NULL COMMENT 'Điện thoại',
  `ACCOUNTDOB` date NOT NULL COMMENT 'Sinh nhật',
  `ACCOUNTSEX` int(1) NOT NULL COMMENT 'Giới tính (1- Nam, 0- Nữ)',
  `ACCOUNTADD` varchar(500) NOT NULL COMMENT 'Địa chỉ',
  `ACCOUNTDATE` date NOT NULL COMMENT 'Ngày tạo',
  `ACCOUNTVALID` int(1) NOT NULL DEFAULT '1' COMMENT 'Tình trạng hoạt động',
  `ACCOUNTLIKEDITEMS` text COMMENT 'Sản phẩm đang thích',
  `ACCOUNTLIKEDCOMBOS` text COMMENT 'Combo đang thích',
  `ACCOUNTNOTI` int(1) NOT NULL DEFAULT '1' COMMENT 'Nhận thông báo từ website',
  PRIMARY KEY (`ACCOUNTID`),
  UNIQUE KEY `ACCOUNTUSER` (`ACCOUNTUSER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Tài khoản đăng nhập';

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`ACCOUNTID`, `ACCOUNTUSER`, `ACCOUNTPASS`, `ACCOUNTNAME`, `ACCOUNTEMAIL`, `ACCOUNTPHONE`, `ACCOUNTDOB`, `ACCOUNTSEX`, `ACCOUNTADD`, `ACCOUNTDATE`, `ACCOUNTVALID`, `ACCOUNTLIKEDITEMS`, `ACCOUNTLIKEDCOMBOS`, `ACCOUNTNOTI`) VALUES
(4, 'kaito', 'pass', 'Bien', 'Bien@gmail.com', '1234567891', '1997-01-01', 1, 'Quang Nam', '0000-00-00', 1, NULL, NULL, 0),
(5, 'newfull', 'dodien', 'Nguyễn Thành Công', 'obmega3@gmail.com', '0911123456', '2014-02-10', 0, 'Linh Trung', '2018-05-15', 1, '2,26,1', '3', 1);

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
CREATE TABLE IF NOT EXISTS `admin` (
  `EMPID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã nhân viên',
  `EMPNAME` varchar(30) NOT NULL COMMENT 'Tên nhân viên',
  `EMPDOB` date NOT NULL COMMENT 'Ngày sinh',
  `EMPADD` varchar(500) NOT NULL COMMENT 'Địa chỉ',
  `EMPPHONE` varchar(11) NOT NULL COMMENT 'Số điện thoại',
  `EMPSAL` decimal(13,2) NOT NULL COMMENT 'Lương nhân viên',
  `EMPLVL` int(1) NOT NULL DEFAULT '1' COMMENT '1 - quản lý, 2 - nhân viên',
  `EMPPAYRATE` decimal(2,0) NOT NULL DEFAULT '1' COMMENT 'Hệ số lương',
  PRIMARY KEY (`EMPID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Bảng tài khoản Admin';

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
CREATE TABLE IF NOT EXISTS `blog` (
  `BLOGID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã bài',
  `BLOGTITLE` varchar(500) NOT NULL COMMENT 'Tựa đề',
  `BLOGCONTENT` varchar(5000) NOT NULL COMMENT 'Nội dung',
  `BLOGDATE` datetime NOT NULL COMMENT 'Ngày tạo',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo',
  PRIMARY KEY (`BLOGID`),
  KEY `EMPID` (`EMPID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tin tức khuyến mãi';

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `CARTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã giỏ',
  `ACCOUNTID` int(11) DEFAULT NULL COMMENT 'Mã tài khoản',
  `CARTTIME` datetime NOT NULL COMMENT 'Thời điểm tạo giỏ',
  `ACTIVE` int(1) NOT NULL DEFAULT '1' COMMENT 'Đang kích hoạt',
  PRIMARY KEY (`CARTID`),
  KEY `ACCOUNTID` (`ACCOUNTID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Giỏ hàng';

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
CREATE TABLE IF NOT EXISTS `cart_detail` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  PRIMARY KEY (`CARTID`,`ITEMID`),
  KEY `ITEMID` (`ITEMID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết giỏ hàng';

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`CARTID`, `ITEMID`, `QUANTITY`) VALUES
(1, 4, 20),
(2, 1, 1),
(7, 1, 5),
(7, 2, 1),
(7, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail_combo`
--

DROP TABLE IF EXISTS `cart_detail_combo`;
CREATE TABLE IF NOT EXISTS `cart_detail_combo` (
  `CARTID` int(11) NOT NULL COMMENT 'Mã giỏ',
  `COMBOID` int(11) NOT NULL COMMENT 'Mã combo',
  `QUANTITY` int(2) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  PRIMARY KEY (`CARTID`,`COMBOID`),
  KEY `COMBOID` (`COMBOID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE IF NOT EXISTS `combo` (
  `COMBOID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã Combo',
  `COMBONAME` varchar(30) NOT NULL COMMENT 'Tên Combo',
  `COMBOPRICE` decimal(13,2) NOT NULL COMMENT 'Giá Combo',
  `COMBOLIKE` int(11) NOT NULL DEFAULT '0' COMMENT 'Số lượt thích',
  `COMBOSTATUS` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `COMBOIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh',
  PRIMARY KEY (`COMBOID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Combo';

--
-- Dumping data for table `combo`
--

INSERT INTO `combo` (`COMBOID`, `COMBONAME`, `COMBOPRICE`, `COMBOLIKE`, `COMBOSTATUS`, `COMBOIMGURL`) VALUES
(1, 'combo test 1', '50000.00', 0, 0, 'combo1.png'),
(2, 'combo test 2', '169000.00', 0, 0, 'combo2.png'),
(3, 'Combo mùa hè', '52000.00', 0, 1, ''),
(4, 'Combo C1', '120000.00', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `combo_detail`
--

DROP TABLE IF EXISTS `combo_detail`;
CREATE TABLE IF NOT EXISTS `combo_detail` (
  `COMBOID` int(11) NOT NULL COMMENT 'Mã Combo',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  PRIMARY KEY (`COMBOID`,`ITEMID`),
  KEY `ITEMID` (`ITEMID`)
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
CREATE TABLE IF NOT EXISTS `item` (
  `ITEMID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã món',
  `ITEMNAME` varchar(30) NOT NULL COMMENT 'Tên món',
  `ITEMPRICE` decimal(13,2) NOT NULL COMMENT 'Giá',
  `ITEM_TYPEID` int(11) NOT NULL COMMENT 'Mã loại',
  `ITEMSTOCK` int(11) NOT NULL COMMENT 'Số lượng tồn',
  `ITEMLIKED` int(11) NOT NULL DEFAULT '0' COMMENT 'Số lượt thích',
  `ITEMSTATUS` int(1) NOT NULL DEFAULT '1' COMMENT '1 - Đang bán, 0 - Ngừng bán',
  `ITEMIMGURL` text NOT NULL COMMENT 'Đường dẫn hình ảnh',
  `ITEMISNEW` int(1) NOT NULL DEFAULT '1' COMMENT 'Nếu mới bán: 1, còn lại: 0',
  PRIMARY KEY (`ITEMID`),
  KEY `ITEM_TYPEID` (`ITEM_TYPEID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='Món ăn';

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEMID`, `ITEMNAME`, `ITEMPRICE`, `ITEM_TYPEID`, `ITEMSTOCK`, `ITEMLIKED`, `ITEMSTATUS`, `ITEMIMGURL`, `ITEMISNEW`) VALUES
(1, 'Gà truyền thống', '20000.00', 12, 1000, 0, 1, '12-1.png', 0),
(2, 'Gà giòn không cay', '25000.00', 12, 1000, 0, 1, '12-2.png', 1),
(3, 'Cơm gà viên', '30000.00', 13, 1000, 0, 1, '13-3.png', 1),
(4, 'Cơm gà giòn cay', '29000.00', 13, 1000, 0, 1, '13-4.png', 1),
(5, 'Khoai tây chiên (Vừa)', '15000.00', 16, 1000, 0, 1, '16-5.png', 1),
(6, 'Khoai tây chiên (Lớn)', '20000.00', 16, 1000, 0, 1, '16-6.png', 1),
(7, 'Bánh mật ong', '10000.00', 17, 1111, 0, 1, 'item test.png', 1),
(8, 'Canh củ cải', '23000.00', 24, 1111, 0, 1, 'item test 2.png', 1),
(9, 'Canh bào ngư', '50000.00', 24, 1111, 0, 1, 'canh bào ngư.png', 1),
(10, 'Cơm hải sản', '40000.00', 13, 1111, 0, 1, '', 1),
(11, 'Mì ý (Vừa)', '23000.00', 23, 1111, 0, 1, 'Mì ý (Vừa).png', 1),
(12, 'Cơm gà phủ bông', '51000.00', 13, 2222, 0, 1, 'Cơm gà phủ bông.png', 1),
(13, 'Burger Bò Teriyaki', '25000.00', 14, 1000, 0, 1, 'Burger Bò Teriyaki.png', 1),
(14, 'Burger Tôm', '26000.00', 14, 1000, 0, 1, 'Burger Tôm.png', 1),
(15, 'Burger Gà', '23000.00', 14, 1000, 0, 1, 'Burger Gà.png', 1),
(16, 'Burger thịt xông khói', '22000.00', 14, 2000, 0, 1, 'Burger thịt xông khói.png', 1),
(17, 'Rau trộn (Nhỏ)', '15000.00', 22, 1000, 0, 1, 'Rau trộn (Nhỏ).png', 1),
(18, 'Rau trộn (Vừa)', '20000.00', 22, 222, 0, 1, 'Rau trộn (Vừa).png', 1),
(19, 'Kem Vani', '3000.00', 18, 2222, 0, 1, 'Kem vani.png', 1),
(20, 'Kem Chocolate', '6000.00', 18, 2000, 0, 1, 'Kem Chocolate.png', 1),
(21, 'Kem Sundae', '15000.00', 19, 1111, 0, 0, 'Kem Sundae.png', 1),
(22, 'Kem Tornado', '20000.00', 19, 1111, 0, 1, 'Kem Tornado.png', 1),
(23, 'Pepsi (Vừa)', '10000.00', 15, 1111, 0, 1, 'Pepsi (Vừa).png', 1),
(24, 'Pepsi (Đại)', '20000.00', 15, 1111, 0, 1, 'Pepsi (Đại).png', 1),
(25, '7up (Vừa)', '10000.00', 15, 1111, 0, 1, '7up (Vừa).png', 1),
(26, '7up (Đại)', '20000.00', 15, 1111, 0, 1, '7up (Đại).png', 1),
(27, 'Hot Pack', '15000.00', 17, 1111, 0, 1, 'Hot Pack.png', 1),
(28, 'Khoanh mực nướng (3 miếng)', '25000.00', 17, 1000, 0, 1, 'Khoanh mực nướng (3 miếng).png', 1),
(29, 'Burger Gà giòn cay', '32000.00', 14, 1111, 0, 1, 'Burger Gà giòn cay.png', 1),
(30, 'Gà phủ bông', '32000.00', 12, 1111, 0, 1, 'Gà phủ bông.png', 1);

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
CREATE TABLE IF NOT EXISTS `item_category` (
  `ITEM_CATEGORYID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã danh mục',
  `ITEM_CATEGORYNAME` varchar(30) NOT NULL COMMENT 'Tên danh mục',
  `ITEM_CATEGORYIMGNAME` text NOT NULL COMMENT 'Tên hình ảnh hiển thị',
  `ITEM_CATEGORYALIAS` varchar(20) NOT NULL COMMENT 'Id gọi tắt',
  PRIMARY KEY (`ITEM_CATEGORYID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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
CREATE TABLE IF NOT EXISTS `item_promotion` (
  `ITMPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STATUS` int(1) NOT NULL COMMENT 'Trạng thái của mã giảm giá',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `HOURLYPR` int(1) NOT NULL DEFAULT '0' COMMENT 'Có khung giờ cố định?',
  `STARTHOUR` int(2) DEFAULT NULL COMMENT 'Giờ bắt đầu (24h)',
  `ENDHOUR` int(2) DEFAULT NULL COMMENT 'Giờ kết thúc (24h)',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo',
  PRIMARY KEY (`ITMPR_ID`),
  KEY `ACCOUNTID` (`EMPID`)
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
CREATE TABLE IF NOT EXISTS `item_promotion_detail` (
  `ITMPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `MINQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối thiểu',
  `MAXQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối đa',
  `NEWPRICE` decimal(10,0) DEFAULT NULL COMMENT 'Giá mới (nếu có) [Bỏ trống nếu khuyến mãi %]',
  `PRVALUE` int(2) DEFAULT '5' COMMENT 'Giá trị khuyến mãi (%) [Bỏ trống nếu đổi giá tự do]',
  PRIMARY KEY (`ITMPR_ID`,`ITEMID`),
  KEY `ITEMID` (`ITEMID`)
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
CREATE TABLE IF NOT EXISTS `item_type` (
  `ITEM_TYPEID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã loại',
  `ITEM_TYPENAME` varchar(30) NOT NULL COMMENT 'Tên loại',
  `UNIT_NAME` varchar(20) DEFAULT 'Phần' COMMENT 'Tên đơn vị tính',
  `ITEM_CATEGORYID` int(11) NOT NULL COMMENT 'Mã danh mục',
  PRIMARY KEY (`ITEM_TYPEID`),
  KEY `ITEM_CATEGORYID` (`ITEM_CATEGORYID`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Loại';

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
CREATE TABLE IF NOT EXISTS `receipt` (
  `RECEIPTID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã hóa đơn',
  `ACCOUNTID` int(11) NOT NULL COMMENT 'Mã tài khoản',
  `RECEIPTTIME` datetime NOT NULL COMMENT 'Thời điểm thanh toán',
  `RECEIPTVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn',
  PRIMARY KEY (`RECEIPTID`),
  KEY `ACCOUNTID` (`ACCOUNTID`)
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
CREATE TABLE IF NOT EXISTS `receipt_detail` (
  `RECEIPTID` int(11) NOT NULL COMMENT 'Mã hóa đơn',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `QUANTITY` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng',
  `VALUE` decimal(13,2) NOT NULL COMMENT 'Tổng giá',
  PRIMARY KEY (`RECEIPTID`,`ITEMID`),
  KEY `ITEMID` (`ITEMID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Chi tiết hóa đơn';

-- --------------------------------------------------------

--
-- Table structure for table `receipt_promotion`
--

DROP TABLE IF EXISTS `receipt_promotion`;
CREATE TABLE IF NOT EXISTS `receipt_promotion` (
  `RCPPR_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã khuyến mãi',
  `NAME` varchar(30) NOT NULL COMMENT 'Tên khuyến mãi',
  `STATUS` int(1) NOT NULL COMMENT 'Trạng thái của mã giảm giá',
  `STARTDATE` date NOT NULL COMMENT 'Ngày bắt đầu',
  `ENDDATE` date NOT NULL COMMENT 'Ngày kết thúc',
  `HOURLYPR` int(1) NOT NULL DEFAULT '0' COMMENT 'Có khung giờ cố định?',
  `STARTHOUR` int(11) DEFAULT NULL COMMENT 'Giờ bắt đầu',
  `ENDHOUR` int(11) DEFAULT NULL COMMENT 'Giờ kết thúc',
  `EMPID` int(11) NOT NULL COMMENT 'Người tạo',
  PRIMARY KEY (`RCPPR_ID`),
  KEY `ACCOUNTID` (`EMPID`)
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
CREATE TABLE IF NOT EXISTS `receipt_promotion_detail` (
  `RCPPR_DTLID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã chi tiết khuyến mãi',
  `RCPPR_ID` int(11) NOT NULL COMMENT 'Mã khuyến mãi',
  `MINRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối thiểu',
  `MAXRCPVALUE` decimal(13,2) NOT NULL COMMENT 'Giá trị hóa đơn tối đa',
  `PROVALUE` int(2) NOT NULL DEFAULT '10' COMMENT 'Giá trị khuyến mãi (%)',
  PRIMARY KEY (`RCPPR_DTLID`),
  KEY `RCPPR_ID` (`RCPPR_ID`)
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
-- Table structure for table `receipt_promotion_req`
--

DROP TABLE IF EXISTS `receipt_promotion_req`;
CREATE TABLE IF NOT EXISTS `receipt_promotion_req` (
  `RCPPR_DTLID` int(11) NOT NULL COMMENT 'Mã chi tiết khuyến mãi',
  `ITEMID` int(11) NOT NULL COMMENT 'Mã món',
  `MINQUANT` int(11) NOT NULL DEFAULT '1' COMMENT 'Số lượng tối thiểu',
  PRIMARY KEY (`RCPPR_DTLID`,`ITEMID`),
  KEY `ITEMID` (`ITEMID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Điều kiện khuyến mãi';

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

--
-- Constraints for table `receipt_promotion_req`
--
ALTER TABLE `receipt_promotion_req`
  ADD CONSTRAINT `receipt_promotion_req_ibfk_1` FOREIGN KEY (`ITEMID`) REFERENCES `item` (`ITEMID`) ON DELETE CASCADE,
  ADD CONSTRAINT `receipt_promotion_req_ibfk_2` FOREIGN KEY (`RCPPR_DTLID`) REFERENCES `receipt_promotion_detail` (`RCPPR_DTLID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
