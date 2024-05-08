<h3 class="text-center">TẤT CẢ CÁC KHOẢN THANH TOÁN</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-danger text-light text-center">
        <tr>
            <th>SL no</th>
            <th>Số hóa đơn</th>
            <th>Số tiền</th>
            <th>Phương thức thanh toán</th>
            <th>Ngày đặt hàng</th>
            <th>Xóa</th>
        </tr>
    </thead>
<tbody class='bg-warning'>

<?php 
$get_payments=
    "
        Select * 
        from `user_payments`
    ";
$result=mysqli_query($connection,$get_payments);
$row_count=mysqli_num_rows($result);
if($row_count==0){
    echo "<h2 class='text-center text-danger mt-5'>Chưa nhận được khoản thanh toán nào</h2>";
} else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $amount=$row_data['amount'];
        $invoice_number=$row_data['invoice_number'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
        $number++;
?>
        <tr style='font-weight: 600;' class='text-center'>
                    <td><?php echo $number ?></td>
                    <td><?php echo $invoice_number ?></td>
                    <td><?php echo $amount ?> tỷ VND</td>
                    <td><?php echo $payment_mode ?></td>
                    <td><?php echo $date ?></td>
                    <td><a href='index.php?delete_payment=<?php echo $payment_id ?>' class='text-danger'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
<?php 
    }
}
?>

       
        
    </tbody>
</table>