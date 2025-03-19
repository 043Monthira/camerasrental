<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
require_once('db.php');


try {
    // ดึงข้อมูลกล้องทั้งหมดจากฐานข้อมูล
    $stmt = $conn->query("SELECT * FROM cameras");

    // สร้างอาร์เรย์เพื่อเก็บข้อมูลกล้อง
    $cameras = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cameras[] = $row;
    }

    // แสดงข้อมูลกล้องในรูปแบบ JSON
    echo json_encode($cameras, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    // หากเกิดข้อผิดพลาดในการดึงข้อมูล
    die(json_encode(array("error" => "ไม่สามารถดึงข้อมูลได้: " . $e->getMessage())));
}
?>
