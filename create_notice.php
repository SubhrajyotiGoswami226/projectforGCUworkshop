<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];

    
    if (empty($title) || empty($description)) {
        echo 'Please provide a notice title and description.';
    } else {
        
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'notices';

        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        
        $sql = "INSERT INTO notices (title, description) VALUES ('$title', '$description')";
        if ($conn->query($sql) === true) {
            header('Location: view_notice.php?id=' . urlencode($conn->insert_id));
            exit();
        } else {
            echo 'Failed to create the notice: ' . $conn->error;
        }

        $conn->close();
    }
}
?>
