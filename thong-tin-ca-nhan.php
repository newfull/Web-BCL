<?php include_once("header.php");?>
<head>
    <title>Thông tin cá nhân</title>
    
</head>

<body>
    <div class="account-management">
        <div class="row">
            <div class="col-xs-2">
                <?php include_once("qltk-left.php");?>
            </div>
            <div class="col-xs-10">
                <div class="nav-name">
                    <p id="Nav-name">Thông tin cá nhân</p>
                </div>

                <div class="frames-bi"> 
                    <div class="container">
                        <div class="row">

                            <div class="col-xs-3">
                                <p>Tên</p>
                                <p  id="current-user1"> Nguyễn Thế Biển</p>
                                <input id='edit-name'class="hide" type="" name=""> </input>
                                <p>Giới tính</p>
                                <p id="user-sex">Nam</p>
                                <select id='edit-sex'class="hide" > 
                                    <option value="nam">Nam</option>
                                    <option value="nu">Nữ</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <p>Địa chỉ email</p>
                                <p id="user-email">thebienpronguyen@gmail.com</p>
                                <input id='edit-email'class="hide" type="" name=""> </input>
                                <p >Ngày sinh</p>
                                <p id="user-dob">22/01/1997</p>
                                <div class="container">
                                    <div class="col-sm-3"">
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker8'>
                                                <input type='text' class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar">
                                                    </span>                                               
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <p>Số điện thoại</p>
                                <p id="user-phone">01202185875</p>
                                <input id='edit-phone'class="hide" type="" name=""> </input>
                            </div>
                        </div>
                        <div class="edit-info-bi">
                            <button class="btn btn-success" id="btn-suathongtin">Sửa thông tin</button>
                            <button class="btn btn-success" id="btn-doimatkhau"> Đổi mật khẩu</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/main.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/smoothscroll.js"></script>
<script src="/js/velocity.min.js"></script>
<script src="/js/bien.js"></script>
    
</body>
</html>


<?php include_once("footer.php");?>
