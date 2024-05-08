<style>
.btn-refresh-admin{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    font-size: 20px;
}

.btn-refresh-admin:hover {
    background-color: green;
}
</style>


<h3 class="text-center">DANH SÁCH ADMIN</h3>

<div style="display: flex; justify-content: flex-end; margin-top: 35px;">
    <!-- Search -->
    <form action="../admin_area/search_admin.php" method="get" class="d-flex" style="margin-right: 10px;">
        <input style="width: 700px; font-size: 18px;" class="form-control me-2" 
                type="search" 
                placeholder="Nhập tên admin tìm kiếm" 
                name="search_admin_name_data" 
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
                name="search_data_admin_name">
    </form>

    <!-- Refresh -->
    <button class="btn-refresh-admin" type="button" id="refreshFilter" class="btn btn-secondary" style="margin-right: 10px;">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='index.php?list_admins'>
            <i class="fas fa-sync-alt"></i> Làm mới
        </a>
    </button>

</div>

<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light text-center">
        <tr>
            <th>SL no</th>
            <th>Tên</th>
            <th>Email</th>
        </tr>
    </thead>
<tbody class='bg-warning'>

<?php 
$get_payments=
    "
        Select * 
        from `admin_table`
    ";
$result=mysqli_query($connection,$get_payments);
$row_count=mysqli_num_rows($result);
if($row_count==0){
    echo "<h2 class='text-center text-danger mt-5'>Chưa có tài khoản Admin nào</h2>";
} else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $admin_id=$row_data['admin_id'];
        $admin_name=$row_data['admin_name'];
        $admin_email=$row_data['admin_email'];
        $number++;
?>
        <tr style='font-weight: 600;' class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $admin_name ?></td>
                    <td><?php echo $admin_email ?></td>
        </tr>
<?php 
    }
}
?>

       
        
    </tbody>
</table>
<div style="font-weight: 700;">
<i>Warning: chỉ có quyền Admin mới được xem thông tin trong trang này!</i>
</div>