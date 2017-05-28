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
            $result = mysql_query("SELECT COUNT(*) AS total FROM USERS WHERE USERNAME='$username'");
            $row = mysql_fetch_array($result);

            $result = mysql_query("SELECT COUNT(*) AS total FROM USERS_APPROVAL WHERE USERNAME='$username'");
            $row2 = mysql_fetch_array($result);

            if ($row['0'] != 0 || $row2['0'] != 0) {
                $_SESSION['user_in_use_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/INFS3202/create_account.php');
                
            } else {
                if(isset($_SESSION['user_in_use_error'])) {
                    unset ($_SESSION['user_in_use_error']);
                }
            }          
  
            mysql_query("INSERT INTO USERS_APPROVAL VALUES('$username', '$hashed_password', '$email', '1')");
            $_SESSION['hashpass'] = $hashed_password;
            header('Location: https://infs3202-gzhlr.uqcloud.net/');
        ?>

