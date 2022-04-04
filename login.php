<?php
session_start(); // Starting Session
$error = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
    
        $email = $_POST['email'];
		    // $password = $_POST['password'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "create_account";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM second WHERE email = ? LIMIT 1";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                echo "<script>alert('email or Password is invalid !') </script>";   
                echo "<a href='login.html'><Strong>Please Login With correct Email & Password!!! Click to Login</Strong></a>";            
                    // header("Location: http://localhost/website/login.html");
                }
            else {
                header("Location: http://localhost/website/home.php");
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>