<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['message'];


        require "PHPMailer/PHPMailer.php";
        require "PHPMailer/SMTP.php";
        require "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "no.reply.msrtech@gmail.com"; //enter you email address
        $mail->Password = 'mtdtxohelulakihq'; //enter you email password
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress("msreed3@outlook.com"); //enter you email address
        $mail->Subject = ("$email ($subject)");
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        setTimeout(function () {
            window.location.href= 'https://techsolutions-msr.com'; // the redirect goes here
        },5000); // 5 seconds

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
