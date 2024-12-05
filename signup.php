<?php

include("classes/connect.php");
include("classes/signup.php");

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signup = new Signup();
    $result = $signup->evaluate($_POST);

    if ($result === true) {
        header("Location: login.php");
        die;
    } else {
        echo "<div style='text-align:center;font-size:15px;color:white;background-color:grey;'>";
        echo "<br>Error occurred:<br><br>";
        echo $result;
        echo "</div>";
    }

    $first_name = isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : "";
    $last_name = isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : "";
    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
}
?>

<html>
<head>
    <title>SForum | Signup</title>
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
        }

        #bar2 {
            background-color: white;
            width: 600px;
            height: 450px;
            margin: auto;
            margin-top: 150px;
            padding: 10px;
            padding-top: 80px;
            text-align: center;
            font-weight: bold;
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
        }
    </style>
</head>
<body style="font-family: 'Times New Roman';  background-color: rgb(77, 111, 122);">
    <div id="bar">
        <div style="font-size: 50px;">SForum</div>
        <div id="register_button">Signup</div>
    </div>

    <div id="bar2">
        Signup to SForum<br><br>

        <form method="post" action="">
            <input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"><br><br>
            <input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>
            
            <label for="gender">Gender:</label><br><br>
            <select id="text" name="gender">
                <option value="" disabled <?php echo empty($gender) ? 'selected' : ''; ?>>Select your gender</option>
                <option <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                <option <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
            <br><br>

            <input value="<?php echo $email ?>" type="text" name="email" id="text" placeholder="Email"><br><br>
            <input type="password" name="password" id="text" placeholder="Password"><br><br>
            <input type="password" name="password2" id="text" placeholder="Retype Password"><br><br>
            <input type="submit" id="button" value="Sign Up"><br><br>
        </form>
    </div>
</body>
</html>
