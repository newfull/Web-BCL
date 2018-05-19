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
CREATE PROCEDURE sp_account_cre (in acc_user varchar(20),
                                in acc_pass varchar(20),
                                in cus_name varchar(20),
                                in cus_email varchar(30),
                                in cus_phone int(11),
                                in cus_dob date,
                                in cus_sex int(1),
                                in cus_add varchar(500)
                                )
BEGIN
	
    SELECT CUSTOMERID, count(*) 
    into cus_id, dem 
    FROM CUSTOMER WHERE CUSTOMEREMAIL = cus_email;
    IF(dem==1) THEN
        ROLLBACK;
    -- tao customer
    INSERT INTO CUSTOMER VALUES(cus_name, cus_email, cus_phone, cus_dob, cus_sex, cus_add,0,'');
    DECLARE cus_id int(11);
    DECLARE acc_user int(20);
    DECLARE dem int(11);
    ELSE
        -- tao account
        INSERT INTO ACCOUNT VALUES (acc_user, acc_pass,'22-01-1997',1,0,cus_id);
        IF(EXISTS(SELECT * FROM ACCOUNT WHERE ACCOUNTUSER=acc_user)) THEN
            ROLLBACK;
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
create PROCEDURE sp_receipt_getadd(in acc_user int(11),
                                out cus_name varchar(30),
                                out rec_add varchar(500))
BEGIN
	SELECT CUSTOMERNAME, RECEIPTADD 
    into cus_name, rec_add	
    FROM account,customer,receipt
    WHERE ACCOUNT.CUSTOMERID= CUSTOMER.CUSTOMERID AND ACCOUNT.ACCOUNTID= RECEIPT.ACCOUNTID AND
            ACCOUNTUSER = acc_user;
END
DELIMITER ;


-- them thong tin customer
DELIMITER $$
create PROCEDURE pro_ThemKH(in acc_user varchar(20),
                            in cus_name varchar(30),
                            in cus_email varchar(30),
                            in cus_phone int(11),
                            in cus_dob date,
                            in cus_sex int(1),
                            in cus_add varchar(500)
                            )
BEGIN
	IF(EXISTS( SELECT * FROM ACCOUNT WHERE ACCOUNTID = acc_user)) THEN 
        ROLLBACK;
    ELSE
        INSERT INTO CUSTOMER VALUES (cus_name, cus_email, cus_phone, cus_dob, cus_sex, cus_address,0,'');
END
DELIMITER ;

-- ---
-- lay thong tin cua account
CREATE PROCEDURE SP_ACCOUNT_GETINFO( in account_user int(11),
                                    out acc_id int(11),
                                    out acc_user varchar(20),
                                    out acc_date date,
                                    out acc_valid int(1),
                                    out acc_mode int(1),
                                    out cus_id int(11)
                                    )
BEGIN
	IF(EXISTS(SELECT * FROM account WHERE ACCOUNTUSER = account_user)) THEN
        ROLLBACK;
    ELSE
        SELECT ACCOUNTID, ACCOUNTUSER, ACCOUNTDATE, ACCOUNTVALID, ACCOUNTMODE, CUSTOMERID 
        INTO acc_id, acc_user, acc_date, acc_valid, acc_mode, cus_id
        FROM ACCOUNT
        WHERE ACCOUNTUSER= account_user;
END;                  


-- lay thong tin cua customer
CREATE PROCEDURE SP_CUSTOMER_GETINFO( in account_user int(11),
                                    out cus_name varchar(30),
                                    out cus_email varchar(30),
                                    out cus_phone int(11),
                                    out cus_dob date,
                                    out cus_sex int(1),
                                    out cus_add varchar(500),
                                    out cus_likeitem text
                                    )
