<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../webroot/css/login.css">
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../webroot/image/logo/logo.png" class="brand_logo" alt="Logo">
                    </div>

                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="post" action="login.php">
                        <div class="input-group mb-3" >
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="email" class="form-control input_user" value="" required
                                placeholder="email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" required
                                placeholder="password">
                        </div>

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="login" class="btn login_btn">Đăng nhập</button>
                        </div>
                    </form>
                </div>

                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Không có tài khoản <a href="../?view=sign-up" class="text-decoration-none ml-2 ">Đăng ký</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// check login
include("../model/database.php");
@session_start();
if (isset($_SESSION['laclac_khachang'])) {
	header('location:../?view');
 }
if(isset($_POST['login'])){
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$checklogin=checklogin($email,$pass);
    if($checklogin==false){
      	echo '<script>alert("Sai tài khoản hoặc mật khẩu ! Xin mời nhập lại .")</script>';
    }else{
		$row=mysqli_fetch_array($checklogin);
		$_SESSION['laclac_khachang']=$row;
		header('location:../?view');
    }
}
?>