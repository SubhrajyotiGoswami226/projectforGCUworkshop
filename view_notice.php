<?php
// Check if the notice ID is provided in the URL
if (!isset($_GET['id'])) {
    header('Location: index.html');
    exit();
}

// Get the notice ID from the URL
$id = $_GET['id'];

// Connect to the MySQL database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'notices';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Retrieve the notice from the database
$sql = "SELECT * FROM notices WHERE id = $id";
$result = $conn->query($sql);

// Check if the notice exists
if ($result->num_rows === 0) {
    header('Location: index.html');
    exit();
}

// Fetch the notice data
$notice = $result->fetch_assoc();

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Notice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
      margin-top: 50px;
    }
    
    h1 {
      margin-bottom: 10px;
    }
    
    p {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Notice Created</h1>
    <p>Title: <?php echo $notice['title']; ?></p>
    <p>Description: <?php echo $notice['description']; ?></p>
  </div>
</body>
</html>
