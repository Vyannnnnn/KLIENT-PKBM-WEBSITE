<?php

namespace App\Controllers;

class BaseController
{
    protected $view_path = __DIR__ . '/../Views/';

    public function __construct()
    {
    }

    public function render($view, $data = [])
    {
        extract($data);
        $file = $this->view_path . $view . '.php';
        
        if (file_exists($file)) {
            ob_start();
            include $file;
            return ob_get_clean();
        }
        
        return "View tidak ditemukan: {$view}";
    }

    public function view($view, $data = [])
    {
        echo $this->render($view, $data);
    }

    public function redirectWithNotification($path, $title, $message, $type = 'info')
    {
        $message = urlencode($message);
        $title = urlencode($title);
        header("Location: /pkbm-website/public/{$path}?notification={$title}&message={$message}&type={$type}");
        exit;
    }

    public function redirect($path)
    {
        header("Location: /pkbm-website/public/{$path}");
        exit;
    }

    public function json($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
