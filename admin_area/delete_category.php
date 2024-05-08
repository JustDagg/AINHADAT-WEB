<?php 
if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category'];

    $delete_query=
        "
            Delete from `categories` 
            where category_id=$delete_category
        ";
    $result=mysqli_query($connection,$delete_query);
    if($result){
        echo "<script>alert('Loại hạng mục đã được xóa thành công!')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }

}
?>