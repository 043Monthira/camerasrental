<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camera_rental";  // ชื่อฐานข้อมูลที่ใช้

try {
    // เชื่อมต่อกับฐานข้อมูลโดยใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    // ตั้งค่าการจัดการข้อผิดพลาด
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // หากเกิดข้อผิดพลาดในการเชื่อมต่อ
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
}
?>
