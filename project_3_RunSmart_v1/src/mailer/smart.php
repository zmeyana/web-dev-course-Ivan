<?php 

$name = $_POST['name']; // здесь используем атрибут "name", который исп. в инпутах
$phone = $_POST['phone'];
$email = $_POST['email'];

require_once('phpmailer/PHPMailerAutoload.php');
$ini = parse_ini_file('config.ini');

$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                            // Enable verbose debug output

$mail->isSMTP();                                    // Set mailer to use SMTP
$mail->Host = $ini['smtp_host'];  					// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                             // Enable SMTP authentication
$mail->Username = $ini['smtp_username'];            // Наш логин
$mail->Password = $ini['smtp_password'];            // Наш пароль от приложения
$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
$mail->Port = $ini['smtp_port'];                    // TCP port to connect to
 
$mail->setFrom($ini['smtp_username'], 'Pulse');   // От кого письмо 
$mail->addAddress($ini['smtp_username']);     // Add a recipient куда будет приходить письмо
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Данные';
$mail->Body    = ' 
		Пользователь оставил данные <br> 
	Имя: ' . $name . ' <br>
	Номер телефона: ' . $phone . '<br>
	E-mail: ' . $email . '';
 //это был синтаксис php. В php точка - это склеивание строк.

if(!$mail->send()) {
    return false;
} else {
    return true;
}

?>