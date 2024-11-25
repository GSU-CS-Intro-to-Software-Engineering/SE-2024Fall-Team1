<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    print_r($_POST); 
    echo "</pre>";
} else {
    echo "<h3>No form data submitted.</h3>";
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
	
	#bar2{

	background-color: white; 
	width: 600px;
	height: 450px;
	margin:auto; 
	margin-top: 150px;
	padding:10px;
	padding-top:80px;
	text-align: center;
	font-weight: bold;

	}

	#text{
	
	height: 30px;
	width: 350px;	
	border-radius: 3px;	
	border:solid 1px #888;	
	padding: 4px;
	font-size: 14px;

	}

	#button{
	
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

    <div id = "bar2">

	Signup to SForum<br><br>	
	
	<form method="post" action="">
	
	<input  name="first_name"    type="text" id="text" placeholder = "First name"><br><br>
	
	<input  name="last_name"    type="text" id="text" placeholder = "Last name"><br><br>
	
	Gender:<br><br>
	<select id = "text" name="gender">
	
	<option>Male</option>
	<option>Female</option>
	
	</select>
	<br><br>

	<input type="text"  name = "email"      id="text" placeholder = "Email"><br><br>

	<input type="password" name = "password"    id="text" placeholder = "Password"><br><br>
	
	<input type="password"  name = "password2"   id="text" placeholder = "Retype Password"><br><br>

	
	<input type="submit" id="button" value = "Sign Up"><br><br>

	</form>

    </div>
</body>

</html>
