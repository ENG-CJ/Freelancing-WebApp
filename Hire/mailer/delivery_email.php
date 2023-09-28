



<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

class Mail
{

    private string $fullName;
    private string $type;
    private string $receiverEmail;
    private string $message;
    private string $error;


    public function setFullName($name)
    {
        $this->fullName = $name;
        return $this;
    }
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    public function setReceiverEmail($email)
    {
        $this->receiverEmail = $email;
        return $this;
    }
    public function setMessageContent($message)
    {
        $this->message = $message;
        return $this;
    }
    public function getFullName()
    {

        return $this->fullName;
    }
    public function getType()
    {

        return $this->type;
    }
    public function getReceiverEmail()
    {

        return $this->receiverEmail;
    }
    public function getMessageContent()
    {

        return $this->message;
    }
    public function getError()
    {

        return $this->error;
    }


    // rough function

    public function isConfirmed(): bool | string | array
    {

        $sqlAction = "SELECT *FROM subscribers where SUBSCRIBER_CODE=''";
        $resultAction = "";
        $response = array();
        if ($resultAction) {
            $response = array("status" => true, "code" => "200", "response" => [
                "message" => "All Email Was proceeded",
                "area_code" => 109191010,
                "PIP ID " => "P91010101",
                "UserEmail" => "abdulrahmandev10@gmail.com",
                "BusinessEmail" => "HirApp@gmail.com",
                'codeID'=>"GEN-ID-CODE".rand(1000,9999)
                
            ]);

        
        }

        return $response;
    }
    public function sendEmail()
    {

        try {

            if ($this->getType() == "subscribers") {
                $phpMail = new PHPMailer();
                $phpMail->isSMTP();
                $phpMail->Mailer = "smtp";
                $phpMail->SMTPAuth = true;
                $phpMail->SMTPDebug = 0;
                $phpMail->SMTPSecure = "tls";
                $phpMail->Host = "smtp.gmail.com";
                $phpMail->Username = "phonereserved7@gmail.com";
                $phpMail->Password = "ukjxcwusoyutkiai";

                // email
                $phpMail->Subject = "Congratulations! You Got New Client";
                $phpMail->setFrom("phonereserved7@gmail.com", "Hire Application");
                $phpMail->addAddress($this->receiverEmail, $this->fullName);

                $phpMail->isHTML();
                $phpMail->addEmbeddedImage("../images/hired.jpg", "hired");
                $phpMail->Body = $this->message;
                $phpMail->send();


                // checking message 
                $responseMailer = array();

                if ($phpMail->send())
                    $responseMailer = array("success" => true, "Code" => "200", "data" => "Your mail has been success");

                return true;
            } else {
                $phpMail = new PHPMailer();
                $phpMail->isSMTP();
                $phpMail->Mailer = "smtp";
                $phpMail->SMTPAuth = true;
                $phpMail->SMTPDebug = 0;
                $phpMail->SMTPSecure = "tls";
                $phpMail->Host = "smtp.gmail.com";
                $phpMail->Username = "phonereserved7@gmail.com";
                $phpMail->Password = "ukjxcwusoyutkiai";

                // email
                $phpMail->Subject = "Congratulations! You Got New Client";
                $phpMail->setFrom("phonereserved7@gmail.com", "Hire Application");
                $phpMail->addAddress($this->receiverEmail, $this->fullName);

                $phpMail->isHTML();
                $phpMail->addEmbeddedImage("../images/hired.jpg", "hired");
                $phpMail->Body = "<img src='cid:hired' style='margin-bottom: 15px'>\n\n" . $this->message . "
                \n\n
                <h2>Notice</h2>
                <p>currently, You Can Contact This Freelancer By Using  online communication chatting, Or simply pickup via social media apps to linkage
                you and your client  <br>
                <a href='http://192.168.1.2/HireApp/Hire/chat'>
                <button type='button' style='margin-top: 8px; padding: 10px; background: green;
                color: white; font-family: verdana; font-weight: 700; font-size: 16px; width: 220px; border: none; border-radius: 10px;'>Say Hi! To Your Client</button>
                </a> 
                <br> 
                
                <a href='http://192.168.1.2/HireApp/Hire/'>
                <button type='button' style='margin-top: 8px; padding: 10px; background: green;
                color: white; font-family: verdana; font-weight: 700; font-size: 16px; width: 220px; border: none; border-radius: 10px;'>Feedback Or issue</button>
                </a> </p>
                
                ";
                $phpMail->addAttachment("./images/dev.jpg");
                $phpMail->send();


                // checking message 
                $responseMailer = array();

                if ($phpMail->send())
                    $responseMailer = array("success" => true, "Code" => "200", "data" => "Your mail has been success");

                return true;
            }
            // setup


        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }
}


?>