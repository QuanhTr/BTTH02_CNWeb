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
        ĐĂNG KÝ
    ------------------------------ */
   public function register($username, $email, $password, $fullname, $role = 0)
{
    $sql = "INSERT INTO $this->table 
            (username, email, password, fullname, role, created_at)
            VALUES (:username, :email, :password, :fullname, :role, :created_at)";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':username'   => $username,
        ':email'      => $email,
        ':password'   => password_hash($password, PASSWORD_DEFAULT),
        ':fullname'   => $fullname,
        ':role'       => $role,
        ':created_at' => date('Y-m-d H:i:s')
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

        if (!$user) return false;

        if (password_verify($password,$user['password'])) {
            return $user;
        }
        return false;
    }

    /* -----------------------------
        LẤY 1 USER
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
        CẬP NHẬT USER
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
        CẬP NHẬT ROLE
    ------------------------------ */
    public function updateRole($id,$role) {
        $sql = "UPDATE $this->table SET role=:role WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':role'=>$role, ':id'=>$id]);
    }

    /* -----------------------------
        BẬT / TẮT USER
    ------------------------------ */
    public function toggleActive($id) {
        $user = $this->getUserById($id);
        if (!$user) return false;

        $newActive = $user['active'] ? 0 : 1;

        $sql = "UPDATE $this->table SET active=:active WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':active' => $newActive,
            ':id' => $id
        ]);
    }

    /* -----------------------------
        THỐNG KÊ — STATIC
    ------------------------------ */

    public function countAllUsers() {
    $sql = "SELECT COUNT(*) AS total FROM users";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function countActiveUsers() {
    $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

public function countInactiveUsers() {
    $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 0";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
}

    /* -----------------------------
        XÓA USER
    ------------------------------ */
    public function deleteUser($id) {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id'=>$id]);
    }

}
