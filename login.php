<?php
ob_start();
session_start();
require_once 'classes/connect.php'; // Adjust this path as needed

$email = '';
$password = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Sanitize input
    $email = trim($email);

    if (!empty($email) && !empty($password)) {
        $DB = new Database();

        // Query to fetch user by email
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $result = $DB->read($query, [$email]);

        if ($result) {
            $user = $result[0];
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['sforum_userid'] = $user['userid'];
                $_SESSION['username'] = $user['first_name']; // Optional, for profile display

                // Redirect to profile page
                header("Location: profile.php");
                exit;
            } else {
                $error_message = "Invalid login credentials.";
            }
        } else {
            $error_message = "Invalid login credentials.";
        }
    } else {
        $error_message = "Please fill in both fields.";
    }
}
?>

<html>
<head>
    <title>SForum | Log in</title>
    <style>
        #bar {
            height: 100px;
            background-color: rgb(60, 111, 100);
            color: #d9dfeb;
            padding: 4px;
        }

        #register_button {
            background-color: rgb(184, 134, 11);
            width: 60px;
            text-align: center;
            padding: 4px;
            border-radius: 4px;
            float: right;
            cursor: pointer;
        }

        #bar2 {
            background-color: white;
            max-width: 600px;
            height: auto;
            margin: auto;
            margin-top: 150px;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
        }

        #text {
            height: 30px;
            width: 350px;
            border-radius: 3px;
            border: solid 1px #888;
            padding: 4px;
            font-size: 14px;
        }

        #button {
            background-color: #4CAF50;
            width: 200px;
            height: 40px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body style="font-family: 'Times New Roman'; background-color: rgb(77, 111, 122);">
    <div id="bar">
        <div style="font-size: 50px;">SForum</div>
        <div id="register_button">Register</div>
    </div>

    <div id="bar2">
        <?php if (!empty($error_message)) : ?>
            <div style="color: red;"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="post">
            Log in to SForum<br><br>
            <input name="email" value="<?php echo htmlspecialchars($email); ?>" type="text" id="text" placeholder="Email"><br><br>
            <input name="password" type="password" id="text" placeholder="Password"><br><br>
            <input type="submit" id="button" value="Log in"><br><br>
        </form>
    </div>
</body>
</html>
