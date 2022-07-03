<?php
    include "connect.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $email = $_POST['email'];
    $query = 'SELECT * FROM `user` WHERE `email` = "'.$email.'"';
    $data = mysqli_query($conn, $query);
    $result = array();
    while ($row = mysqli_fetch_assoc($data)) {
        $result[] = ($row);
        // code...
    }
    if(empty($result)){
        $arr = [
            'success' => false,
            'message' => " Mail không chính xác",
            'result' => $result
        ];
    }else{
        $email=($result[0]['email']);
        $password=($result[0]['password']);
        $link="<a href='https://192.168.1.7/banhang/reset_pass.php?key=".$email."&reset=".$password."'>Click To Reset password</a>";

        $mail = new PHPMailer();
        $mail->CharSet =  "utf-8";
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;                  
        // GMAIL username
        $mail->Username = "truong1999er@gmail.com";
        // GMAIL password
        $mail->Password = "Phantruong24699@"; //pass cua mail line 36
        $mail->SMTPSecure = "ssl";  
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = "465";
        $mail->From = "truong1999er@gmail.com"; //mail nguoi nhan
        $mail->FromName='App bán hàng';
        $mail->AddAddress($email, 'reciever_name');
        $mail->Subject  =  'Reset Password';
        $mail->IsHTML(true);
        $mail->Body    = $link;
        if($mail->Send())
        {
        	$arr = [
                'success' => true,
                'message' => "Vui lòng kiểm tra mail",
                'result' => $result
            ];
        }
        else
        {
        	$arr = [
                'success' => false,
                'message' => "Gửi yêu cầu về mail không thành công",
                'result' => $mail->ErrorInfo
            ];
        }

    }
    print_r(json_encode($arr));

?>