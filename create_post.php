<?php
session_start();
require_once 'classes/connect.php'; // Adjust the path as needed

// Check if user is logged in
if (!isset($_SESSION['sforum_userid'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['sforum_userid'];
    $post_content = trim($_POST['post_content']);

    // Validate post content
    if (empty($post_content)) {
        die("Post content cannot be empty.");
    }

    // Insert post into the database
    $conn = (new Database())->connect();
    $stmt = $conn->prepare("INSERT INTO posts (userid, post) VALUES (?, ?)");
    $stmt->bind_param("ss", $userid, $post_content);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit;
    } else {
        die("Database error: " . $stmt->error);
    }
}
?>
