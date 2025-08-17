<?php 
require "../confing/confing.php";
require "../includes/header.php";

if (isset($_GET['topics_id'])) {
    $topics_id = $_GET['topics_id'];

    $stmt = $conn->prepare("SELECT * FROM topics WHERE topics_id = :id");
		$stmt->execute(['id' => $topics_id]);
		$topic = $stmt->fetch(PDO::FETCH_OBJ);

		if($topic->user_name !== $_SESSION['username']){
			header("location: ".APPURL."");
		}


    $stmtDelete = $conn->prepare("DELETE FROM topics WHERE topics_id = :id");
    $stmtDelete->execute(['id' => $topics_id]);

    

    // redirect back to homepage
    header("Location: " . APPURL . "");
    exit;
}
?>
