<?php  
include('../includes/connect.php');
include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - ĐĂNG KÍ</title>

     <!-- BOOTSTRAP CSS LINK -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="shortcut icon" type="image/png" href="../images/logo.png"/>
    <!-- FONT AWESOME LINK -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />

<style>
body{
    overflow-x: hidden;
} 

.button-container {
    text-align: center; /* Căn giữa nội dung theo chiều ngang */
    display: flex; /* Sử dụng flexbox để căn giữa nội dung theo chiều dọc */
    flex-direction: column; /* Đặt hướng của flexbox thành cột để căn giữa theo chiều dọc */
    align-items: center; /* Căn giữa các phần tử theo chiều dọc */
}
</style>

</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">ADMIN - ĐĂNG KÍ</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-4">
                <img src="../images/adminreg.png" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-4 mt-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Tên đăng nhập:</label>
                        <input  type="text" 
                                name="admin_name" 
                                id="admin_name" 
                                placeholder="Nhập tên đăng nhập" 
                                required="required" 
                                class="form-control"
                            >
                    </div>

                    <div class="form-outline mb-4">
                        <label for="admin_email" class="form-label">Email:</label>
                        <input  type="email" 
                                name="admin_email" 
                                id="admin_email" 
                                placeholder="Nhập email" 
                                required="required" 
                                class="form-control"
                            >
                    </div>

                    <div class="form-outline mb-4">
                        <label for="admin_password" class="form-label">Mật khẩu:</label>
                        <div class="input-group">
                            <input  type="password" 
                                    name="admin_password" 
                                    id="admin_password" 
                                    placeholder="Nhập mật khẩu" 
                                    required="required" 
                                    class="form-control"
                                >
                            <!-- button eye -->
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="confirm_admin_password" class="form-label">Xác nhận mật khẩu:</label>
                        <div class="input-group">
                            <input  type="password" 
                                    name="confirm_admin_password" 
                                    id="confirm_admin_password" 
                                    placeholder="Nhập xác nhận mật khẩu" 
                                    required="required" 
                                    class="form-control"
                                >
                            <!-- button eye -->
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="button-container">
                        <input style="border-radius: 5px;"  type="submit" 
                                class="bg-primary py-2 px-3 border-0 text-light" 
                                name="admin_register" 
                                value="Đăng kí"
                            >
                        <p class="small fw-bold mt-2 pt-1">Bạn đã có tài khoản ? <a href="admin_login.php" class="link-danger">Đăng nhập</a></p>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>

<!-- php code -->
<?php
if(isset($_POST['admin_register'])){
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
    $confirm_admin_password=$_POST['confirm_admin_password'];

    // Select query
    $select_query="
        SELECT * 
        FROM `admin_table` 
        WHERE admin_name='$admin_name' OR admin_email='$admin_email'
    ";
    $result=mysqli_query($connection,$select_query);
    $rows_count=mysqli_num_rows($result);

    if($rows_count>0){
        echo "<script>alert('Tên đăng nhập hoặc Email đã tồn tại!')</script>";
    } elseif($admin_password!=$confirm_admin_password){
        echo "<script>alert(\"Mật khẩu không khớp!\")</script>";
    } else {
        //Insert query
        $insert_query="
            INSERT INTO `admin_table` (admin_name, admin_email, admin_password)
            VALUES ('$admin_name', '$admin_email', '$hash_password' )
        ";
        $sql_execute=mysqli_query($connection,$insert_query);
        
        // Redirect to login page after successful registration
        echo "<script>alert('Đăng kí thành công!')</script>";
        echo "<script>window.location.href = 'admin_login.php';</script>";
    }
}
?>

<!-- event hide/show password and confirm password -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#admin_password');
    
    togglePassword.addEventListener('click', function() {
        togglePasswordVisibility(password, togglePassword);
    });

    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#confirm_admin_password');

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