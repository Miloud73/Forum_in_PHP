<?php 
require "../confing/confing.php";
require "../includes/header.php";
?>
<?php

    if(isset($_GET['id'])){
		$id= $_GET['id'];

		$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
		$stmt->execute(['id' => $id]);
		$user = $stmt->fetch(PDO::FETCH_OBJ);

		// if($topic->user_name !== $_SESSION['username']){
		// 	header("location: ".APPURL."");
		// }


	}
	if(isset($_POST['submit'])){
		if(
			empty($_POST['email']) ||
			empty($_POST['about'])){
			echo "<script>alert('one or more inputs are empty');</script>";
		} else {
			$email = $_POST['email'];
			$about = $_POST['about'];
				
					$update = $conn->prepare("UPDATE users SET email= :email, about= :about WHERE id = :id");
					$update->execute([
						":email" => $email,
						":about" => $about,
                        ":id" => $id
					]);
					        header("location: edit.php?id=$id&success=1");
        exit;

		}
	}
	
?>
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Create A Topic</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="post" action="edit.php?id=<?php echo $id ?>">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" value="<?php echo htmlspecialchars($user->email) ?>" class="form-control" name="email" placeholder="Enter an email">
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="about" rows="10" cols="80" class="form-control" name="about" ><?php echo htmlspecialchars($user->about) ?></textarea>
									<script>CKEDITOR.replace('about');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Update</button>
						</form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php"?> 