<?php
try {
    // Define constants
    define("HOST", "localhost");
    define("DBNAME", "forum");
    define("USER", "root");
    define("PASS", "");

    // Create a new PDO instance
    $conn = new PDO(
        "mysql:host=".HOST.";dbname=".DBNAME, USER, PASS
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $Exception) {
    echo $Exception->getMessage();
}
?>
