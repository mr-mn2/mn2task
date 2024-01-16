<?php

defined("BASE_PATH") or die("peremetion denied");
function GetCurrentUserId()
{
    if (!isset($_SESSION['login'])){
        return "u should log in <a href = '".siteUrl('auth.php')."'> login here</a>";
    }
    return $_SESSION['login'] -> id;
}
function isloggedIn()
{
    return isset($_SESSION['login']) ? true : false;
}

function getUserByEamil($email)
{
    global $pdo;
    $query = 'select * from users where email =:email';
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? false;
}
function Login($email, $password)
{
    $getUserByEamil = getUserByEamil($email);
    if(!$getUserByEamil){
        return false;
    }
    if(!password_verify($password , $getUserByEamil -> password)){
        return false;
    }
    $_SESSION['login'] = $getUserByEamil;
    var_dump($_SESSION);
    return true;
}
function logout()
{
   unset($_SESSION['login']);
}


function isStrongPassword($password){
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    }
     return true; 
}

function registerValidation($data)
{
    
    if (empty($data['name'] or strlen($data['name']) > 50)) {
        return "invalid name name shoud be less than 50 character !";
    }
    if (empty($data['email']) or !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        return "invalid email address!";
    }
    if (!isStrongPassword($data['password'])) {
        return 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }
   return true;
}
function Register($userData)
{
   
    global $pdo;
    $query = "insert into users(name,email,password) values(:name,:email,:password)";
    $stmt = $pdo->prepare($query);
    $password = password_hash($userData['password'],PASSWORD_BCRYPT);
    $stmt->execute([':name' => $userData['name'], ':email' => $userData['email'], ':password' => $password]);
    return $pdo->lastInsertId();
}
