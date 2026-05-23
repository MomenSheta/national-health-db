<?php

class User extends DB
{
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $phone;
    protected $createdAt;

    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $phone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->phone = $phone;
    }

    public function register()
    {
        $pdo = $this->connect();
        $sql = "INSERT INTO users (name, email, password, role, phone) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $this->name,
            $this->email,
            $this->password,
            $this->role,
            $this->phone
        ]);
    }

    public function login()
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $userRow = $stmt->fetch();
        if ($userRow && password_verify($this->password, $userRow['password'])) {
            return $userRow;
        }

        return null;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: ../views/home.php");
        exit();
    }

    public function updateProfile()
    {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->phone, $this->id]);
    }

    protected function getAllUsers()
    {
        $pdo = $this->connect();
        $stmt = $pdo->query("SELECT id, name, email, role, phone, created_at FROM users");
        return $stmt->fetchAll();
    }
}
