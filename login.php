<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #22223b;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            font-family: 'Mono';
            color: #f2e9e4;
            text-align: center
        }

        main {
            background-color: #4a4e69;
            border-radius: 20px;
            padding: 50px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        input {
            padding: 5px 10px;
        }

        button {
            width: 100%;
            padding: 5px 0;
            cursor: pointer;
            transition: 0.5s;
            font-weight: bold;

        }

        input,
        button {
            border-radius: 5px;
            border: none;
            font-size: 1.5rem;
        }

        button:hover {
            transform: scale(1.05);
            background-color: #22223B;
            color: #F2E9E4;
        }

        button:active {
            transform: scale(0.95);
        }

        .hr {
            background-color: #F2E9E4;
            height: 1px;
            width: 100%;
            margin: 0 auto;
        }

        div.signup-links {
            color: #F2E9E4;
            margin-top: 20px;
        }
    </style>
</head>

<body>
</body>
<main>
    <?php include 'config.php';
    if (isset($_POST['submit'])) {
        // $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // $pin = $_POST['pin'];
        if (empty($email) || empty($password)) {
            echo '<script>alert("Email Or Password Cannot be Empty")</script>';
            return;
        }
        $sql = "select * from users where email='{$email}' and password='{$password}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);
            $id = $result['id'];
            $username = $result["username"];
            $email = $result["email"];
            setcookie("id", $id, time() + 86400, "/");
            setcookie("username", $username, time() + 86400, "/");
            setcookie("email", $email, time() + 86400, "/");
            // $_SESSION["email"] = $email;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["loggedin"] = true;
            header("location: index.php");
        } else {
            echo "<script>
                alert('Invalid Credentials')
                </script>";
        }
    }
    ?>
    <form method="post">
        <h1>Balance Buddy</h1>
        <input type="email" placeholder="Email..." name="email" required>
        <input type="password" placeholder="Password..." name="password" required>
        <button type="submit" name="submit">Login</button>
    </form>
    <div class="hr"></div>
    <div class="text-center signup-links">Don't Have an account ? <a href="signup.php">Create One</a></div>
</main>

</html>