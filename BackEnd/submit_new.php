<?php
include "connect.php";

if(isset($_POST['submit_password']) && $_POST['email'])
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query = "update user set password = '$password' where email = '$email'";
    $data = mysqli_query($conn, $query);

    if($data == true)
    {
        echo "Đổi mật khẩu thành công";
    }
}
?>