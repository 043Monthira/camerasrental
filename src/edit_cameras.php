<?php
require_once 'api/db.php';

if (isset($_GET['camera_id'])) {
    $camera_id = $_GET['camera_id'];

    try {
        // ดึงข้อมูลของกล้องจากฐานข้อมูล
        $sql = "SELECT * FROM cameras WHERE camera_id = :camera_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
        $stmt->execute();
        $camera = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$camera) {
            die("ไม่พบข้อมูลกล้อง");
        }
    } catch (PDOException $e) {
        die("เกิดข้อผิดพลาด: " . $e->getMessage());
    }
} else {
    die("ไม่ได้รับค่า camera_id");
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลกล้อง</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=rocket_launch" />
</head>
<body class=" flex justify-center items-center min-h-screen bg-cover bg-center font-mono"
    style="background-image: url('https://i.pinimg.com/736x/56/08/6d/56086dd729faf9f3ddd62f07f8887dab.jpg');">
    <div class="bg-gray-300 bg-opacity-90 rounded-lg shadow-md border border-gray-300 w-[400px] p-6">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-950">Update Product</h2>
        
        <form action="/camera_store/src/api/update_cameras.php" method="POST">
            <input type="hidden" name="camera_id" value="<?php echo $camera['camera_id']; ?>">

            <div>
                <label for="brand" class="block text-sm font-medium  mt-5">Brand</label>
                <input type="text" name="brand" value="<?php echo htmlspecialchars($camera['brand']); ?>" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
            </div>

            <div>
                <label for="model" class="block text-sm font-medium text-gray-700 mt-5">Model</label>
                <input type="text" name="model" value="<?php echo htmlspecialchars($camera['model']); ?>" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mt-5">Description</label>
                <textarea name="description" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly><?php echo htmlspecialchars($camera['description']); ?></textarea>
            </div>

            <!-- ทำให้สามารถแก้ไขได้ในฟิลด์นี้ -->
            <div>
                <label for="price_per_day" class="block text-sm font-medium text-gray-700 mt-5">Price per day</label>
                <input type="number" name="price_per_day" value="<?php echo $camera['price_per_day']; ?>" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- ทำให้สามารถแก้ไขได้ในฟิลด์นี้ -->
            <div>
                <label for="availability_status" class="block text-sm font-medium text-gray-700 mt-5">Availability</label>
                <input type="text" name="availability_status" value="<?php echo $camera['availability_status']; ?>" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-center">
                <button type="submit" class="w-full bg-green-500 text-white py-2 mt-5 px-4 rounded-lg hover:bg-green-600 transition-all">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
