<?php
include 'connection.php';

    $id = $_GET['id'];

    $query = "SELECT * FROM `user` WHERE `id`='$id'";
    $data = mysqli_query($conn, $query);

    while($user = mysqli_fetch_assoc($data)) {

        $name = $user['name'];
        $email = $user['email'];
        $username = $user['username'];
        $gender = $user['gender'];
        $hobbies = $user['hobby'];
        $address = $user['address'];
        $state = $user['state'];
        $country = $user['country'];
        $profile = $user['profile_photo'];
    }

    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $hobbies = $_POST['hobbies'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $country = $_POST['country'];

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
       
        $query = "UPDATE `user` SET 
                    `name`='$name',
                    `email`='$email',
                    `username`='$username',
                    `gender`='$gender',
                    `hobby`='$hobby',
                    `address` = '$address',
                    `state` = '$state',
                    `country` = '$country',
                    `profile_photo`='$profile'
                    WHERE `id`='$id'";
        $createQuery = mysqli_query($conn, $query);
        if ($createQuery) {
            header('location:home.php');
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"
            integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>
    <style>
        .filebox {
            display: none;
        }
        img {
            height: 225px;
            width: 225px;
        }
    </style>
</head>
<body>

    <form method="post" action="" enctype="multipart/form-data" autocomplete="off" id="userForm" name="userForm">

    <div class="my-4 row justify-content-md-center">
        <div class="col-sm-2">
            <img src="<?php echo  $profile?>" alt="<?php echo  $profile;?>" id="img">
            <span id="profileErr" class="text-danger"></span>
            <input type="file" name="profile" class="form-control filebox my-2" id="profile" value="<?php echo  $user['profile_photo'];?>">
            <button type="button" name="updateImage" class="btn btn-primary my-2" id="changeBtn">Click to update profile photo</button>
        </div>
    </div>

    <div class="my-4 row justify-content-md-center">
        <label for="name" class="col-sm-1 col-form-label">Name</label>
        <div class="col-sm-4">
            <input type="text" name="name" class="form-control" id="name" value="<?php echo $name?>">
            <span id="nameErr" class="text-danger"></span>
        </div>
    </div>

    <div class="my-4 row justify-content-md-center">
        <label for="email" class="col-sm-1 col-form-label">Email</label>
        <div class="col-sm-4">
            <input type="text" name="email" class="form-control" id="email" value="<?php echo $email?>">
            <span id="emailErr" class="text-danger"></span>
        </div>
    </div>

    <div class="my-4 row justify-content-md-center">
        <label for="username" class="col-sm-1 col-form-label">Username</label>
        <div class="col-sm-4">
            <input type="text" name="username" class="form-control" id="username" value="<?php echo $username?>">
            <span id="usernameErr" class="text-danger"></span>
        </div>
    </div>

    <div class="my-4 row justify-content-md-center">
        <label class="col-sm-1 col-form-label">Gender</label>
        <div class="col-sm-4">
            <div class="form-check form-check-inline m-1">
                <input class="form-check-input gender" type="radio" name="gender" id="male" value="Male"
                <?php if($gender == "Male") { echo "checked"; }?>>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline m-1">
                <input class="form-check-input col-sm-2 gender" type="radio" name="gender" id="female" value="Female"
                <?php if($gender == "Female") { echo "checked"; }?>>
                <label class="form-check-label col-sm-2 gender" for="female">Female</label>
            </div>
            <span id="genderErr" class="ml-5 text-danger"></span>
        </div>
    </div>

        <div class="my-4 row justify-content-md-center">
            <label for="hobbies" class="col-sm-1 col-form-label">Hobbies</label>
            <div class="col-sm-4">
                <div class="form-check form-check-inline m-1">
                    <input class="form-check-input hobby" type="checkbox" name="hobbies[]" id="cricket"
                            value="Cricket" <?php if (str_contains($hobbies, "Cricket")) {
                        echo "checked";
                    } ?>>
                    <label class="form-check-label" for="cricket">Cricket</label>
                </div>
                <div class="form-check form-check-inline m-1">
                    <input class="form-check-input hobby" type="checkbox" name="hobbies[]" id="music"
                            value="Music" <?php if (str_contains($hobbies, "Music")) {
                        echo "checked";
                    } ?>>
                    <label class="form-check-label" for="music">Music</label>
                </div>
                <div class="form-check form-check-inline m-1">
                    <input class="form-check-input hobby" type="checkbox" name="hobbies[]" id="dancing"
                            value="Dancing" <?php if (str_contains($hobbies, "Dancing")) {
                        echo "checked";
                    } ?>>
                    <label class="form-check-label" for="dancing">Dancing</label>
                </div>
            </div>
        </div>

        <div class="my-4 row justify-content-md-center">
            <label for="address" class="col-sm-1 col-form-label">Address</label>
            <div class="col-sm-4">
                <textarea class="form-control" name="address" id="address" rows="3"><?php echo $address?></textarea>
                <span id="addressErr" class="text-danger"></span>
            </div>
        </div>


        <div class="my-4 row justify-content-md-center">
            <label for="state" class="col-sm-1 col-form-label">Country</label>
            <div class="col-sm-4">
                <select name="country" class="form-select" id="country">
                    <option value="India" <?php if($country == "India") { echo "selected"; }?>>India</option>
                    <option value="USA" <?php if($country == "USA") { echo "selected"; }?>>USA</option>
                </select>
            </div>
        </div>

    <div class="my-4 row justify-content-md-center">
        <label for="state" class="col-sm-1 col-form-label">State</label>
        <div class="col-sm-4">
            <select name="state" id="state" class="form-select">
                <option value="Gujarat" <?php if($state == "India") { echo "selected"; }?>>Gujarat</option>
                <option value="Maharastra" <?php if($state == "Maharastra") { echo "selected"; }?>>Maharastra</option>
            </select>
        </div>
    </div>

    <div class="my-4 row justify-content-md-center">
        <div class="my-4 row justify-content-md-center">
            <button type="submit" name="save" class="btn btn-primary col-sm-1 mx-3">
                Save
            </button>
        </div>
    </div>
</form>
</script>
</body>
</html>