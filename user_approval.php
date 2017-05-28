<!DOCTYPE HTML>
    <HEAD>   
    <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/search.css">
        <?php session_start();
            $connection = mysql_connect("localhost", 'MLangford', 'Redline66') or die('error');
            $db_selected = mysql_select_db("MilkBank", $connection) or die ("error");

            if (!$connection) {
                echo "connection failed";
                $_POST['pass_error'] = 1;
                header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }
         ?> 
    </HEAD>

    <BODY>
        <div class = "top_pane">
            <h1 class="heading"> RBWH Milk Bank <br> Drug Guide </h1>
        </div>
 
        <?php
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
            $numResults = 0;           
            $result = mysql_query("SELECT * FROM USERS_APPROVAL");
            echo "<div class = \"result_pane\">";
                echo "<table class = \"results\"> <tr>";
                    echo "<th>Name</th> <th>Email</th> </tr>";
             
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr> <td>".$row['0']."</td>";
                        echo "<td>".$row['2']."</td>";               
                        echo "<td> <input type = \"checkbox\" name = \"user$numResults\" value =".$row['0']." form = \"approval\" /> </td> </tr>";
                        $numResults++;          
                    }           
            echo "</table>";
            echo "<form action = \"approve_user.php\" method = \"POST\" id = \"approval\">"; 
            echo "<input class = \"submit\" type = \"submit\" value = \"Approve\" form = \"approval\" />"; 
            echo "</form>";

            echo "</div>";
                ?>
    </BODY>   
</HTML>

