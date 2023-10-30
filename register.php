<?php
include 'connection.php';                        

    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $hobbies = $_POST['hobbies'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];

    $selectedHobby = "";
    foreach($hobbies as $hobby)
    {
        $selectedHobby .= $hobby." ";
    }

    $hobby = rtrim($selectedHobby,",");

    $fileName = $_FILES["profile"]['name'];
    $tmpName = $_FILES["profile"]["tmp_name"];

    $profile = "upload/" . $fileName;

    move_uploaded_file($tmpName, $profile);

    $check = "SELECT * FROM `user` WHERE `email` = '$email' OR `username` = '$username'";
    $checkQuery = mysqli_query($conn,$check);

    $row = mysqli_num_rows($checkQuery);

    if($row > 0) {
        echo "<script>alert('Username or Email already exist')</script>";
        header('location:register.html');
    } else {
        $query = "INSERT INTO `user` (`name`, `email`, `username`, `gender`, `hobby`, `address`, `country`, `state`, `profile_photo`)
        VALUES ('$name', '$email', '$username', '$gender', '$hobby', '$address', '$country', '$state', '$profile')";
        $createQuery = mysqli_query($conn,$query);

        if($createQuery) {
            header('location:home.php');
        } else {
            echo $query;
        }
    }

?>