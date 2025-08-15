<?php 
require "../confing/confing.php";
require "../includes/header.php";
?>
<?php 
	if(isset($_GET['topics_id'])){
		$topics_id= $_GET['topics_id'];

		$stmt = $conn->prepare("SELECT * FROM topics WHERE topics_id = :id");
		$stmt->execute(['id' => $topics_id]);
		$singleTopic = $stmt->fetch(PDO::FETCH_OBJ);

		if ($singleTopic) {
        // Count topics by the same user
			$stmtCount = $conn->prepare("SELECT COUNT(*) as countTopics FROM topics WHERE user_name = :user_name");
			$stmtCount->execute(['user_name' => $singleTopic->user_name]);
			$count = $stmtCount->fetch(PDO::FETCH_OBJ);
    	}

				$stmtReplies = $conn->prepare("SELECT * FROM replies WHERE topics_id = :id");
		$stmtReplies->execute(['id' => $topics_id]);
		$allReplies = $stmtReplies->fetch(PDO::FETCH_OBJ);

	}
	
?>
    <div class="container">
		
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left"><?php 
    							echo htmlspecialchars($singleTopic->title );
						  ?></h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
							<li id="main-topic" class="topic topic">
								<div class="row">
									<div class="col-md-2">
										<div class="user-info">
											<img class="avatar pull-left" src="../img/<?php echo htmlspecialchars($singleTopic->user_image)?>" />
											<ul>
												<li><strong><?php echo htmlspecialchars($singleTopic->user_name)?></strong></li>
												<li><?php echo $count->countTopics; ?> Posts</li>
												<li><a href="profile.php">Profile</a>
											</ul>
										</div>
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<p><?php echo htmlspecialchars($singleTopic->body)?></p>
										</div>
									</div>
								</div>
							</li>
							
						</ul>
						<h3>Reply To Topic</h3>
						<form role="form">				
							<div class="form-group">
								<textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
								<script>
									CKEDITOR.replace( 'reply' );
								</script>
							</div>
							<button type="submit" class="color btn btn-default">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		
			<?php require "../includes/footer.php"?>