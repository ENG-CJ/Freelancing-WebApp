<?php
include '../connections/conn.php';
session_start();



class Client extends Connections
{

    public function loadClients()
    {
        extract($_POST);

        $id = $_SESSION['profile_id'];
        $sql = "SELECT users.USERID,users.FullName,users.Mobile,users.AccountType FROM users
        LEFT JOIN hiredfreelancers
        ON users.USERID=hiredfreelancers.clientID
        WHERE hiredfreelancers.freelancerID='$id'
        ;";
        $Users = new Client();
        $result = $Users->connect()->query($sql);
        if ($result) {
?>

            <table class="table table-hover clientTableData">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Client Type</th>
                        <th scope="col">Chat</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    foreach ($result as $row => $value) {
                    ?>

                        <tr>
                            <td><?php echo $value['USERID'] ?></td>
                            <td><?php echo $value['FullName'] ?></td>
                            <td><?php echo $value['Mobile'] ?></td>
                            <td><?php echo $value['AccountType'] ?></td>
                            <td>
                                <a title="Message <?php echo $value['FullName'] ?>" 
                                href="./DCChannel.php?freelancer_code=default"
                                class="text-decoration-none text-success"
                                >
                                    <i class="fa-solid fa-message"></i>
                                </a>

                            </td>

                        <?php

                    }

                        ?>



                </tbody>
            </table>



            <?php


        }

        // echo json_encode($response);
    }
    public function loadClientsDashboard()
    {
        extract($_POST);

        if ($_SESSION['type'] == "Admin") {

            $sql = "SELECT users.FullName,users.Mobile,users.AccountType FROM users
            where users.AccountType!='Admin'
            ORDER BY users.FullName DESC  LIMIT 10;";
            $Users = new Client();
            $result = $Users->connect()->query($sql);
            if ($result) {
            ?>

                <table class="table  table-striped clientTable">

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
        ON users.USERID=hiredfreelancers.clientID
        WHERE hiredfreelancers.freelancerID='$id' ORDER BY users.FullName DESC  LIMIT 10;";
            $Users = new Client();
            $result = $Users->connect()->query($sql);
            if ($result) {
            ?>

                <table class="table  table-striped clientTable">

                    <thead>
                        <tr>

                            <th scope="col">Client</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Client Type</th>
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
    $api = new Client();
    $api->$action();
}

?>