<style>
    .btn-outline-dark:hover {
        background-color: #31D2F2; 
        color: #fff; 
        font-weight: bold;
        border: 2px solid red;
    }
</style>

<form class="d-flex" action="search_product.php" method="get">
        <input style="width: 350px; font-size: 17px;" class="form-control me-2" 
                type="search" 
                placeholder="Nhập từ khóa hoặc địa điểm tìm kiếm" 
                name="search_data" 
                aria-label="Search">
        <input style="width: 150px; font-size: 17px;" type="submit" 
                value="Tìm kiếm" 
                class="btn btn-outline-dark" 
                name="search_data_product">
      </form>