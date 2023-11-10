<!-- navbar -->
<nav class="navbar navbar-expand-md navbar-light">
  <!-- TODO: Add WebApp Logo -->
  <a class="navbar-brand" href="index.php" style="color: #F2E9E4;">
    <!-- <img src="img/bnklg.png" alt="Logo" width="26" style="margin-bottom:4px;">  -->
    <b>Balance Buddy</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php" style="color: #F2E9E4;"><b>Home</b></a>
      </li>
      <?php if ($_SESSION["username"] == "admin") { ?>
        <li class="nav-item">
          <a class="nav-link" href="users.php" style="color: #F2E9E4;"><b>All Users</b></a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="selecteduserdetail.php?id=<?= $_COOKIE["id"] ?>" style="color: #F2E9E4;"><b>Send
              Money</b></a>
        </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="transactionhistory.php" style="color: #F2E9E4;"><b>Transaction History</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" style="color: #F2E9E4;"><b>Logout</b></a>
      </li>
  </div>
</nav>