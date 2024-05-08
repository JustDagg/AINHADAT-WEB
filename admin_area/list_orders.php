<h3 class="text-center">TẤT CẢ ĐƠN HÀNG</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light text-center">
        <tr>
            <th>SL no</th>
            <th>Tên người dùng</th>
            <th>Địa chỉ</th>
            <th>Số tiền</th>
            <th>Số hóa đơn</th>
            <th>Tổng sản phẩm</th>
            <th>Ngày đặt đơn hàng</th>
            <th>Tình trạng</th>
            <th>Xóa</th>
        </tr>
    </thead>
<tbody class='bg-warning'>

<?php 
// đếm số lần đặt hàng
$count_orders_query = 
    "
        SELECT COUNT(*) AS order_count
        FROM user_orders
        WHERE user_id = (
            SELECT user_id
            FROM (
                SELECT user_id, SUM(total_products) AS total_products_bought
                FROM user_orders
                GROUP BY user_id
                ORDER BY total_products_bought DESC
                LIMIT 1
            ) AS top_buyer
        )
    ";
$result_count_orders = mysqli_query($connection, $count_orders_query);
$row_count_orders = mysqli_fetch_assoc($result_count_orders);
$order_count = $row_count_orders['order_count'];

// người dùng đặt hàng nhiều nhất
$get_top_buyer_query = 
    "
        SELECT u.username, SUM(o.total_products) AS total_products_bought
        FROM user_orders AS o
        INNER JOIN user_table AS u ON o.user_id = u.user_id
        GROUP BY o.user_id
        ORDER BY total_products_bought DESC
        LIMIT 1
    ";
$result_top_buyer = mysqli_query($connection, $get_top_buyer_query);
$row_top_buyer = mysqli_fetch_assoc($result_top_buyer);
$top_buyer_username = $row_top_buyer['username'];
$top_buyer_total_products = $row_top_buyer['total_products_bought'];
echo "<h4 style='font-weight:700; margin-top:25px;'>Khách hàng đặt hàng nhiều nhất: <u style='color: blue;'><i class='fa-regular fa-star'></i>$top_buyer_username ($order_count lần)</u></h4>";

// hiển thị bảng đặt hàng
$get_orders=
    "
        SELECT uo.*, u.username, u.user_address
        FROM user_orders uo
        INNER JOIN user_table u ON uo.user_id = u.user_id
    ";
$result=mysqli_query($connection,$get_orders);
$row_count=mysqli_num_rows($result);
if($row_count==0){
    echo "<h2 class='text-center text-danger mt-5'>Chưa có đơn đặt hàng nào</h2>";
} else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $username=$row_data['username'];
        $user_address=$row_data['user_address'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
        $number++;
?>
        <tr style='font-weight: 600;' class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $username ?></td>
                    <td><?php echo $user_address ?></td>
                    <td><?php echo $amount_due ?> tỷ VND</td>
                    <td><?php echo $invoice_number ?></td>
                    <td><?php echo $total_products ?></td>
                    <td><?php echo $order_date ?></td>
                    <td><?php echo $order_status ?></td>
                    <td><a href='index.php?delete_order=<?php echo $order_id ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
<?php 
    }
}
?>

       
        
    </tbody>
</table>