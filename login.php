<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $username=$_POST['username'];
    $password=$_POST['password'];

    require 'db_connect.php';

    //is user is already logged in 
    if(isset($_SESSION['username']))
    $alert="You are already logged in!";
    else
    {
        //validate user
        $sql="select * from user where username='$username'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $user=mysqli_fetch_assoc($result);
            $hash=$user['password'];
            if(password_verify($password,$hash))
            {
                session_start();
                $_SESSION['id']=$user['id'];
                $_SESSION['username']=$user['username'];
                header('Location:/QuickNotes/home.php');
            }
            else
            $alert="Please enter valid details";
        }
        else
        $alert="Please enter valid details";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .container{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
    </style>

  </head>
  <body>
    <?php require 'base.php' ?>
    <?php

    if(isset($alert))
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Failed!</strong>".$alert."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    ?>

    <form class="container mt-5" method="post" action="/QuickNotes/login.php">
        <h1>Log In</h1>
  <div class="mb-3 mt-5 col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
  </div>
  <div class="mb-3 col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Log In</button>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>