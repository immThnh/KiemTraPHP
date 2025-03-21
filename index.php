<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base_folder = '/demo/kiemtra';  // Thư mục gốc của ứng dụng
$uri = str_replace($base_folder, '', $_SERVER['REQUEST_URI']);
$uri_parts = array_values(array_filter(explode('/', trim($uri, '/'))));

// Xác định controller & method
$controller_name = !empty($uri_parts[0]) ? ucfirst($uri_parts[0]) . 'Controller' : 'StudentController';
$method = !empty($uri_parts[1]) ? $uri_parts[1] : 'index';

// Đường dẫn file controller
$controller_path = __DIR__ . "/controller/$controller_name.php";

// Kiểm tra controller có tồn tại không
if (file_exists($controller_path)) {
    require_once $controller_path;

    if (class_exists($controller_name)) {
        $controller = new $controller_name();
        
        if (method_exists($controller, $method)) {
            // Lấy các tham số nếu có
            $params = array_slice($uri_parts, 2);

            // Gọi phương thức với tham số tương ứng
            call_user_func_array([$controller, $method], $params);
        } else {
            echo "404 - Không tìm thấy phương thức '$method' trong '$controller_name'.";
        }
    } else {
        echo "404 - Không tìm thấy class '$controller_name'.";
    }
} else {
    echo "404 - Không tìm thấy file controller '$controller_path'.";
}
?>
