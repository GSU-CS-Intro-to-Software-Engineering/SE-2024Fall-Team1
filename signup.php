<?php

class Signup
{
	
private $error = "";
	
public function evaluate($data)
{
	foreach($data as $key => $value) {
		# code....
		
		if(empty($value))
		{
			$error = $error . $key . "is empty!<br>";
		}
}

if ($error == "")
{
	$this->create_user($data)
	
}else
{
	return $error;
}

public function create_user($data) {
    // Extract user data
    $firstname = $data['first_name'];
    $lastname = $data['last_name'];
    $gender = $data['gender'];
    $email = $data['email'];
    $password = $data['password'];
    $url_address = create_url();
    $userid = create_userid();

    // SQL query with corrected syntax
    $query = "INSERT INTO users (userid, first_name, last_name, gender, email, password, url_address) 
              VALUES ('$userid', '$firstname', '$lastname', '$gender', '$email', '$password', '$url_address')";

    // Database operation
    $DB = new Database();
	$DB->save($query);
}
	private function create_url()
	{
		

}

	private function create_userid(){
		
		
}
}
}