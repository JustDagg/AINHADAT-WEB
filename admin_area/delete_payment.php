<?php 
if(isset($_GET['delete_payment'])){
    $delete_payment=$_GET['delete_payment'];

    $delete_query=
        "
            Delete from `user_payments` 
            where payment_id=$delete_payment
        ";
    $result=mysqli_query($connection,$delete_query);
    if($result){
        echo "<script>alert('Thanh toán đã được xóa thành công!')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')</script>";
    }

}
?>