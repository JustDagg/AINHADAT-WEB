<!-- connect file -->
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
    <title>AINHADAT - ADMIN</title>
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
.admin_image{
    width: 100px;
    object-fit: contain;
}

.footer{
    position: absolute;
    bottom: 0;
}

body{
    overflow-x: hidden;
}

.product_img{
    width: 100px;
    object-fit: contain;
}

.btn-nav:hover{
    background-color: blue;
}

</style>
</head>
<body>
    <!-- NAVBAR -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-danger">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">

<?php 
if(!isset($_SESSION['admin_name'])){
  echo  "<li class='nav-item'>
          <a class='nav-link text-light' href='#'>Welcome Guest</a>
        </li>";
} else{
  echo  "<li class='nav-item'>
          <a style='font-weight: 700;' class='nav-link text-light' href='#'>Welcome ".$_SESSION['admin_name']."</a>
        </li>";
}

if(!isset($_SESSION['admin_name'])){
  echo  "<li class='nav-item'>
          <a class='nav-link text-light' href='admin_login.php'>ĐĂNG NHẬP</a>
        </li>";
}
if(!isset($_SESSION['admin_name'])){
  echo  "<li class='nav-item'>
            <a class='nav-link text-light' href='admin_registration.php'>ĐĂNG KÍ</a>
        </li>";
} else{
  echo  "<li class='nav-item'>
          <a class='nav-link text-light' href='admin_logout.php'>ĐĂNG XUẤT</a>
        </li>";
}
?>

                    </ul>

                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 style="font-weight: 800;" class="text-center p-2">Admin - Quản lý</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-4">                
                    <p style="font-weight: 700;" class="text-light text-center">Xin chào, <?php echo $_SESSION['admin_name'] ?></p>
                </div>
                <!-- button*10>a.nav-link.text-light.bg-info.my-1 -->
                <div class="button text-center">
                    
                    <button class="btn-nav"><a href="index.php?list_charts" class="nav-link text-light bg-success my-1">
                        <i class="fa-solid fa-square-poll-vertical"></i> Số liệu thống kê</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?list_orders" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-cart-shopping"></i> Tất cả đơn hàng</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?list_payments" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-money-check-dollar"></i> Tất cả thanh toán</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?list_admins" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-user-tie"></i> Danh sách Admin</a>
                    </button> 

                    <button class="btn-nav"><a href="index.php?list_users" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-user"></i> Danh sách người dùng</a>
                    </button> 

                    <button class="btn-nav"><a href="index.php?view_products" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-city"></i> Xem nhà đất bán</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?view_categories" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-list"></i> Xem loại hạng mục nhà đất bán</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?view_brands" class="nav-link text-light bg-danger my-1">
                        <i class="fa-solid fa-map-location-dot"></i> Xem địa điểm nhà đất bán</a>
                    </button>

                    <button class="btn-nav"><a href="index.php?list_errors" class="nav-link text-light bg-warning my-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> Danh sách báo lỗi</a>
                    </button>
                    
                </div>
            </div>
        </div>
        
        <!-- fourth child -->
        <div class="container my-3">

<style>
.btn-add-product{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    margin-right: 10px;
}   

.btn-add-product:hover {
    background-color: green;
}

.btn-export-product{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    margin-right: 10px;
}

.btn-export-product:hover {
    background-color: green;
}

.btn-refresh-product{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    font-size: 20px;
}

.btn-refresh-product:hover {
    background-color: green;
}

</style>

<h3 class="text-center">DANH SÁCH NHÀ ĐẤT BÁN</h3>

<div style="display: flex; justify-content: flex-end; margin-top: 35px;">
    <!-- Search -->
    <form action="../admin_area/search_product.php" method="get" class="d-flex" style="margin-right: 10px;">
        <input style="width: 675px; font-size: 18px;" class="form-control me-2" 
                type="search" 
                placeholder="Nhập tiêu đề, địa điểm, loại hạng mục nhà đất tìm kiếm" 
                name="search_admin_product_data" 
                aria-label="Search">
        <input style="
                    width: 150px; 
                    font-size: 17px;
                    background-color: seagreen; 
                    border: none; 
                    border-radius: 5px;
                    color: white;
                    text-decoration: none;
                    " 
                type="submit" 
                value="Tìm kiếm" 
                class="btn btn-outline-dark" 
                name="search_admin_data_product">
    </form>

    <!-- Add Product -->
    <button class="btn-add-product">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='index.php?insert_products'>
            <i class="fa-regular fa-plus"></i> Thêm nhà đất bán
        </a>
    </button>

    <!-- Export Excel Product -->
    <button class="btn-export-product">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='export_products.php'>
            <i class="fa-solid fa-file-export"></i> Export Excel
        </a>
    </button>

    <!-- Refresh -->
    <button class="btn-refresh-product" type="button" id="refreshFilter" class="btn btn-secondary" style="margin-right: 10px;">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='index.php?view_products'>
                <i class="fas fa-sync-alt"></i> Làm mới
        </a>
    </button>

</div>

<table class="table table-bordered mt-5">
    <thead class="bg-danger">
        <tr class="text-center text-light">
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Địa điểm</th>
            <th>Loại hạng mục</th>
            <th>Ảnh nhà đất</th>
            <th>Giá bán</th>
            <th>Kích thước</th>
            <th>Đã bán</th>
            <th>Ngày tạo</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody style="font-weight: 600;" class="bg-warning">

<?php 
search_admin_product();
?>
   
    </tbody>
</table>

</div>
<!-- last child -->
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>