<?php
// Start the session
session_start();

// Include the database connection
$file_path = __DIR__ . '/classes/connect.php';
if (!file_exists($file_path)) {
    die("File not found: " . $file_path);
}
require_once $file_path;

// Check if the user is logged in
if (!isset($_SESSION['sforum_userid'])) {
    header("Location: login.php");
    exit;
}

// Fetch user information from the database
$userid = $_SESSION['sforum_userid'];
$DB = new Database();
$query = "SELECT * FROM users WHERE userid = ? LIMIT 1";
$user_data = $DB->read($query, [$userid]);

if ($user_data) {
    $user_data = $user_data[0]; // Get user details
} else {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page | SForum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        #blue_bar {
            background-color: #005f99;
            color: white;
            height: 50px;
            padding: 10px;
        }
        #blue_bar input {
            float: right;
            width: 200px;
            border: none;
            padding: 5px;
            border-radius: 5px;
        }
        #profile_container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        #profile_pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto;
            background-color: #ccc;
            overflow: hidden;
        }
        #profile_pic img {
            width: 100%;
            height: auto;
        }
        #profile_info {
            text-align: center;
            margin-top: 20px;
        }
        #profile_info h2 {
            margin: 10px 0;
            font-size: 24px;
            color: #333;
        }
        #profile_info p {
            margin: 5px 0;
            color: #666;
        }
        #menu {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            padding: 0;
            list-style: none;
        }
        #menu li {
            margin: 0 15px;
        }
        #menu li a {
            text-decoration: none;
            color: #005f99;
            padding: 10px 15px;
            border-radius: 5px;
            background-color: #f3f4f6;
            transition: background-color 0.3s;
        }
        #menu li a:hover {
            background-color: #005f99;
            color: white;
        }
        #upload_form_container {
            text-align: center;
            margin-top: 20px;
        }
        #upload_form_container label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }
        #upload_form_container input[type="file"] {
            margin-bottom: 15px;
            font-size: 14px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 70%;
            max-width: 400px;
        }
        #upload_form_container button {
            background-color: #005f99;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #upload_form_container button:hover {
            background-color: #004080;
        }
        #post_form_container textarea {
            width: 100%;
            max-width: 700px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-bottom: 10px;
        }
        #post_form_container button {
            background-color: #005f99;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #post_form_container button:hover {
            background-color: #004080;
        }
        .post {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post p {
            font-size: 16px;
            margin: 0 0 10px;
        }
        .post small {
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div id="blue_bar">
        <div style="width: 800px; margin: auto;">
            SForum
            <input type="text" id="search_box" placeholder="Search...">
        </div>
    </div>

    <!-- Profile Container -->
    <div id="profile_container">
        <!-- Profile Picture -->
        <div id="profile_pic">
            <img src="<?php echo !empty($user_data['profile_pic']) ? $user_data['profile_pic'] : 'defaultpic.jpg'; ?>" alt="">
        </div>

        <!-- Profile Information -->
        <div id="profile_info">
            <h2><?php echo htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name']); ?></h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
        </div>

        <!-- Profile Picture Upload Form -->
        <div id="upload_form_container">
            <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
                <label for="profile_pic">Change Profile Picture:</label>
                <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required>
                <button type="submit">Upload</button>
            </form>
        </div>

        <!-- Post Submission Form -->
        <div id="post_form_container">
            <form action="create_post.php" method="POST">
                <textarea name="post_content" rows="4" placeholder="What's on your mind?" required></textarea><br>
                <button type="submit">Post</button>
            </form>
        </div>

<!-- User Posts -->
<div id="user_posts">
    <h3>Your Posts</h3>
    <?php
    $posts_query = "SELECT * FROM posts WHERE userid = ? ORDER BY date DESC";
    $user_posts = $DB->read($posts_query, [$userid]);

    if (!empty($user_posts)) {
        foreach ($user_posts as $post) {
            echo "<div class='post'>";
            echo "<p>" . htmlspecialchars($post['post']) . "</p>"; // Access the `post` column
            echo "<small>Posted on: " . date("F j, Y, g:i a", strtotime($post['date'])) . "</small>"; // Access the `date` column
            echo "</div>";
        }
    } else {
        echo "<p>No posts to display.</p>";
    }
    ?>
</div>


        <!-- Navigation Menu -->
        <ul id="menu">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
