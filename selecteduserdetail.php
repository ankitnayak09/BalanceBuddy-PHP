<?php
session_start();
include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];
    $pin = $_POST['pin'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);




    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")'; // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Sorry, Insufficient Balance")'; // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else if ($pin != $sql1['pin']) {
        echo '<script>alert("Wrong Pin");</script>';
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$from";
        mysqli_query($conn, $sql);


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);

        $sender = $sql1['username'];
        $receiver = $sql2['username'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Transaction Completed');
                                     window.location='transactionhistory.php';
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
                echo "Send Money";
            }
            ?>
        </h2>
        <?php
        include 'config.php';
        $sid = $_GET['id'];
        $sql = "SELECT * FROM  users where id=$sid";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        }
        $rows = mysqli_fetch_assoc($result);
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
                </table>
            </div>
            <hr><br>

            <div class="row">

                <div class="col-6">
                    <label style="color : #6c757d;"><b>Transfer To:</b></label>
                    <select name="to" class="form-control" required>
                        <option value="" disabled selected>Select Account</option>
                        <?php
                        include 'config.php';
                        $sid = $_GET['id'];
                        $sql = "SELECT * FROM users where id!=$sid";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            echo "Error " . $sql . "<br>" . mysqli_error($conn);
                        }
                        while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                            <?php if ($rows['username'] != "admin") { ?>
                                <option class="table" value="<?php echo $rows['id']; ?>">

                                    <?php echo $rows['username']; ?>
                                    <!-- (Balance: <?php echo $rows['balance']; ?> ) -->

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

            <div class="row my-3">
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="number" name="pin" class="form-control" placeholder="Enter Your Pin" required>
                </div>
            </div>

            <br><br>
            <div class="text-center">
                <button class="btn" name="submit" type="submit" id="myBtn">Transfer Amount</button>
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