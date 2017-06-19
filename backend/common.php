<?php
function connect_to_database() {
    $conn = new PDO("mysql:host=localhost;dbname=MilkBank", "admin", "public") or die("Database Error");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function create_user($username, $password, $repassword, $email) {
    $conn = connect_to_database();
    
    $stmnt = $conn->prepare("SELECT COUNT(*) AS total FROM USERS WHERE USERNAME=?");
    $stmnt->execute(array($username));
    $result = $stmnt->fetch(PDO::FETCH_NUM);

    $stmnt = $conn->prepare("SELECT COUNT(*) AS total FROM USERS_APPROVAL WHERE USERNAME=?");
    $stmnt->execute(array($username));
    $result2 = $stmnt->fetch(PDO::FETCH_NUM);
    
    $userCount = $result['0'] + $result2['0'];

    if ($userCount != 0) {
        //double up username
        session_unset();
        $_SESSION['double_user'] = 1;
        header('Location: https://infs3202-gzhlr.uqcloud.net/create_user.php');
    } else if (isset($_SESSION['double_user'])) {
        unset ($_SESSION['double_user']);
    }
    //check for empty passwords
    if (($password != '') && ($repassword != '')) {
        //reset empty password flag
        if (isset ($_SESSION['empty_pass_error'])) {
            unset ($_SESSION['empty_pass_error']);
        }
        //check for matching passwords 
        if ($password != $repassword) {
            session_unset();
            $_SESSION['match_pass_error'] = 1;
            header('Location: https://infs3202-gzhlr.uqcloud.net/create_user.php');
        } else {
            //rest matching password flag
            if (isset ($_SESSION['match_pass_error'])) {
                unset ($_SESSION['match_pass_error']);
            }
        }
    } else {
    //redirect for empty password
        session_unset();
        $_SESSION['empty_pass_error'] = 1;
        header('Location: https://infs3202-gzhlr.uqcloud.net/create_user.php');
    }
    
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);
    $stmnt = $conn->prepare("INSERT INTO USERS_APPROVAL VALUES(?,?,?,?)");
    $stmnt->execute(array($username, $hashedPass, $email, $userCount));
    session_unset();
    header('Location: https://infs3202-gzhlr.uqcloud.net/');
}

function check_password($password, $hash)
{
    if (password_verify($password, $hash)) {
        //passwords match 
        if (isset($_SESSION['bad_password'])) {
            unset($_SESSION['bad_password']); 
        }
        return true;
    } else {
        session_unset();
        $_SESSION['bad_password'] = 1;
        header('Location: https://infs3202-gzhlr.uqcloud.net/');
    }   
    return false;
}

function check_login($username, $password)
{
    $conn = connect_to_database();
    $stmnt = $conn->prepare("SELECT * FROM USERS WHERE username = ?");
    $stmnt->execute(array($username));
    $result = $stmnt->fetch(PDO::FETCH_NUM);
    
    if ($result != false) {
        $correctPass = check_password($password, $result['1']);
        if ($correctPass == true) {      
            $_SESSION['username'] = $username;
            $_SESSION['access'] = "granted";
            return true;
        }
    }
    session_unset();
    header('Location: https://infs3202-gzhlr.uqcloud.net/');
    return false;
}

?>
