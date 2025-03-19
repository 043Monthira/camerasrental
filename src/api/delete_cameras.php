<?php
// เชื่อมต่อฐานข้อมูล
require_once 'db.php';

if (isset($_GET['camera_id'])) {
    $camera_id = $_GET['camera_id'];

    // เตรียม SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM cameras WHERE camera_id = :camera_id";
    $stmt = $conn->prepare($sql);

    // Bind ข้อมูล
    $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);

    // ลบข้อมูล
    if ($stmt->execute()) {
        // ถ้าลบสำเร็จ ให้แสดงข้อความและเปลี่ยนเส้นทางไปยังหน้าแอดมิน
        echo "<script>
                alert('ลบข้อมูลสำเร็จ');
                window.location.href = '../admin.html'; // กลับไปที่หน้าแอดมิน
              </script>";
    } else {
        // ถ้ามีข้อผิดพลาดในการลบ
        echo "<script>
                alert('ไม่สามารถลบข้อมูลได้');
                window.location.href = '../admin.html'; // กลับไปที่หน้าแอดมิน
              </script>";
    }
} else {
    echo "<script>
            alert('ไม่พบข้อมูลกล้องที่ต้องการลบ');
            window.location.href = '../admin.html'; // กลับไปที่หน้าแอดมิน
          </script>";
}
?>
