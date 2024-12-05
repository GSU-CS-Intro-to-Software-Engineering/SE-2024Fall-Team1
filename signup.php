<?php

class Signup
{
    private $error = [];

    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error[] = "$key is empty!";
            }
        }

        // Validate email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error[] = "Invalid email format!";
        }

        // Validate password
        if (strlen($data['password']) < 8) {
            $this->error[] = "Password must be at least 8 characters!";
        }

        if (empty($this->error)) {
            return $this->create_user($data);
        } else {
            return implode("<br>", $this->error);
        }
    }

    private function create_user($data)
    {
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = uniqid("user_", true);

        $conn = (new Database())->connect(); // Assuming a Database class for connection
        $stmt = $conn->prepare("INSERT INTO users (userid, first_name, last_name, gender, email, password, url_address) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $userid, $first_name, $last_name, $gender, $email, $password, $url_address);

        if ($stmt->execute()) {
            return true; // Success
        } else {
            return "Database error: " . $stmt->error;
        }
    }
}
