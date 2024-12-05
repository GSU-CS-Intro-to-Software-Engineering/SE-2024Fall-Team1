<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "mywebsite_db";
    private $connection;

    public function connect()
    {
        if (!$this->connection || !$this->connection->ping()) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db);

            if ($this->connection->connect_error) {
                die("Database connection failed: " . $this->connection->connect_error);
            }
        }
        return $this->connection;
    }

    private function getParamTypes($params)
    {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 'b'; // Binary data
            }
        }
        return $types;
    }

    public function read($query, $params = [])
    {
        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if (!$stmt) {
            error_log("Failed to prepare query: " . $conn->error);
            return false;
        }

        if (!empty($params)) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        } elseif (strpos($query, '?') !== false) {
            error_log("Query requires parameters but none were provided.");
            return false;
        }

        if (!$stmt->execute()) {
            error_log("Query execution failed: " . $stmt->error);
            return false;
        }

        $result = $stmt->get_result();

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            error_log("Failed to fetch result: " . $stmt->error);
            return false;
        }
    }
}
?>
