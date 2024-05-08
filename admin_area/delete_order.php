<?php 
if(isset($_GET['delete_order'])){
    $delete_order=$_GET['delete_order'];

    $delete_query=
        "
            Delete from `user_orders` 
            where order_id=$delete_order
        ";
    $result=mysqli_query($connection,$delete_query);
    if($result){
        echo "<script>alert('Đơn đặt hàng đã được xóa thành công!')</script>";
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
    }

}
?>