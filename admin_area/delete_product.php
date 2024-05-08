<?php 
if(isset($_GET['delete_product'])){
    $delete_id=$_GET['delete_product'];

    // Delete query
    $delete_product=
        "
            Delete from `products` 
            where product_id=$delete_id
        ";
    $result_product=mysqli_query($connection,$delete_product);
    if($result_product){
        echo "<script>alert('Xóa sản phẩm thành công!')</script>";
                echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}

?>