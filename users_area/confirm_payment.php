<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];

    $select_data=
        "
            Select * 
            from `user_orders` 
            where order_id=$order_id
        ";
    $result=mysqli_query($connection,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query=
        "
            insert into `user_payments` (order_id,  invoice_number,  amount,    payment_mode   ) 
            values                      ($order_id, $invoice_number, $amount,   '$payment_mode')
        ";
    $result=mysqli_query($connection,$insert_query);
    if($result){
        echo "<h3 class='text-center text-light'>Hoàn tất thanh toán thành công!</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders=
        "
            update `user_orders` 
            set order_status='Complete' 
            where order_id=$order_id
        ";
    $result_orders=mysqli_query($connection,$update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANG XÁC NHẬN THANH TOÁN</title>

    <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

</head>
<body class="bg-dark">
    <h1 class="text-center text-light">XÁC NHẬN THANH TOÁN</h1>
    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center text-light">
                <label for="">Số tiền: </label> <i>( tỷ VND )</i>
                <input type="text" class="form-control w-50 m-auto" name="amount"
                    value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Lựa chọn phương thức thanh toán:</option>
                    <option>Paypal</option>
                    <option>Momo</option>
                    <option>Pay Offline (LH:0123456789)</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center text-light">
                <input type="submit" class="bg-primary py-2 px-3 border-0 text-light" value="Xác nhận thanh toán" name="confirm_payment">
            </div>
        </form>
    </div>
</body>
</html>

