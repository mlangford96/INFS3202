<!DOCTYPE HTML>
    <HEAD>
        <title>Search</title>
         <?php
            session_start();
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
          
            //check for empty passwords
            if (($password != '') && ($repassword != '')) {
                //reset empty password flag
                if (isset ($_SESSION['empty_pass_error'])) {
                    unset ($_SESSION['empty_pass_error']);
                }                 
                //check for matching passwords 
                if ($password != $repassword) {
                    $_SESSION['match_pass_error'] = 1;
                    header('Location: https://infs3202-gzhlr.uqcloud.net/create_account.php/');
                } else {
                    //rest matching password flag
                    if (isset ($_SESSION['match_pass_error'])) {
                        unset ($_SESSION['match_pass_error']);
                    }                 
                }
            } else {
                //redirect for empty password
                $_SESSIONS['empty_pass_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/create_account.php/'); 
            }

            //connect to database
            $connection = mysql_connect("localhost", "MLangford", "Redline66");

            if (!$connection) {
                echo "connection failed";
                $_SESSION['connect_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }
             else if(isset($_SESSION['connect_error'])) {
                unset($_SESSION['connect_error']);
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $db_selected = mysql_select_db("MilkBank", $connection) or die ("error");

            mysql_query("INSERT INTO USERS VALUES('$username', '$hashed_password', '$email', '1')");
            $_SESSION['hashpass'] = $hashed_password;
            header('Location: https://infs3202-gzhlr.uqcloud.net/'); //will be changed to email conf
        ?>
        <link rel = "stylesheet" type = "text/css" href = "style/results.css">

    </HEAD>

 </HTML>