BEGIN
    IF(EXISTS(SELECT * FROM account WHERE accountuser = accountUSER)) THEN
        ROLLBACK;
    ELSE
        SELECT CUSTOMERNAME, CUSTOMEREMAIL, CUSTOMERPHONE, CUSTOMERDOB, CUSTOMERSEX, CUSTOMERADD, LIKEDITEMS 
        into cus_name, cus_email, cus_phone, cus_dob, cus_sex, cus_add, cus_likeitem
        FROM CUSTOMER, ACCOUNT
        WHERE ACCOUNT.CUSTOMERID= CUSTOMER.CUSTOMERID AND ACCOUNTUSER= ACCOUNT_USER;
END;
-- lay thong tin ds san pham trong cataloge

create PROCEDURE SP_ITEM_GETINFO(IN item_catagory_name int(11),
                                out item_type_name varchar(30),
                                out item_name varchar(30),
                                out item_price decimal(13,2),
                                out item_stock int(11),
                                out item_liked int(11),
                                out item_status int(1),
                                out item_is_new int(1)
                                )
BEGIN
    SELECT ITEM_TYPENAME, ITEMNAME, ITEMPRICE, ITEMSTOCK, ITEMLIKED, ITEMSTATUS, ITEMISNEW
    INTO item_type_name, item_name, item_price, item_stock, item_liked, item_status, item_is_new
    FROM ITEM, ITEM_TYPE, ITEM_CATEGORYNAME
    WHERE ITEM.ITEM_TYPEID =  ITEM_TYPE.ITEM_TYPEID AND 
            ITEM_TYPE.ITEM_CATEGORYID = ITEM_CATEGORY.ITEM_CATEGORYID AND 
            ITEM_CATEGORY.ITEM_CATEGORYNAME=item_catagory_name
    ORDER BY ITEM_TYPENAME, ITEMNAME, ITEMPRICE, ITEMSTOCK, ITEMLIKED, ITEMSTATUS, ITEMISNEW DESC

END;

-- lay thong tin san pham

create PROCEDURE SP_ITEM_GETINFO(in item_id int(11),
                                out item_name varchar(30),
                                out item_price decimal(13,2),
                                out item_type_name varchar(30),
                                out item_stock int(11),
                                out item_liked int(11),
                                out item_status int(1),
                                out item_isnew int(1),
                                out item_type_name varchar(30),
                                out item_unit_name varchar(20),
                                out item_catagory_name varchar(30)
                                )
BEGIN
    IF(EXISTS(SELECT * FROM ITEM WHERE ITEMID = item_id)) THEN
        ROLLBACK;
    ELSE
        SELECT ITEMNAME, ITEMPRICE, ITEMNAME, ITEMSTOCK, ITEMLIKED, ITEMSTATUS, ITEMISNEW, ITEM_TYPENAME, UNIT_NAME, ITEM_CATEGORYNAME 
        INTO item_name, item_price, item_type_name, item_stock, item_liked, item_status ,
             item_isnew, item_type_name , item_unit_name, item_catagory_name 
        FROM ITEM, ITEM_TYPE, ITEM_CATEGORY
        WHERE ITEM.ITEM_TYPEID = ITEM_TYPE.ITEM_TYPEID AND ITEM_TYPE.ITEM_CATEGORYID = ITEM_CATEGORY.ITEM_CATEGORYID
                AND ITEMID = item_id;

END;

-- lấy thông tin giỏ hàng
CREATE PROCEDURE SP_CART_GETINFO(in acc_user int(11),
                                out cart_time datetime,
                                out item_name varchar(30),
                                out item_price decimal(13,2),
                                out cart_detail_quantity int(11),
                                out cart_detail_value decimal(13,2),
                                out cart_value decimal(13,2)
                                )
BEGIN
    
    SELECT CARTTIME, ITEMNAME, ITEMPRICE, QUANTITY, CART_DETAIL.VALUE, CART.VALUE
    into cart_time, item_name, item_price, cart_detail_quantity, cart_detail_value, cart_value
    FROM CART, CART_DETAIL, ACCOUNT, ITEM
    WHERE ACCOUNT.ACCOUNTID= CART.ACCOUNTID AND CART.CARTID= CART_DETAIL.CARTID AND
        CART_DETAIL.ITEMID= ITEM.ITEMID AND ACOUNT.ACCOUNTUSER = acc_user;

