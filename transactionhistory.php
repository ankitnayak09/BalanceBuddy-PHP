<?php session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: login.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style>
        /* Custom CSS */
        body {
            background-color: #22223B;
        }

        .hero-div {
            background-image: url("img/hero.jpg");
            height: 500px;
            overflow: hidden;
        }
    </style>
</head>

<body>

    <?php
    include 'navbar.php';
    ?>

    <div class="container">
        <h2 class="text-center pt-4" style="color :#6c757d;">Transaction History</h2>

        <br>
        <div class="table-responsive-sm">
            <table class="table table-hover table-striped table-condensed table-dark table-bordered">
                <thead style="color : white;">
                    <tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center">Sender</th>
                        <th class="text-center">Receiver</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include 'config.php';

                    $username = $_COOKIE['username'];
                    if ($username != 'admin') {
                        $sql = "SELECT * FROM transaction where sender='$username' or receiver='$username'";
                    } else {
                        $sql = "SELECT * FROM transaction";
                    }

                    $query = mysqli_query($conn, $sql);
                    $count = 1;
                    while ($rows = mysqli_fetch_assoc($query)) {
                        ?>

                        <tr style="color : white;">
                            <td class="py-2">

                                <?php
                                if ($username == "admin") {
                                    echo $rows['sno'];
                                } else {
                                    echo $count++;
                                }
                                ?>
                            </td>
                            <td class="py-2">
                                <?php echo $rows['sender']; ?>
                            </td>
                            <td class="py-2">
                                <?php echo $rows['receiver']; ?>
                            </td>
                            <td class="py-2" style="<?php if ($username == $rows['sender']) {
                                echo 'color:red';
                            } else if ($username == $rows['receiver']) {
                                echo 'color:green';
                            } else {
                            } ?>">Rs.

                                <?php echo $rows['balance']; ?> /-
                            </td>
                            <td class="py-2">
                                <?php echo $rows['datetime']; ?>
                            </td>

                            <?php
                    }

                    ?>
                </tbody>
            </table>

        </div>
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