<?php 
// getting products
function getproducts(){
    global $connection;

    // condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    $select_query=
        "
            Select * 
            from `products` 
            order by rand() LIMIT 0,9
        ";
    $result_query=mysqli_query($connection,$select_query);

    // $row=mysqli_fetch_assoc($result_query);
    // echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <h5 class='text-danger' style='font-weight: 700; margin-bottom: 25px;'>$product_price<span style='margin-left: 5px;'>tỷ VND</span>
                    <i class='card-text' style='color: black; font-size: 15px; margin-left: 15px;'>$product_land_size</i>
                </h5>
                <h5 style='color: green; float:right;'>";
$get_count = 
"
    SELECT * 
    FROM `orders_pending` 
    WHERE product_id='$product_id'
";
$result_count = mysqli_query($connection, $get_count);
$rows_count = mysqli_num_rows($result_count);
    if ($rows_count > 0) {
        echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
    }
echo "</h5>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
            </div>
        </div>
    </div>";
    }
}
}
}

// getting all products and pagination
function get_all_products(){
    global $connection;

    // điều kiện để kiểm tra isset hay không
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

    // Số lượng sản phẩm trên mỗi trang
    $products_per_page = 12;

    // Trang hiện tại, mặc định là 1 nếu không được đặt
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Tính chỉ số bắt đầu để truy xuất sản phẩm
    $start = ($current_page - 1) * $products_per_page;

    // Truy vấn để có được tổng số sản phẩm
    $total_query = 
        "
            SELECT COUNT(*) AS total 
            FROM `products`
        ";
    $total_result = mysqli_query($connection, $total_query);
    $total_row = mysqli_fetch_assoc($total_result);
    $total_products = $total_row['total'];

    // Tính tổng số trang
    $total_pages = ceil($total_products / $products_per_page);

    $select_query=
        "
            SELECT * 
            FROM `products` 
            LIMIT $start, $products_per_page
        ";
    $result_query=mysqli_query($connection,$select_query);

    // thẻ sản phẩm HTML
    $product_cards_html = '';
    
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        // Xây dựng HTML thẻ sản phẩm
        $product_card_html = "<div class='col-md-4 mb-2'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <h5 class='text-danger' style='font-weight: 700; margin-bottom: 25px;'>$product_price<span style='margin-left: 5px;'>tỷ VND</span>
                <i class='card-text' style='color: black; font-size: 15px; margin-left: 15px;'>$product_land_size</i>
            </h5>
            <h5 style='color: green; float:right;'>";

$get_count = 
    "
        SELECT * 
        FROM `orders_pending` 
        WHERE product_id='$product_id'
    ";
$result_count = mysqli_query($connection, $get_count);
$rows_count = mysqli_num_rows($result_count);
if ($rows_count > 0) {
    $product_card_html .= "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
}

$product_card_html .= "</h5>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
        </div>
    </div>
</div>";


        // Nối thẻ HTML
        $product_cards_html .= $product_card_html;
    }

    // Echo thẻ sản phẩm HTML
    echo "<div class='row'>$product_cards_html</div>";

    // Liên kết phân trang
    echo "<ul class='pagination' style='margin-left: 100px; margin-top: 30px; text-align: center;'>";
        for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li class='page-item''>
                <a style='background-color: #D0902A; 
                            color: white; 
                            font-size: 16px;
                            padding: 15px 25px; 
                            border-radius: 5px;
                            align-items: center;
                            margin-left: 5px;' 
                   class='page-link' href='?page=$i'>$i
                </a>
              </li>";
    }
    echo "</ul>";
}
}
}

// getting unique categories
function get_unique_categories(){
    global $connection;

    // condition to check isset or not
    if(isset($_GET['category'])){
        $category_id=$_GET['category'];
    $select_query=
        "   
            Select * 
            from `products` 
            where category_id=$category_id
        ";
    $result_query=mysqli_query($connection,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>Không có sẵn cho loại hạng mục này</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
            <h5 style='color: green; float:right;'>";
            $get_count = 
            "
                SELECT * 
                FROM `orders_pending` 
                WHERE product_id='$product_id'
            ";
            $result_count = mysqli_query($connection, $get_count);
            $rows_count = mysqli_num_rows($result_count);
                if ($rows_count > 0) {
                    echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
                }
            echo "</h5>
        </div>
    </div>
    </div>";
    }
}
}

