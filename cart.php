<!-- CONNECT FILE -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AINHADAT</title>
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

    <link rel="shortcut icon" type="image/png" href="images/logo.png"/>

    <!-- CSS FILE -->
    <link rel="stylesheet" href="style.css">
<style>
.cart_img{
    width: 250px;
    height: 200px;
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
    <a class="logo-link" href="index.php">
        <img src="./images/logo.png" alt="" class="logo">
      </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-weight: 600;">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> TRANG CHỦ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php"><i class="fa-solid fa-city"></i> NHÀ ĐẤT BÁN</a>
        </li>
        
<?php 
if(isset($_SESSION['username'])){
  echo "<li class='nav-item'>
        <a class='nav-link' href='./users_area/profile.php'><i class='fa-solid fa-user'></i> TÀI KHOẢN CỦA TÔI</a>
        </li>";
} else{
    echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_registration.php'><i class='fa-solid fa-id-card'></i> ĐĂNG KÍ</a>
          </li>";
}
?>
        
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa-solid fa-phone"></i> LIÊN HỆ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="error.php"><i class="fa-solid fa-triangle-exclamation"></i> BÁO LỖI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-arrow-down"></i><sup><?php cart_item(); ?></sup></a>
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
          <a class='nav-link' href='./users_area/logout.php'>ĐĂNG XUẤT</a>
        </li>";
}
?>

    </ul>
</nav>

<!-- third child -->
<div class="bg-light">
    <h5 class="text-center" style="font-weight: 700; margin-bottom: 40px">Ai Nhà Đất - Nền Tảng Mua Bán Bất Động Sản Uy Tín Hàng Đầu Tại Việt Nam</h5>
</div>

<!-- fourth child - table -->
<div class="container">
    <div class="row">
        <form action="" method="post">
        <table class="table table-bordered text-center">
            
                <!-- php code to display dynamic data -->

<?php
$get_ip_add = getIPAddress();
$total_price=0;
$cart_query=
  "
    Select * 
    from `cart_details` 
    where ip_address='$get_ip_add'
  ";
$result=mysqli_query($connection,$cart_query);
$result_count=mysqli_num_rows($result);
if($result_count>0){
        echo    "<thead>
                    <tr>
                        <th>Tiêu đề sản phẩm</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Tổng giá</th>
                        <th>Xóa</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
            <tbody>";

while($row=mysqli_fetch_array($result)){
    $product_id=$row['product_id'];
    $select_products=
      "
        Select * 
        from `products` 
        where product_id='$product_id'
      ";
    $result_products=mysqli_query($connection,$select_products);
    while($row_product_price=mysqli_fetch_array($result_products)){
$product_price=array($row_product_price['product_price']);
$price_table=$row_product_price['product_price'];
$product_title=$row_product_price['product_title'];
$product_image1=$row_product_price['product_image1'];
$product_values=array_sum($product_price);
$total_price+=$product_values;

?>

                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                  

<?php
$get_ip_add = getIPAddress();  
if(isset($_POST['update_cart'])){
    $quantities=$_POST['qty'];
    $update_cart=
      "
        update `cart_details` 
        set quantity=$quantities 
        where ip_address='$get_ip_add'
      ";
    $result_products_quantity=mysqli_query($connection,$update_cart);
    $total_price=$total_price*$quantities;
}

?>

                    <td><?php echo $price_table ?> tỷ VND</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                    <td>
                        <!-- <button class="bg-success px-3 py-2 border-0 
                        mx-3 text-light">Update</button> -->
                        <!-- <input type="submit" value="Update Cart" class="bg-success px-3 py-2 border-0 
                        mx-3 text-light" name="update_cart"> -->
                        <!-- <button class="bg-success px-3 
                        py-2 border-0 mx-3 text-light">Remove</button> -->
                        <input type="submit" value="Remove Cart" class="bg-success px-3 py-2 border-0 
                        mx-3 text-light" name="remove_cart">
                    </td>

                </tr>

<?php 
        }
    }
}
else{
    echo "<h2 class='text-center text-danger'>Giỏ hàng trống</h2>";
}
?>

            </tbody>
        </table>
        <!-- subtotal -->
        <div class="d-flex mb-5">

<?php 
$get_ip_add = getIPAddress();
$cart_query=
  "
    Select * 
    from `cart_details` 
    where ip_address='$get_ip_add'
  ";
$result=mysqli_query($connection,$cart_query);
$result_count=mysqli_num_rows($result);
if($result_count>0){
    echo "  <h4 class='px-3'>Subtotal:<strong class='text-info'> $total_price tỷ VND <strong></h4>
            <input style='border-radius: 10px;' type='submit' value='Tiếp tục mua sắm' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>
            <button style='border-radius: 10px;' class='bg-warning px-3 py-2 border-0'><a href='./users_area/checkout.php' class='text-dark text-decoration-none'>Thủ tục thanh toán</a></button>";
} else{
    echo "<input style='border-radius: 10px;' type='submit' value='Tiếp tục mua sắm' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
}
if(isset($_POST['continue_shopping'])){
    echo "<script>window.open('index.php','_self')</script>";
}

?>
        
        </div>
    </div>
</div>
</form>
<!-- function to remove item -->
<?php
function remove_cart_item(){
    global $connection;
    if(isset($_POST['remove_cart'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query=
              "
                Delete from `cart_details` 
                where product_id=$remove_id
              ";
            $run_delete=mysqli_query($connection,$delete_query);
            if($run_delete){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
} 
echo $remove_item=remove_cart_item();

?>

<!-- last child -->
    <!-- include footer -->
<?php
include("./includes/footer.php");
?>
</div>
    
<!-- BOOTSTRAP JS LINK -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>
</body>
</html>