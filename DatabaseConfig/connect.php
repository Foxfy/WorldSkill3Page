<?php
    session_start();
    // เชื่อมต่อฐานข้อมูล
    $conn = mysqli_connect('localhost','root','','football1');
    // ตั้งค่าชุดภาษา
    mysqli_set_charset($conn,'utf8');
    // ตั้งค่า timezone
    date_default_timezone_set('Asia/Bangkok');
?>