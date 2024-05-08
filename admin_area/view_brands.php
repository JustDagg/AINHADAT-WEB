<style>
.btn-add-brand{
    float: right; 
    margin-bottom: 20px; 
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
}    

.btn-add-brand:hover {
    background-color: green;
}
</style>

<h3 class="text-center">TẤT CẢ ĐỊA ĐIỂM NHÀ ĐẤT BÁN TẠI HÀ NỘI</h3>

<button class="btn-add-brand">
    <a style="text-decoration: none; color: white; font-size: 18px;" href='index.php?insert_brand'>
        <i class="fa-regular fa-plus"></i> Thêm địa điểm
    </a>
</button>

<table class="table table-bordered mt-5">
    <thead class="bg-danger text-center text-light">
        <tr>
            <th>SL no</th>
            <th>Tiêu đề địa điểm nhà đất bán tại Hà Nội</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody style="font-weight: 600;" class="bg-warning">

<?php 
$select_cat=
    "
        Select * 
        from `brands`
    ";
$result=mysqli_query($connection,$select_cat);
$number=0;
while($row=mysqli_fetch_assoc($result)){
    $brand_id=$row['brand_id'];
    $brand_title=$row['brand_title'];
    $number++;
?>

        <tr class="text-center">
            <td><?php echo $number ?></td>
            <td><?php echo $brand_title ?></td>
            <td><a href='index.php?edit_brands=<?php echo $brand_id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_brands=<?php echo $brand_id ?>' type="button" class="text-danger"><i class='fa-solid fa-trash'></i></a></td>
        </tr>

<?php 
}
?>

    </tbody>
</table>
