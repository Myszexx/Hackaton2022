<?php
session_start();
header('Content-Type: application/json; charset: UTF-8');

$json = [];
$time = [];
$task = [];

require_once "../accounts/connection.php";

if(isset($_POST['length']) && isset($_POST['startday']) && isset($_SESSION['user_id']))
{
    $length = $_POST['length'];
    $startday = $_POST['startday'];

    $sql1 = "SELECT `id`, `start_date`, `end_date`, `type` FROM free_time WHERE user_id = " . $_SESSION['user_id'] . " AND start_date BETWEEN sysdate() AND SYSDATE()+" . $length;
    $sql2 = "SELECT `task_id`, `task_type`, `time`, `comment`, `title`, `priority`, `alerts`, `color` FROM tasks WHERE user_id = " . $_SESSION['user_id'] . " AND alerts BETWEEN sysdate() AND SYSDATE()+" . $length;

    $res1 = $conn -> query($sql1);
    $res2 = $conn -> query($sql2);

    $res1_num_rows = $res1 -> num_rows;
    $res2_num_rows = $res2 -> num_rows;

    $res1 = $res1 -> fetch_assoc();
    $res2 = $res2 -> fetch_assoc();

    for($i = 0; $i < $res1_num_rows; $i++)
    {
        $time[$i] = [
            "id" => $res1['id'],
            "start_date" => $res1['start_date'],
            "end_date" => $res1['end_date'],
            "type" => $res1['type']
        ];
    }

    for($i = 0; $i < $res2_num_rows; $i++)
    {
        $task[$i] = [
            "task_id" => $res2['task_id'],
            "time" => $res2['time'],
            "type" => $res2['type'],
            "comment" => $res2['comment'],
            "title" => $res2['title'],
            "priority" => $res2['priority'],
            "alerts" => $res2['alerts'],
            "colors" => $res2['colors']
        ];
    }


    $json = [
        "tasks" => $task,
        "time" => $time
    ];

    echo json_encode($json);
}