<?php  
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AINHADAT - ĐĂNG KÍ</title>

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
    <h2 class="text-center">ĐĂNG KÍ NGƯỜI DÙNG MỚI</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
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
                            minlength="6"
                >
                <div class="invalid-feedback">Tên đăng nhập phải chứa ít nhất 6 ký tự.</div>
                </div>

                <div class="form-outline mb-4">
                    <!-- Email field -->
                    <label for="user_email" class="form-label">Email:</label>
                    <input  type="email" 
                            id="user_email" 
                            class="form-control" 
                            placeholder="Nhập email" 
                            autocomplete="off" 
                            required="required" 
                            name="user_email"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- Image field -->
                    <label for="user_image" class="form-label">Ảnh người dùng:</label>
                    <input  type="file" 
                            id="user_image" 
                            class="form-control" 
                            required="required" 
                            name="user_image"
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
                </div>

                <div class="form-outline mb-4">
                    <!-- Confirm password field -->
                    <label for="confirm_user_password" class="form-label">Xác nhận mật khẩu:</label>
                    <div class="input-group">
                        <input  type="password" 
                                id="confirm_user_password" 
                                class="form-control" 
                                placeholder="Nhập xác nhận mật khẩu" 
                                autocomplete="off" 
                                required="required" 
                                name="confirm_user_password"
                        >
                        <!-- button eye -->
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                    </div>
                </div>

                <div class="form-outline mb-4">
                    <!-- Address field -->
                    <label for="user_address" class="form-label">Địa chỉ:</label>
                    <input  type="text" 
                            id="user_address" 
                            class="form-control" 
                            placeholder="Nhập địa chỉ" 
                            autocomplete="off" 
                            required="required" 
                            name="user_address"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- Contact field -->
                    <label for="user_contact" class="form-label">Số điện thoại:</label>
                    <input  type="text" 
                            id="user_contact" 
                            class="form-control" 
                            placeholder="Nhập số điện thoại" 
                            autocomplete="off" 
                            required="required" 
                            name="user_contact"
                            pattern="[0-9]{11}"
                            title="Số điện thoại phải chứa chính xác 11 số."
                    >
                    <div class="invalid-feedback">Số điện thoại phải chứa chính xác 11 số.</div>
                </div>

                <div class="text-center mt-4 pt-2">
                    <button class="bg-secondary py-2 px-5 border-0 text-light ml-2" id="backToIndex">Quay lại trang chủ</button>
                    <input style="border-radius: 5px;" type="submit" value="Đăng kí" class="bg-primary py-2 px-5 border-0 text-light" name="user_register">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Bạn đã có tài khoản ? <a href="user_login.php" class="text-danger">Đăng nhập</a></p>
                </div>

            </form>
        </div>
    </div>
</div>
    
</body>
</html>

<!-- php code -->
    <!-- PHPMailer -->
<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $confirm_user_password=$_POST['confirm_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();
    $email_sent = false;

    $mail = new PHPMailer(true);

    try{
        $mail->SMTPDebug = 0;

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth=true;

        $mail->Username = ''; //Your Email;

        $mail->Password = ''; //Your Password;
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom('YOUR_EMAIL', 'AINHADAT.vn');

        $mail->addAddress($user_email, $user_username);

        $mail->isHTML(true);

        $mail->Subject = 'Register an account';
        $mail->Body    = 'Cảm ơn bạn đã đăng kí tài khoản trên AINHADAT. Mọi thông tin mua bán bất động sản xin vui lòng liên hệ: 0123456789';
        
        $mail->send();
        $email_sent = true;

        // Select query
        $select_query=
            "
                Select * 
                from `user_table` 
                where username='$user_username' or user_email='$user_email'
            ";
        $result=mysqli_query($connection,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0){
            echo "<script>alert('Tên đăng nhập hoặc Email đã tồn tại!')</script>";
        } else if($user_password!=$confirm_user_password){
            echo "<script>alert(\"Mật khẩu không khớp!\")</script>";
        } else {
        //Insert query
            move_uploaded_file($user_image_tmp,"./user_images/$user_image");
            $insert_query=
                "
                    insert into `user_table` (username,         user_email,     user_password,      user_image,     user_ip,    user_address,       user_mobile     )
                    values                   ('$user_username', '$user_email',  '$hash_password',   '$user_image',  '$user_ip', '$user_address',    '$user_contact' )
                ";
            $sql_execute=mysqli_query($connection,$insert_query);
            
        }
    
    } catch (Exception $e) {
        // Xử lý ngoại lệ
        echo 'Có lỗi khi gửi email: ' . $e->getMessage();
    }

    if ($email_sent) {
        echo "<script>alert('Bạn đã nhận được email đăng kí thành công')</script>";
    }

    // Selecting cart items
    $select_cart_items=
        "
            Select * 
            from `cart_details` 
            where ip_address='$user_ip'
        ";
    $result_cart=mysqli_query($connection,$select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('Bạn có sản phẩm trong giỏ hàng')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else{
        echo "<script>window.open('../index.php','_self')</script>";
    }
    

}
?>

<!-- redirect to trang chủ -->
<script>
document.getElementById("backToIndex").onclick = function() {
    window.location.href = "../index.php";
}
</script>

<!-- event hide/show password and confirm password -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#user_password');
    
    togglePassword.addEventListener('click', function() {
        togglePasswordVisibility(password, togglePassword);
    });

    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#confirm_user_password');

    toggleConfirmPassword.addEventListener('click', function() {
        togglePasswordVisibility(confirmPassword, toggleConfirmPassword);
    });

    function togglePasswordVisibility(inputField, toggleButton) {
        const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
        inputField.setAttribute('type', type);
        toggleButton.querySelector('i').classList.toggle('fa-eye');
        toggleButton.querySelector('i').classList.toggle('fa-eye-slash');
    }
});
</script>
