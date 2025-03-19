<?php
$host = "localhost";
$dbname = "camera_rental"; // ตรวจสอบให้ตรงกับชื่อฐานข้อมูลจริง
$username = "root"; // ถ้าใช้ XAMPP/MAMP/WAMP ให้ใช้ "root"
$password = ""; // ถ้าใช้ XAMPP ปกติรหัสผ่านจะว่างเปล่า

try {
    $pdo = new PDO("mysql:host=localhost;dbname=camera_rental;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_GET['brand'])) {
        die("ไม่พบแบรนด์ที่เลือก");
    }

    $brand_name = $_GET['brand'];

    // ใช้ LOWER() เพื่อไม่ให้เกิดปัญหากรณีตัวพิมพ์ใหญ่เล็กไม่ตรงกัน
    $stmt = $pdo->prepare("SELECT * FROM cameras WHERE LOWER(brand) = LOWER(:brand_name)");
    $stmt->execute(['brand_name' => $brand_name]);
    $cameras = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$cameras) {
        die("ไม่พบรุ่นของแบรนด์ที่เลือก");
    }
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รุ่นของแบรนด์: <?php echo htmlspecialchars($brand_name); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=rocket_launch" />
</head>
<body class="bg-gray-200 font-mono ">
<header class="bg-white shadow-md py-4 px-6 flex flex-wrap justify-between items-center">
    <div class="text-3xl font-bold text-gray-700 flex items-center">
        <span class="material-icons text-3xl mr-2 text-gray-600">monochrome_photos</span>
       
        <a href="index.html" class="hover:text-gray-600">COM ON</a>
    </div>
    <div class="flex items-center space-x-4">
        <div class="relative">
            <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
            <input type="text" placeholder="ค้นหาข้อมูล..." 
                   class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 w-60">
        </div>
        <nav class="hidden md:flex space-x-6 text-gray-600">
            <a href="howto.html" class="hover:text-black">วิธีเช่า</a>
            <a href="contact.html" class="hover:text-black">ติดต่อเรา</a>
        </nav>
        <div class="flex items-center space-x-4">
            <a href="#" class="relative">
                <span class="material-icons text-3xl text-gray-600 hover:text-black">shopping_cart</span>
            </a>
            <a href="login.html" class="flex items-center space-x-2 hover:text-black">
                <span class="material-icons text-3xl text-gray-600">account_circle</span>
            </a>
        </div>
    </div>
</header>


<h1 class="text-3xl font-mono text-gray-600 text-center mt-8 drop-shadow-lg">
    ให้เช่ากล้อง: <?php echo htmlspecialchars($brand_name);?> อุปกรณ์ถ่ายภาพ 
</h1>
<h2 class="text-2xl  text-gray-400 text-center my-2">เช่ากล้องถ่ายรูป Mirrorless เลนส์ และอุปกรณ์ถ่ายรูปโซนี่</h2>

<?php if ($cameras): ?>
    <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-6 my-8 ">
        <?php foreach ($cameras as $camera): ?>
            <li class="bg-white rounded-lg shadow-md p-4 text-center ">
                <?php 
                // ตรวจสอบการแสดงภาพจากโฟลเดอร์ display/
                $imagePath = isset($camera['image']) && !empty($camera['image']) ? "display/" . htmlspecialchars($camera['image']) : "src/display/default.jpg";
                ?>
                <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($camera['model']); ?>" class="w-30 h-60 flex justify-center items-center ml-10">

                <h2 class="text-xl font-semibold text-gray-900"><?php echo htmlspecialchars($camera['model']); ?></h2>
                <p class="text-gray-700 ">ราคา: <?php echo number_format($camera['price_per_day'], 2); ?> บาท/วัน</p>

                <!-- ปุ่ม ดูรายละเอียด -->
                <a href="product.php?id=<?php echo $camera['camera_id']; ?>" class="mt-4 inline-block bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                    ดูรายละเอียด
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-center text-red-600">ไม่พบรุ่นของแบรนด์นี้</p>
<?php endif; ?>
<footer class="bg-gray-800 text-white py-10  font-mono">
    <div class="container mx-auto px-6 flex justify-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-center md:text-left">

            

            <!-- CONTACT -->
            <div>
                
                <ul class="space-y-3 text-sm">
                    <li> Call : 082-343-8793</li>
                    <li> ID Line : camon8793</li>
                    
                    
                    
                </ul>
            </div>

            <div>
                
                <ul class="space-y-3 text-sm">
                    
                    
                    <li> สาขาอำเภอเมืองสุราษฎร์ธานี</li>
                    <li> เปิดทุกวัน 10.00-20.00</li>
                    
                    
                </ul>
            </div>

           
        </div>
    </div>
</footer>

</body>
</html>
