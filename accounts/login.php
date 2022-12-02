<?php
session_start();

require_once "connection.php";

if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT `user_id`, `login`, `passwd` FROM users WHERE `login` = '$username'";

    $res = $conn -> query($sql);

    if($res -> num_rows > 0)
    {   

        $password = sha1($password);

        $log = $res -> fetch_assoc();

        if($log['login'] == $username && $log['passwd'] == $password)
        {
            $_SESSION['username'] = $log['user_id'];
            header('Location: ../dashboard.html');
        }
        else
        {
            echo "Dane logowania są niepoprawne";
        }
    }
    else
    {
        echo "Takie konto już istnieje";
    }
}