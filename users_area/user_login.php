<?php  
include('../includes/connect.php');
include('../functions/common_function.php');
require('../vendor/autoload.php');
require('../function.php');
@session_start();

$client = clientGoogle();
$url = $client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AINHADAT - ĐĂNG NHẬP</title>

    <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <!-- FONT AWESOME LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

    <link rel="shortcut icon" type="image/png" href="../images/logo.png"/>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<div class="container-fluid m-3">
    <h2 class="text-center">ĐĂNG NHẬP NGƯỜI DÙNG</h2>
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <!-- Username field -->
                    <label for="user_username" class="form-label">Tên đăng nhập:</label>
                    <input  type="text" 
                            id="user_username" 
                            class="form-control" 
                            placeholder="Nhập tên đăng nhập" 
                            autocomplete="off" 
                            required="required" 
                            name="user_username"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- Password field -->
                    <label for="user_password" class="form-label">Mật khẩu:</label>
                    <div class="input-group">
                        <input  type="password" 
                                id="user_password" 
                                class="form-control" 
                                placeholder="Nhập mật khẩu" 
                                autocomplete="off" 
                                required="required" 
                                name="user_password"
                        >
                        <!-- button eye -->
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <p id="capslock-warning" style="color: red; margin-top: 15px;" hidden><i class="fa-solid fa-triangle-exclamation"></i> Capslock is on!</p>
                </div>

                <div class="text-center mt-4 pt-2">
                    <input style="border-radius: 5px;" type="submit" value="Đăng nhập" class="bg-primary py-2 px-5 border-0 text-light" name="user_login">
                    <span style="font-weight: bold;">Hoặc</span>
                    <img style="width: 50px; height: 50px; border: none;" src='../images/google.png'>
                    <a href='<?= $url ?>' class="bg-danger py-2 px-5 border-0 text-light" style="border-radius: 5px; text-decoration: none;">Đăng nhập với Google</a>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản ? <a href="user_registration.php" class="text-danger">Đăng kí</a></p>
                </div>

            </form>
        </div>
    </div>
</div>
    
</body>
</html>

<?php 
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
    
    $select_query=
        "
            Select * 
            from `user_table` 
            where username='$user_username'
        ";
    $result=mysqli_query($connection,$select_query);
    $rows_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    // Cart item
    $select_query_cart=
        "
            Select * 
            from `cart_details` 
            where ip_address='$user_ip'
        ";
    $select_cart=mysqli_query($connection,$select_query_cart);
    $rows_count_cart=mysqli_num_rows($select_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            // echo "<script>alert('Login Successfully!')</script>";
            if($rows_count==1 and $rows_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('Đăng nhập thành công!')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Đăng nhập thành công!')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else{ 
            echo "<script>alert('Thông tin không hợp lệ!')</script>";
        }
    } else{
        echo "<script>alert('Thông tin không hợp lệ!')</script>";
    }
}

?>

<!-- event hide/show password -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#user_password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>';
    });
});
</script>

<!-- event capslock-password warning -->
<script>
const passwordInput = document.getElementById('user_password');
const warning = document.getElementById('capslock-warning');

passwordInput.addEventListener('keyup', (event) => {
    if (event.getModifierState('CapsLock')) {
        warning.hidden = false
    } else {
        warning.hidden = true
    }
})
</script>