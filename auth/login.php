<?php 
require "../confing/confing.php";
require "../includes/header.php";
?>
<?php
  if(isset($_SESSION['username'])){
    header("location:".APPURL."");
  }


	if(isset($_POST['register'])){
		if(
      empty($_POST['email']) ||
      empty($_POST['password'])
    ){
      echo "<script>alert('one or more inputs are empty');</script>";
    } else {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $login = $conn->prepare("SELECT * FROM users WHERE email = '$email'");
      $login->execute();
      $fetch=$login->fetch(PDO::FETCH_ASSOC);

      if($login->rowCount()> 0){
        if(password_verify($password , $fetch['password'])){
          $_SESSION['username'] = $fetch['username'];
          $_SESSION['user_id'] = $fetch['id'];
          // $_SESSION['name'] = $fetch['name'];
          $_SESSION['email'] = $fetch['email'];
          $_SESSION['user_image'] = $fetch['avatar'];
          header("location:".APPURL.""); 
        } else {
          echo "<script>alert('Password is incorrect');</script>";
        }
      }
    }
	}
?>
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Register</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" enctype="multipart/form-data" method="post" action="login.php">
							
							<div class="form-group">
							<label>Email Address*</label> <input type="email" class="form-control"
							name="email" placeholder="Enter Your Email Address">
							</div>
					
					<div class="form-group">
                        <label>Password*</label> <input type="password" class="form-control"
                    name="password" placeholder="Enter A Password">
                    </div>
	
			        <input name="register" type="submit" class="color btn btn-default" value="Register" />
        </form>
					</div>
				</div>
			</div>
      <?php include("../includes/footer.php") ?>