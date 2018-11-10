<?php
session_start();
include_once('../../includes/gfconfig.php');
?>
<div clas="page-content">
    <div class="container">
        <p align='center' class='mess' style='font-weight:bold;'></p>
        <form class="book-frm frm-login">
            <h3>Using your account</h3>
            <div class="form-group">
                <input type="email" id='username' class="form-control" placeholder="Email hoặc tên đăng nhập">
            </div>
            <div class="form-group">
                <input type="password" id='password' class="form-control" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-success btn-login btn-block" id='btn_login'>Đăng nhập</button>
                <div class="checkbox text-center">
                    <label><a href="" class="link">Quên mật khẩu</a></label>
                </div>
            </div>

            <p class="notic">Yor can also sing in using your Facebook Account or Google Account</p>
            <div class="clearfix"></div>
            <div class="text-center" style="margin-bottom: 30px">
                    <a href="" class="btn btn-social btn-facebook" style="width: 180px; margin-bottom: 10px" id='fbloginBtn'>
                        <i class="fa fa-facebook"></i> Login Facebook
                    </a>
                    <a href="" class="btn  btn-social btn-google" style="width: 180px; margin-bottom: 10px" id='glloginBtn'>
                        <i class="fa fa-google"></i> Login Google
                    </a>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
$(document).ready(function(){
	$('#btn_login').click(function(){
		$('.mess').html('&nbsp;');
		if(!checkinput()) return;
		var data={};
		data['username']=$('#username').val();
		data['password']=$('#password').val();
		$.post('<?php echo ROOTHOST;?>ajaxs/mem/login.php',{'pdata':data},function(req){
			if(req!=''){
				$('.mess').html('Đăng nhập không thành công, hãy thử lại!').css('color','#f00');
			}else{
                alert('Đăng nhập thành công');
				location.href='<?php echo ROOTHOST;?>trang-chu';
			}
			
		});
	});
	function checkinput(){
		if($('#username').val().trim()==''){
			$('.mess').html('Username không được để trống').css('color','#f00');
			return false;
		}else if($('#password').val().trim()==''){
			$('.mess').html('Mật khẩu không được để trống').css('color','#f00');
			return false;
		}
		return true;
	}
	$('#fbloginBtn').click(function(){
		FB.login(function(response) {
			if (response.authResponse) {
				getUserData();
			}
		}, {scope: 'email,public_profile', return_scopes: true});
		return false;
	});
	function getUserData() {
		FB.api('/me',{fields: 'gender, first_name, last_name, email, picture'},function(response) {
			$.post('<?php echo ROOTHOST;?>ajaxs/mem/fblogin.php',{'value':response},function(data){
			location.reload();
			
			});
		});
	}
});
</script>