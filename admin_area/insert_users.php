<head>
    <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <style>
      body{
        overflow-x: hidden;
      }
    </style>

</head>
<body>
<div class="container-fluid m-3">
    <h2 class="text-center">TẠO NGƯỜI DÙNG MỚI</h2>
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
                    >
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
                    >
                </div>

                <div class="text-center mt-4 pt-2">
                    <input type="submit" value="Tạo mới" class="bg-primary py-2 px-5 border-0 text-light" name="user_register">
                </div>

            </form>
        </div>
    </div>
</div>
    
</body>
</html>

<!-- php code -->
<?php  
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
    }

    else{
    //Insert query
    move_uploaded_file($user_image_tmp,"../users_area/user_images/$user_image");
    $insert_query=
        "
            insert into `user_table` (username,         user_email,     user_password,      user_image,     user_ip,    user_address,       user_mobile)
            values                   ('$user_username', '$user_email',  '$hash_password',   '$user_image',  '$user_ip', '$user_address',    '$user_contact')
        ";
    $sql_execute=mysqli_query($connection,$insert_query);
    }

}
?>

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