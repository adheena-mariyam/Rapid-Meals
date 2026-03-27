<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<link rel="icon" type="image/png" href="./Asset/Template/Login/images/icons/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="./Asset/Template/Login/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="./Asset/Templates/Fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="./Asset/Templates/Fonts/fonts/fonts.css"/>
<link rel="stylesheet" type="text/css" href="./Asset/Assets/Login/login.css"/>
<link rel="stylesheet" type="text/css" href="./Asset/Templates/Login/css/util.css"/>
</head>
<body>
<?php
include("../Asset/Connection/Connection.php");

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    $selQuery="select * from tbl_user where user_name='".$username."' and user_password='".$password."'";
    $result=$con->query($selQuery);
    $data=$result->fetch_assoc();
    
    if($result->num_rows>0)
    {
        $_SESSION['userid']=$data['user_id'];
        $_SESSION['username']=$data['user_name'];
        header("Location: ../User/UserHomepage.php");
    }
    else
    {
        echo "<script>alert('Invalid username or password')</script>";
    }
}
?>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="post">
                <span class="login100-form-title p-b-43">Login to account</span>
                
                <div class="wrap-input100 validate-input" data-validate="Valid username is required">
                    <input class="input100" type="text" name="username">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Username</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>
                
                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">Remember me</label>
                    </div>
                    <div>
                        <a href="#" class="txt1">Forgot Password?</a>
                    </div>
                </div>
                
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="login">Login</button>
                </div>
                
                <div class="text-center p-t-46 p-b-20">
                    <span class="txt2">or sign up using</span>
                </div>
                
                <div class="login100-form-social flex-c-m">
                    <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
            </form>
            <div class="login100-more" style="background-image: url('./Asset/Template/Login/images/bg-01.jpg');"></div>
        </div>
    </div>
</body>
</html>
