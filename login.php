<?php

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        // Sanitize input
        $email = addslashes($data['email']);
        $password = $data['password'];

        // Query to check the email
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";

        $DB = new Database();
        $result = $DB->read($query, [$email]); // Use parameterized query

        if ($result) {
            $row = $result[0];

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Set session variable for the user ID
                $_SESSION['sforum_userid'] = $row['userid'];

                // Redirect to profile page
                header("Location: profile.php");
                exit; // Ensure no further script execution
            } else {
                $this->error .= "Wrong password<br>";
            }
        } else {
            $this->error .= "No email found<br>";
        }

        return $this->error;
    }
}
?>
