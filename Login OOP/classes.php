<?php

class User
{
    private $db;
    public $loggedInUser;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        session_start();

        // Check if user is logged in
        if ($this->isLoggedIn()) {
            $this->loggedInUser = $this->getUserById($_SESSION['user']);
        }
    }

    public function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            return false; // Invalid username or password
        }

        // If login successful, store user ID in session
        $_SESSION['user'] = $user['id'];
        $this->loggedInUser = $user;
        return true;
    }

    public function isLoggedIn()
    {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];
        $query = "SELECT COUNT(*) FROM users WHERE id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    return false;
    }


    public function getUserById($userId)
    {
        $query = "SELECT * FROM users WHERE id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLoggedInUser()
    {
        return $this->loggedInUser;
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->loggedInUser = null;
    }
}
