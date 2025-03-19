<?php
// เชื่อมต่อฐานข้อมูล
$host = "localhost";
$dbname = "camera_rental";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // ดึงข้อมูลจากตาราง cameras
    $stmt = $pdo->prepare("SELECT * FROM cameras");
    $stmt->execute();
    
    $cameras = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // ส่งข้อมูลกลับเป็น JSON
    echo json_encode($cameras);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
