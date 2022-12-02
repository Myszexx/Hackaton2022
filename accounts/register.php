<?php
session_start();

require_once "connection.php";

if(isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['checkpass']))
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkpass = $_POST['checkpass'];

    $sql = "SELECT `login`, `mail` FROM users WHERE `mail` = '$email' OR `login` = '$username'";

    $res = $conn -> query($sql);

    if($res -> num_rows > 0)
    {
        echo "Konto już istnieje";
    }
    else
    {
        if($checkpass == $password)
        {
            $password = sha1($password);

            $sql = "INSERT INTO users (login, mail, passwd) VALUE ('$username', '$email', '$password')";

            $res = $conn -> query($sql);

            if($res)
            {
                echo "Konto zostało utworzone";
            }
            else
            {
                echo 'Wystąpił błąd';
            }
        }
    }
}