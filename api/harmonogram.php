<?php
if(isset($_POST['length']) && isset($_POST['startday']))
{
    $length = $_POST['length'];
    $startday = $_POST['startday'];

    $sql = "SELECT id, start_date, end_date, type FROM free_time WHERE user_id = "+$user_id_z_sesji+" AND start_date BEETWEEN sysdate AND SYSDATE+"+$_POST['length'];
    $sql = "SELECT taks_id, task_type, time, comment, title, priority,alerts,color FROM tasks WHERE user_id = "+$user_id_z_sesji+" AND alerts BEETWEEN sysdate AND SYSDATE+"+$_POST['length'];
}