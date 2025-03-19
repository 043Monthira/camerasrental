<?php
include 'db.php'; // ตรวจสอบว่าเชื่อมต่อฐานข้อมูลได้หรือไม่

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $camera_id = $_POST['camera_id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $price_per_day = $_POST['price_per_day'];
    $availability_status = $_POST['availability_status'];

    // ตรวจสอบว่า camera_id มีค่าหรือไม่
    if (!empty($camera_id)) {
        $stmt = $conn->prepare("UPDATE cameras SET brand=?, model=?, description=?, price_per_day=?, availability_status=? WHERE camera_id=?");
        $stmt->execute([$brand, $model, $description, $price_per_day, $availability_status, $camera_id]);

        if ($stmt) {
            echo "Updated successfully";
        } else {
            echo "Failed to update";
        }
    } else {
        echo "Invalid camera_id";
    }
}
// หลังจากที่ทำการอัปเดตข้อมูลแล้ว
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Updated successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Unable to update the camera"]);
}

    // เพิ่มการ redirect ไปยังหน้า admin เมื่ออัปเดตสำเร็จ
    echo "<script>
        alert('ข้อมูลอัปเดตสำเร็จ');
        window.location.href = '../admin.html'; // ไปยังหน้าแอดมิน
      </script>";
?>

