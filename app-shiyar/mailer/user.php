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
<nav class="navbar navbar-light bg-light">

  <a class="navbar-brand" href="#">
AHMED SABRY  </a>

  <img src="profile.jpg" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">

</nav>

<main class="container m-auto" style="max-width: 720px;">

<?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role === "user"){
echo '<div class="shadow p-3 mb-1 bg-white rounded mt-5"> Welcome ' .$_SESSION['user']->name . "</div>";
echo '<a  class="btn btn-light shadow w-100 mb-1" href="profile.php">تعديل ملف الشخصي</a>';
echo '<a  class="btn btn-light shadow w-100 mb-1" href="task.php">إضافة واجبات لقيام بها</a>';

echo "<form> <button class='btn btn-danger w-100' type='submit' name='logout'>تسجيل خروج</button></form>";
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


<!-- <
session_start();
if(isset($_SESSION['user'])) { 
    if($_SESSION['user']->role==="user") {
        echo "welcome ".$_SESSION['user']->name;
        echo "<a href='profile.php'> updatedata   </a>";
        echo "<form>  <button type='submit' name='add'> addtolist </form>";
        echo "<form> <button type='submit' name='logout'> logout </form>";
    }
    else {
        header("Location:https://http://localhost/server/app-shiyar/login.php",true);
        die("");
    }

}
else {
    header("Location:http://localhost/server/app-shiyar/login.php",true);
    die("");

}
if(isset($_GET['logout']))
 {
     session_unset();
     session_destroy();
     header("Location:http://localhost/server/app-shiyar/login.php",true);

 }
 if(isset($_GET['add']) ) {
    header("Location:http://localhost/server/app-shiyar/mailer/task.php",true);
    

 }

?>
