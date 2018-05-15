
$(document).ready(function(){
	$("#btn-suathongtin").click(function(){
		if($("#edit-name").hasClass('hide')){//nếu textfield đang ẩn
			//reset các filed input
			$("input").val('');

			//hiện text field để nhập Tên ra và reset giá trị
			$("#edit-name").removeClass('hide');
						
			//hiện text field để nhập email ra và reset giá trị
			$("#edit-email").removeClass('hide');
			
			//hiện text field để nhập sdt ra và reset giá trị
			$("#edit-phone").removeClass('hide');
			
			//hiện option để chọn giới tính ra
			$("#edit-sex").removeClass('hide');

			//hiển thị datapicker để nhập ngày sinh
			$("#edit-dob").removeClass('hide');

			// ẩn tên user, email, sdt, giới tính, ngày sinh hiện tại
			$("#current-user1").addClass('hide');
			$("#user-email").addClass('hide');
			$("#user-phone").addClass('hide');
			$("#user-sex").addClass('hide');
			$("#user-dob").addClass('hide');

			$('#btn-suathongtin').removeClass('btn-success');//đổi màu btn sửa thông tin 
			$('#btn-suathongtin').addClass('btn-info');
			$("#btn-suathongtin").html('Lưu');//đổi tên của btn thành Lưu			

			
		}
		else{
			//ẩn
			$("#edit-name").addClass('hide');
			$("#edit-email").addClass('hide');
			$("#edit-phone").addClass('hide');
			$("#edit-sex").addClass('hide');
			$("#edit-dob").addClass('hide');

			//hiện
			$('#current-user1').removeClass('hide');
			$('#user-email').removeClass('hide');
			$('#user-phone').removeClass('hide');
			$('#user-sex').removeClass('hide');
			$('#user-dob').removeClass('hide');		

			$('#btn-suathongtin').removeClass('btn-info');//đổi màu btn sửa thông tin 
			$('#btn-suathongtin').addClass('btn-success');
			$("#btn-suathongtin").html('Sửa thông tin');//đổi tên của btn thành Sửa thông tin				
		}

	});
	

	$("#btn-doimatkhau").click(function(){
		alert();
	});
    $('#datetimepicker8').datetimepicker({
    	icons: {
        	time: "fa fa-clock-o",
        	date: "fa fa-calendar",
        	up: "fa fa-arrow-up",
        	down: "fa fa-arrow-down"
    	}
	});
	
})
