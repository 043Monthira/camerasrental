<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db.php'; // เชื่อมต่อฐานข้อมูล

header("Content-Type: application/json");

// รับค่าจากฟอร์ม
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username'], $data['password'], $data['first_name'], $data['last_name'], $data['email'], $data['phone_number'], $data['address'])) {
    $username = $data['username'];
    $password = $data['password']; // ❌ ไม่เข้ารหัส
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $phone_number = $data['phone_number'];
    $address = $data['address'];

    try {
        // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
        $stmt = $conn->prepare("SELECT * FROM customers WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => false, "message" => "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว"]);
            exit;
        }

        // เพิ่มข้อมูลเข้า Database
        $stmt = $conn->prepare("INSERT INTO customers (username, password, first_name, last_name, email, phone_number, address) 
                                VALUES (:username, :password, :first_name, :last_name, :email, :phone_number, :address)");
        $stmt->execute([
            'username' => $username,
            'password' => $password, // ❌ บันทึกแบบ plain text
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'address' => $address
        ]);

        echo json_encode(["status" => true, "message" => "สมัครสมาชิกสำเร็จ"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => false, "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => false, "message" => "ข้อมูลไม่ครบถ้วน"]);
}
?>
