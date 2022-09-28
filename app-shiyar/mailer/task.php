<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <!-- Image and text -->
    <!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-light bg-light">

<a class="navbar-brand" href="#">
AHMED SABRY </a>

<img src="profile.jpg" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">

</nav>

<main class="container m-auto" style="max-width: 720px; direction: rtl; text-align: right;">

<?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role === "user"){

  echo '<form method="POST">
  <a class="w-100 btn btn-dark mb-3 mt-2" style="" href="user.php"> عودة لصفحة الرئيسية</a>
  <input class="form-control" type="text" name="text" required/>
  <button class="w-100 btn btn-warning mb-3 mt-2" type="submit" name="add">إضافة</button>
  </form>';


  require_once 'connectToDatabase.php';
if(isset($_POST['add'])){

$addItem = $database->prepare("INSERT INTO tasks(text,userid,status) VALUES(:text,:userId,'no')");
$addItem->bindParam("text",$_POST['text']);

$userId = $_SESSION['user']->id;

$addItem->bindParam("userId",$userId);


if($addItem->execute()){
echo '<div class="alert alert-success mt-3 mb-3"> تم اضافة بنجاح </div>';
header("refresh:2;");
}


}

$toDoItems = $database->prepare("SELECT * FROM tasks WHERE userId = :id");
$userId = $_SESSION['user']->id;

$toDoItems->bindParam("id",$userId);
$toDoItems->execute();
echo '<table class="table">';
echo '<tr>';
echo '<th>المهمة</th>';
echo '<th>الحالة</th>';
echo '<th>حذف</th>';

echo '</tr>';
foreach($toDoItems AS $items){
  echo ' <form> <tr> ';
echo '<th>'.$items['text'].'</th>';
if($items['status'] ==="no"){
  echo '<th>
  <input type="hidden" name="statusValue" value="'.$items['status'].'"/>
  <button type="submit" class="btn btn-warning" 
  name="status" value="'.$items['id'].'">غير منجز</button> </th>';
}else if($items['status'] ==="yes"){
  echo '<th> 
  <input type="hidden" name="statusValue" value="'.$items['status'].'"/>
  <button type="submit" class="btn btn-success" 
  name="status" value="'.$items['id'].'">منجز</button></th>';
}

echo '<th> <button type="submit" class="btn btn-outline-danger" 
name="remove" value="'.$items['id'].'">حذف</button></th>';

echo '</tr> </form>';

}
echo '</table>';

if(isset($_GET['status'])){

if($_GET['statusValue'] ==="no"){
$updateStatus = $database->prepare("UPDATE tasks SET status = 'yes' WHERE id = :id");
$updateStatus->bindParam("id",$_GET['status']);
$updateStatus->execute();
header("location:task.php",true);
}else if($_GET['statusValue'] ==="yes"){
  $updateStatus = $database->prepare("UPDATE tasks SET status = 'no' WHERE id = :id");
  $updateStatus->bindParam("id",$_GET['status']);
  $updateStatus->execute();
  header("location:task.php",true);
}

}

if(isset($_GET['remove'])){
$removeItem = $database->prepare("DELETE FROM tasks WHERE id = :id");
$removeItem->bindParam('id',$_GET['remove']);
$removeItem->execute();
header("location:task.php",true);
}

}else{
    header("Location:http://localhost/server/app-shiyar/login.php",true);
  die("");
}
}else{
    header("Location:http://localhost/server/app-shiyar/login.php",true);
  die(""); 
}

if(isset($_GET['logout'])){
  session_unset();
  session_destroy();
  header("Location:http://localhost/server/app-shiyar/login.php",true);
}
?> 
</main>
</body>
</html>

<?php
/*session_start();
$user="ahmed";
$pass="ahmed";
$mysql=new PDO("mysql:host=localhost;dbname=ahm;",$user,$pass);

if(isset($_SESSION['user'])) { 
    if($_SESSION['user']->role==="user") {
         
        echo "<nav class='navbar navbar-dark bg-primary'>

        <form method='POST'>  <input type='text' style='width:700px; margin:20px' name='text'>  
        <button type='submit' class='btn btn-success' name='send' > add to list </button>
        <button type='submit'   class='btn btn-secondary' name='edit' > update </button>
        <button type='submit'  class='btn btn-danger' name='delete' > delete </button>
        
        <button type='submit'  class='btn btn-dark'  name='exit'> logout </button>
        </form>   </nav>";
         
    }
}

if(isset($_POST['send']) ) {
  
     $userid=$_SESSION['user']->id;
    $text=$_POST['text'];
    $sql="INSERT into tasks (text,userid) values ('$text','$userid')";
    $result=$mysql->prepare($sql);
    
    if($result->execute()) {
        echo " the task is added to database";
    }


}
$userid=$_SESSION['user']->id;
$sql="select * from tasks where userid='$userid'";
$result=$mysql->prepare($sql);
$result->execute();
echo '<table>';
echo '<tr>';
echo '<th>  task</th>';
echo '<th>  status</th>';
echo '<th>  delete</th>';
echo '</tr>';
foreach($result as $a) {
   echo ' 
    <li class="list-group-item "">'.$a['text'].'</li>   ';
  echo '</table>';
}

if(isset($_POST['exit'])) {
    header("Location:../login.php",true);
    session_unset();
    session_destroy();
}
?>


*/

?>