<?php 

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$email = $_POST['email'];
$city = $_POST['city'];
$street = $_POST['street'];

$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'zendarolll@gmail.com'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'flatronezt717b'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('info@e-home.kz'); // от кого будет уходить письмо?
$mail->addAddress($email);     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', '');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Форма обратной связи Контакты';
$body = '' .$email . ' оставил заявку, его телефон ' .$city. '<br>' .$street. '<br>Почта этого пользователя: ' .$email;
$mail->Body    = $body;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Error';
} else {
   echo 'Отправленно';
}
?>