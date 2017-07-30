<?php
require 'phpmailer/PHPMailerAutoload.php';

$name=$_POST['name']; 

$email=$_POST['email'];

$msg=$_POST['message'];

$date=date("d.m.y"); // число.месяц.год 
 
$time=date("H:i"); // часы:минуты:секунды 
 
$backurl="../../index.html";  // На какую страничку переходит после отправки письма 

$msg=" 
 
 
<p>Name: $name</p> 
 
 
<p>E-mail: $email</p> 
 
 
<p>Message: $msg</p> 
 
 
"; 
// Проверяем валидность e-mail 
 
if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", 
strtolower($email))) 
 
 { 
 
  echo 
"<center>Incorrect data !!!! <a 
href='javascript:history.back(1)'><B>Back</B></a>. You enter incorect data, please re-enter it"; 
 
  } 
 
 else 
 
 { 
$mail = new PHPMailer;

$mail->SMTPDebug = false;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'avboris28@gmail.com';                 // SMTP username
$mail->Password = 'zx522794zx';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('avboris28@gmail.com.com', 'Mailer');
$mail->addAddress('avborik28@gmail.com', 'Boris');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $name;
$mail->Body    = $msg;
$mail->AltBody = 'ALT';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
// Saving part
$f = fopen("message.txt", "a+"); 
 
fwrite($f," \n $date $time Message from $name"); 
 
fwrite($f,"\n $msg "); 
 
fwrite($f,"\n ---------------"); 
 
fclose($f); 
 
// Выводим сообщение пользователю 
 
print "<script language='Javascript'><!-- 
function reload() {location = \"$backurl\"}; setTimeout('reload()', 6000); 
//--></script> 
 
$msg 
 
<p>Message saved! Please wait, you will be redirect on main page...</p>";  
exit; 
 } 
?>