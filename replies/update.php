<?php
require "../confing/confing.php";
require "../includes/header.php";

if (!isset($_GET['id']) || !isset($_GET['topics_id'])) {
    header("Location: " . APPURL);
    exit;
}

$reply_id  = $_GET['id'];
$topics_id = $_GET['topics_id'];

// Fetch the reply
$stmt = $conn->prepare("SELECT * FROM replies WHERE id = :id");
$stmt->execute(['id' => $reply_id]);
$reply = $stmt->fetch(PDO::FETCH_OBJ);

if (!$reply) {
    header("Location: " . APPURL . "/topics/topic.php?topics_id=" . $topics_id);
    exit;
}

// Ensure only the owner can update
if ($reply->user_name !== $_SESSION['username']) {
    header("Location: " . APPURL . "/topics/topic.php?topics_id=" . $topics_id);
    exit;
}

// Handle form submission
if (isset($_POST['submit'])) {
    if (empty($_POST['reply'])) {
        echo "<script>alert('The reply cannot be empty');</script>";
    } else {
        $updatedReply = $_POST['reply'];

        $stmtUpdate = $conn->prepare("UPDATE replies SET reply = :reply WHERE id = :id");
        $stmtUpdate->execute([
            ':reply' => $updatedReply,
            ':id' => $reply_id
        ]);

        header("Location: " . APPURL . "/topics/topic.php?topics_id=" . $topics_id);
        exit;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h2>Update Reply</h2>
                    <form method="post" action="">
                        <div class="form-group">
                            <textarea name="reply" rows="6" class="form-control"><?php echo htmlspecialchars($reply->reply); ?></textarea>
                            <script>CKEDITOR.replace('reply');</script>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        <a href="<?php echo APPURL . '/topics/topic.php?topics_id=' . $topics_id; ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../includes/footer.php"; ?>
