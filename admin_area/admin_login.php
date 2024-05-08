<?php  
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - ĐĂNG NHẬP</title>

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
        <h2 class="text-center mb-5">ADMIN - ĐĂNG NHẬP</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-4">
                <img src="../images/adminlogin.png" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-4 mt-4">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Tên đăng nhập:</label>
                        <input  type="text" 
                                name="admin_name" 
                                id="admin_name" 
                                placeholder="Nhập tên đăng nhập:" 
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
                            <!-- button eye  -->
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                        <p id="capslock-warning" style="color: red; margin-top: 15px;" hidden><i class="fa-solid fa-triangle-exclamation"></i> Capslock is on!</p>
                    </div>

                    <div class="button-container">
                        <input style="border-radius: 5px;"  type="submit" 
                                class="bg-primary py-2 px-3 border-0 text-light" 
                                name="admin_login" 
                                value="Đăng nhập"
                            >
                        <p class="small fw-bold mt-2 pt-1">Bạn chưa có tài khoản ? <a href="admin_registration.php" class="link-danger">Đăng kí</a></p>
                    </div>

                </form>
            </div>

        </div>
    </div>
</body>
</html>

<?php 
if(isset($_POST['admin_login'])){
    $admin_name=$_POST['admin_name'];
    $admin_password=$_POST['admin_password'];
    
    // Select query
    $select_query="
        SELECT * 
        FROM `admin_table` 
        WHERE admin_name='$admin_name'
    ";
    $result=mysqli_query($connection,$select_query);
    $rows_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);

    if($rows_count > 0) {
        if(password_verify($admin_password, $row_data['admin_password'])) {
            // Tên đăng nhập và mật khẩu hợp lệ
            $_SESSION['admin_name'] = $admin_name;
            echo "<script>alert('Đăng nhập thành công!')</script>";
            echo "<script>window.open('index.php?list_charts','_self')</script>";
        } else { 
            // Mật khẩu không đúng
            echo "<script>alert('Sai mật khẩu!')</script>";
        }
    } else {
        // Tên đăng nhập không tồn tại
        echo "<script>alert('Thông tin không hợp lệ!')</script>";
    }
}
?>

<!-- event hide/show password -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#admin_password');
    
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.innerHTML = type === 'password' ? '<i class="fa-solid fa-eye"></i>' : '<i class="fa-solid fa-eye-slash"></i>';
    });
});
</script>

<!-- event capslock-password warning -->
<script>
const passwordInput = document.getElementById('admin_password');
const warning = document.getElementById('capslock-warning');

passwordInput.addEventListener('keyup', (event) => {
    if (event.getModifierState('CapsLock')) {
        warning.hidden = false
    } else {
        warning.hidden = true
    }
})
</script>