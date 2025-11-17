<?php 
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $check = $connection->prepare("SELECT * FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        print "Username is already in used";
    }else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            print "Registration Success";
            header("Location: login.php");
        }else {
            print "Error Occured: " . $connection->error;
        }
        $stmt->close();
    }
    $check->close();
}
?>