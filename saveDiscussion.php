<?php
$servername = "localhost";
$username = "devon";
$password = "hicproj";
$dbname = "hicdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert new topic
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['topic_id'])) {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO topics (title, name, subject) VALUES ('$title', '$name', '$subject')";

    if ($conn->query($sql) === TRUE) {
        echo "New topic created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Insert new comment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['topic_id'])) {
    $topic_id = $_POST['topic_id'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments (topic_id, name, comment) VALUES ('$topic_id', '$name', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "New comment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
