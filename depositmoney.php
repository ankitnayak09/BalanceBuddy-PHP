<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["username"] != "admin") {
    header("location: login.php");
    exit();
}
include 'config.php';

if (isset($_POST['submit'])) {
    $to = $_POST['to'];
    $amount = $_POST['amount'];


    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be Deposited")'; // showing an alert box.
        echo '</script>';
    }

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be deposited')";
        echo "</script>";
    } else {


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);


        if ($query) {
            echo "<script> alert('Amount Deposited');
                           </script>";

        }

        $newbalance = 0;
        $amount = 0;
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
        button {
            border: none;
            background: #d9d9d9;
        }

        button:hover {
            background-color: #777E8B;
            transform: scale(1.1);
            color: white;
        }

        body {
            background-color: #22223b;
        }
    </style>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

    <div class="container">
        <h2 class="text-center pt-4" style="color : #6c757d;">
            <?php if ($_SESSION["username"] == "admin") {
                echo "Deposit Money";
            } else {
                echo "Transact Money";
            }
            ?>
        </h2>
        <?php
        include 'config.php';
        $sql = "SELECT * FROM  users";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        }
        ?>
        <form method="post" name="tcredit" class="tabletext"><br>
            <div>
                <table class="table table-striped table-condensed table-bordered table-dark">
                    <tr style="color : white;">
                        <th class="text-center">Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Total Balance</th>
                    </tr>
                    <?php

                    while ($rows = mysqli_fetch_assoc($result)) {
                        if ($rows['username'] != "admin") {
                            ?>

                            <tr style="color : white;">
                                <td class="py-2">
                                    <?php echo $rows['id'] ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['username'] ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['email'] ?>
                                </td>
                                <td class="py-2">Rs.
                                    <?php echo $rows['balance'] ?>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </div>
            <hr><br>

            <div class="row">

                <div class="col-6">
                    <label style="color : #6c757d;"><b>Deposit To:</b></label>
                    <select name="to" class="form-control" required>
                        <option value="" disabled selected>Select Account</option>
                        <?php
                        include 'config.php';
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            echo "Error " . $sql . "<br>" . mysqli_error($conn);
                        }
                        while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <?php if ($rows['username'] != "admin") { ?>
                                <option class="table" value="<?php echo $rows['id']; ?>">

                                    <?php echo $rows['username']; ?>
                                    (Email:
                                    <?php echo $rows['email']; ?> )

                                </option>
                            <?php } ?>
                            <?php
                        }
                        ?>
                        <div>
                    </select>
                </div>


                <div class="col-6">
                    <label style="color : #6c757d;"><b>Amount:</b></label>
                    <input type="number" class="form-control" name="amount" required>
                </div>

            </div>

            <br><br>
            <div class="text-center">
                <button class="btn" name="submit" type="submit" id="myBtn">Deposit Amount</button>
            </div>
        </form>
    </div>
    <footer class="text-center mt-5 py-2">
        <p style="color: #f2e9e4 ">Developed by <a href="#">
                <b>Ankit Kumar Nayak</b>
            </a>
        </p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>

</html>