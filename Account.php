    <?php
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        // echo $username;
        if (empty($username) || empty($password) || empty($password2)) {
            echo "<script>alert('Missing information!')</script>";
            echo '<script type="text/javascript">window.location.href="CreateAccount.html";</script>';
            exit;
        }

        if ($password != $password2) {
            echo "<script>alert('Passwords do not match!')</script>";
            echo '<script type="text/javascript">window.location.href="CreateAccount.html";</script>';
            exit;
        }

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

        echo 1;

        $sql = "SELECT * FROM users WHERE username = '$username'";
        // echo $sql;
        $result = $conn->query($sql);
        echo 2;
        // echo $result->num_rows;
        if ($result->num_rows > 0) {
            // echo "here!";
            echo 3;
            echo "<script>alert('This username is already taken!')</script>";
            echo '<script type="text/javascript">window.location.href="CreateAccount.html";</script>';
            exit;
            // echo "<script>window.location.href = Login.html</script>";
        }

        $insertSql = "INSERT INTO users (username, user_pass) VALUES ('$username', SHA1('$password'))";
        if ($conn->query($insertSql) === TRUE) {
            echo "<script>alert('Account created successfully!')</script>";
        }
        else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }

        echo '<script type="text/javascript">window.location.href="Login.html";</script>';
    ?>