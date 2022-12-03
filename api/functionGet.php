<?php
session_start();

require_once "../accounts/connection.php";
$data = array();

if(isset($_SESSION['user_id']))
{
    $sql = "SELECT `id`, `module_name`, `href`, `isMenu` FROM modules";

    $res = $conn -> query($sql);

    if($res)
    {
        while($row = $res -> fetch_assoc())
        {
            $data['id'] = $row['id'];
            $data['module_name'] = $row['module_name'];
            $data['href'] = $row['href'];
            $data['isMenu'] = $row['isMenu'];

            echo json_encode($data);
        }
    }
    else
    {
        echo "Wygląda na to, że baza jest pusta";
    }
}
else
{
    header('location: ../index.php');
}