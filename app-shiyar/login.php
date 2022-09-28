
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php require_once 'nav.php' ?>  
 
<main class="container mt-3" style="text-align: right!important;">
<form method="POST">

<p class="font-weight-bold">بريد الكتروني </p>
<input class="form-control" type="email" name="email" required/>


<p class="font-weight-bold">كلمة المرور </p>
<input class="form-control" type="password" name="password" required/>
<a href="reset.php"> نسيت كلمة مرور؟</a>
<br>
<a class="btn btn-outline-dark mt-3" href="rigester.php">تسجيل </a>
<button class="btn btn-warning mt-3" type="submit" name="login">تسجيل دخول</button>

</form>

<?php
if(isset($_POST['login'])){
    require_once 'mailer/connectToDatabase.php';
$login = $database->prepare("SELECT * FROM userss WHERE email = :email AND password = :password");
$login->bindParam("email",$_POST['email']);
$passwordUser = $_POST['password'];
$login->bindParam("password",$passwordUser);
$login->execute();
if($login->rowCount()===1){
$user = $login->fetchObject();
if($user->active == 1){
    session_start();
$_SESSION['user'] = $user;

if($user->role ==="user"){
header("location: http://localhost/server/app-shiyar/mailer/user.php",true);
}else if($user->role ==="ADMIN"){
    header("location:admin/index.php",true);
}else if($user->role ==="SUPER-ADMIN"){
    header("location:super-admin/index.php",true);
}

}else{
    echo '
    <div class="alert alert-warning"> 
    يرجى تفعيل حسابك في البداية , لقد ارسلنا 
    رمز تحقق من حسابك إلى بريد الكتروني خاص بك
    </div>
    ';
}
}else{
 echo '
 <div class="alert alert-danger">
 كلمة مرور او بريد الكتروني غير صحيح 
 </div>
 ';   
}
}
?>
</main>


</body>
</html>






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
    <form method="POST">
    <div class="container">
    e-mail : <input  class="form-control form-control-lg" type="email" name="email"  /> <br>
password : <input class="form-control form-control-lg" type="password" name="pass"  /> <br>
<button class="btn btn-primary mb-3" type="submit" name="login">login</button>
<a href="rigester.php" class="btn btn-secondary mb-3">register</a> 

    </div>
    </form>
 
     

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>
</html>


<ed?php
/*if(isset($_POST['login'])) {
    $user="ahmed";
$pass="ahmed";
$mysql=new PDO("mysql:host=localhost;dbname=ahm;",$user,$pass);
$email=$_POST['email'];
$pass=$_POST['pass'];

$sql="select * from userss where email= '$email' and password ='$pass'";
$result=$mysql->prepare($sql);
$result->execute();
if($result->rowCount()===1) {
    $user=$result->fetchObject();
    if($user->active==="1") {
        session_start();    
        $_SESSION['user']=$user;
        echo '<div class="alert alert-info" role="alert">
      hello . '.$user->name.' 
      </div>';
      $_SESSION['email']=$user->email;
      $_SESSION['password']=$user->password;
      $_SESSION['name']=$user->name;
      if($user->role==="user") {
        header("Location:mailer/user.php",true);
    }
      elseif ($user->role==="admin") {
        header("Location:mailer/admin.php",true);
 
      }
    }
    else {
        echo "يرجي تفعيل حسابك";
    }

}
else {
    echo ' <div class="alert alert-danger" role="alert">
 
 يرجي تفعيل حسابك او اعادة كتابته بشكل صحيح
    </div>';

}

 }

?>