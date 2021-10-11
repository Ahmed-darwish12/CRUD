<?php
$host= "localhost";
$password = "";
$user= "root";
$dbname= "trainingcompany";

$connect = mysqli_connect($host ,$user ,$password , $dbname);

// if($connect){
//     echo "true";
// }else{
//     echo "false";
// }

// insert

if(isset($_POST['send'])){
    $course = $_POST['course'];
    $cost = $_POST['cost'];

    $insert =  "INSERT INTO `courses` Values (null ,'$course' , $cost )"; 
    $i = mysqli_query($connect , $insert);
}
//  Read  Select
$select = "SELECT * FROM `courses`";
$s = mysqli_query($connect , $select);

// delete  
if(isset($_GET['delete'])){
    $id =  $_GET['delete'];
    $delete = "DELETE FROM `courses` WHERE id = $id ";
    mysqli_query($connect , $delete);
}

// EDIT
$course = '';
$cost = '';
$update = false;
if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $select = "SELECT * FROM `courses` WHERE id = $id ";
   $ss = mysqli_query($connect ,$select);
   $row = mysqli_fetch_assoc($ss);
   $course = $row['course'];
   $cost = $row['cost'];
    if(isset($_POST['update'])){
        $course = $_POST['course'];
        $cost = $_POST['cost'];
    
        $update =  "UPDATE `courses` SET course = '$course' , cost = $cost WHERE id = $id "; 
        $i = mysqli_query($connect , $update);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="./main.css">
</head>
<body>
    
<div class="container col-6">
 <div class="card">
     <div class="card-body">
         <h2 class="text-info text-center"> CRUD Operation</h2>
       <form method="POST">
           <div class="form-group">
               <label>Course</label>
               <input name="course" type="text" value ="<?php echo $course?>" class="form-control" placeholder="Course Name">
           </div>
           <div class="form-group">
               <label>Course Cost</label>
               <input name="cost" type="text" value ="<?php echo $cost?>"class="form-control" placeholder="Course Cost">
           </div>
           <div class="mx-auto w-25">
               <?php if($update) :?>
               <button name="update" class="btn btn-primary mx-auto my-3 w-40">update Data</button>
               <?php else: ?>
           <button name="send" class="btn btn-info mx-auto my-3 w-40">Send Data</button>
           <?php endif ;?>
           </div>
       </form>
     </div>
 </div>
</div>

<div class="container col-6 mt-2">
 <div class="card">
     <div class="card-body">
      <table class="table table-dark">
         <tr>
             <th>ID</th>
             <th>Course</th>
             <th>Cost</th>
             <th> Action</th>
         </tr>
         <?php foreach($s as $data){ ?>
               <tr>
                <th> <?php echo $data['id'] ?></th>
                <th> <?php echo $data['course'] ?></th>
                <th> <?php echo $data['cost'] ?></th>
                <td> <a href="index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger mx-3"> Delete</a><a href="index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info">Edit</a> </td>

               </tr>
                
            <?php }?>
      </table>
     </div>
 </div>
</div>



</body>
</html>