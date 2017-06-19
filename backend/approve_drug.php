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
        $stmnt = $conn->prepare("SELECT * FROM DRUG_APPROVAL WHERE NAME = ?");
        $stmnt->execute(array($value));

        $row = $stmnt->fetch(PDO::FETCH_NUM);
        $name = $row['0'];
        $dosage = $row['1'];
        $halfLife = $row['2'];
        $standDown = $row['3'];
        $ingredients = $row['4'];
        $approval = $row['5'];

        $stmnt = $conn->prepare("INSERT INTO Medication VALUES(?, ?, ?, ?, ?, ?)");        
        $stmnt->execute(array($name, $dosage, $halfLife, $standDown, $ingredients, "1"));
        $stmnt = $conn->prepare("DELETE FROM DRUG_APPROVAL WHERE NAME=?");        
        $stmnt->execute(array($value));
     }
     header('Location: https://infs3202-gzhlr.uqcloud.net/search.php'); 
?>
