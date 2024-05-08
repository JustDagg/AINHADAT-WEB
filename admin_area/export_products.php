<?php 
include('../includes/connect.php');
// Filter the excel data
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

// Excel file name for download 
$fileName = "products-data_" . date('Y-m-d') . ".xls"; 

// Column names
$fields = array('"ID"', '"TIÊU ĐỀ"', '"ĐỊA ĐIỂM"', '"LOẠI HẠNG MỤC"', '"GIÁ BÁN NHÀ ĐẤT"', '"KÍCH THƯỚC"', '"NGÀY TẠO"');

// Display column names as first row 
$excelData = implode("|", array_values($fields)) . "\n"; 

// Fetch records from DB
$query = $connection->query(
    "
        SELECT products.*, brands.brand_title, categories.category_title
        FROM products
        JOIN brands ON products.brand_id = brands.brand_id
        JOIN categories ON products.category_id = categories.category_id
    "
    );
if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $lineData = array($row['product_id'], $row['product_title'], $row['brand_title'], $row['category_title'], $row['product_price'], $row['product_land_size'], $row['date']);
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("|", array_values($lineData)) . "\n"; 
    }
} else {
    $excelData .= 'No records found...'. "\n";
}

// Headers for excel download
header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
header("Content-Disposition: attachment; filename=\"$fileName\"");
echo "\xEF\xBB\xBF"; // UTF-8 BOM

// Output Excel data
echo $excelData;

exit();
?>
