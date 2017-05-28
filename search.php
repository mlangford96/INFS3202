<!DOCTYPE HTML>
    <HEAD>
        <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/results.css">
        <?php
            session_start(); 
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['password'] = $_POST['password'];
            $connection = mysql_connect("localhost", "MLangford", "Redline66");

            if (!$connection) {
                echo "connection failed";
                $_SESSION['pass_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }
             else if(isset($_SESSION['pass_error'])) {
                unset($_SESSION['pass_error']);
            }
            $db_selected = mysql_select_db("MilkBank", $connection) or die ("error");
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
        ?>
 
    </HEAD>

    <BODY>
        <div class = "top_pane">
            <h1 class="heading"> RBWH Milk Bank <br> Drug Guide </h1>
        </div>

        <div class = "search_pane">
            <form action = "results.php" method = "POST">
                <input class = "search_in" type = "text" name = "input_text" 
                        placeholder = "Enter keywords">
                <div id="livesearch"></div>
                <input class = "submit" type = "submit" value = "Search">
            </form>
        </div>
    </BODY>   
</HTML>

