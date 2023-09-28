<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';


if(isset($_POST['send'])){
    $response=array();
try{
    extract($_POST);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    $response=array("error"=>"Invalid Email Format.","status"=>true);
else{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Mailer="smtp";
    $mail->SMTPAuth=true;
    $mail->SMTPSecure="tls";
    $mail->Host="smtp.gmail.com";
    $mail->Port=587;
    $mail->Username="phonereserved7@gmail.com";
    $mail->Password="ukjxcwusoyutkiai";

    // sending data
  
    $messageBody=$issue;
    $fromName=$username;
    $fromEmail=$email;
    $subject ="Message From ".$fromName;


    $mail->addAddress("abdulrahmandev10@gmail.com","Abdulrahman");
    $mail->Subject=$subject;
    $mail->isHTML(true);                                                                       
    $mail->setFrom($fromEmail,$fromName);
$mail->Body="USER EMAIL :".$fromEmail."<br>Report Issue From Portal<br><br><hr>".$messageBody;
$mail->send();
$response=array("error"=>"","status"=>true,"response"=>"We Will Fix Your Issue as Soon as Possible😊. Plz Review Your Account With in 24hours");
}
   
}catch(Exception $ex){
    $response=array("status"=>true,"response"=> $ex->getMessage())
;
}
echo json_encode($response);



}





?>