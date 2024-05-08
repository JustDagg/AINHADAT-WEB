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
$get_products=
    "
        SELECT products.*, brands.brand_title, categories.category_title
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        JOIN categories ON products.category_id = categories.category_id
    ";
$result=mysqli_query($connection,$get_products);
while($row=mysqli_fetch_assoc($result)){
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
    // $number++;
?>
    <tr class='text-center'>
        <td><?php echo $product_id ?></td>
        <td style='font-weight: bold;'><?php echo $product_title ?></td>
        <td><?php echo $brand_title ?></td>
        <td><?php echo $category_title ?></td>
        <td><img src='./product_images/<?php echo $product_image1 ?>' class='product_img'/></td>
        <td><?php echo $product_price ?> tỷ VND</td>
        <td><?php echo $product_land_size ?></td>
        <td>

<!-- COUNT ORDERS_PENDING -->
<?php 
$get_count=
    "
        Select * 
        from `orders_pending` 
        where product_id='$product_id'
    ";
$result_count=mysqli_query($connection,$get_count);
$rows_count=mysqli_num_rows($result_count);
echo $rows_count;
?>

        </td>
        <td><?php echo $date ?></td>
        <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product=<?php echo $product_id ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
    </tr>
<?php 
}
?>

</tbody>
</table>