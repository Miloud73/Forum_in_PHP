<?php require "../includes/header.php"; ?>
<?php require "../confing/confing.php"; ?>

<?php 
if(isset($_GET['name'])){
    $name = $_GET['name'];

    // Récupérer topics + nombre de réponses
    $stmt = $conn->prepare("
        SELECT topics.*,
               COUNT(replies.id) as count_reply
        FROM topics
        LEFT JOIN replies ON topics.topics_id = replies.topics_id
        WHERE topics.category = :name
        GROUP BY topics.topics_id
        ORDER BY topics.create_at DESC
    ");
    $stmt->execute([':name' => $name]);
    $allTopics = $stmt->fetchAll(PDO::FETCH_OBJ);
}
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
                        <?php if($allTopics): ?>
                            <?php foreach($allTopics as $topic): ?>
                                <li class="topic">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img class="avatar pull-left" src="../img/<?php echo htmlspecialchars($topic->user_image); ?>" />
                                        </div>
                                        <div class="col-md-10">
                                            <div class="topic-content pull-right">
                                                <h3>
                                                    <a href="../topics/topic.php?topics_id=<?php echo $topic->topics_id; ?>">
                                                        <?php echo htmlspecialchars($topic->title); ?>
                                                    </a>
                                                </h3>
                                                <div class="topic-info">
                                                    <a href="show.php?name=<?php echo urlencode($topic->category); ?>">
                                                        <?php echo htmlspecialchars($topic->category); ?>
                                                    </a> >>
                                                    <a href="../profile.php?user=<?php echo urlencode($topic->user_name); ?>">
                                                        <?php echo htmlspecialchars($topic->user_name); ?> 
                                                    </a> >>
                                                    Posted on: <?php echo $topic->create_at; ?>
                                                    <span class="color badge pull-right"><?php echo $topic->count_reply; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No topics found in this category.</p>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
<?php require "../includes/footer.php"; ?>
