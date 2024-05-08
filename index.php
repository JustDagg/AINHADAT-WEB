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
body{
  overflow-x: hidden;
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

.testimonial {
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 100px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.testimonial p {
    font-size: 20px;
    line-height: 1.8;
    margin-bottom: 15px;
    font-family: 'Roboto', sans-serif;
}

.testimonial strong {
    font-weight: bold;
}

.testimonial:hover {
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

/* Màu sắc và gradient */
.testimonial:nth-child(odd) {
    background-color: #f8f9fa;
}

.testimonial:nth-child(even) {
    background-color: #edf2f7;
}

.testimonial:nth-child(odd) {
    background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
}

.testimonial:nth-child(even) {
    background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
}

#scrollTopBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  cursor: pointer;
  padding: 15px;
  border: none;
  border: 1px solid #32599d; 
  border-radius: 50%;
  display: inline-block;
}

#scrollTopBtn:hover {
  background-color: #777;
}

.container {
  font-size: 20px; 
  margin-bottom: 30px;
}

.slideshow-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 54px;
    color: #333; /* Màu của biểu tượng */
    margin: 0 10px;
    padding: 10px;
}

.slideshow-btn:hover {
    color: #31D2F2; /* Màu của biểu tượng khi hover */
}

.card-img-top:hover {
  transform: scale(1.1);
}
</style>


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
        <li class="nav-item-total">
          <a class="nav-link" href="#">TỔNG GIÁ: <?php total_cart_price(); ?><span style="margin-left: 5px;">tỷ VND</span></a>
        </li>
      </ul>

<?php
include("./includes/search.php");
?>

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

<!-- fourth child -->
<div class="row px-3">
    <div class="col-md-10">
    <!-- products -->
        <div class="row">
<!-- fetching products -->

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div id="slideshow">
                <img src="images/banner.jpg" alt="Banner 1" style="width: 100%; max-height: 400px">
                <img src="images/banner2.jpg" alt="Banner 2" style="width: 100%; max-height: 400px; display: none;">
                <img src="images/banner3.jpg" alt="Banner 3" style="width: 100%; max-height: 400px; display: none;">
            </div>
            <button onclick="prevSlide()" class="slideshow-btn"><i class="fa-solid fa-arrow-left"></i></button>
            <button onclick="nextSlide()" class="slideshow-btn"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </div>
    <div class="row">
        <div style="margin-top: 40px; color:#c0392b;" class="col text-center">
            <b style="font-size: 35px;">Khách hàng nói về Công Ty TNHH AI Nhà Đất tại Hà Nội</b>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="testimonial">
                <p>"Công ty TNHH Ai Nhà Đất rất chuyên nghiệp và hỗ trợ tận tình. Tôi rất hài lòng với dịch vụ của họ."</p>
                <p><strong>Tuấn Đặng</strong></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <p>"Dịch vụ của Ai Nhà Đất rất nhanh chóng và hiệu quả. Tôi đã tìm thấy căn nhà mơ ước của mình nhờ họ."</p>
                <p><strong>Quang Hải</strong></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial">
                <p>"Tôi đã sử dụng dịch vụ của Công ty TNHH Ai Nhà Đất và thực sự không thể hài lòng hơn. Đội ngũ của họ rất chuyên nghiệp và tận tình."</p>
                <p><strong>Văn Toàn</strong></p>
            </div>
        </div>
        <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 style="text-align:center; color:#c0392b;"><strong>MUA BÁN</strong> BẤT ĐỘNG SẢN UY TÍN, NHANH CHÓNG TẠI&nbsp;<span style="color:#e67e22;">AI NHÀ ĐẤT HÀ NỘI</span></h2>
            <p style="text-align:center; color:#f1c40f;"><em>(AI NHÀ ĐẤT: Nền Tảng Công nghệ Bất động sản được phát triển bởi Công Ty TNHH AI NHÀ ĐẤT)</em></p>
            <p style="text-align:center;">Nền tảng kết nối người mua, người bán &amp; NHÀ MÔI GIỚI uy tín</p>
            <p style="text-align:center;">Giao dịch nhanh chóng – An toàn – Hiệu quả</p>
            <p>Công ty TNHH AI NHÀ ĐẤT tự hào giới thiệu nền tảng công nghệ bất động sản tiên tiến, là một địa chỉ uy tín và đáng tin cậy cho việc mua bán và cho thuê bất động sản tại Việt Nam. Với sứ mệnh kết nối người mua, người bán và nhà môi giới, chúng tôi cam kết mang đến cho khách hàng một trải nghiệm giao dịch nhanh chóng, an toàn và hiệu quả.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3><strong>I. Tầm nhìn và mục tiêu</strong></h3>
            <p>Với tầm nhìn xây dựng một cộng đồng bất động sản đáng tin cậy, AI NHÀ ĐẤT nhằm đem đến sự kết nối mạnh mẽ giữa người mua, người bán và nhà môi giới uy tín trên nền tảng công nghệ. Mục tiêu chính của chúng tôi là cung cấp dịch vụ mua bán và cho thuê bất động sản nhanh chóng, an toàn và hiệu quả, đồng thời mang đến thông tin toàn diện và hữu ích về thị trường bất động sản.</p>
            <h3><strong>II. Các loại hình mua bán bất động sản trên AI NHÀ ĐẤT HÀ NỘI</strong></h3>
            <p>Tại AI NHÀ ĐẤT, chúng tôi cung cấp một loạt các loại hình bất động sản cho mua bán và cho thuê, đáp ứng đa dạng nhu cầu của khách hàng.</p>
            <h3 style="text-align: center; color:#c0392b;"><strong>Dưới đây là một số loại hình nổi bật mà khách hàng có thể tìm thấy trên nền tảng của chúng tôi.</strong></h3>
            <!-- Thêm các phần còn lại của mô tả của bạn tại đây -->
        </div>
    </div>
