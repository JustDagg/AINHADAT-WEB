<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title=$_POST['cat_title'];

    // select data from database
    $select_query=
        "
            Select * 
            from `categories` 
            where category_title='$category_title'
        ";
    $result_select=mysqli_query($connection,$select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('Loại này đã tồn tại bên trong cơ sở dữ liệu!')</script>";
    } else {
    $insert_query=
        "
            insert into `categories` (category_title) 
            values                   ('$category_title')
        ";
    $result=mysqli_query($connection,$insert_query);
    if($result){
        echo "<script>alert('Loại hạng mục đã được thêm thành công!')</script>";
    }
}}

?>
<h2 class="text-center">THÊM LOẠI HẠNG MỤC</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-danger" id="basic-addon1">
            <i class="fa-solid fa-receipt text-light">

            </i>
        </span>
        <input type="text" class="form-control" 
                name="cat_title" 
                placeholder="Thêm loại hạng mục" 
                aria-label="Categories" 
                aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" 
                class="bg-danger border-0 p-2 my-3 text-light" 
                name="insert_cat" 
                value="Thêm loại hạng mục">
    </div>
</form>