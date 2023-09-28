<?php
include '../connections/conn.php';
session_start();




// results area TODO? mysqli_next_result($connection);

class Chat extends Connections
{

    /**
     * fetch current user from clients table based on their id's 
     * getting users photo from client id's 
     * @return  string or boolean
     */
    public function fetchCurrentUserPhoto(): string | bool
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT Photo FROM Users where USERID ='$id';";
        $Chat = new Chat();
        $result = $Chat->connect()->query($sql);
        if ($result) {

            $row = $result->fetch_assoc();
            $response = array("error" => "", "image" => $row['Photo'], "username" => $row['FullName'], "state" => $row['loggedStatus']);
        }

        return "Hello";
    }
    public function findFreelancer()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT users.USERID,users.Username,users.FullName,users.Photo,users.loggedStatus
        FROM users
        LEFT JOIN hiredfreelancers
        ON users.USERID=hiredfreelancers.freelancerID
        WHERE hiredfreelancers.clientID='$id' and users.FullName like '%" . $targetValue . "%'";
        $Chat = new Chat();
        $result = $Chat->connect()->query($sql);
        if ($result) {

            while ($row = $result->fetch_assoc()) {
                $response[] = array("error" => "", "data" => $row);
            }
        }

        echo json_encode($response);
    }

    public function sendMessage()
    {
        extract($_POST);
        $sql = "INSERT INTO `chats`(`FromUser`, `ToUser`, `Message`) 
        VALUES ('$fromUser','$toUser','$message')";
        $Chat = new Chat();
        $res = array();
        $result = $Chat->connect()->query($sql);
        if ($result)
            $res = array("success" => "sended");

        else
            $res = array("error" => $Chat->connect()->error);

        echo json_encode($res);
    }



    public function fetchTargetUser()
    {
        extract($_POST);
        $response = array();

        $sql = "SELECT FullName,Photo,loggedStatus FROM Users where USERID ='$id';";
        $Chat = new Chat();
        $result = $Chat->connect()->query($sql);
        if ($result) {

            $row = $result->fetch_assoc();
            $response = array("error" => "", "image" => $row['Photo'], "username" => $row['FullName'], "state" => $row['loggedStatus']);
        }

        echo json_encode($response);
    }
    public function fetchMessages()
    {
        extract($_POST);
        $response = array();

        // $sql = "SELECT *FROM chats 
        // where 
        // (FromUser='$fromUser' and ToUser='$toUser') or (FromUser='$toUser' and ToUser='$fromUser');";
        $sql = "SELECT *FROM chats
WHERE ((chats.FromUser='$fromUser' AND chats.ToUser='$toUser')
OR (chats.FromUser='$toUser' AND chats.ToUser='$fromUser'));;";
        $Chat = new Chat();
        $result = $Chat->connect()->query($sql);
        $output = "";
        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count == 0) {
?>
                <div class="error-provider">
                    <div class="error-message">
                        <strong>Messages Will Appear Here!</strong>
                    </div>
                </div>

<?php
                return;
            }

            while ($rows = $result->fetch_assoc()) {
                // print_r($rows);
                // print_r ($rows);
                if ($rows['FromUser'] == $_SESSION['profile_id']) {
                    $output .= "
                    <div class='message_container'>
                    <div class='messages'>
                    <div class='outgoing-messages outgoing-message'>
                    <div class='outgoing'>
                        <p style='margin-bottom: 6px'>" . $rows['Message'] . "</p>
                    </div>
                </div>
                    </div>
                    </div>
                    ";
                } else {
                    $output .= "
                    <div class='message_container'>
                    <div class='messages'>
                    <div class='incoming-messages incoming-message'>
                    <div class='incoming'>
                        <p>" . $rows['Message'] . "</p>
                    </div>
                </div>
                    </div>
                    </div>
                    ";
                }
            }
            // $response[]=array("rows"=>$count);


        }

        echo $output;
    }
}

$action = $_POST['action'];
if (isset($action)) {
    $api = new Chat();
    $api->$action();
}
