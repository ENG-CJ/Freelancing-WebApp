<?php
include '../connections/conn.php';
include '../mailer/delivery_email.php';
session_start();




class Subscriber extends Connections
{

    public function collectSubscriberData()
    {
        extract($_POST);
        $Users = new Subscriber();
        $response = array();
        $sql_1 = "SELECT *from subscribers WHERE subscriber_email='$email';";
        $result_1 = $Users->connect()->query($sql_1);
        if ($result_1) {
            if (mysqli_num_rows($result_1) > 0) {
                $response = array("response" => "You Already Subscribed...");
            } else {
                $sql = "INSERT INTO `subscribers`(`subscriber_name`, `subscriber_email`) VALUES ('$name','$email');";


                $result = $Users->connect()->query($sql);
                if ($result) {

                    $mail = new Mail();
                    $mail->setFullName($name);
                    $mail->setReceiverEmail($email);
                    $mail->setMessageContent("Thank You For Subscribing Our Website, to get More Updates.");
                    $mail->setType("subscribers");
                    if ($mail->sendEmail())
                        $response = array("status" => true, "response" => "We Appreciate You!. We Will Notify The Biggest Updates");
                    else
                        $response = array("status" => false, "response" => "Something Went Wrong While Processing..");
                } else
                    $response = array("status" => false, "response" => $Users->connect()->error);
            }
        }else
        $response = array("status" => false, "response" => $Users->connect()->error);



        echo json_encode($response);
    }

    public function loadSubscribersDashboard()
    {
        extract($_POST);

        if ($_SESSION['type'] == "Admin") {

            $sql = "SELECT users.FullName,users.Mobile,users.AccountType FROM users
            where users.AccountType!='Admin'
            ORDER BY users.FullName DESC  LIMIT 10;";
            $Users = new Subscriber();
            $result = $Users->connect()->query($sql);
            if ($result) {
?>

                <table class="table  table-striped SubscriberTable">

                    <thead>
                        <tr>

                            <th scope="col">User</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        foreach ($result as $row => $value) {
                        ?>

                            <tr>

                                <td><?php echo $value['FullName'] ?></td>
                                <td><?php echo $value['Mobile'] ?></td>
                                <td><?php echo $value['AccountType'] ?></td>

                            <?php

                        }

                            ?>



                    </tbody>
                </table>



            <?php


            }
        } else {
            $id = $_SESSION['profile_id'];
            $sql = "SELECT users.FullName,users.Mobile,users.AccountType FROM users
        LEFT JOIN hiredfreelancers
        ON users.USERID=hiredfreelancers.SubscriberID
        WHERE hiredfreelancers.freelancerID='$id' ORDER BY users.FullName DESC  LIMIT 10;";
            $Users = new Subscriber();
            $result = $Users->connect()->query($sql);
            if ($result) {
            ?>

                <table class="table  table-striped SubscriberTable">

                    <thead>
                        <tr>

                            <th scope="col">Subscriber</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Subscriber Type</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        foreach ($result as $row => $value) {
                        ?>

                            <tr>

                                <td><?php echo $value['FullName'] ?></td>
                                <td><?php echo $value['Mobile'] ?></td>
                                <td><?php echo $value['AccountType'] ?></td>

                            <?php

                        }

                            ?>



                    </tbody>
                </table>



<?php


            }

            // echo json_encode($response);
        }
    }
}

$action = $_POST['action'];
if (isset($action)) {
    $api = new Subscriber();
    $api->$action();
}

?>