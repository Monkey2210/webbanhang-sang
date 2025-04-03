<?php
class AccountModel
{
    private $conn;
    private $table_name = "account";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // lấy thông tin tài khoản username
    public function getAccountByUsername($username)
    {
        $query = "SELECT username, password, COALESCE(role, 'user') AS role FROM account WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    //lấy tài khoản mới vào database
    function save($username, $name, $password, $role = "user")
    {
        $query = "INSERT INTO " . $this->table_name . "(username, password, role) VALUES (:username,:password, :role)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //kiểm tra username có tồn tài không (dùng cho reset password)
    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM account WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }



    //cập nhật mật khẩu mới
    public function updatePassword($username, $newpassword)
    {
        $sql = "UPDATE account SET password = ? WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$newpassword, $username]);
    }
}
