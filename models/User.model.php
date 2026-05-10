<?php

class User extends DB {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $phone;
    protected $createdAt;

    // todo: remove createAt property from the constructor (it will be added by the DB)
    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null, $phone = null, $createdAt = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->phone = $phone;
        $this->createdAt = $createdAt;
    }

    public function register() {
        $pdo = $this->connect();
        $sql = "INSERT INTO users (name, email, password, role,phone) VALUES (?, ?, ?, ?,?)";
        $stmt = $pdo->prepare($sql);

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $stmt->execute([
            $this->name,
            $this->email,
            $hashedPassword,
            $this->role,
            $this->phone
        ]);
    }

    public function login() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$this->email]);
        $userRow = $stmt->fetch();
        // todo: just return the $userRow because it will be used in the view...
        // todo: don't set the Model properties (security issue)
        if ($userRow && password_verify($this->password, $userRow['password'])) {
            $this->id = $userRow['id'];
            $this->name = $userRow['name'];
            $this->email = $userRow['email'];
            $this->role = $userRow['role'];
            $this->phone = $userRow['phone'];
            $this->createdAt = $userRow['created_at'];
            return $this;
        }

        return null;
    }

    // todo: add logout() method...


    public function updateProfile() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->phone, $this->id]);
    }

    protected function getAllUsers() {
        $pdo = $this->connect();
        $stmt = $pdo->query("SELECT id, name, email, role, phone, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        // todo: FETCH_ASSOC is set as default fetch at @db.model.php
    }
}
