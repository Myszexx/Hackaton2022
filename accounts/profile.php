<?php
session_start();
header('Content-Type: application/json');

require_once "connection.php";

if(isset($_SESSION['user_id']))
{
    $sql = "SELECT `login`, `mail`, `start_date` FROM users WHERE user_id = " . $_SESSION['user_id'];

    $res = $conn -> query($sql);

    $res = $res -> fetch_assoc();

    echo json_encode($res);
}
else
{
    header('location: ../index.php');
}