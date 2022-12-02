<?php
session_start();

if(isset($_SESSION['user_id']))
{
    header('location: dashboard.html');
}
else
{
    header('location: login.html');
}