END;

CREATE PROCEDURE SP_CART_TO_RECEIPT(in acc_user int(11),
                                    )
BEGIN
    INSERT INTO RECEIPT(ACCOUNTID,RECEIPTTIME, RECEIPTVALUE)
        SELECT CART.ACCOUNTID, CARTTIME, VALUE
        FROM CART, ACCOUNT 
        WHERE CART.ACCOUNTID = ACOUNT.ACCOUNTID AND ACCOUNTUSER = acc_user;
    INSERT INTO RECEIPT_DETAIL(RECEIPTID,ITEMID, QUANTITY, VALUE)
        SELECT RECEIPT.RECEIPTID, CART_DETAIL.ITEM, CART_DETAIL.QUANTITY, CART_DETAIL.VALUE
        FROM CART_DETAIL, CART, ACCOUNT, RECEIPT
        WHERE CART_DETAIL.CARTID= CART.CARTID AND CART.ACCOUNTID= ACOUNT.ACCOUNTID 
                AND ACOUNT.ACCOUNTID = RECEIPT.ACCOUNTID AND ACOUNT.ACCOUNTUSER= acc_user;
    DELETE CART FROM CART, ACOUNT 
    WHERE CART.ACCOUNTID = ACOUNT.ACCOUNTID AND ACCOUNTUSER= acc_user;                
END;


------------------------trigger
---------------------------

CREATE TRIGGER trig_account_insert BEFORE INSERT ON ACCOUNT
FOR EACH ROW
BEGIN   
    SET NEW.ACCOUNTDATE = CURDATE();
END;


CREATE TRIGGER trig_account_insert BEFORE INSERT ON CART
FOR EACH ROW
BEGIN   
    SET NEW.CARTTIME = NOW();
END;

CREATE TRIGGER trig_account_insert BEFORE INSERT ON RECEIPT
FOR EACH ROW
BEGIN   
    SET NEW.RECEIPTTIME = NOW();
END;


-- neu k co thoi gian co dinh thi set thoi gian bat dau & ket thuc = null
CREATE TRIGGER trig_itempromotion_insert BEFORE INSERT ON ITEM_PROMOTION
FOR EACH ROW
BEGIN
    IF(NEW.HOURLYPR == 0) THEN
        SET NEW.STARTHOUR =null;
        SET NEW.ENDHOUR =null;
    END IF;
END;


-- nhập vào item_promotion_detai thì minquant >0 và minquant<maxquant 
CREATE TRIGGER trig_itempromotiondetail_insert BEFORE INSERT ON ITEM_PROMOTION_DETAIL
FOR EACH ROW
BEGIN
    IF(NEW.MINQUANT < 0) THEN
        SET NEW.MINQUANT =0;
    END IF;
    DECLARE SWAPQUANT INT(11);
    DECLARE diff_date int(11);
    DECLARE SWAPDATE DATE;
    SELECT DATEDIFF(NEW.STARTDATE,NEW.ENDDATE) INTO diff_date
    IF(diff_date>0)
        SET SWAPDATE = NEW.STARTDATE;
        SET NEW.STARTDATE = NEW.ENDDATE;
        SET NEW.ENDDATE= SWAPDATE;
    END IF;
    IF(NEW.MAXQUANT < NEW.MINQUANT) THEN
        SET SWAPQUANT = NEW.MINQUANT;
        SET NEW.MINQUANT = NEW.MAXQUANT;
        SET NEW.MAXQUANT= SWAP;
    END IF;
END;

