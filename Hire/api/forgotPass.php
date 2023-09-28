<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
include '../connections/conn.php';




class ForgotPass extends Connections{
    public static function update($email,$pass){
        $response=array();
        $sql = "UPDATE users set  Password='$pass' WHERE Email='$email';";
        $ForgotPass = new ForgotPass();
        $result = $ForgotPass->connect()->query($sql);
        if ($result) {
    
            $response = array("error" => "", "response" => "Your Security Info Has Been Changed Successfully");
        }
        echo json_encode($response);
    }
    public static function check($email){
        $response=array();
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $response=array("error"=>"Invalid Email Format.","status"=>true);
        else{
            $sql = "select *from users WHERE Email='$email';";
            $ForgotPass = new ForgotPass();
            $result = $ForgotPass->connect()->query($sql);
            if ($result) {
                if(mysqli_num_rows($result)>0)
                     $response = array("valid" => true,"error"=>"");
          
                 else
                     $response = array("valid" => false,"error"=>"", "response" => "Incorrect Email Address, This Email Does Not Exist.");
            }
        }
       
        echo json_encode($response);
    }
    
    public static function send($email){
        try{
            
            $response=array();
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
        
            $randNumber=rand(1000,9999);
            // sending data
          
            $messageBody="
            <h1>OTP VERIFICATION CODE</h1>
            <hr/>
            <p>Here is your verification code use this 4 digit code to reset your password
            </p>
            <br>
            <strong>$randNumber</strong>
    
            ";
          
            $fromEmail="abdulrahmandev10@gmail.com";
            
        
            $mail->addAddress($email,"HireMe App User");
            $mail->Subject="Reset Your Password";
            $mail->isHTML(true);                                                                       
            $mail->setFrom($fromEmail,"ENG-CJ | Main Admin");
        $mail->Body=$messageBody;
        $mail->send();
        $response=array("error"=>"","status"=>true,"response"=>"We'll Send an email to this email address. use the OTP Code to reset your passcode","code"=>$randNumber);
        }
           
        }catch(Exception $ex){
            $response=array("status"=>true,"response"=> $ex->getMessage())
        ;
        }
        echo json_encode($response);
    }
}

if(isset($_POST['sendOTP'])){
    extract($_POST);
    ForgotPass::send($_POST['email']);
}
if(isset($_POST['updatePass'])){
    extract($_POST);
    ForgotPass::update($_POST['email'],$_POST['pass']);
}
if(isset($_POST['check'])){
    extract($_POST);
    ForgotPass::check($_POST['email']);
}
