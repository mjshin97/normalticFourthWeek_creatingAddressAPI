<?php
    session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

    $host = 'localhost';
    $user = 'test_user'; 
    $pw = '1111'; 
    $db_name = 'test_db'; 
    $mysqli = new mysqli($host,$user,$pw,$db_name); 
    
    $userId = $_POST['id'];
    $userPw = $_POST["password"];
/////////////////////////////////////////////////////////////////variety methods
    $q = "SELECT * FROM test_table WHERE ((userId = '$userId')
    AND (userPw = '$userPw'))";

    // $q = "SELECT * FROM test_table WHERE (userId = '$userId' AND userPw = '$userPw')";
    // answer : fd' or '1'='1 /////v4

    // $q = "SELECT * FROM test_table WHERE userId = '$userId' 
    // AND userPw = '$userPw'"; 
    //answer : fd' or '1'='1 /////v3

    // $q = "SELECT * FROM test_table WHERE (userId = '$userId') AND (userPw = '$userPw')"; 
    //answer : fd') or '1'='1'# /////v2

    // $q = "SELECT * FROM test_table WHERE userId = '$userId' AND userPw = '$userPw'"; 
    //answer : fd' or '1'='1 answer : fd'# /////v1

////////////////////////////////////////////////////////////////
    $result = $mysqli -> query($q);
    $row = $result -> fetch_array(MYSQLI_ASSOC);//

    if($row != null){
        $_SESSION['is_login'] = true; //comunicate by '$_SESSION[is_login]' in 'main.php' line 6 to 8
        $_SESSION['nickname'] = $row['userId'];
        header('Location: ./main.php');
        exit;
    } else {
        echo"Please sign up first.";
    }
?>