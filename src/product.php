<?php
// เชื่อมต่อฐานข้อมูล
include 'api/db.php';

// ตรวจสอบว่าได้รับ 'id' หรือไม่
if (isset($_GET['id'])) {
    $camera_id = $_GET['id'];  // รับค่า 'id' จาก URL
} else {
    echo "ไม่พบข้อมูลกล้อง";
    exit;
}

// ดึงข้อมูลจากฐานข้อมูลตาม camera_id
$stmt = $conn->prepare("SELECT * FROM cameras WHERE camera_id = :camera_id");
$stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
$stmt->execute();

// ดึงข้อมูลของกล้อง
$camera = $stmt->fetch();

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($camera) {
    // แสดงข้อมูลกล้องที่ได้รับ
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดกล้อง <?php echo htmlspecialchars($camera['model']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
     <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=rocket_launch" />
</head>
<body class="bg-gray-200 font-mono ">
<!-- Header -->
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


    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6 flex my-10">
        <!-- Product Image -->
        <div class="w-1/2 bg-gray-300 flex items-center justify-center rounded-lg">
        <img src="display/<?php echo htmlspecialchars($camera['image']); ?>" alt="<?php echo htmlspecialchars($camera['model']); ?>" class="w-full h-auto object-cover rounded">



        </div>
        
        <!-- Product Details -->
        <div class="w-1/2 pl-6 ">
            <h2 class="text-2xl font-bold text-gray-900"><?php echo htmlspecialchars($camera['model']); ?></h2>
            <p class="text-lg font-semibold text-gray-800 mt-2">ราคา: <span class="text-gray-600"><?php echo number_format($camera['price_per_day'], 2); ?> บาท/วัน</span></p>
            <p class="text-lg font-semibold text-gray-800">สถานะ: <span class="text-green-600"><?php echo $camera['availability_status'] == 'available' ? 'พร้อมให้เช่า' : 'ไม่พร้อมให้เช่า'; ?></span></p>
            <p class="mt-4 font-semibold text-gray-800">รายละเอียด:</p>
            <p class="text-gray-600"><?php echo htmlspecialchars($camera['description']); ?></p>
            
            <div class="mt-6 flex gap-4">
                <button class="bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600">Add to Cart</button>
                <button class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-400">Rent now</button>
            </div>
        </div>
    </div>
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

<?php
} else {
    echo "ไม่พบข้อมูลกล้องที่คุณเลือก";
}
?>
