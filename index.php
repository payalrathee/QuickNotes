<?php

//database connectivity variables
$servername="localhost";
$user="root";
$password="";
$db="quick_notes";
$isInserted=false;
$isUpdated=false;
$isDeleted=false;

//establish connection
$conn=mysqli_connect($servername,$user,$password,$db);

if(isset($_GET['delete']))
{
  $id=$_GET['delete'];
  $sql="delete from note where id=$id";
  $result=mysqli_query($conn,$sql);
  if($result)
  $isDeleted=true;
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
  if(isset($_POST['editId']))
  {
      $id=$_POST['editId'];
      $title=$_POST['titleEdit'];
      $desc=$_POST['descriptionEdit'];

      $sql="update note set title='$title', description='$desc' where id=$id";
      $result=mysqli_query($conn,$sql);
      if($result)
      $isUpdated=true;
  }
  else
  {
    $title=$_POST['title'];
    $desc=$_POST['description'];

    $sql="insert into note(title,description) values('$title','$desc')";
    $result=mysqli_query($conn,$sql);
    if($result)
    $isInserted=true;
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QuickNotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet"/>
  </head>
  <body>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="container mt-3" method="post" action="/QuickNotes/index.php">
        <input type="hidden" id="editId" name="editId">
  <div class="mb-3">
    <label for="titleEdit" class="form-label">Title</label>
    <input type="text" class="form-control" id="titleEdit" aria-describedby="emailHelp" name="titleEdit">
  </div>
  <div class="mb-3">
    <label for="descriptionEdit" class="form-label">Note</label>
    <div class="form-floating">
      <textarea class="form-control" placeholder="Leave a comment here" id="descriptionEdit" style="height: 100px" name="descriptionEdit"></textarea>
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>
    </div>
  </div>
</div>
    
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">QuickNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About QuickNotes</a>
        </li>
      </ul>
      <!-- <form class="d-flex" role="search">
        <a class="nav-item nav-link" href="#" style="color:white;">Sign Up</a> 
      </form> -->
    </div>
  </div>
</nav>

<?php
if($isInserted==true)
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been added successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>"
?>
<?php
if($isUpdated==true)
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>"
?>
<?php
if($isDeleted==true)
echo "
<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>"
?>

<form class="container mt-3" method="post" action="/QuickNotes/index.php">
    <h2>Add a Note</h2>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Note</label>
    <div class="form-floating">
      <textarea class="form-control" placeholder="Leave a comment here" id="description" style="height: 100px" name="description"></textarea>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>

<div class="container mt-3 my-3">
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S No.</th>
      <th scope="col">Title</th>
      <th scope="col">Note</th>
      <th scope="col">Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql="select * from note";
      $result=mysqli_query($conn,$sql);
      $count=1;
      while($row=mysqli_fetch_assoc($result))
      {
        echo"
        <tr>
          <th scope='row'>".$count."</th>
          <td>".$row['title']."</td>
          <td>".$row['description']."</td>
          <td>".$row['date']."</td>
          <td>
          <button type='button' class='btn btn-primary edit' id=".$row['id'].">Edit</button>
          <button type='button' class='btn btn-danger delete' id=d".$row['id'].">Delete</button>
          </td>
        </tr>";
        $count++;
      }
    ?>
  </tbody>
  <hr>
</table>
</div>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
    } );
    </script>
    <script>
      edits=document.getElementsByClassName("edit");
      Array.from(edits).forEach((element)=>{
        element.addEventListener('click',(e)=>{
          tr=e.target.parentNode.parentNode;
          title=tr.getElementsByTagName('td')[0].innerText;
          description=tr.getElementsByTagName('td')[1].innerText;
          descriptionEdit.value=description;
          titleEdit.value=title;
          editId.value=e.target.id;
          $('#editModal').modal('toggle');
        })
      })

      deletes=document.getElementsByClassName("delete");
      Array.from(deletes).forEach((element)=>{
        element.addEventListener('click',(e)=>{
          id=e.target.id.substring(1,);
          if(confirm("Are you sure you want to delete this note?"))
          {
            window.location=`/QuickNotes/index.php?delete=${id}`
          }
        })
      })
    </script>
  </body>
</html>