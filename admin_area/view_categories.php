<style>
.btn-add-category{
    float: right; 
    margin-bottom: 20px; 
    background-color: seagreen; 
    border: none; 
    padding: 10px 15px; 
    border-radius: 5px;
}    

.btn-add-category:hover {
    background-color: green;
}
</style>

<h3 class="text-center">TẤT CẢ LOẠI HẠNG MỤC NHÀ ĐẤT BÁN</h3>

<button class="btn-add-category">
    <a style="text-decoration: none; color: white; font-size: 18px;" href='index.php?insert_category'>
        <i class="fa-regular fa-plus"></i> Thêm loại hạng mục
    </a>
</button>

<table class="table table-bordered mt-5">
    <thead class="bg-danger text-center text-light">
        <tr>
            <th>SL no</th>
            <th>Tiêu đề loại hạng mục</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody style="font-weight: 600;" class="bg-warning">

<?php 
$select_cat=
    "
        Select * 
        from `categories`
    ";
$result=mysqli_query($connection,$select_cat);
$number=0;
while($row=mysqli_fetch_assoc($result)){
    $category_id=$row['category_id'];
    $category_title=$row['category_title'];
    $number++;
?>

        <tr class="text-center">
            <td><?php echo $number ?></td>
            <td><?php echo $category_title ?></td>
            <td><a href='index.php?edit_category=<?php echo $category_id ?>' class='text-success'><i class='fa-solid fa-pen-to-square'></i></a></td>
            <td><a href='index.php?delete_category=<?php echo $category_id ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
        </tr>

<?php 
}
?>

    </tbody>
</table>
