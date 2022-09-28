<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-light bg-light">

<a class="navbar-brand" href="#">
AHMED SABRY</a>

<img src="profile.jpg" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">

</nav>
    <main class="container " style="text-align: right; direction: rtl; max-width:760px;  margin:auto;" >

<?php 
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role === "user"){


echo '<form method="POST">
<div class="p-3 shadow "> اسم :  </div>
<input class="form-control mb-1" type="text" name="name" value="'.$_SESSION['user']->name.'" required />
<div class="p-3 shadow "> العمر : </div>
<input  class="form-control mb-1" type="date" name="age" value="'.$_SESSION['user']->age.'" required />
<button class="w-100 btn btn-warning mt-1" type="submit" name="update" value="'.$_SESSION['user']->id.'">تحديث</button>
<a class="w-100 btn btn-light mt-1" href="user.php"> عودة لصفحة الرئيسية</a>
</form>';

if(isset($_POST['update'])){
   require_once 'connectToDatabase.php';
    $updateUserData = $database->prepare("UPDATE userss SET name 
    = :name ,age=:age WHERE id = :id ");
        $updateUserData->bindParam('name',$_POST['name']);

        $updateUserData->bindParam('age',$_POST['age']);
        $updateUserData->bindParam('id',$_POST['update']);

    if($updateUserData->execute()){
        echo '<div class="alert alert-success mt-3">  تم تحديث البيانات بنجاح </div>';
        $user =  $database->prepare("SELECT * FROM userss WHERE id = :id ");
        $user->bindParam('id',$_POST['update']);
        $user->execute();
        $_SESSION['user'] = $user->fetchObject();
        header("refresh:2;");
    }  else{
        echo '<div class="alert alert-danger mt-3">  فشل تحديث البيانات </div>';
    }
}
}else{
    session_unset();
    session_destroy();
    header("Location:http://localhost/server/app-shiyar/login.php",true);
}
}else{
    session_unset();
    session_destroy();
    header("Location:http://localhost/server/app-shiyar/login.php",true);
}

?>

</main>
</body>
</html>
<!--
session_start();
if(isset($_SESSION['user'])) {
    echo '<form method="POST">
    name :<input type="text" name="name" value="'.$_SESSION['user']->name.'" required/>
    age :<input type="number" name="age" value="'.$_SESSION['user']->age.'" required/>
    pass :<input type="password" name="pass" value="'.$_SESSION['user']->password.'" required/>
    <button type="submit" name="edit">update  </button>
    <button type="submit" name="exit">exit  </button>
    <a href="../login.php "> back to login page> </a>
    
    </form>';
}

if(isset($_POST['edit']))
{

    $user="ahmed";
$pass="ahmed";
$mysql=new PDO("mysql:host=localhost;dbname=ahm;",$user,$pass);

//get id from the user that want update his data 
$id=$_SESSION['user']->id;

$name=$_POST['name'];
$age=$_POST['age'];
$password=$_POST['pass'];
$sql="UPDATE userss set name='$name',age='$age',password='$password' where id='$id'";
$result=$mysql->prepare($sql);
if($result->execute() ) {
    echo "the data is edited successfully";
    $user=$mysql->prepare("select * from userss where id='$id'");
    $user->execute();
    $_SESSION['user']=$user->fetchObject();
    header("refresh:3;"); 
}
else {
    echo "something wrong";
}

}
if(isset($_POST['exit'])) {
    session_unset();
    session_destroy();
    header("Location:http://localhost/server/app-shiyar/login.php",true);
}
?>*/
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-light bg-light">

<a class="navbar-brand" href="#">
  Coder Shiyar
</a>

<img src="../img/logo.jpg" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">

</nav>
    <main class="container " style="text-align: right; direction: rtl; max-width:760px;  margin:auto;" >
