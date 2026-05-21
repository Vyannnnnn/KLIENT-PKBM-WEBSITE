<?php
// Simple Autoloader
spl_autoload_register(function ($class) {
    // Konversi namespace ke path
    // App\Controllers\Home -> app/Controllers/Home.php
    $prefix = 'App\\';
    if (strpos($class, $prefix) !== 0) {
        return;
    }
    
    $relative_class = substr($class, strlen($prefix));
    $file = __DIR__ . '/../app/' . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

// Routing sederhana untuk aplikasi
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/pkbm-website/public';
$path = str_replace($base_path, '', $request_uri);
$path = strtok($path, '?');
$path = trim($path, '/');

// Default route
if (empty($path)) {
    $path = 'home';
}

// Simple Router dengan support hyphen ke camelCase
$parts = explode('/', $path);
$controller_name = !empty($parts[0]) ? $parts[0] : 'home';
$action = !empty($parts[1]) ? $parts[1] : 'index';
$id = !empty($parts[2]) ? $parts[2] : null;

// Convert hyphenated names to CamelCase
// Contoh: admin-news menjadi AdminNews
$controller = str_replace('-', '', ucwords($controller_name, '-'));
$controller = str_replace('_', '', ucwords($controller, '_'));

$controller_path = __DIR__ . '/../app/Controllers/' . $controller . '.php';

if (file_exists($controller_path) && $controller !== 'Index') {
    require_once $controller_path;
    $controller_class = "App\\Controllers\\" . $controller;
    if (class_exists($controller_class)) {
        $obj = new $controller_class();
        if (method_exists($obj, $action)) {
            if ($id) {
                $obj->$action($id);
            } else {
                $obj->$action();
            }
        } else {
            http_response_code(404);
            echo "Method tidak ditemukan: $action";
        }
    } else {
        http_response_code(404);
        echo "Controller tidak ditemukan: $controller";
    }
} else {
    http_response_code(404);
    echo "Controller tidak ditemukan: $controller";
}
