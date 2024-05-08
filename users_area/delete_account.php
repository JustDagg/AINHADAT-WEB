<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XÓA TÀI KHOẢN</title>
</head>
<body>
    <h3 class="mb-4">XÓA TÀI KHOẢN</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input style="font-weight: 700; font-size: 20px;" type="submit" class="form-control w-50 m-auto text-danger" name="delete" value="Xóa tài khoản">
            
        </div>
        <div class="form-outline mb-5">
            <input style="font-weight: 700; font-size: 20px;" type="submit" class="form-control w-50 m-auto text-success" name="dont_delete" value="Không xóa tài khoản">
        </div>
    </form>
</body>
</html>

<?php 
$username_session=$_SESSION['username'];
if(isset($_POST['delete'])){
    $delete_query=
        "
            Delete from `user_table` 
            where username='$username_session'
        ";
    $result=mysqli_query($connection,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('Đã xóa tài khoản thành công!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";
}

?>