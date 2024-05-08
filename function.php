<?php
include('includes/connect.php');
?>

<?php 
function clientGoogle(){
    // Lấy những giá trị này từ https://console.google.com
    $client_id = ''; // Client ID
    $client_secret = ''; // Client secret
    $redirect_uri = 'http://localhost/ainhadat%20Website/xulyGoogle.php'; // URL tại Authorised redirect URIs
    $client = new Google_Client();
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->addScope('email');
    $client->addScope('profile');
    return $client;

}

function checkThongTin($user_email) {
    global $connection;

    // Truy vấn để kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu dựa trên email
    $sql = "SELECT * FROM user_table WHERE user_email = ?";

    // Sử dụng Prepared Statement
    $statement = mysqli_prepare($connection, $sql);

    // Kiểm tra nếu Prepared Statement được tạo thành công
    if ($statement) {
        // Bind email vào Prepared Statement
        mysqli_stmt_bind_param($statement, "s", $user_email);

        // Thực thi truy vấn
        mysqli_stmt_execute($statement);

        // Lấy kết quả
        $result = mysqli_stmt_get_result($statement);

        // Kiểm tra số hàng kết quả trả về
        if (mysqli_num_rows($result) > 0) {
            // Trả về thông tin người dùng nếu tồn tại
            return mysqli_fetch_assoc($result);
        } else {
            // Trả về null nếu không tìm thấy người dùng
            return null;
        }

        // Đóng Prepared Statement
        mysqli_stmt_close($statement);
    } else {
        // Xử lý lỗi khi không thể tạo Prepared Statement
        echo "Error: Unable to prepare statement.";
    }
}


function insertUser($username, $token, $user_email, $user_image) {
    global $connection;
    // Chuẩn bị câu lệnh sử dụng Prepared Statement
    $insert_query = "INSERT INTO user_table (username, user_email, user_image, token) VALUES (?, ?, ?, ?)";

    // Tạo một Prepared Statement
    $statement = mysqli_prepare($connection, $insert_query);

    // Kiểm tra nếu Prepared Statement được tạo thành công
    if ($statement) {
        // Binds variables to a prepared statement as parameters
        mysqli_stmt_bind_param($statement, "ssss", $username, $user_email, $user_image, $token);

        // Thực thi câu lệnh Prepared Statement
        mysqli_stmt_execute($statement);

        // Đóng Prepared Statement
        mysqli_stmt_close($statement);
    } else {
        // Xử lý lỗi khi không thể tạo Prepared Statement
        echo "Error: Unable to prepare statement.";
    }
}

?>