<?php
include 'classes/adminlogin.php';
?>
<?php
$class = new adminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $adminEmail = $_POST['adminEmail'];
  $adminPass = md5($_POST['adminPass']);
  $login_check = $class->login_admin($adminEmail, $adminPass);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Preschool - Bootstrap Admin Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

<link href="../../../../css?family=Roboto:300,400,500,700,900" rel="stylesheet">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">

<link rel="stylesheet" href="assets/css/style.css">
<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class="main-wrapper">
<div class="account-page">
<div class="container">
<h3 class="account-title text-white">Login</h3>
<div class="account-box">
<div class="account-wrapper">
<div class="account-logo">
<a href="index.html"><img src="assets/img/logo.png" alt="SchoolAdmin"></a>
</div>
<form  action="" method="post" >
<div class="form-group">
<label>Username or Email</label>
<input name="adminEmail" type="text" class="form-control">
</div>
<div class="form-group">
<label>Password</label>
<input name="adminPass" type="password" class="form-control">
</div>
<div class="form-group text-center custom-mt-form-group">
<button class="btn btn-primary btn-block account-btn" type="submit">Login</button>
</div>
<div class="text-center">
<a href="forgot-password.html">Forgot your password?</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/jquery.slimscroll.js"></script>

<script src="assets/js/app.js"></script>
</body>
</html>