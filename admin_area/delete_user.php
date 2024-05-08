<?php 
if(isset($_GET['delete_user'])){
    $delete_user_id = $_GET['delete_user'];

    // Delete query
    $delete_query = 
    "
        DELETE FROM `user_table` 
        WHERE user_id = $delete_user_id
    ";
    $result_delete = mysqli_query($connection, $delete_query);

    // Kiểm tra và xử lý kết quả truy vấn xóa
    if($result_delete) {
        echo "Bản ghi đã được xóa thành công.";
    } else {
        echo "Lỗi trong quá trình xóa bản ghi: " . mysqli_error($connection);
    }
?>
    <!-- Hiển thị cảnh báo xác nhận trước khi xóa -->
    <script>
        if (confirm("Bạn có chắc chắn muốn xóa tài khoản người dùng này?")) {
            window.location.href = './index.php?list_users';
        } else {
            window.location.href = './index.php?list_users';
        }
    </script>
<?php
}
?>

