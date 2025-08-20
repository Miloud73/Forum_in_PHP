<?php 
require "../confing/confing.php";
require "../includes/header.php";

if (isset($_GET['id']) && isset($_GET['topics_id'])) {
    $reply_id = $_GET['id'];
    $topics_id = $_GET['topics_id'];

    // fetch reply
    $stmt = $conn->prepare("SELECT * FROM replies WHERE id = :id");
    $stmt->execute(['id' => $reply_id]);
    $reply = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$reply) {
        header("location: ".APPURL."/topics/topic.php?topics_id=".$topics_id);
        exit;
    }

    // check ownership
    if ($reply->user_name !== $_SESSION['username']) {
        header("location: ".APPURL."/topics/topic.php?topics_id=".$topics_id);
        exit;
    }

    // delete reply
    $stmtDelete = $conn->prepare("DELETE FROM replies WHERE id = :id");
    $stmtDelete->execute(['id' => $reply_id]);

    // redirect back to the topic
    header("Location: " . APPURL . "/topics/topic.php?topics_id=" . $topics_id);
    exit;
}
?>
