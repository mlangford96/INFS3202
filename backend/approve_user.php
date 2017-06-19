<?php 
    session_start();
    require "common.php";
    $loggedIn = check_login($_SESSION['username'], $_SESSION['password']);
    $conn = connect_to_database();    
    
    if ($_SESSION['username'] != "admin") {
        header('Location: https://infs3202-gzhlr.uqcloud.net/');
    }
    
    foreach ($_POST as $key => $value) {
        htmlspecialchars($key); 
        htmlspecialchars($value); 
        $stmnt = $conn->prepare("SELECT * FROM USERS_APPROVAL WHERE USERNAME = ?");
        $stmnt->execute(array($value));

        $row = $stmnt->fetch(PDO::FETCH_NUM);
        $name = $row['0'];
        $pass = $row['1'];
        $email = $row['2'];

        $stmnt = $conn->prepare("INSERT INTO USERS VALUES(?, ?, ?, ?)");        
        $stmnt->execute(array($name, $pass, $email, "1"));
        $stmnt = $conn->prepare("DELETE FROM USERS_APPROVAL WHERE USERNAME=?");        
        $stmnt->execute(array($value));
     }
     header('Location: https://infs3202-gzhlr.uqcloud.net/search.php'); 
?>
