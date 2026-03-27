<?php
session_start();
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Login</title>
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="../Asset/Template/Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../Asset/Template/Login/css/main.css">
<!--===============================================================================================-->
</head>

<body>
<?php
session_start();  
include("../Asset/Connection/Connection.php");

if(isset($_POST["btn_login"]))
{
	$Uname=$_POST["txt_username"];
	$Pwd=$_POST["txt_password"]; 
	
	$selQryA="select * from tbl_admin where admin_username='".$Uname."' and admin_password='".$Pwd."'";
	$rowA=$con->query($selQryA);
	
	$selQryU="select * from tbl_user where user_name='".$Uname."' and user_password='".$Pwd."'";
	echo $selQryU;
	$rowU=$con->query($selQryU); 
	
	$selQryM="select * from tbl_manager where manager_name='".$Uname."' and manager_password='".$Pwd."'";
	$rowM=$con->query($selQryM);
	

	if($dataA=$rowA->fetch_assoc())
	{
		$_SESSION["aid"]=$dataA["admin_id"];
		$_SESSION["admin_name"]=$dataA["admin_name"];
		header("Location:../Admin/Dashboard.php");
	}
	else if($dataU=$rowU->fetch_assoc())
	{
		$_SESSION["uid"]=$dataU["user_id"];
		$_SESSION["username"]=$dataU["user_name"];
		header("Location:../User/DashBoard.php");
	}
	else if($dataM=$rowM->fetch_assoc())
	{
		$_SESSION["mid"]=$dataM["manager_id"];
		$_SESSION["managername"]=$dataM["manager_name"];
		header("Location:../Manager/DashBoard.php");
	}
		
	else
	{
		?>
        <script>
		alert("Invalid Credentials");
		window.location="Login.php";
		</script>
        <?php
	}
}
?>

<body>
	<div class="limiter">
	
		<div class="container-login100">
			
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../Asset/Template/Login/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form"  method="post">
					<p style="font-size: 24px;color:#000 ;">
						
					<span class="login100-form-title">
					Login
					</span>
					
				</p>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="txt_username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="txt_password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="btn_login">
							Login
						</button>
						
					</div>
					<div class="container-login100-form-btn">
						
					</div>

					

					<div class="text-center p-t-136">
						<a class="txt2" href="UserRegistration.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
						<br>
						<br>
						<a class="txt2" href="UserRegistration.php">
						<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
							Home
							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../Asset/Template/Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../Asset/Template/Login/vendor/bootstrap/js/popper.js"></script>
	<script src="../Asset/Template/Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../Asset/Template/Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../Asset/Template/Login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../Asset/Template/Login/js/main.js"></script>

</body>
</html>
