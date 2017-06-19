<!DOCTYPE HTML>
    <HEAD>   
    <title>Approval</title>
        <link rel = "stylesheet" type = "text/css" href = "style/common.css">
        <link rel = "stylesheet" type = "text/css" href = "style/search.css">
        <link rel = "stylesheet" type = "text/css" href = "style/extras.css">
     
        <?php session_start();
            require "backend/common.php";
            $loggedIn = check_login($_SESSION['username'], $_SESSION['password']);
            $conn = connect_to_database();
        ?> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $("#top_pane").fadeIn();
        $("#drug_pane").fadeIn();
        $("#tools_pane").fadeIn();
        });
        </script>
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
        <?php
           if ($_SESSION['username'] != "admin") {
                 header('Location: https://infs3202-gzhlr.uqcloud.net/');
            }
            $stmnt = $conn->prepare("SELECT * FROM DRUG_APPROVAL");
            $stmnt->execute(array());
        ?>
        <div class="search_pane" id = "drug_pane">
            <table class=results" id = "results_table"><tr>
                <th>Name</th> <th>Dosage</th>  <th>Half Life</th> <th>Stand Down</th> <th>Ingredients</th><th>Approve?</th></tr>
        <?php
            $numResults = 0;
            while ($row = $stmnt->fetch(PDO::FETCH_NUM)) {
                echo "<tr> <td>".$row['0']."</td>";
                echo "<td>".$row['1']."</td>";
                echo "<td>".$row['2']."</td>";
                echo "<td>".$row['3']."</td>";               
                echo "<td>".$row['4']."</td>";               
                echo "<td> <input id=\"check\" type = \"checkbox\" name = \"user$numResults\" value =".$row['0']." form = \"approval\" /> </td> </tr>";
                $numResults++;
            }
        ?>
           </table>
           <form action="backend/approve_drug.php" method="POST" id="approval">
               <input class="submit" type="submit" value="Approve" form ="approval"/>
           </form>
       </div>
    </BODY>
</HTML>
