<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php
        // var_dump($_POST['username']);
        $username = $_POST["username"];
        $password = $_POST["password"];
        // echo $username;
        if (empty($username) || empty($password)) {
            echo "<script>alert('Please enter both username and password!')</script>";
            echo '<script type="text/javascript">window.location.href="Login.html";</script>';
            exit;
        }

        // MySQL connection block
        $server = getenv("DB_SERVER");
        $user = getenv("DB_USER");
        $pw = getenv("DB_PASS");
        $db = getenv("DB_DB");
        $conn = new mysqli($server, $user, $pw);
        if ($conn->connect_error) 
        {
            // echo "help";
            die("Connection Failed: " . $conn->connect_error);
        }
        $conn->select_db($db);

        $sql = "SELECT * FROM users WHERE username = '$username' AND user_pass = SHA1('$password')";
        // echo $sql;
        $result = $conn->query($sql);
        // echo $result->num_rows;
        if ($result->num_rows == 0) {
            // echo "here!";
            echo "<script>alert('Incorrect username or password!')</script>";
            echo '<script type="text/javascript">window.location.href="Login.html";</script>';
            exit;
            // echo "<script>window.location.href = Login.html</script>";
        }
        
    ?>
</body>

</html>