<?php
session_start();
if (isset($_SESSION['user'])){
    header("Location:index.php");
}
print_r($_POST);
$regCode = true;
$phone = trim($_POST['phone'])??null;
$email = trim($_POST['email'])??null;
$login = trim($_POST['login'])??null;
$pass = trim($_POST['pass'])??null;
$pass2 = trim($_POST['passRep'])??null;
$mysql = new mysqli("localhost", "root", "", "internet_shop");
$phoneRegExp = "/\+?(\d{1,2})[\s(]*(\d{3})[\s)]*(\d{3})[\s-]*(\d{2})[\s-]*(\d{2})$/";
$emailRegExp = "/[\w\.']+@\w{1,5}\.\w{2,3}$/";
$phoneParts = Array();
$data = array('values'=>array('login'=>$login,'email'=>$email,'phone'=>$phone));

$errors = array('login'=>"",'email'=>"",'phone'=>"",'pass'=>"");
unset($_SESSION['signUp']);

if (preg_match("/[A-z0-9]{4,20}/",$login)){
    if($mysql->query("SELECT * FROM users WHERE login = '$login'")->num_rows){
        $errors['login'] = "this user already exists";
    } else{
     $login=mysqli_real_escape_string($mysql, htmlspecialchars($login));
    }
} else{
    $errors['login'] = "incorrect login";
}

if (!preg_match($emailRegExp,$email)){
    $errors['email'] = "incorrect email";
    $regCode = false;
}
if (!preg_match("/.{8,}/",$pass)){
    $errors['pass'] = "password too short";
    $regCode = false;
}elseif (preg_match("/[A-Z]+/",$pass) && preg_match("/[a-z]+/",$pass) && preg_match("/[0-9]+/",$pass)){
    if($pass==$pass2){
        $pass = md5($pass);
    } else{
        $errors['pass'] = "passwords are not match";
        $regCode = false;
    }
} else {
    $errors['pass'] = "incorrect password";
    $regCode = false;
}

if (!empty($phone)){
    if (preg_match($phoneRegExp,$phone,$phoneParts)){
        $phone = "";
        foreach ($phoneParts as $key=>$item){
            if ($key>0)
            $phone= $phone.$item;
        }
    } else{
        $errors['phone'] = "incorrect phone number";
    }
}
if ($regCode){
    $mysql->query("INSERT INTO `users` (login,password,email,phone) VALUES ('$login','$pass','$email','$phone')");
    $_SESSION['user'] = $login;
    header("Location:index.php");

}else{
    $data['errors'] = $errors;
    $_SESSION['signUp'] = $data;
    header("Location:registration.php");
}
exit();


