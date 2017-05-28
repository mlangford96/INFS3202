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

        <div class = "tools_pane">
            <h2>Tools</h2>
            <ul>
                <li><a href="add_drug.php">Add a Medication</a></li>
                <?php if ($_SESSION['username'] == "mlangford") {
                           echo "<li><a href=\"drug_approvak.php\">Drug Approval</a></li>";
                           echo "<li><a href=\"user_approval.php\">User Approval</a></li>";
                      }
                ?>
            </ul>
        </div>        

        <div class = "search_pane">
            <form action = "results.php" method = "POST">
                <input id = "main_search" class = "search_in" type = "text" 
                        name = "input_text" onkeyup="showResult(this.value)"
                        placeholder = "Enter keywords">
                <div id="livesearch"></div>
                <input class = "submit" type = "submit" value = "Search">
            </form>
        </div>

    <script src = "js/live_search.js" type = "application/javascript"> </script> 
    </BODY>   
</HTML>

