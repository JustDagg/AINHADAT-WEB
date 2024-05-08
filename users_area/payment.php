<?php  
include('../includes/connect.php');
include('../functions/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANG THANH TOÁN</title>

    <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <style>
        body{
            overflow-x: hidden;
        }

        .pay_online{
            width: 90%;
            margin: auto;
            display: block;
        }

        .pay_offline{
            width: 35%;
            margin: auto;
            display: block;
        }

        p.text-center{
            font-size: 60px;
            font-weight: 700;
        }
        p.text-center:hover{
            color: #31D2F2;
        }

    </style>
</head>
<body>

    <!-- php code to access user id -->
<?php 
// sử dụng dựa trên địa chỉ IP
// $user_ip=getIPAddress();
// $get_user=
//     "
//         Select * 
//         from `user_table` 
//         where user_ip='$user_ip'
//     ";
// $result=mysqli_query($connection,$get_user);
// $run_query=mysqli_fetch_array($result);
// $user_id=$run_query['user_id'];

// sử dụng dựa trên phiên đăng nhập
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $get_user=
        "
            Select * 
            from `user_table` 
            WHERE username = '$username'
        ";
        $result=mysqli_query($connection,$get_user);
        if($result) {
            // Lấy dòng dữ liệu đầu tiên
            $run_query = mysqli_fetch_array($result);
            // Lấy user_id từ kết quả truy vấn
            $user_id = $run_query['user_id'];
        } else {
            // Xử lý lỗi nếu có
            echo "Có lỗi xảy ra khi truy vấn cơ sở dữ liệu.";
        }
    } else {
        // Xử lý trường hợp khi người dùng chưa đăng nhập
        // Ví dụ: Chuyển hướng người dùng đến trang đăng nhập
        header("Location: user_login.php");
        exit; // Đảm bảo kết thúc script sau khi chuyển hướng
    }

?>

    <div class="container">
        <h2 class="text-center text-primary">Các lựa chọn thanh toán</h2>
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img class="pay_online" src="../images/upi.png" alt=""></a>
            </div>
            <div class="col-md-6">
                <a style="text-decoration: none;" href="order.php?user_id=<?php echo $user_id ?>"><p class="text-center" style="text-decoration: none;">Pay offline</p><img class="pay_offline" src="../images/giohangicon.jpg" alt=""></a>
            </div>
        </div>
    </div>
    
</body>
</html>