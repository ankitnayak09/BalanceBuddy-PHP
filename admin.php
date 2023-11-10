<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">

  <title>Admin Page | Balance Buddy</title>

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

  <div class="container-fluid">
    <!-- Introduction section -->
    <div class="row intro">

      <div class="col-sm-12 col-md img text-center hero-div">
        <!-- TODO: Replace Hero Image -->
        <!-- <img src="img/bank.png" class="img-fluid pt-2"> -->
        <!-- <img src="img/hero.jpg" class="img-fluid pt-2"> -->
      </div>
    </div>

    <div class="row mt-5">
      <div class="col">
        <h1 class="username-greeting">Hi,
          <?= $_SESSION['username']; ?>
        </h1>
      </div>
    </div>


    <!-- Activity section -->
    <div class="row activity text-center py-5">
      <!-- <div class="col-md act">
        <img src="img/user.jpg" class="img-fluid my-2" style="border-radius: 50%">
        <br>
        <a href="createuser.php"><button style="background-color : #2785C4;" style="border-radius:0%">Create a
            User</button></a>
      </div>
      <div class="col-md act">
        <img src="img/ruser.jpg" class="img-fluid my-2" style="border-radius: 50%">
        <br>
        <a href="removeuser.php"><button style="background-color : #2785C4;" style="border-radius:0%">Delete
            Users</button></a>
      </div> -->
      <div class="col-md act">
        <img src="img/transaction.png" width="200" height="200" class="img-fluid my-2">
        <br>
        <a href="transfermoney.php"><button style="background-color : #2785C4;">Make a Deposit</button></a>
      </div>
      <div class="col-md act">
        <img src="img/clock.png" width="200" height="200" class="img-fluid my-2">
        <br>
        <a href="transactionhistory.php"><button style="background-color : #2785C4;">Transaction History</button></a>
      </div>

    </div>
  </div>
  <footer class="text-center mt-5 py-2">
    <p>Developed by <a href="#">
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