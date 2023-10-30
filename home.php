<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://www.tutsmake.com/country-state-city-database-in-mysql-php-ajax/" rel="stylesheet"
          integrity="https://www.tutsmake.com/country-state-city-database-in-mysql-php-ajax/" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js"></script>
    <title>Users</title>
    <style>
        *{
            box-sizing: border-box;
        }
        .th,td{
            width:500px;
        }
    </style>
</head>
<body>

<div class="my-3 row justify-content-md-center">
    <div class="d-flex flex-row">
        <a href="register.html" class="col-sm-1 btn btn-primary mx-4">Add user</a>
    </div>

    <div class="d-flex flex-row-reverse col-sm-12">
        <!-- <lable for="serchUsername" class="mx-4">Serch</a> -->
        <button type="button" class="btn btn-primary mx-1   " name="serchBtn" id="serchBtn"><i class="bi bi-search"></i></button>
        <input type="text" name="serchbox" class="col-sm-2" id="serchbox">
    </div>
</div>


<?php
include 'connection.php';
$query = "SELECT * FROM `user`";
$run = mysqli_query($conn, $query);
?>
<table class="table table-hover mx-2">
    <thead>
    <th>Id</th>
    <th>Profile Photo</th>
    <th>Name</th>
    <th>Email</th>
    <th>Username</th>
    <th>Hobby</th>
    <th>Gender</th>
    <th>Address</th>
    <th>State</th>
    <th>City</th>
    <th>Action</th>
    </thead>

    <tbody id="userData">
    <?php
    while ($row = mysqli_fetch_assoc($run)) {

        $id = $row['id'];
        $name = $row['name'];
        $profile = $row['profile_photo'];
        $email = $row['email'];
        $username = $row['username'];
        $gender = $row['gender'];
        $hobbies = $row['hobby'];
        $address = $row['address'];
        $country = $row['country'];
        $state = $row['state'];

        ?>

        <tr>
            <td><?php echo $id; ?></td>
            <td><img src="<?php echo $profile; ?>" alt="<?php echo $profile; ?>" height="50px" width="70px"></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $email ?></td>
            <td><?php echo $username ?></td>
            <td><?php echo $hobbies ?></td>
            <td><?php echo $gender ?></td>
            <td><?php echo $address?></td>
            <td><?php echo $country?></td>
            <td><?php echo $state?></td>

            <td>
                <a href="editUser.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class="bi bi-pen"></i></a>
              
                <a href="deleteUser.php?id=<?php echo $id; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
               
            </td>
        </tr>

        <?php
    }
    ?>

    </tbody>
</table>
</body>
</html>