       <?php session_start();
            $connection = mysql_connect("localhost", 'MLangford', 'Redline66') or die('error');
            $db_selected = mysql_select_db("MilkBank", $connection) or die ("error");

            if (!$connection) {
                echo "connection failed";
                $_POST['pass_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }
     
           $username = $_SESSION['username'];           
            $password = $_SESSION['password'];

            $result = mysql_query("SELECT * FROM USERS WHERE USERNAME='$username'");
            $row = mysql_fetch_array($result);
            $hash = $row['1'];
            if (password_verify($password, $hash)) {
                //passwords match 
                if (isset($_SESSION['bad_password'])) {
                    unset($_SESSION['bad_password']);
                } 
            } else {
                $_SESSION['bad_password'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }            
            if ($_SESSION['username'] != "mlangford") {
                 header('Location: https://infs3202-gzhlr.uqcloud.net/'); 
            }
            foreach ($_POST as $key => $value) {
                echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
                htmlspecialchars($key); 
                htmlspecialchars($value);
        
                $result = mysql_query("SELECT * FROM USERS_APPROVAL WHERE USERNAME='$value'");
                $row = mysql_fetch_array($result);
                $name = $row['0'];
                $pass = $row['1'];
                $email = $row['2'];
                mysql_query("INSERT INTO USERS VALUES('$name', '$pass', '$email', '1')");        
                mysql_query("DELETE FROM USERS_APPROVAL WHERE USERNAME='$value'");        
                header('Location: https://infs3202-gzhlr.uqcloud.net/INFS3202/search.php'); 
   
            }
            ?>

