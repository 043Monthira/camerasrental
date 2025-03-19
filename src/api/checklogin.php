<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// รวมไฟล์เชื่อมต่อฐานข้อมูลที่มีอยู่แล้ว
require_once 'db.php';

// รับข้อมูลจากการส่งแบบ JSON
$data = json_decode(file_get_contents("php://input"), true);

// ตรวจสอบว่าได้รับข้อมูล username และ password หรือไม่
if (isset($data['username']) && isset($data['password'])) {
    $username = $data['username'];
    $password = $data['password'];

    try {
        // สร้างคำสั่ง SQL เพื่อตรวจสอบการมีอยู่ของผู้ใช้
        $stmt = $conn->prepare("SELECT * FROM customers WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // ตรวจสอบผลลัพธ์จากการ query
        if ($stmt->rowCount() > 0) {
            // ถ้ามีผลลัพธ์ แสดงสถานะเข้าสู่ระบบสำเร็จ
            echo json_encode(['status' => true, 'message' => 'เข้าสู่ระบบสำเร็จ']);
        } else {
            // ถ้าไม่พบข้อมูล แสดงข้อความผิดพลาด
            echo json_encode(['status' => false, 'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']);
        }
    } catch(PDOException $e) {
        echo json_encode(['status' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => false, 'message' => 'ข้อมูลไม่ครบถ้วน']);
}
?>