// getting unique brands
function get_unique_brands(){
    global $connection;

    // condition to check isset or not
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
    $select_query=
        "
            Select * 
            from `products` 
            where brand_id=$brand_id
        ";
    $result_query=mysqli_query($connection,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>Nhà đất bán tại Hà Nội không có sẵn cho khu vực này</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
            <h5 style='color: green; float:right;'>";
            $get_count = 
            "
                SELECT * 
                FROM `orders_pending` 
                WHERE product_id='$product_id'
            ";
            $result_count = mysqli_query($connection, $get_count);
            $rows_count = mysqli_num_rows($result_count);
                if ($rows_count > 0) {
                    echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
                }
            echo "</h5>
        </div>
    </div>
    </div>";
    }
}
}

// display brands in sidenav
function getbrands(){
    global $connection;
    $select_brands=
        "
            Select * 
            from `brands`
        ";
    $result_brands=mysqli_query($connection, $select_brands);
    while($row_data=mysqli_fetch_assoc($result_brands)){
        $brand_title=$row_data['brand_title'];
        $brand_id=$row_data['brand_id'];
        echo " <li style='list-style-type: none;' class='nav-item'>
        <a href='display_all.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
    </li> ";
    }
}

// display categories in sidenav
function getcategories(){
    global $connection;
    $select_categories=
        "
            Select * 
            from `categories`
        ";
    $result_categories=mysqli_query($connection, $select_categories);
    while($row_data=mysqli_fetch_assoc($result_categories)){
        $category_title=$row_data['category_title'];
        $category_id=$row_data['category_id'];
        echo " <li style='list-style-type: none;' class='nav-item'>
        <a href='display_all.php?category=$category_id' class='nav-link text-light'>$category_title</a>
    </li> ";
    }
}

// searching product function
function search_product(){
    global $connection;
    if(isset($_GET['search_data_product'])){
        $search_data_value=$_GET['search_data'];
    $search_query=
    "
        SELECT products.*, brands.brand_title
        FROM products
        LEFT JOIN brands ON products.brand_id = brands.brand_id
        WHERE products.product_keywords LIKE '%$search_data_value%'
        OR brands.brand_title LIKE '%$search_data_value%'
    ";
    $result_query=mysqli_query($connection,$search_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>Không có kết quả phù hợp. Không tìm thấy sản phẩm nào trong danh mục này</h2>";
    }
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <h5 class='text-danger' 
                style='font-weight: 700; margin-bottom: 25px;'>$product_price<span style='margin-left: 5px;'>tỷ VND</span>
                <i class='card-text' 
                    style='color: black; font-size: 15px; margin-left: 15px;'>$product_land_size</i>
            </h5>
            <h5 style='color: green; float:right;'>";
$get_count = 
"
    SELECT * 
    FROM `orders_pending` 
    WHERE product_id='$product_id'
";
$result_count = mysqli_query($connection, $get_count);
$rows_count = mysqli_num_rows($result_count);
    if ($rows_count > 0) {
        echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
    }
echo "</h5>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
            <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
        </div>
    </div>
    </div>";
    }
}
}

