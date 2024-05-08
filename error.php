<?php  
include('includes/connect.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BÁO LỖI</title>

    <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="shortcut icon" type="image/png" href="images/logo.png"/>
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>
<body>
<div class="container-fluid m-3">
    <h2 class="text-center">BÁO LỖI</h2>
        <div class="text-center mt-4 pt-2">
    </div>
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <!-- error_title field -->
                    <label for="error_title" class="form-label">Lí do:</label>
                    <input  type="text" 
                            id="error_title" 
                            class="form-control" 
                            placeholder="Nhập lí do bạn phàn nàn về trải nghiệm trang web" 
                            autocomplete="off" 
                            required="required" 
                            name="error_title"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- error_username -->
                    <label for="error_username" class="form-label">Tên đăng nhập:</label>
                    <input  type="text" 
                            id="error_username" 
                            class="form-control" 
                            placeholder="Nhập tên đăng nhập" 
                            autocomplete="off" 
                            required="required" 
                            name="error_username"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- Email field -->
                    <label for="error_email" class="form-label">Email:</label>
                    <input  type="email" 
                            id="error_email" 
                            class="form-control" 
                            placeholder="Nhập email" 
                            autocomplete="off" 
                            required="required" 
                            name="error_email"
                    >
                </div>

                <div class="form-outline mb-4">
                    <!-- error_mobile -->
                    <label for="error_mobile" class="form-label">SDT:</label>
                    <input  type="text" 
                            id="error_mobile" 
                            class="form-control" 
                            placeholder="Nhập số điện thoại" 
                            autocomplete="off" 
                            required="required" 
                            name="error_mobile"
                    >
                </div>

                <div class="text-center mt-4 pt-2">
                    <button class="bg-secondary py-2 px-5 border-0 text-light ml-2" id="backToIndex">Quay lại trang chủ</button>
                    <input type="submit" value="Gửi ý kiến" class="bg-primary py-2 px-5 border-0 text-light" name="error_submit">
                </div>
            
            </form>
        </div>
    </div>
</div>
    
</body>
</html>

<?php  

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['username'])){
    // Chỉ thực hiện các thao tác khi người dùng đã đăng nhập

    // Kiem tra xem nguoi dung da nhan nut Gui hay chua
    if(isset($_POST['error_submit'])){
        // Lấy dữ liệu từ form
        $error_title=$_POST['error_title'];
        $error_mobile=$_POST['error_mobile'];
        $error_email=$_POST['error_email'];

        // Lấy user_id và username từ session
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];

        // Thực hiện câu lệnh INSERT
        $insert_query="
            INSERT INTO `user_error` (error_title,      error_username,     error_mobile,       error_email     )
            VALUES                   ('$error_title',   '$username',        '$error_mobile',    '$error_email'  )
        ";
        $sql_execute=mysqli_query($connection,$insert_query);

        // Kiểm tra xem câu lệnh INSERT có thành công hay không
        if($sql_execute) {
            // Nếu thành công, hiển thị một thông báo thành công bằng JavaScript
            echo "<script>alert('Gửi thông tin báo lỗi thành công!'); window.location.href = 'index.php';</script>";
            exit;
        } else {
            // Nếu câu lệnh INSERT không thành công, hiển thị thông báo lỗi
            echo "Có lỗi xảy ra khi gửi thông tin báo lỗi.";
        }
    }
} else {
    // Nếu người dùng chưa đăng nhập, không cho họ truy cập vào trang này
    echo "<h2 class='text-center text-danger' style='margin-top: 50px;'>Vui lòng đăng nhập trước khi gửi thông tin báo lỗi.</h2>";
}
?>

<script>
document.getElementById("backToIndex").onclick = function() {
    window.location.href = "index.php";
}
</script>
