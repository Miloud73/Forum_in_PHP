<?php 
	// start counting All Topics
  	$stmt = $conn->prepare("SELECT count(*) as all_topics FROM topics ");
    $stmt->execute();
    $count_AllTopic = $stmt->fetch(PDO::FETCH_OBJ);
	// end counting All Topics
	// start counting Design topic
	$stmtDesign = $conn->prepare("SELECT count(*) as design_topic from topics where category ='Design'");
	$stmtDesign->execute();
    $count_DesignTopic = $stmtDesign->fetch(PDO::FETCH_OBJ);
	// end counting Design topic

	// start counting Development topic
	$stmtDevelopment = $conn->prepare("SELECT count(*) as Development_topic from topics where category ='Development'");
	$stmtDevelopment->execute();
    $count_DevelopmentTopic = $stmtDevelopment->fetch(PDO::FETCH_OBJ);
	// end counting Development topic

	// start counting Business & Marketing topic
	$stmtMarketing = $conn->prepare("SELECT count(*) as marketing_topic from topics where category ='Business & Marketing'");
	$stmtMarketing->execute();
    $count_MarketingTopic = $stmtMarketing->fetch(PDO::FETCH_OBJ);
	// end counting Business & Marketing topic
	
	// start counting Search Engines topic
	$stmtSearch  = $conn->prepare("SELECT count(*) as Search_topic from topics where category ='Search Engines'");
	$stmtSearch ->execute();
    $count_SearchTopic = $stmtSearch->fetch(PDO::FETCH_OBJ);
	// end counting Search Engines topic
	// start counting Cloud & Hosting topic
	$stmtCloud  = $conn->prepare("SELECT count(*) as Cloud_topic from topics where category ='Cloud & Hosting'");
	$stmtCloud->execute();
    $count_Cloud = $stmtCloud->fetch(PDO::FETCH_OBJ);
	// end counting Cloud & Hosting topic
		

?>

<div class="col-md-4">



				<div class="sidebar">
					
					
					<div class="block">
					<h3>Categories</h3>
					<div class="list-group block ">
						<a href="#" class="list-group-item active">All Topics <span class="badge pull-right"><?php echo  $count_AllTopic->all_topics; ?></span></a> 
						<a href="#" class="list-group-item">Design<span class="color badge pull-right"><?php echo  $count_DesignTopic->design_topic; ?></span></a>
						<a href="#" class="list-group-item">Development<span class="color badge pull-right"><?php echo  $count_DevelopmentTopic->Development_topic; ?></span></a>
						<a href="#" class="list-group-item">Business & Marketing <span class="color badge pull-right"><?php echo  $count_MarketingTopic->marketing_topic; ?></span></a>
						<a href="#" class="list-group-item">Search Engines<span class="color badge pull-right"><?php echo  $count_SearchTopic->Search_topic; ?></span></a>
						<a href="#" class="list-group-item">Cloud & Hosting <span class="color badge pull-right"><?php echo  $count_Cloud->Cloud_topic; ?></span></a>
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
