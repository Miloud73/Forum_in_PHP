<?php 
require "../confing/confing.php";
require "../includes/header.php";
?>
<?php
	if(!isset($_SESSION["username"])){
		header("location".APPURL."");
	}

    if(isset($_GET['topics_id'])){
		$topics_id= $_GET['topics_id'];

		$stmt = $conn->prepare("SELECT * FROM topics WHERE topics_id = :id");
		$stmt->execute(['id' => $topics_id]);
		$topic = $stmt->fetch(PDO::FETCH_OBJ);


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
				
					$update = $conn->prepare("UPDATE topics SET title= :title,body= :body, category= :category , user_name = :user_name WHERE topics_id = :id");
					$update->execute([
						":user_name" => $user_name,
						":title" => $title,
						":body" => $body,
						":category" => $category,
                        ":id" => $topics_id
					]);
					header("location: ".APPURL."");
					
			
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
						<form role="form" method="post" action="update.php?topics_id=<?php echo $topics_id ?>">
							<div class="form-group">
								<label>Topic Title</label>
								<input type="text" value="<?php echo htmlspecialchars($topic->title) ?>" class="form-control" name="title" placeholder="Enter Post Title">
							</div>
							<div class="form-group">
								<label>Category</label>
								<select name="category" class="form-control"  >
									<option value="Design"<?php if($topic->category == "Design") echo "selected"; ?>>Design</option>
									<option  value="Development"<?php if($topic->category == "Development") echo "selected"; ?>>Development</option>
									<option value="Business & Marketing" <?php if($topic->category == "Business & Marketing") echo "selected"; ?>>Business & Marketing</option>
									<option value="Search Engines" <?php if($topic->category == "Search Engines") echo "selected"; ?>>Search Engines</option>
									<option value="cloud & Hosting" <?php if($topic->category == "cloud & Hosting") echo "selected"; ?>>Cloud & Hosting</option>
							</select>
							</div>
								<div class="form-group">
									<label>Topic Body</label>
									<textarea id="body" rows="10" cols="80" class="form-control" name="body" ><?php echo htmlspecialchars($topic->body) ?></textarea>
									<script>CKEDITOR.replace('body');</script>
								</div>
							<button type="submit" name="submit" class="color btn btn-default">Update</button>
						</form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php"?> 