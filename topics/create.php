<?php 
require "../confing/confing.php";
require "../includes/header.php";
?>
<?php
	if(!isset($_SESSION["username"])){
		header("location".APPURL."");
	}
	if(isset($_POST['submit'])){
		if(
			empty($_POST['title']) ||
			empty($_POST['body'])|| 
			empty($_POST['category'] )){
			echo "<script>alert('one or more inputs are empty');</script>";
		} else {
			$title = $_POST['title'];
			$category = $_POST['category'];
			$body = $_POST['body'];
			$user_name = $_SESSION['username'];
			$user_image = $_SESSION['user_image'];
				
					$insert = $conn->prepare("INSERT INTO topics (title, category, body, user_name, user_image) 
					VALUES (:title, :category, :body, :user_name, :user_image)");
					$insert->execute([
						":user_name" => $user_name,
						":user_image" => $user_image,
						":title" => $title,
						":body" => $body,
						":category" => $category
					]);
					header("location:".APPURL."");
					
			
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
						<form role="form" method="post" action="create.php">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
							</div>
							<div class="form-group">
								<label>Category</label>
								<select name="category" class="form-control">
									<option value="Design">Design</option>
									<option  value="Development">Development</option>
									<option value="Marketing">Marketing</option>
									<option value="SEO">SEO</option>
									<option value="Hosting">Hosting</option>
							</select>
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php"?> 