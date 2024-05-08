<?php 
if(isset($_GET['edit_brands'])){
    $edit_brand=$_GET['edit_brands'];

    $get_brands="Select * from `brands` where brand_id=$edit_brand";
    $result=mysqli_query($connection,$get_brands);
    $row=mysqli_fetch_assoc($result);
    $brand_title=$row['brand_title'];
}

if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];

    $update_query=
        "
            update `brands` 
            set brand_title='$brand_title' 
            where brand_id=$edit_brand
        ";
    $result_brand=mysqli_query($connection,$update_query);
    if($result_brand){
        echo "<script>alert('Địa điểm nhà đất tại Hà Nội đã được cập nhật thành công!')</script>";
        echo "<script>window.open('./index.php?view_brand','_self')</script>";
    }
}

?>

<div class="container mt-3">
    <h1 class="text-center">SỬA ĐỊA ĐIỂM NHÀ ĐẤT BÁN TẠI HÀ NỘI</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Tiêu đề địa điểm nhà đất bán tại Hà Nội</label>
            <input  type="text" 
                    name="brand_title" 
                    id="brand_title" 
                    value="<?php echo $brand_title ?>"
                    class="form-control" 
                    required="required"
                >
        </div>

        <input  type="submit" 
                value="Cập nhật địa điểm" 
                class="btn btn-danger px-3 mb-3"
                name="edit_brand"
            >

    </form>
</div>