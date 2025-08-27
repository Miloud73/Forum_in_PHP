<?php 
	// start counting All Topics
  	$stmt = $conn->prepare("SELECT count(*) as all_topics FROM topics ");
    $stmt->execute();
    $count_AllTopic = $stmt->fetch(PDO::FETCH_OBJ);
	// end counting All Topics

	// number of post inside every category
	$stmtCategories = $conn ->prepare("SELECT categories.id AS id,categories.name AS name,
	COUNT(topics.category) AS count_categories FROM categories
	LEFT JOIN topics ON categories.name = topics.category GROUP BY (topics.category) ");
	$stmtCategories->execute();

	$allCategories = $stmtCategories->fetchAll(PDO::FETCH_OBJ);
?>
<div class="col-md-4">
				<div class="sidebar">
					<div class="block">
					<h3>Categories</h3>
					<div class="list-group block ">
						<a href="#" class="list-group-item active">All Topics <span class="badge pull-right"><?php echo  $count_AllTopic->all_topics; ?></span></a> 
						 <?php foreach($allCategories as $category): ?>
						<a href="/forum/categories/show.php?name=<?php echo $category->name ; ?>" class="list-group-item"><?php echo $category->name ?><span class="color badge pull-right"><?php echo $category->count_categories ?></span></a>
						<?php endforeach ?>
					</div>
					</div>

					<div class="block" style="margin-top: 20px;">
						<h3 class="margin-top: 40px">Forum Statistics</h3>
						<div class="list-group">
							<a href="#" class="list-group-item">Total Number of Users:<span class="color badge pull-right">4</span></a>
							<a href="#" class="list-group-item">Total Number of Topics:<span class="color badge pull-right">9</span></a>
							<a href="#" class="list-group-item">Total Number of Categories: <span class="color badge pull-right">12</span></a>
							
						</div>
				    </div>
			    </div>	
				</div>
			</div>
		</div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo APPURL ;?>/js/bootstrap.js"></script>
  </body>
</html>
