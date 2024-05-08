<!-- CONNECT FILE -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HỒ SƠ - <?php echo $_SESSION['username'] ?></title>
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

    <!-- CSS FILE -->
    <link rel="stylesheet" href="../style.css">
<style>
body{
    overflow-x: hidden;
}

.profile_img{
    width: 90%;
    margin: auto;
    display: block;
    object-fit: contain;
}

.edit_img{
    width: 100px;
    height: 100px;
    object-fit: contain;
}

.nav-item:hover{
    background-color: burlywood;
    border-radius: 20px;
}

.logo-link img {
  text-decoration: none;
  height: 70px;
  width: 70px;
  margin-right: 10px;
}

</style>

</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="logo-link" href="../index.php">
        <img src="../images/logo.png" alt="" class="logo">
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-weight: 600;">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../index.php"><i class="fa-solid fa-house"></i> TRANG CHỦ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php"><i class="fa-solid fa-city"></i> NHÀ ĐẤT BÁN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php"><i class="fa-solid fa-user"></i> TÀI KHOẢN CỦA TÔI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa-solid fa-phone"></i> LIÊN HỆ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../error.php"><i class="fa-solid fa-triangle-exclamation"></i> BÁO LỖI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup><?php cart_item(); ?></sup></a>
        </li>
        <li class="nav-item-total">
          <a class="nav-link" href="#">TỔNG GIÁ: <?php total_cart_price(); ?><span style="margin-left: 5px;">tỷ VND</span></a>
        </li>
      </ul>

    </div>
  </div>
</nav>

<!-- calling cart function -->
<?php
cart();

?>

<!-- second child -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav me-auto">

<?php 
if(!isset($_SESSION['username'])){
  echo  "<li class='nav-item'>
          <a class='nav-link' href='#'>WELCOME GUEST</a>
        </li>";
} else{
  echo  "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome ".$_SESSION['username']."</a>
        </li>";
}

if(!isset($_SESSION['username'])){
  echo  "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>ĐĂNG NHẬP</a>
        </li>";
} else{
  echo  "<li class='nav-item'>
          <a class='nav-link' href='logout.php'>ĐĂNG XUẤT</a>
        </li>";
}
?>

    </ul>
</nav>

<!-- third child -->
<div class="bg-light">
    <h5 class="text-center" style="font-weight: 700; margin-bottom: 40px">Ai Nhà Đất - Nền Tảng Mua Bán Bất Động Sản Uy Tín Hàng Đầu Tại Việt Nam</h5>
</div>

<!-- fourth child -->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-dark text-center" style="height:100vh;">
            <li class="nav-item bg-primary">
                <a style="padding: 10px 10px;" class="nav-link text-light" href="#"><h4>Hồ sơ của bạn</h4></a>
            </li>

<?php
$username=$_SESSION['username'];
$user_image=
  "
    Select * 
    from `user_table` 
    where username='$username'
  ";
$result_image=mysqli_query($connection,$user_image);
$row_image=mysqli_fetch_array($result_image);
$user_image=$row_image['user_image'];
echo "  <li class='nav-item-ava'>
            <img style='border-radius: 30px;' src='./user_images/$user_image' class='profile_img my-4' alt=''>
        </li>"
?>

            <li class="nav-item">
                <a class="nav-link text-light" href="profile.php">ĐƠN HÀNG ĐANG CHỜ XỬ LÝ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="profile.php?edit_account">SỬA TÀI KHOẢN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="profile.php?my_orders">ĐƠN HÀNG CỦA TÔI</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="profile.php?delete_account">XÓA TÀI KHOẢN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="logout.php">ĐĂNG XUẤT</a>
            </li>
        </ul>
    </div>
    <div class="col-md-10 text-center">

<?php
get_user_order_details();
if(isset($_GET['edit_account'])){
    include('edit_account.php');
}
if(isset($_GET['my_orders'])){
  include('user_orders.php');
}
if(isset($_GET['delete_account'])){
  include('delete_account.php');
}
?>

    </div>
</div>

<!-- last child -->
<!-- include footer -->
<div class="bg-primary p-3 text-center" style="color:antiquewhite; font-weight:700;">
    <p>© Copyright 2024 Ai Nhà Đất - Designed by Tuan Dang . All Rights Reserved.</p>
    <div style="margin-top: 12px;" class="re__right-fix">
        <a target="_blank" style="display: inline-block; margin-right: 5px;" href="https://www.facebook.com/ainhadat.vn">
        <img style="border: 1px solid #32599d; border-radius: 50%;" src="../images/facebook.jpg" width="30">
        </a>

        <a target="_blank" style="display: inline-block; margin-right: 5px;" href="https://youtube.com/@AinhadatVN">
        <img style="border: 1px solid #df3f31; border-radius: 50%;" src="../images/youtube.jpg" width="30">
        </a>   
        
        <a target="_blank" style="display: inline-block; margin-right: 5px;" href="https://zalo.me/0362316021">
        <img style="border: 1px solid #00a1dc; border-radius: 50%;" src="../images/zalo.jpg" width="30">
        </a>
    </div>
</a>
</div>
</div>
    
<!-- BOOTSTRAP JS LINK -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>