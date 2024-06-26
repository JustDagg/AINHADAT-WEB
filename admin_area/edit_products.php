<?php 
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_data=
        "
            Select * 
            from `products` 
            where product_id=$edit_id
        ";
    $result=mysqli_query($connection,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    // Thêm ký tự xuống dòng \n vào nơi bạn muốn xuống dòng
    $description_with_newline = nl2br($product_description);
    $product_keywords=$row['product_keywords'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    $product_image1=$row['product_image1'];
    $product_image2=$row['product_image2'];
    $product_image3=$row['product_image3'];
    $product_price=$row['product_price'];

    // Fetching category name
    $select_category=
        "
            Select * 
            from `categories` 
            where category_id=$category_id
        ";
    $result_category=mysqli_query($connection,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];

    // Fetching brand name
    $select_brand=
        "
            Select * 
            from `brands` 
            where brand_id=$brand_id
        ";
    $result_brand=mysqli_query($connection,$select_brand);
    $row_brand=mysqli_fetch_assoc($result_brand);
    $brand_title=$row_brand['brand_title'];

}
?>

<div class="container mt-5">
    <h1 class="text-center">SỬA NHÀ ĐẤT BÁN</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Tiêu đề sản phẩm</label>
            <input  type="text" 
                    id="product_title" 
                    value="<?php echo $product_title ?>"
                    name="product_title" 
                    class="form-control" 
                    required="required"
                >
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_desc" class="form-label">Mô tả sản phẩm</label>
            <textarea id="product_desc" name="product_desc" class="form-control" required="required">
                <?php echo $product_description ?>
            </textarea>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Từ khóa sản phẩm</label>
            <input  type="text" 
                    id="product_keywords" 
                    value="<?php echo $product_keywords ?>"
                    name="product_keywords" 
                    class="form-control" 
                    required="required"
                >
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Loại hạng mục sản phẩm</label> 
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title ?>"><?php echo $category_title ?></option>
                
<?php 
$select_category_all=
    "
        Select * 
        from `categories` 
    ";
$result_category_all=mysqli_query($connection,$select_category_all);
while($row_category_all=mysqli_fetch_assoc($result_category_all)){
    $category_title=$row_category_all['category_title'];
    $category_id=$row_category_all['category_id'];
    echo "<option value='$category_id'>$category_title</option>";
};
?>

            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_brands" class="form-label">Địa điểm bán đất tại Hà Nội</label> 
            <select name="product_brands" class="form-select">
                <option value="<?php echo $brand_title ?>"><?php echo $brand_title ?></option>
 
<?php 
$select_brand_all=
    "
        Select * 
        from `brands` 
    ";
$result_brand_all=mysqli_query($connection,$select_brand_all);
while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
    $brand_title=$row_brand_all['brand_title'];
    $brand_id=$row_brand_all['brand_id'];
    echo "<option value='$brand_id'>$brand_title</option>";
};
?>

            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Ảnh sản phẩm 1</label>
            <div class="d-flex">
                <input  type="file" 
                        id="product_image1" 
                        name="product_image1" 
                        class="form-control w-90 m-auto" 
                        required="required"
                    >
                <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Ảnh sản phẩm 2</label>
            <div class="d-flex">
                <input  type="file" 
                        id="product_image2" 
                        name="product_image2" 
                        class="form-control w-90 m-auto" 
                        required="required"
                    >
                <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Ảnh sản phẩm 3</label>
            <div class="d-flex">
                <input  type="file" 
                        id="product_image3" 
                        name="product_image3" 
                        class="form-control w-90 m-auto" 
                        required="required"
                    >
                <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="product_img">
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Giá sản phẩm</label>
            <input  type="text" 
                    id="product_price" 
                    value="<?php echo $product_price ?>"
                    name="product_price" 
                    class="form-control" 
                    required="required"
                >
            <span>(đơn vị tỷ VND)</span>
        </div>

        <div class="text-center">
            <input type="submit" name="edit_product" value="Cập nhật sản phẩm" class="btn btn-danger px-3 mb-3">
        </div>

    </form>
</div>

<!-- Editing products -->
<?php
if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_keywords=$_POST['product_keywords'];
    $product_category=$_POST['product_category'];
    $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];

    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    // Checking for fields empty or not
    if( $product_title=='' or 
        $product_desc=='' or 
        $product_keywords=='' or 
        $product_category=='' or
        $product_brands=='' or
        $product_image1=='' or
        $product_image2=='' or
        $product_image3=='' or
        $product_price==''
    ){
        echo "<script>alert('Vui lòng điền vào tất cả các mục!')</script>";
    } else{
        move_uploaded_file($temp_image1,"./product_images/$product_image1");
        move_uploaded_file($temp_image2,"./product_images/$product_image2");
        move_uploaded_file($temp_image3,"./product_images/$product_image3");

        // Query to update products
        $update_product=
            "
                update `products` 
                set product_title='$product_title',
                    product_description='$product_desc',
                    product_keywords='$product_keywords',
                    category_id='$product_category', 
                    brand_id='$product_brands',
                    product_image1='$product_image1',
                    product_image2='$product_image2',
                    product_image3='$product_image3',
                    product_price='$product_price',
                    date=NOW()
                where product_id=$edit_id
            ";
            $result_update=mysqli_query($connection,$update_product);
            if($result_update){
                echo "<script>alert('Sản phẩm được cập nhật thành công!')</script>";
                echo "<script>window.open('./index.php?view_products','_self')</script>";
            }
    }

}
?>