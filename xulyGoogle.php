<?php

ob_start(); // khắc phục lỗi chuyển hướng header

session_start();

// Gọi file Database vào sử dụng

require 'database.php';

// Gọi thư viện login goolge

require 'vendor/autoload.php';

// Gọi file function

require 'function.php';

// client

$client = clientGoogle();

// Kiểm tra xem có $_GET[‘code’] không. nếu không thì trở về login còn không thì tiếp tục xử lý

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  
    if (isset($token['access_token'])) {
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google\Service\Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $user_email =  $google_account_info->email;
        $username =  $google_account_info->name;
        $user_image =  $google_account_info->picture;

        // Lấy thông tin người dùng
        $info = checkThongTin($user_email); // Kiểm tra thông tin người dùng trong cơ sở dữ liệu

        if (!$info) {
            // Nếu không có tài khoản thì thêm một tài khoản mới
            $token = mt_rand(1000, 50000); 
            $username = insertUser($username, $token, $user_email, $user_image); // Thêm người dùng vào cơ sở dữ liệu và lấy user_id mới

            // SET SESSION['username'] với user_id mới và trở về trang chủ
            $_SESSION['username'] = $username;
            header('location: /ainhadat%20Website/index.php');
        } else {
            // Nếu đã có tài khoản, set SESSION['username'] với user_id của người dùng
            $_SESSION['username'] = $info['username'];
            header('location: /ainhadat%20Website/index.php');
        }
    } else {
        header('location: /ainhadat%20Website/index.php');
    }
}


?>
