<?php

class User extends DB {
    protected $id;
    protected $name;      
    protected $email;
    protected $password;
    protected $role;
    protected $phone;
    protected $createdAt;


    public function __construct($id = null, $name = null, $email = null, $password = null, $role = null,$phone=null,$createdAt=null) {
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
    
    public function login($email, $password){
        $pdo = $this->connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userRow=$stmt->fetch();

        if($userRow && password_verify($password,$userRow['password'])){
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

    public function updateProfile() {
        $pdo = $this->connect();
        $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$this->name, $this->phone, $this->id]);
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getRole() { return $this->role; }
    public function getPhone() { return $this->phone; }
    public function getCreatedAt() { return $this->createdAt; }
}