<?php
require_once "config/Database.php";

class User {
    private $conn;
    private $table = "users";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* -----------------------------
        ĐĂNG KÝ TÀI KHOẢN
    ------------------------------ */
    public function register($username,$email,$password,$fullname,$role=0) {
        $sql = "INSERT INTO $this->table (username,email,password,fullname,role)
                VALUES (:username,:email,:password,:fullname,:role)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password,PASSWORD_DEFAULT),
            ':fullname' => $fullname,
            ':role' => $role
        ]);
    }

    /* -----------------------------
        ĐĂNG NHẬP
    ------------------------------ */
    public function login($usernameOrEmail,$password) {
        $sql = "SELECT * FROM $this->table 
                WHERE username=:ue OR email=:ue LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':ue'=>$usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Bỏ kiểm tra active
        if($user && password_verify($password,$user['password'])) {
            return $user;
        }
        return false;
    }

    /* -----------------------------
        LẤY USER THEO ID
    ------------------------------ */
    public function getUserById($id) {
        $sql = "SELECT * FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* -----------------------------
        LẤY TẤT CẢ USER
    ------------------------------ */
    public function getAllUsers() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /* -----------------------------
        CẬP NHẬT THÔNG TIN USER
    ------------------------------ */
    public function updateUser($id,$fullname,$email) {
        $sql = "UPDATE $this->table 
                SET fullname=:fullname, email=:email
                WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':fullname'=>$fullname,
            ':email'=>$email,
            ':id'=>$id
        ]);
    }

    /* -----------------------------
        ĐỔI MẬT KHẨU
    ------------------------------ */
    public function changePassword($id,$oldPass,$newPass) {
        $user = $this->getUserById($id);

        if(!$user || !password_verify($oldPass,$user['password'])) return false;

        $sql = "UPDATE $this->table
                SET password=:newPass
                WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':newPass'=>password_hash($newPass,PASSWORD_DEFAULT),
            ':id'=>$id
        ]);
    }

    /* -----------------------------
        PHÂN QUYỀN USER
    ------------------------------ */
    public function updateRole($id,$role) {
        $sql = "UPDATE $this->table SET role=:role WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':role'=>$role, ':id'=>$id]);
    }

    /* -----------------------------
        (ĐÃ XOÁ – KHÔNG CẦN ACTIVE)
    ------------------------------ */

    // public function toggleActive($id) {}

    /* -----------------------------
        XÓA USER
    ------------------------------ */
    public function deleteUser($id) {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id'=>$id]);
    }
}