//filter minmax product price
function filterminmax_product(){
    global $connection;
// Kiểm tra xem có dữ liệu nhập từ form không
    if(isset($_GET['min_price']) && isset($_GET['max_price'])) {
            // Lấy giá trị từ form
            $min_price = $_GET['min_price'];
            $max_price = $_GET['max_price'];

            // Thực hiện truy vấn SQL để lấy sản phẩm trong khoảng giá đã nhập
            if(!empty($min_price) || !empty($max_price)) {
                // Xử lý chuỗi truy vấn SQL
                $query = 
                "
                    SELECT * 
                    FROM products 
                    WHERE 
                ";

                if (!empty($min_price) && !empty($max_price)) {
                    $query .= 
                    "
                        product_price BETWEEN $min_price AND $max_price
                    ";
                } elseif (!empty($min_price)) {
                    $query .= 
                    "
                        product_price >= $min_price
                    ";
                } elseif (!empty($max_price)) {
                    $query .= 
                    "   
                        product_price <= $max_price
                    ";
                }
        $result = mysqli_query($connection, $query);
        $num_of_rows=mysqli_num_rows($result);
        if(mysqli_num_rows($result) > 0) {
            
        while($row=mysqli_fetch_assoc($result)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];
            $product_land_size=$row['product_land_size'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo "<div class='col-md-4 mb-2'>
            <div class='card'>
                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <h5 class='text-danger' 
                        style='font-weight: 700; 
                        margin-bottom: 25px;'>$product_price
                    <span style='margin-left: 5px;'>tỷ VND</span>
                    <i class='card-text' 
                        style='color: black; font-size: 15px; margin-left: 15px;'>$product_land_size</i>
                </h5>
                <h5 style='color: green; float:right;'>";
$get_count = 
"
    SELECT * 
    FROM `orders_pending` 
    WHERE product_id='$product_id'
";
$result_count = mysqli_query($connection, $get_count);
$rows_count = mysqli_num_rows($result_count);
    if ($rows_count > 0) {
        echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
    }
echo "</h5>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
                <a href='product_details.php?product_id=$product_id' class='btn btn-info'>Xem chi tiết</a>
            </div>
        </div>
        </div>";
        }
        } else {
            // Nếu không có sản phẩm nào được tìm thấy, hiển thị thông báo cho người dùng
            echo "<h2 class='text-center text-danger'>Không tìm thấy sản phẩm nào trong khoảng giá đã nhập.</h2>";
        }
        } else {
        // Nếu không có dữ liệu hợp lệ từ form
        echo "<h2 class='text-center text-danger'>Vui lòng nhập giá tối thiểu hoặc giá tối đa.</h2>";
        }
    }
}

// view details products function
function view_details(){
    global $connection;

    // condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

        $product_id=$_GET['product_id'];
    $select_query=
        "
            Select * 
            from `products` 
            where product_id=$product_id
        ";
    $result_query=mysqli_query($connection,$select_query);
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $description_with_newline = nl2br($product_description);
        $product_keywords=$row['product_keywords'];
        $product_image1=$row['product_image1'];
        $product_image2=$row['product_image2'];
        $product_image3=$row['product_image3'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
            <h5 class='card-title'>$product_title</h5>
            <p class='card-text'>$product_description</p>
            <h5 class='text-danger' 
                style='font-weight: 700; margin-bottom: 25px;'>$product_price<span style='margin-left: 5px;'>tỷ VND</span>
                <i class='card-text' 
                    style='color: black; font-size: 15px; margin-left: 15px;'>$product_land_size</i>
            </h5>
            <h5 style='color: green; float:right;'>";
$get_count = 
"
    SELECT * 
    FROM `orders_pending` 
    WHERE product_id='$product_id'
";
$result_count = mysqli_query($connection, $get_count);
$rows_count = mysqli_num_rows($result_count);
    if ($rows_count > 0) {
        echo "<i class='fa-solid fa-circle-check'></i> Đã đặt cọc nhà đất";
    }
echo "</h5>
            <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Thêm vào giỏ hàng</a>
            <a href='index.php' class='btn btn-info'>Quay về trang chủ</a>
        </div>
    </div>
    </div>
    
    <div class='col-md-8'>
                <div class='row'>
                    <div class='col-md-12 mb-3'>
                        <h1>$product_title</h1>
                    </div>
                    <div class='col-md-12'>
                        <h4 class='text-primary mb-4'>Ảnh liên quan đến sản phẩm</h4>
                    </div>
                    <div class='col-md-6'>
                        <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                    </div>
                    <div class='col-md-6 mb-4'>
                        <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                    </div>
                    <div class='col-md-12 mb-4'>
                        <h4 class='text-primary'>Thông tin mô tả:</h4>
                        <h4 class='card-text'>$description_with_newline</h4>
                    </div>
                    <div class='col-md-6'>
                        <h4 class='text-primary'><i class='fa-solid fa-ruler-combined'></i>Mức giá:</h4>
                        <h4 class='card-text'>$product_price tỷ</h4>
                    </div>
                    <div class='col-md-6 mb-4'>
                        <h4 class='text-primary'><i class='fa-solid fa-ruler-combined'></i>Diện tích:</h4>
                        <h4 class='card-text'>$product_land_size</h4>
                    </div>
                    <div class='col-md-12 mb-4'>
                        <h5 class='text-danger'>Liên hệ: <u style='color: blue; cursor: pointer;'>0123456789</u> hoặc <a style='color: blue;' href='https://zalo.me/0869249390'>Nhắn Zalo</a> để thương lượng hoặc có thể trả đúng giá trên website của chúng tôi. Xin trân trọng cảm ơn!</h5>
                    </div>
                    <div class='col-md-12 mb-5'>
                        <h4 class='text-primary'>Từ khóa:</h4>
                        <h5 class='card-text'>$product_keywords</h5>
                    </div>
                </div>
            </div>";
    }
}
}
}
}

