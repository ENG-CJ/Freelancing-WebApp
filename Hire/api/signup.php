<?php
include '../connections/conn.php';
session_start();




// results area TODO? mysqli_next_result($connection);

class Signup extends Connections{
  
    private static function setOnline($id){
        //SETTING AND UPADTING USERS CURRENT STATUS
        $sql ="UPDATE users SET loggedStatus='Online' where USERID='$id';";
        $signup= new Signup();
        $result=$signup->connect()->query($sql);
        if(!$result)
           return;
    }
    public  function setOffline(){
         //SETTING AND UPADTING USERS CURRENT STATUS
        $id=$_SESSION['profile_id'];
        $sql ="UPDATE users SET loggedStatus='Offline' where USERID='$id';";
        $signup= new Signup();
        $response=array();
        $result=$signup->connect()->query($sql);
        if($result){
            $response=array("error"=>"");
            session_unset();
            session_destroy();
            // exit(); 
        }
        $response=array("error"=>$signup->connect()->error);
        echo json_encode($response);
    }
    public function findUser(){
        extract($_POST);
        $response=array();
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            // response checking method 
           $response=array("error"=>"Invalid Email Format Address. Make Sure Email Format");
        else{
            $sql ="SELECT *FROM Users where Email ='$email' AND Password='$password';";
            $signup= new Signup();
            $result=$signup->connect()->query($sql);
            if($result){
                if(mysqli_num_rows($result)>0)
                {
                    $row=$result->fetch_assoc();
                    Signup::setOnline($row['USERID']);
                    $_SESSION['profile_id']=$row['USERID'];
                    $_SESSION['username']=$row['Username'];
                    $_SESSION['fullName']=$row['FullName'];
                    $_SESSION['img']=$row['Photo'];
                    $_SESSION['Email']=$row['Email'];
                    $_SESSION['type']=$row['AccountType'];
                    $_SESSION['state']=$row['AccountStatus'];
                    $response=array("error"=>"","userType"=>$_SESSION['type'],"state"=>$_SESSION['state']);
              
                }else
                    $response=array("error"=>"Incorrect Email Address Or Password");
            }
        }
        echo json_encode($response);
    }
    public function Register(){
        extract($_POST);
        $signup= new Signup();
        $response=array();
        if($type=="Employer Profile"){
            if($imageAvailable=="No"){

                $fileName="../images/default.jpg";
                $file=explode("/",$fileName);
                $actualName=$file[2];
                $employerID=uniqid("EMPVH-");
                $sql="CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','NoFb','NoGithub','NoWapp','$actualName');";
                $result=$signup->connect()->query($sql);
                if($result)
                  $response=array("response"=>"Your Account Has Been Configured.😊");
                else
                $response=array("response"=>$signup->connect()->error);
        
            }

            else{
                $employerID=uniqid("EMPVH-");
                $tempFile=$_FILES['profile']['tmp_name'];
                $file_name=$_FILES['profile']['name'];
                $extension=explode(".",$file_name);
                $actualExt=$extension[1];
                $actualUserProfile=$employerID.".".$actualExt;
                $uploadFile="../uploads/".$actualUserProfile;
              
             
                $sql="CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','NoDes','NoFb','NoGithub','NoWapp','$actualUserProfile');";
                $result=$signup->connect()->query($sql);
                if($result)
                  {
                   move_uploaded_file($tempFile,$uploadFile);
                    $response=array("response"=>"Your Account Has Been Configured.😊");
                  }
                else
                $response=array("response"=>$signup->connect()->error);
        
            }
       
        }else if ($type=="freelancer Profile"){
            if($imageAvailable=="No"){


                if(!filter_var($facebook,FILTER_VALIDATE_URL))
                {
                    $response=array("response"=>"","error"=>"Facebook URL is Not valid URL. Plz Provide Valid URL");
                    echo json_encode($response);
                    return;
                }
                if(!filter_var($github,FILTER_VALIDATE_URL))
                {
                    $response=array("response"=>"","error"=>"Github URL is Not valid URL. Plz Provide Valid URL");
                    echo json_encode($response);
                    return;
                }
                if(!filter_var($whatsapp,FILTER_VALIDATE_URL))
                {
                    $response=array("response"=>"","error"=>"whatsapp URL is Not valid URL. Plz Provide Valid URL");
                    echo json_encode($response);
                    return;
                }
                $fileName="../images/dev.jpg";
                $file=explode("/",$fileName);
                $actualName=$file[2];
                $employerID=uniqid("EMPVH-");
                $sql="CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','$description','$facebook','$github','$whatsapp','$actualName');";
                $result=$signup->connect()->query($sql);
                if($result)
                 {
                    $error="";
                    for($index=0; $index<count($Tools); $index++){
                        $query="INSERT INTO `experiencefreelancers`(`toolID`, `category`, `freelancerID`) VALUES ('$Tools[$index]','$categoryID','$employerID');";
                        $result_2=$signup->connect()->query($query);
                        if(!$result_2)
                         {
                            $response=array("response"=>"","error"=>$signup->connect()->error);
                            break;
                         }
                         
                    }
                    $response=array("error"=>"","response"=>"Your Account Has Been Configured.😊");
                  

                 }
                else

             {
                $response=array("response"=>"","error"=>$signup->connect()->error);
              
             
             }
        
            }

            else{

                $arrayTools=explode(",",$Tools);
                // $response=array("count"=>($arrayTools));
                $employerID=uniqid("EMPVH-");
                $tempFile=$_FILES['profile']['tmp_name'];
                $file_name=$_FILES['profile']['name'];
                $extension=explode(".",$file_name);
                $actualExt=$extension[1];
                $actualUserProfile=$employerID.".".$actualExt;
                $uploadFile="../uploads/".$actualUserProfile;
              
             
                $sql="CALL add_user('$employerID','$name','$username','$mobile','$email','$password','$type','Active','$description','$facebook','$github','$whatsapp','$actualUserProfile');";
                $result=$signup->connect()->query($sql);
                if($result)
                  {
                   move_uploaded_file($tempFile,$uploadFile);
                    // $response=array("response"=>"Your Account Has Been Configured.😊");
                    // $toolsName=array($Tools);
                    for($index=0; $index<count($arrayTools); $index++){
                        $query="INSERT INTO `experiencefreelancers`(`toolID`, `category`, `freelancerID`) VALUES ('$arrayTools[$index]','$categoryID','$employerID');";
                        $result_2=$signup->connect()->query($query);
                        if(!$result_2)
                         {
                            $response=array("response"=>"No Response Data","error"=>$signup->connect()->error." ".$Tools);
                            break;
                         }
                         
                    }
                    $response=array("error"=>"","response"=>"Your Account Has Been Configured.😊");
                  }
                else
                $response=array("response"=>$signup->connect()->error);
        
            }
        }
        echo json_encode($response);
    }
    public function loadAccountTypes(){
        $conn= new Signup();
        $response=array();
        if($conn->connect()->connect_error)
            $response=array("State"=>false,"error"=>$conn->connect()->error);

        $sql = "SELECT Type from accounttypes;";
        $Result= $conn->connect()->query($sql);
        if($Result){
            while($rows=$Result->fetch_assoc()){
                $response[]=array("Data"=>$rows['Type']);
            }
        }else{
            $response=array("State"=>false,"error"=>$conn->connect()->error);
        }

        echo json_encode($response);
    }
}

$action= $_POST['action'];
if(isset($action))
    {
        $api= new Signup();
        $api->$action();
    }

?>