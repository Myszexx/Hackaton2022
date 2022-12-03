<?php
session_start();

require_once "../accounts/connection.php";

if(isset($_SESSION['user_id']))
{
    $sql = "INSERT INTO bilans (id_transakcji, kwota, `+-`, NAZWA, typ, TASK_ID) VALUES ('', '$kwota', '$czyWydatek', '$nazwa', '$typ', '$task_id')";

    $res = $conn -> query($sql);

    if(!$res)
    {
        echo "Dane nie weszły do tabeli";
    }
}
else
{
    header('location: ../index.php');
}