// get ip address function
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

// cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $connection;
        $get_ip_add = getIPAddress();
        $get_product_id=$_GET['add_to_cart'];
        $select_query=
            "
                Select * 
                from `cart_details` 
                where ip_address='$get_ip_add' and product_id=$get_product_id
            ";
        $result_query=mysqli_query($connection,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows>0){
            echo "<script>alert('Mặt hàng này đã có sẵn trong giỏ hàng')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query=
                " 
                    insert into `cart_details`  (product_id,        ip_address,     quantity)
                    values                      ($get_product_id,   '$get_ip_add',  0       )
                ";
            $result_query=mysqli_query($connection,$insert_query);
            echo "<script>alert('Mặt hàng đã được thêm vào giỏ hàng')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

// function to get cart item numbers
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $connection;
        $get_ip_add = getIPAddress();
        $select_query=
            "
                Select * 
                from `cart_details` 
                where ip_address='$get_ip_add'
            ";
        $result_query=mysqli_query($connection,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
        } else {
            global $connection;
            $get_ip_add = getIPAddress();
            $select_query=
                "
                    Select * 
                    from `cart_details` 
                    where ip_address='$get_ip_add'
                ";
            $result_query=mysqli_query($connection,$select_query);
            $count_cart_items=mysqli_num_rows($result_query);
        }
        echo $count_cart_items;
}

// total price function
function total_cart_price(){
    global $connection;
    $get_ip_add = getIPAddress();
    $total_price=0;
    $cart_query=
        "
            Select * 
            from `cart_details` 
            where ip_address='$get_ip_add'
        ";
    $result=mysqli_query($connection,$cart_query);
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
    $product_values=array_sum($product_price);
    $total_price+=$product_values;
        }
    }
    echo $total_price;
}

// get user order details
function get_user_order_details(){
    global $connection;
    $username=$_SESSION['username'];
    $get_details=
        "
            Select * 
            from `user_table` 
            where username='$username'
        ";
    $result_query=mysqli_query($connection,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){ 
                    $get_orders=
                        "
                            Select * 
                            from `user_orders` 
                            where user_id=$user_id and order_status='pending'
                        ";
                    $result_orders_query=mysqli_query($connection,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h1 class='text-center mt-5 mb-2'>Bạn có <span class='text-danger'>$row_count</span> đơn hàng đang chờ xử lý</h1>
                        <p class='text-center' style='font-size: 30px;'><a href='profile.php?my_orders' class='text-primary'>Chi tiết đơn hàng</a></p>";
                    } else{
                        echo "<h1 class='text-center mt-5 mb-2'>Bạn có 0 đơn hàng đang chờ xử lý</h1>
                        <p class='text-center' style='font-size: 30px;'><a href='../index.php' class='text-primary'>Khám phá sản phảm</a></p>";
                    }
                }
            }
        }
    }
}