</div>
    </div>
</div>

<?php
// calling function
getproducts();
get_unique_categories();
get_unique_brands();
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  
?>
  
<!-- row end -->
</div>
<!-- col end -->
</div>
    <div class="col-md-2 bg-dark p-0">
    <!-- BRANDS TO BE DISPLAY -->
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-primary">
                <a style="padding: 10px 10px;" href="#" class="nav-link text-light">
                  <h4>Địa điểm nhà đất bán tại Hà Nội</h4>
                </a>
            </li>

<?php
// calling function
getbrands();
?>
        </ul>

    <!-- CATEGORIES TO BE DISPLAY -->
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-primary">
                <a style="padding: 10px 10px;" href="#" class="nav-link text-light"><h4>Loại hạng mục</h4></a>
            </li>

<?php
// calling function
getcategories()
?>
           
        </ul>
    </div>
</div>

<button onclick="topFunction()" id="scrollTopBtn" title="Go to top"><img style="width: 40px; height: 40px; " src="./images/scroll-top.jpg" alt="Scroll to Top"></button>


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

<script>
  // Tham chiếu đến nút
var scrollTopBtn = document.getElementById("scrollTopBtn");

// Khi người dùng cuộn xuống 20px từ đỉnh của trang, hiển thị nút
window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    scrollTopBtn.style.display = "block";
  } else {
    scrollTopBtn.style.display = "none";
  }
}

// Khi người dùng nhấp vào nút, cuộn lên đầu của trang
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<!-- BANNER SWAP -->
<script>
    var slideIndex = 1; // Đặt slideIndex bắt đầu từ 1 thay vì 0
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementById("slideshow").getElementsByTagName("img");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        if (slideIndex > slides.length) {slideIndex = 1} // Nếu slideIndex lớn hơn số lượng ảnh, đặt slideIndex về 1
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 10000); // Change image every 2 seconds
    }

    function prevSlide() {
        var slides = document.getElementById("slideshow").getElementsByTagName("img");
        slideIndex--;
        if (slideIndex < 1) {
            slideIndex = slides.length; // Nếu slideIndex nhỏ hơn 1, đặt slideIndex bằng số lượng ảnh
        }
        showSlides();
    }

    function nextSlide() {
        var slides = document.getElementById("slideshow").getElementsByTagName("img");
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1; // Nếu slideIndex lớn hơn số lượng ảnh, đặt slideIndex về 1
        }
        showSlides();
    }
</script>


</body>
</html>