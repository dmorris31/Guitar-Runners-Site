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

// Retrieve topics from the database
$sql = "SELECT * FROM topics ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['subject'] . "</p>";
        echo "<p>Posted by <strong>" . $row['name'] . "</strong> on <span class='post-time'>" . $row['created_at'] . "</span></p>";

        // Load comments for this topic
        $topic_id = $row['id'];
        $sql_comments = "SELECT * FROM comments WHERE topic_id = $topic_id ORDER BY created_at";
        $result_comments = $conn->query($sql_comments);

        if ($result_comments->num_rows > 0) {
            while ($comment_row = $result_comments->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p>" . $comment_row['comment'] . "</p>";
                echo "<p>Comment by <strong>" . $comment_row['name'] . "</strong> on <span class='comment-time'>" . $comment_row['created_at'] . "</span></p>";
                echo "</div>";
            }
        } else {
            echo "<div class='comment'>No comments yet.</div>";
        }

        // Form to post a new comment
        echo "<div class='add-comment'>";
        echo "<input type='hidden' name='topic_id' value='" . $row['id'] . "'>";
        echo "<input type='text' placeholder='Your name' name='name' class='comment-name'>";
        echo "<textarea placeholder='Reply to this topic...' name='comment' class='comment-text'></textarea>";
        echo "<button onclick='postComment(this)'>Reply</button>";
        echo "</div>";

        echo "</div>";
    }
} else {
    echo "No topics found.";
}

$conn->close();
?>
