<!DOCTYPE HTML>
    <HEAD>   
    <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/common.css">  
        <link rel = "stylesheet" type = "text/css" href = "style/search.css">
        <link rel = "stylesheet" type = "text/css" href = "style/extras.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $("#top_pane").fadeIn();
        $("#search_pane").fadeIn();
        $("#tools_pane").fadeIn();
        $("#results_pane").fadeIn();
        });
        </script>

        <?php
            session_start(); 
            require "backend/common.php";
            $loggedIn = check_login($_SESSION['username'], $_SESSION['password']);  
            $conn = connect_to_database();
         ?> 
    </HEAD>

    <BODY>
        <div class = "top_pane" id = "top_pane">
            <h1 class="heading"> RBWH Milk Bank <br> Drug Guide </h1>
        </div>
 
        <div class = "tools_pane" id = "tools_pane">
            <h2>Tools</h2>
            <ul>
                <li><a href="search.php">Search</a></li> 
                <li><a href="add_drug.php">Add a Medication</a></li>
                <?php if ($_SESSION['username'] == "admin") {
                           echo "<li><a href=\"drug_approval.php\">Drug Approval</a></li>";
                           echo "<li><a href=\"user_approval.php\">User Approval</a></li>";
                      }
                ?>
                <li><a href="backend/logout.php">Logout</a></li>
            </ul>
        </div>        

        <div class = "search_pane" id = "search_pane">
            <form action = "results.php" method = "POST">
                <input id = main_search class = "search_in" type="text" name="input_text" 
                        placeholder = "Enter Keywords" onkeyup="showResult(this.value)">
                <div id="livesearch"></div>
                <input class = "submit" type="submit" value = "Search">
            </form>
        </div>
        <?php
            if (isset($_POST['input_text']) && $_POST['input_text']) {
                $input_text = $_POST['input_text'];
            } else {
                header('Location: https://infs3202-gzhlr.uqcloud.net/search.php');
            }
            $tokens = explode(' ', $input_text);
            $output_text = implode("\|", $tokens);
            $numResults = 0;           
            $stmnt = $conn->prepare("SELECT * FROM Medication WHERE NAME REGEXP ? OR INGREDIENTS REGEXP ?");
            $stmnt->execute(array($output_text, $output_text));
            ?>
            <div class = "result_pane" id = "results_pane">
                <table class = "results"> 
                    <tr> <th>Name</th> <th>Dosage (mg)</th> <th>Half Life (hrs)</th>
                    <th>Stand Down (hrs)</th> <th>Ingredioents</th> <th>Approval</th></tr>
            <?php
                while ($row = $stmnt->fetch(PDO::FETCH_NUM)) {
                    echo "<tr> <td>".$row['0']."</td>";
                    echo "<td>".$row['1']."</td>";
                    echo "<td>".$row['2']."</td>";               
                    echo "<td>".$row['3']."</td>";
                    echo "<td>".$row['4']."</td>";
                    echo "<td>".$row['5']."</td>"; 
                    echo "<td> <input type = \"checkbox\" name = \"drug$numResults\" value =".$row['0']." form = \"approval\" />  </tr>";
                        $numResults++;          
                }
            ?>           
            </table>
            <form action ="search.php" method ="POST" id ="approval"> 
                <input class="submit" type="submit" value="submit for approval" form="approval"/> 
           </form>
       </div>
	<script src = "js/live_search.js" type = "application/javascript"> </script>
    </BODY>   
</HTML>

