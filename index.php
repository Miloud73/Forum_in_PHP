<?php require"includes/header.php" ?>
<?php require"confing/confing.php" ?>
<?php 
	$topics = $conn->query(
		"SELECT topics.topics_id as id,topics.title as title , topics.category as category , topics.user_name as user_name , topics.user_image as user_image , topics.create_at as create_at , COUNT(replies.topics_id) as count_reply  FROM topics LEFT JOIN replies ON topics.topics_id = replies.topics_id GROUP BY (replies.topics_id)"
	);
	$topics->execute();

	$allTopics = $topics->fetchAll(PDO::FETCH_OBJ);
?>

    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Welcome to Forum</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
						<?php foreach($allTopics as $topic):?>
							<li class="topic">
							<div class="row">
							<div class="col-md-2">
								<img class="avatar pull-left" src="img/<?php echo $topic->user_image; ?>" />
							</div>
							<div class="col-md-10">
								<div class="topic-content pull-right">
									<h3>
									<a href="topics/topic.php?topics_id=<?php echo $topic->id; ?>">
											<?php echo $topic->title; ?>
										</a>
									</h3>
									<div class="topic-info">
										<a href="category.html">
											<?php echo $topic->category; ?>
										</a> >> 
										<a href="profile.html">
											<?php echo $topic->user_name; ?> 
										</a>>> Posted on: <?php echo $topic->create_at; ?>
										<span class="color badge pull-right"><?php echo $topic->count_reply; ?></span>
									</div>
								</div>
							</div>
						</div>
					</li>
					<?php endforeach?>
						</ul>
						
					</div>
				</div>
			</div>
<?php require "includes/footer.php"?>