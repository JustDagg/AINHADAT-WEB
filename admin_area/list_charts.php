<?php
 
global $connection;

 // Đếm số lượng người dùng
$user_count_query = "SELECT COUNT(*) AS user_count FROM user_table";
$user_count_result = mysqli_query($connection, $user_count_query);
$user_count_row = mysqli_fetch_assoc($user_count_result);
$user_count = $user_count_row['user_count'];
 
 // Đếm số lượng sản phẩm
$product_count_query = "SELECT COUNT(*) AS product_count FROM products";
$product_count_result = mysqli_query($connection, $product_count_query);
$product_count_row = mysqli_fetch_assoc($product_count_result);
$product_count = $product_count_row['product_count'];

// Đếm số lượng địa điểm nhà đất 
$brand_count_query = "SELECT COUNT(*) AS brand_count FROM brands";
$brand_count_result = mysqli_query($connection, $brand_count_query);
$brand_count_row = mysqli_fetch_assoc($brand_count_result);
$brand_count = $brand_count_row['brand_count'];

// Đếm số lượng hạng mục bất động sản
$category_count_query = "SELECT COUNT(*) AS category_count FROM categories";
$category_count_result = mysqli_query($connection, $category_count_query);
$category_count_row = mysqli_fetch_assoc($category_count_result);
$category_count = $category_count_row['category_count'];

 
 // Tạo mảng $dataPoints
$dataPoints = array(
    array("label"=> "Người dùng", "y"=> $user_count),
    array("label"=> "Sản phẩm", "y"=> $product_count),
    array("label"=> "Địa điểm nhà đất", "y"=> $brand_count),
    array("label"=> "Hạng mục bất động sản", "y"=> $category_count)
 );


	
?>

<div id="chartContainer" style="height: 500px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "SỐ LIỆU THỐNG KÊ"
	},
	axisY: {
		title: "Thống kê số lượng"
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>