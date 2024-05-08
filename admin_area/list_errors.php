<h3 class="text-center">DANH SÁCH BÁO LỖI</h3>

<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light text-center">
        <tr>
            <th>SL no</th>
            <th>Nội dung</th>
            <th>Tên người dùng</th>
            <th>Số điện thoại</th>
        </tr>
    </thead>
<tbody class='bg-warning'>

<?php 
$get_errors=
    "
        Select * 
        from `user_error` order by error_id desc
    ";
$result=mysqli_query($connection,$get_errors);
$row_count=mysqli_num_rows($result);
if($row_count==0){
    echo "<h2 class='text-center text-danger mt-5'>Chưa có phản hồi về báo lỗi</h2>";
} else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $error_id=$row_data['error_id'];
        $error_title=$row_data['error_title'];
        $error_username=$row_data['error_username'];
        $error_mobile=$row_data['error_mobile'];
        $number++;
?>
        <tr style='font-weight: 600;' class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $error_title ?></td>
                    <td><?php echo $error_username ?></td>
                    <td><?php echo $error_mobile ?></td>
        </tr>
<?php 
    }
}
?>

       
        
    </tbody>
</table>