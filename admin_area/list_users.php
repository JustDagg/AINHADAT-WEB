<style>
.btn-add-user{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    font-size: 20px;
    margin-right: 10px;
}    

.btn-add-user:hover {
    background-color: green;
}

.btn-refresh-user{
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
    font-size: 20px;
}

.btn-refresh-user:hover {
    background-color: green;
}

</style>


<h3 class="text-center">DANH SÁCH NGƯỜI DÙNG</h3>

<div style="display: flex; justify-content: flex-end; margin-top: 35px;">
    <!-- Search -->
    <form action="../admin_area/search_user.php" method="get" class="d-flex" style="margin-right: 10px;">
        <input style="width: 550px; font-size: 18px;" class="form-control me-2" 
                type="search" 
                placeholder="Nhập tên người dùng tìm kiếm" 
                name="search_admin_user_data" 
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
                name="search_admin_data_user">
    </form>

    <!-- Add User -->
    <button class="btn-add-user">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='index.php?insert_users'>
            <i class="fa-regular fa-plus"></i> Thêm người dùng
        </a>
    </button>

    <!-- Refresh -->
    <button class="btn-refresh-user" type="button" id="refreshFilter" class="btn btn-secondary" style="margin-right: 10px;">
        <a style="text-decoration: none; color: white; font-size: 16px;" href='index.php?list_users'>
            <i class="fas fa-sync-alt"></i> Làm mới
        </a>
    </button>

</div>


<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light text-center">
        <tr>
            <th>SL no</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Ảnh người dùng</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Xóa</th>
        </tr>
    </thead>
<tbody class='bg-warning'>

<?php 
$get_users=
    "
        Select * 
        from `user_table` order by user_id desc
    ";
$result=mysqli_query($connection,$get_users);
$row_count=mysqli_num_rows($result);
if($row_count==0){
    echo "<h2 class='text-center text-danger mt-5'>No users yet</h2>";
} else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_email=$row_data['user_email'];
        $user_image=$row_data['user_image'];
        $user_address=$row_data['user_address'];
        $user_mobile=$row_data['user_mobile'];
        $number++;
?>
        <tr style='font-weight: 600;' class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $username ?></td>
                    <td><?php echo $user_email ?></td>
                    <td><img class="product_img" src="../users_area/user_images/<?php echo $user_image ?>" alt="<?php echo $username ?>"></td>
                    <td><?php echo $user_address ?></td>
                    <td><?php echo $user_mobile ?></td>
                    <td><a href='index.php?delete_user=<?php echo $user_id ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
<?php 
    }
}
?>

       
        
    </tbody>
</table>