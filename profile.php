<html>
<head>
    <title>Profile Page | SForum</title>
    <style type="text/css">
        /* Top Bar Styling */
        #blue_bar {
            height: 50px;
            background-color: rgb(60, 111, 100);
            color: #d9dfeb;
            padding: 10px;
            font-size: 24px;
            text-align: center;
        }

        #search_box {
            width: 400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 20px;
        }

        /* Profile Container Styling */
        #profile_container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: grey;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        #profile_pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #ddd;
            margin: 20px auto;
        }

        /* Navigation Menu Styling */
        #menu {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 30px;
            list-style-type: none;
            padding: 0;
        }

        #menu li {
            font-family: Arial, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        #menu li a {
            text-decoration: none;
            color: #d9dfeb;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: rgb(60, 111, 100);
            transition: background-color 0.3s ease;
        }

        #menu li a:hover {
            background-color: rgb(77, 111, 122);
        }

        /* Responsive Image */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Post Area Styling */
        #post_area {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: left;
            font-family: Arial, sans-serif;
        }

        #post_input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            resize: none;
        }

        #post_button {
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
    </style>
</head>
<body style="font-family: tahoma; background-color: rgb(77, 111, 122);">

    <!-- Top Bar -->
    <div id="blue_bar">
        <div style="width: 800px; margin: auto; font-size: 30px;">
            SForum &nbsp;&nbsp;
            <input type="text" id="search_box" placeholder="Search for friends">
            <img src="profilepic.jpg" style="width: 80px; float: right;">
        </div>
    </div>

    <!-- Profile Container -->
    <div id="profile_container">
        <!-- Profile Picture -->
        <div id="profile_pic">
            <img src="profilepic.jpg" alt="Profile Picture" style="border-radius: 50%; width: 100%;">
        </div>

        <!-- Profile Info -->
        <div id="profile_info">
            <h2>User Name</h2>
            <p>Bio: Enthusiast of tech, design, and social media.</p>
        </div>

        <!-- Navigation Menu -->
        <ul id="menu">
            <li><a href="#photos">Photos</a></li>
            <li><a href="#settings">Settings</a></li>
        </ul>
    </div>

    <!-- Post Area -->
    <div id="post_area">
        <textarea id="post_input" rows="4" placeholder="What's on your mind?"></textarea>
        <button id="post_button">Post</button>

    </div>
</body>
</html>
