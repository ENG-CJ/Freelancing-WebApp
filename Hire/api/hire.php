<?php 
include '../connections/conn.php';
include '../mailer/delivery_email.php';


class HIRE extends Connections{

  
    public function Hire(){
        extract($_POST);
        $response=array();
        $conn=new HIRE();

        $date=date('Y-m-d');
        $sql_validation="SELECT *from  hiredfreelancers where freelancerID='$freelancerID' AND `clientID`='$clientID';";
        $result_validation=$conn->connect()->query($sql_validation);
        if($result_validation){
            if(mysqli_num_rows($result_validation)>0)
              $response=array("error"=>"Hi Client! You Already Hired This Freelancer, To Reach This Freelancer Plz Navigate
               Hired Freelancers Section. or simply click this link ");
            else{
                $sql="INSERT INTO `hiredfreelancers`(`freelancerID`, `clientID`, `hireDate`) VALUES ('$freelancerID','$clientID','$date');";
                $result=$conn->connect()->query($sql);
                if($result){
                    $mailer=new Mail();
                        $mailer->setFullName($fullName);
                        $mailer->setReceiverEmail($receiverEmail);
                        $mailer->setMessageContent("Hello! ".$fullName. " You Got new Client So Contact With Directly Communication Channels By Using This Links Below. if there is some issue plz show us and report by by using links below");
        $mailer->setType("freelancer");
                        
                    if($mailer->sendEmail())
                        $response=array("error"=>"","response"=>"You Are Hired This Freelancer, You Can Contact By His Current Communication Channels, Plz Wait Redirecting or simply Click Close...");
                    else
                    $response=array("error"=>$mailer->getError(),"response"=>$mailer->getError());
        
                }
                else
                $response=array("error"=>$conn->connect()->error,"response"=>$conn->connect()->error);
            }
        }
       

        echo json_encode($response);

    }
}




$action = $_POST['action'];
if (isset($action)) {
    $api = new HIRE();
    $api->$action();
}
