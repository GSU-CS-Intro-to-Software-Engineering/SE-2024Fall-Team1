<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline | SForum</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(77, 111, 122);
        }

        /* Top Bar Styling */
        #blue_bar {
            height: 50px;
            background-color: rgb(60, 111, 100);
            color: #d9dfeb;
            padding: 10px;
            font-size: 24px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        #search_box {
            width: 300px;
            height: 25px;
            border-radius: 5px;
            border: none;
            padding: 5px;
            font-size: 14px;
        }

        /* Timeline Container */
        #timeline_container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        /* Post Input Area */
        #post_input {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }

        #post_button {
            margin-top: 10px;
            background-color: rgb(60, 111, 100);
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #post_button:hover {
            background-color: rgb(77, 111, 122);
        }

        /* Individual Posts */
        .post {
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post p {
            margin: 0;
            font-size: 16px;
        }

        .post .author {
            font-weight: bold;
            color: #333;
        }

        .post .timestamp {
            font-size: 12px;
            color: gray;
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div id="blue_bar">
        <div style="width: 800px; margin: auto;">
            SForum &nbsp;&nbsp;
            <input type="text" id="search_box" placeholder="Search for friends">
        </div>
    </div>

    <!-- Timeline Container -->
    <div id="timeline_container">
        <!-- Post Input -->
        <form method="POST" action="timeline.php">
            <textarea id="post_input" name="new_post" placeholder="What's on your mind?"></textarea>
            <button id="post_button" type="submit">Post</button>
        </form>

        <hr>

        <!-- Display Posts -->
        <?php
        // Mock database of posts
        $posts = [
            [
                "author" => "John Doe",
                "content" => "Hello, world! This is my first post on SForum.",
                "timestamp" => "2024-11-22 10:00 AM"
            ],
            [
                "author" => "Jane Smith",
                "content" => "Just had the best coffee ever!",
                "timestamp" => "2024-11-22 11:30 AM"
            ]
        ];

        // Add a new post if submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['new_post'])) {
            $new_post = [
                "author" => "You",
                "content" => htmlspecialchars($_POST['new_post']),
                "timestamp" => date("Y-m-d H:i A")
            ];
            array_unshift($posts, $new_post); // Add new post to the top of the timeline
        }

        // Display each post
        foreach ($posts as $post) {
            echo '<div class="post">';
            echo '<p class="author">' . htmlspecialchars($post['author']) . '</p>';
            echo '<p>' . htmlspecialchars($post['content']) . '</p>';
            echo '<p class="timestamp">' . htmlspecialchars($post['timestamp']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>
