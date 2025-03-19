<?php
// เปิดการแสดงข้อผิดพลาด
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['brand'], $_POST['model'], $_POST['description'], $_POST['price_per_day'], $_POST['availability_status'], $_FILES['image'])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $description = $_POST['description'];
        $price_per_day = $_POST['price_per_day'];
        $availability_status = $_POST['availability_status'];

        // ตรวจสอบการอัปโหลดไฟล์
        if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            $new_filename = time() . "_" . uniqid() . "." . $extension; // ป้องกันชื่อซ้ำกัน
            $target_dir = "../../display/"; // เปลี่ยนจาก uploads เป็น display
            $target_file = $target_dir . $new_filename;

            // ตรวจสอบว่าโฟลเดอร์ display มีอยู่หรือไม่ ถ้าไม่มีให้สร้างใหม่
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // ย้ายไฟล์ไปยังโฟลเดอร์ที่ต้องการ
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // บันทึกข้อมูลลงฐานข้อมูล
                $sql = "INSERT INTO cameras (brand, model, description, price_per_day, availability_status, image)
                        VALUES (:brand, :model, :description, :price_per_day, :availability_status, :image)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':brand', $brand);
                $stmt->bindParam(':model', $model);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price_per_day', $price_per_day);
                $stmt->bindParam(':availability_status', $availability_status);
                $stmt->bindParam(':image', $target_file);

                if ($stmt->execute()) {
                    echo json_encode(["status" => "success", "message" => "เพิ่มข้อมูลกล้องสำเร็จ!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการเพิ่มข้อมูล"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "ไม่สามารถอัปโหลดไฟล์ได้"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "มีข้อผิดพลาดในการอัปโหลดไฟล์"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ข้อมูลไม่ครบ"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ไม่ใช่การร้องขอแบบ POST"]);
}
?>
