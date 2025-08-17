<?php 
require "../confing/confing.php";
require "../includes/header.php";

if (isset($_GET['topics_id'])) {
    $topics_id = $_GET['topics_id'];

    $stmt = $conn->prepare("DELETE FROM topics WHERE topics_id = :id");
    $stmt->execute(['id' => $topics_id]);

    // redirect back to homepage
    header("Location: " . APPURL . "");
    exit;
}
?>
