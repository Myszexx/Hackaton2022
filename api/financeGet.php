<?php
session_start();

require_once "../accounts/connection.php";

if(isset($_POST['user_id']))
{
    $sql = "SELECT SUM(kwota) AS suma FROM bilans INNER JOIN tasks t on bilans.TASK_ID = t.task_id JOIN users u on t.user_id = u.user_id WHERE u.user_id =" . $_SESSION['user_id'];

    $res = $conn -> query($sql);

    while ($row = $res -> fetch_assoc())
    {
        $data['user_id'] = $res['u.user_id'];
        $data['']
    }
}
else
{
    header('location: ../index.php');
}