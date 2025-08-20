<?php 
require "../confing/confing.php";
require "../includes/header.php";

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
    $stmtReplies = $conn->prepare("SELECT * FROM replies WHERE topics_id = :id ORDER BY create_at ASC");
    $stmtReplies->execute(['id' => $topics_id]);
    $allReplies = $stmtReplies->fetchAll(PDO::FETCH_OBJ);
}

// for replies section
if(isset($_POST['submit'])){
    if(empty($_POST['reply'])){
        echo "<script>alert('The reply is empty');</script>";
    } else {
        $reply = $_POST['reply'];
        $user_id = $_SESSION['user_id'];
        $user_image = $_SESSION['user_image'];
        $user_name = $_SESSION['username'];

        $insert = $conn->prepare("INSERT INTO replies (reply, user_id, topics_id, user_name, user_image) 
		VALUES (:reply, :user_id, :topics_id, :user_name, :user_image)");
        $insert->execute([
            ":user_name" => $user_name,
            ":user_image" => $user_image,
            ":reply" => $reply,
            ":user_id" => $user_id,
            ":topics_id" => $topics_id
        ]);
        header("location:".APPURL."/topics/topic.php?topics_id=".$topics_id."");
        exit;
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><?php echo htmlspecialchars($singleTopic->title); ?></h1>
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
                                            <li><a href="profile.php">Profile</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo htmlspecialchars($singleTopic->body)?></p>
                                    </div>
                                </div>
                                <?php if($singleTopic->user_name == $_SESSION['username']) : ?>
                                    <a class="btn btn-danger" 
                                       href="delete.php?topics_id=<?php echo $singleTopic->topics_id; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this topic?');">
                                        Delete
                                    </a>
                                    <a class="btn btn-warning" href="update.php?topics_id=<?php echo $singleTopic->topics_id; ?>" role="button">Update</a>
                                <?php endif ?>
                            </div>
                        </li>
                    </ul>

                    <!-- ✅ Replies Section -->
                    <h3>Replies</h3>
                    <ul class="replies">
                        <?php if($allReplies): ?>
                            <?php foreach($allReplies as $reply): ?>
                                <li class="topic">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="avatar pull-left" src="../img/<?php echo htmlspecialchars($reply->user_image); ?>" />
                                        </div>
                                        <div class="col-md-10">
                                            <p><strong><?php echo htmlspecialchars($reply->user_name); ?></strong></p>
                                            <p><?php echo htmlspecialchars($reply->reply); ?></p>
                                            <small>Posted on: <?php echo $reply->create_at; ?></small>
                                        </div>
                                        <?php if($reply->user_name == $_SESSION['username']) : ?>
                                            <a class="btn btn-danger" 
                                            href="../replies/delete.php?id=<?php echo $reply->id; ?>" 
                                            onclick="return confirm('Are you sure you want to delete this topic?');">
                                                Delete
                                            </a>
                                            <a class="btn btn-warning" href="../replies/update.php?id=<?php echo $reply->id; ?>"  role="button">
                                                Update
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No replies yet. Be the first to reply!</p>
                        <?php endif; ?>
                    </ul>

                    <!-- Reply Form -->
                    <h3>Reply To Topic</h3>
                    <form role="form" method="post" action="topic.php?topics_id=<?php echo htmlspecialchars($topics_id); ?>">				
                        <div class="form-group">
                            <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                            <script>CKEDITOR.replace('reply');</script>
                        </div>
                        <button type="submit" name="submit" class="color btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"?>

