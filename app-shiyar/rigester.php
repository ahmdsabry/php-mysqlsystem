
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<?php require_once 'nav.php' ?>  

<div class="container" dir="rtl" style="text-align: right !important;">


<form method="POST" >
اسم : <input class="form-control" type="text" name="name" required/>
<br>
العمر : <input class="form-control" type="date" name="age" required/>
<br>
إيميل : <input class="form-control" type="email" name="email" required/>
<br>
كلمة مرور : <input class="form-control" type="text" name="password" required />
<br>
<button class="btn btn-dark" type="submit" name="register">تسجيل - Register</button>

<a class="btn btn-warning" href="login.php">تسجيل دخول</a>

</form>

</div>


<?php 
   require_once 'mailer/connectToDatabase.php';

if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM userss WHERE email = :EMAIL");
    $email = $_POST['email'];
    $checkEmail->bindParam("EMAIL",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger" role="alert">
        هذا حساب سابقا مستخدم
      </div>';
    }else{
        $name =$_POST['name'] ;
        $password = ($_POST['password']) ;
        $email = $_POST['email'];
        $age = $_POST['age'];

        $addUser = $database->prepare("INSERT INTO 
        userss(name,age,password,email,SECURITY_CODE,role)
         VALUES(:NAME,:AGE,:PASSWORD,:EMAIL,:SECURITY_CODE,'user')");


        $addUser->bindParam("NAME",$name);
        $addUser->bindParam("AGE",$age);
        $addUser->bindParam("PASSWORD",$password);
        $addUser->bindParam("EMAIL",$email);
        $securityCode = md5(date("h:i:s"));
        $addUser->bindParam("SECURITY_CODE",$name);

        if($addUser->execute()){
            echo '<div class="alert alert-success" role="alert">
            تم إنشاء حساب بنجاح 
          </div>';

          require_once "mail.php";
          $mail->addAddress($email);
          $mail->Subject = "رمز تحقق من بريد الكتروني";
          $mail->Body = '<h1> شكرا لتسجيلك في موقعنا</h1>'
          . "<div> رابط تحقق من حساب" . "<div>" . 
          "<a href='http://localhost/server/app-shiyar/mailer/active.php?code=".$name  . "'>
           " . "http://localhost/server/app-shiyar/mailer/active.php". "?code=" .$name . "</a>";
          ;
          $mail->setFrom("as2874550@gmail.com", "ahmed sabry");
          $mail->send();


        }else{
            echo '<div class="alert alert-danger" role="alert">
            حدث خطا غير متوقع
          </div>';
        }
       
    }

}
?>
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
    <div class="container">
    <form method="POST">
name : <input class="form-control form-control-lg" type="text" name="name" required/> <br>
age : <input class="form-control form-control-lg" type="number" name="age" required/> <br>
e-mail : <input  class="form-control form-control-lg" type="email" name="email" required/> <br>
password : <input class="form-control form-control-lg" type="password" name="pass" required/> <br>
<button class="btn btn-primary mb-3" type="submit" name="send">register</button>
<a href="login.php" class="btn btn-secondary mb-3">login</a> 



</form>

    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>
</html>

  /*
$user="ahmed";
$pass="ahmed";
$mysql=new PDO("mysql:host=localhost;dbname=ahm;",$user,$pass);
 if(isset($_POST['send'])) {
$sql="select * from userss where email= :email";
$result=$mysql->prepare($sql);
$email=$_POST['email'];
$result->bindParam("email",$email);
$result->execute();
if($result->rowCount()>0) {
  echo  '<div class="alert alert-danger" role="alert">
 this email is using before
</div> ';
} 
else {
    $name=$_POST['name'];
    $age=$_POST['age'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $sql="INSERT into userss (name,age,email,password,secure,role) values ('$name','$age','$email','$pass','$name','user')";
    $result=$mysql->prepare($sql);
    $sec=md5(date("h:i:s"));
    if($result->execute()) {
        $name=$_POST['name'];

        $sql="UPDATE userss set active='1' where name='$name'";
        $result=$mysql->prepare($sql);
        $result->execute();
        echo  '<div class="alert alert-success" role="alert">
        the form is fulled successfully 
       </div>';
   //    header("Location : https://http://localhost/server/app-shiyar/login.php ");

     /*  require_once("mail.php");
       $mail->addAddress($email);
       $mail->Subject="رمز تحقق بريد الكتروني ";
       $mail->Body="<h1> شكرا   لتسجيلك في موقعنا </h1>" . "<div>   رابط تحقق من الحساب </div>". 
       "<a href='http://localhost/server/app-shiyar/active.php?code=".$sec."' >". "http://localhost/server/app-shiyar/active.php" . "?code=".$sec."</a>";
       $mail->setFrom("as2874550@gmail.com", "ahmed sabry");
       $mail->send();
    }
    else {
        echo "something wrong ";
    }
}

}

?>