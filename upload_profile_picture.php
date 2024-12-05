<?php
session_start();
require_once 'classes/connect.php'; // Adjust this path as needed

// Check if user is logged in
if (!isset($_SESSION['sforum_userid'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['sforum_userid'];

    // Check if a file was uploaded
    if (!empty($_FILES['profile_pic']['name'])) {
        $file = $_FILES['profile_pic'];

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowed_types)) {
            die("Invalid file type. Please upload a valid image file.");
        }

        // Validate file size (max 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            die("File size exceeds the 5MB limit.");
        }

        // Generate a unique file name
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_file_name = "uploads/profile_" . uniqid() . "." . $file_extension;

        // Create the uploads directory if it doesn't exist
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        // Move the uploaded file to the server
        if (move_uploaded_file($file['tmp_name'], $new_file_name)) {
            // Update the database with the new file path
            $conn = (new Database())->connect();
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE userid = ?");
            $stmt->bind_param("ss", $new_file_name, $userid);

            if ($stmt->execute()) {
                header("Location: profile.php");
                exit;
            } else {
                die("Database error: " . $stmt->error);
            }
        } else {
            die("Failed to upload the file.");
        }
    } else {
        die("No file was uploaded.");
    }
}
?>