// ----- ADMIN SECTION -----
// SEARCH ADMIN PAGE USER
function search_admin_user(){
    global $connection;
    if(isset($_GET['search_admin_data_user'])){
        $search_admin_data_value=$_GET['search_admin_user_data'];
        $search_query=
        "
            Select * 
            from `user_table`
            WHERE username LIKE '%$search_admin_data_value%'
        ";
    $result_query=mysqli_query($connection,$search_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 style='margin-top: 60px;' class='text-center text-danger'>Không có kết quả phù hợp. Không tìm thấy người dùng</h2>";
    }
    $number=0;
    while($row=mysqli_fetch_assoc($result_query)){
        
        $user_id=$row['user_id'];
        $username=$row['username'];
        $user_email=$row['user_email'];
        $user_image=$row['user_image'];
        $user_address=$row['user_address'];
        $user_mobile=$row['user_mobile'];
        $number++;
        echo "
                <tr style='font-weight: 600;' class='text-center'>
                    <td>$number</td>
                    <td>$username</td>
                    <td>$user_email</td>
                    <td><img class='product_img' src='../users_area/user_images/$user_image' alt='$username'></td>
                    <td>$user_address</td>
                    <td>$user_mobile</td>
                    <td><a href='index.php?delete_user='$user_id' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
            ";
    }
}
}

// SEARCH ADMIN PAGE PRODUCT
function search_admin_product(){
    global $connection;
    if(isset($_GET['search_admin_data_product'])){
        $search_admin_product_data_value=$_GET['search_admin_product_data'];
        $search_product_query=
        "
            SELECT products.*, brands.brand_title, categories.category_title
            FROM products
            JOIN brands ON products.brand_id = brands.brand_id
            JOIN categories ON products.category_id = categories.category_id
            WHERE product_title LIKE '%$search_admin_product_data_value%'
            OR brands.brand_title LIKE '%$search_admin_product_data_value%'
            OR categories.category_title LIKE '%$search_admin_product_data_value%'
        ";
    $result_query=mysqli_query($connection,$search_product_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 style='margin-top: 60px;' class='text-center text-danger'>Không có kết quả phù hợp. Không tìm thấy nhà đất</h2>";
    }
    $number=0;
    while($row=mysqli_fetch_assoc($result_query)){
        
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $brand_id=$row['brand_id'];
        $brand_title=$row['brand_title'];
        $category_id=$row['category_id'];
        $category_title=$row['category_title'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $product_land_size=$row['product_land_size'];
        $date=$row['date'];
        echo "
    <tr class='text-center'>
        <td>$product_id</td>
        <td style='font-weight: bold;'>$product_title</td>
        <td>$brand_title</td>
        <td>$category_title</td>
        <td><img src='./product_images/$product_image1' class='product_img'/></td>
        <td>$product_price tỷ VND</td>
        <td>$product_land_size</td>
        <td>";

    // Đếm số lượng đơn hàng đang chờ xử lý
    $get_count = 
        "
            SELECT * 
            FROM `orders_pending` 
            WHERE product_id='$product_id'
        ";
    $result_count = mysqli_query($connection, $get_count);
    $rows_count = mysqli_num_rows($result_count);
    echo $rows_count;

    echo "</td>
        <td>$date</td>
        <td><a href='index.php?edit_products='$product_id' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product='$product_id' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
}
}
}

// SEARCH ADMIN PAGE ADMIN NAME
function search_admin(){
    global $connection;
    if(isset($_GET['search_data_admin_name'])){
        $search_admin_name_data_value=$_GET['search_admin_name_data'];
        $search_admin_name_query=
        "
            Select * 
            from `admin_table`
            WHERE admin_name LIKE '%$search_admin_name_data_value%'
        ";
    $result_query=mysqli_query($connection,$search_admin_name_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows==0){
        echo "<h2 style='margin-top: 60px;' class='text-center text-danger'>Không có kết quả phù hợp. Không tìm thấy admin</h2>";
    }
    $number=0;
    while($row=mysqli_fetch_assoc($result_query)){
        
        $admin_name=$row['admin_name'];
        $admin_email=$row['admin_email'];
        $number++;
        echo "
        <tr style='font-weight: 600;' class='text-center'>
            <td>$number</td>
            <td>$admin_name</td>
            <td>$admin_email</td>
        </tr>
            ";
    }
}
}



?>