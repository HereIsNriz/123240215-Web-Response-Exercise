<?php 
include "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $connection->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $row["username"];
            header("Location: dashboard.php");
        }else {
            print "<script>alert(\"Password Incorrect\");window.location.href = \"logout.php\";</script>";
        }
    }else {
        print "<script>alert(\"Username Not Found\");window.location.href = \"logout.php\";</script>";
    }
}
?>