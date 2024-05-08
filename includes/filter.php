<form method="get" action="filterminmax_product.php" class="row justify-content-end align-items-end">
    <div class="col-md-3">
        <div class="mb-5">
            <label style="font-weight: 700; font-size: 20px;" for="min_price" class="form-label">Giá tối thiểu (tỷ VND):</label>
            <input style="padding: 10px;" type="number" class="form-control" id="min_price" name="min_price" placeholder="Nhập giá tối thiểu">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-5">
            <label style="font-weight: 700; font-size: 20px;" for="max_price" class="form-label">Giá tối đa (tỷ VND):</label>
            <input style="padding: 10px;" type="number" class="form-control" id="max_price" name="max_price" placeholder="Nhập giá tối đa">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <button style="font-weight: 700; font-size: 20px;" type="submit" class="btn btn-info text-light w-100" name="filter_min_max"><i class="fa-solid fa-filter"></i> Lọc</button>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-5">
            <button style="font-weight: 700; font-size: 20px;" type="button" id="refreshFilter" class="btn btn-secondary w-100"><i class="fas fa-sync-alt"></i> Làm mới</button>
        </div>  
    </div>
</form>