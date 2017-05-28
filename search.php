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
 
        <div class = "search_pane">
           <form action = "search.php" method = "POST">
                <input id = main_search class = "search_in" type="text" name="input_text" 
                        placeholder = "Enter Keywords" onkeyup="showResult(this.value)">
<div id="livesearch"></div>
                <input class = "submit" type="submit" value = "Search">
            </form>
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
 
            $input_text = $_POST['input_text'];
            $tokens = explode(' ', $input_text);
            $output_text = implode("|", $tokens);
            $numResults = 0;           

            $result = mysql_query("SELECT * FROM Medication WHERE NAME REGEXP '$output_text' OR INGREDIENTS REGEXP '$output_text'");
            echo "<div class = \"result_pane\">";
                echo "<table class = \"results\"> <tr>";
                    echo "<th>Name</th> <th>Dosage (mg)</th> <th>Half Life (hrs)</th>";
                            echo "<th>Stand Down (hrs)</th> <th>Ingredioents</th> <th>Approval</th></tr>";
             
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr> <td>".$row['0']."</td>";
                        echo "<td>".$row['1']."</td>";
                        echo "<td>".$row['2']."</td>";               
                        echo "<td>".$row['3']."</td>";
                        echo "<td>".$row['4']."</td>";
                        echo "<td>".$row['5']."</td>"; 
                        echo "<td> <input type = \"checkbox\" name = \"drug$numResults\" value =".$row['0']." form = \"approval\" />  </tr>";
                        $numResults++;          
                    }           
            echo "</table>";
            echo "<form action = \"approval.php\" method = \"POST\" id = \"approval\">"; 
            echo "<input class = \"submit\" type = \"submit\" value = \"submit for approval\" form = \"approval\" />"; 
            echo "</form>";

            echo "</div>";
                ?>
       
	<script src = "js/live_search.js" type = "application/javascript"> </script>
    </BODY>   
</HTML>