-- nhập vào receipt_promotion_detail thì mỉncpvalue >0 và minrcpvalue < maxrcpvalue
CREATE TRIGGER trig_receiptpromotiondetail_insert BEFORE INSERT ON RECEIPT_PROMOTION_DETAIL
FOR EACH ROW
BEGIN
    IF(NEW.MINRCPVALUE < 0) THEN
        SET NEW.MINRCPVALUE =0;
    END IF;
    DECLARE SWAP INT(11);
    IF(NEW.MAXRCPVALUE < NEW.MINRCPVALUE) THEN
        SET SWAP = NEW.MINRCPVALUE;
        SET NEW.MINRCPVALUE = NEW.MAXRCPVALUE;
        SET NEW.MINRCPVALUE= SWAP;
    END IF;
END;

-- neu k co thoi gian co dinh thi set thoi gian bat dau & ket thuc = null, set gia tri khuyen mai =0 neu value<0
CREATE TRIGGER trig_userpromotion_insert BEFORE INSERT ON USER_PROMOTION
FOR EACH ROW
BEGIN
    IF(NEW.HOURLYPR == 0) THEN
        SET NEW.STARTHOUR =null;
        SET NEW.ENDHOUR =null;
    END IF;
    DECLARE diff_date int(11);
    DECLARE SWAP DATE;
    SELECT DATEDIFF(NEW.STARTDATE,NEW.ENDDATE) INTO diff_date
    IF(diff_date>0)
        SET SWAP = NEW.STARTDATE;
        SET NEW.STARTDATE = NEW.ENDDATE;
        SET NEW.ENDDATE= SWAP;
    END IF;
    IF(NEW.VALUE <0) THEN
        SET NEW.VALUR =0;
    END IF;
END;

-- gia tri bonus nam trong khoang [0;10%]
CREATE TRIGGER trig_itempromotion_insert BEFORE INSERT ON USER_PROMOTION_DETAIL
FOR EACH ROW
BEGIN
    IF(NEW.BONUS <0) THEN
        SET NEW.BONUS =0;
    ELSEIF(NEW.BONUS>10)
        SET NEW.BONUS =10;
    END IF;
END;

-- trong receipt_detail, tinh value = so luong * gia
-- trong receipt, tinh receipt_value = receipt_value* receipt_detail.value

CREATE TRIGGER trig_receiptdetail_insert BEFORE INSERT ON RECEIPT_DETAIL
FOR EACH ROW
BEGIN
    SET NEW.VALUE = QUANTITY* (SELECT ITEMPRICE FROM ITEM WHERE ITEMID = NEW.ITEMID);
    UPDATE RECEIPT SET RECEIPTVALUE += NEW.VALUE WHERE RECEIPTID = NEW.RECEIPTID;
END;

-- nagy bat da < nagy ket thuc
-- neu k co thoi gian co dinh thi set thoi gian bat dau & ket thuc = null
CREATE TRIGGER trig_receiptpromotion_insert BEFORE INSERT ON RECEIPT_PROMOTION
FOR EACH ROW
BEGIN
    IF(NEW.HOURLYPR == 0) THEN
        SET NEW.STARTHOUR =null;
        SET NEW.ENDHOUR =null;
    END IF;
    DECLARE diff_date int(11);
    DECLARE SWAP DATE;
    SELECT DATEDIFF(NEW.STARTDATE,NEW.ENDDATE) INTO diff_date
    IF(diff_date>0)
        SET SWAP = NEW.STARTDATE;
        SET NEW.STARTDATE = NEW.ENDDATE;
        SET NEW.ENDDATE= SWAP;
    END IF;
END;

--
CREATE TRIGGER trig_cartdetail_insert BEFORE INSERT ON CART_DETAIL
FOR EACH ROW
BEGIN
    SET NEW.VALUE = QUANTITY* (SELECT ITEMPRICE FROM ITEM WHERE ITEMID = NEW.ITEMID);
    UPDATE CART SET VALUE += NEW.VALUE WHERE CARTID = NEW.CARTID;
END;










