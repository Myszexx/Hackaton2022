<?php
session_start();
header('Content-Type: application/json');

$data = [];

require_once "connection.php";

if(isset($_SESSION['user_id']))
{
    $sql = "SELECT `login`, `mail`, `start_date` FROM users WHERE user_id = " . $_SESSION['user_id'];

    $res = $conn -> query($sql);

    while($row = $res -> fetch_assoc())
    {
        $data['login'] = $row['login'];
        $data['mail'] = $row['mail'];
        $data['start_date'] = $row['start_date'];

        echo json_encode($data);
    }
}
else
{
    header('location: ../index.php');
}