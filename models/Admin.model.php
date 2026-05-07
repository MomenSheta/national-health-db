<?php

require_once "User.model.php";

class Admin extends User {

public function __construct($id = null, $name = null, $email = null, $password = null, $role = null,$createdAt=null){
    parent::__construct($id,$name,$email,$password,$role,$createdAt);
}


public function getUsers() {
        return $this->getAllUsers(); 
    }

public function deleteUser($targetUserId){
    $pdo = $this->connect();
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$targetUserId]);
} 

public function addDoctor($name,$email,$password,$phone){
    $newDoctor=new User(null,$name,$email,$password,'doctor',$phone);
    return $newDoctor->register();

}

public function addPatient($name,$email,$password,$phone){
    $newPatient=new User(null,$name,$email,$password,'patient',$phone);
    return $newPatient->register();


}
}