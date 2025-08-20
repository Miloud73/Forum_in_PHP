<?php 
require "../confing/confing.php";
require "../includes/header.php";

if (isset($_GET['id'])) {
    $topics_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM replies WHERE id = :id");
		$stmt->execute(['id' => $topics_id]);
		$reply = $stmt->fetch(PDO::FETCH_OBJ);

		if($reply->user_name !== $_SESSION['username']){
			header("location: ".APPURL."");
		}


    $stmtDelete = $conn->prepare("DELETE FROM replies WHERE id = :id");
    $stmtDelete->execute(['id' => $topics_id]);

    

    // redirect back to homepage
    header("Location: " . APPURL . "/topics/topic.php?topics_id=".$topics_id."");
    exit;
}
?>
