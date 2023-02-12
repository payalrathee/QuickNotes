<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quick Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <p class="navbar-brand">QuickNotes</p>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/QuickNotes/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/QuickNotes/about.php">About QuickNotes</a>
        </li>
      </ul>
      <form class="navbar-nav mb-2 mb-lg-0">
        <?php
        if(isset($_SESSION['username']))
        echo "
        <a class='nav-item nav-link' href='/QuickNotes/logout.php' style='color:white;'>Logout</a> 
        ";
        else
        echo "
        <a class='nav-item nav-link' href='/QuickNotes/login.php' style='color:white;'>Log In</a>
        <a class='nav-item nav-link' href='/QuickNotes/signup.php' style='color:white;'>Sign Up</a>
        ";

        ?>
        </form>
      
    </div>
  </div>
</nav>

</body>
</html>

