<?php 
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];

    $get_categories="Select * from `categories` where category_id=$edit_category";
    $result=mysqli_query($connection,$get_categories);
    $row=mysqli_fetch_assoc($result);
    $category_title=$row['category_title'];
}

if(isset($_POST['edit_cat'])){
    $cat_title=$_POST['category_title'];

    $update_query=
        "
            update `categories` 
            set category_title='$cat_title' 
            where category_id=$edit_category
        ";
    $result_cat=mysqli_query($connection,$update_query);
    if($result_cat){
        echo "<script>alert('Loại hạng mục được cập nhật thành công!')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}

?>

<div class="container mt-3">
    <h1 class="text-center">SỬA LOẠI HẠNG MỤC</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Tiêu đề loại hạng mục</label>
            <input  type="text" 
                    name="category_title" 
                    id="category_title" 
                    value="<?php echo $category_title ?>"
                    class="form-control" 
                    required="required"
                >
        </div>

        <input  type="submit" 
                value="Cập nhật loại hạng mục" 
                class="btn btn-danger px-3 mb-3"
                name="edit_cat"
            >

    </form>
</div>