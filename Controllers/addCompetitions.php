<?php
    include_once('.././DatabaseConfig/connect.php');

    if(empty($_POST)){
        header('location:.././create.php');
    }

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $max_teams = $_POST['max_teams'];
    $banner = $_FILES['banner']['name'];

    $sql = "SELECT * FROM competitions c WHERE c.slug ='$slug'";
    $result = $conn->query($sql);
    if($result){
        $_SESSION['alert']['msg'] = "this slug is already in use";
        $_SESSION['alert']['css'] = "alert-danger";
        header('location:.././create.php');
    }

    if($banner != null){
        copy($_FILES['banner']['tmp_name'] , '.././images/'.$_FILES['banner']['name']);
    }

    $sql = "INSERT INTO `competitions` (`id`, `name`, `slug`, `max_teams`, `banner`) 
    VALUES (NULL, '$name', '$slug', '$max_teams', '$banner');";
    $inserted = $conn->query($sql);
    $insert_id = mysqli_insert_id($conn);

    foreach($_POST['allowed_Provinces'] as $provinces_id){
        $sql = "INSERT INTO `allowed_provinces` (`id`, `competitions_id`, `provinces_id`) 
        VALUES (NULL, '$insert_id', '$provinces_id');";
        $inserted = $conn->query($sql);
    }

    $_SESSION['alert']['msg'] = "competitions create success fully";
    $_SESSION['alert']['css'] = "alert-success";
    header('location:.././detail.php?competition_slug='.$slug);
?>