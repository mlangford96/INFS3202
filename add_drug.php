<!DOCTYPE HTML>
    <HEAD>   
    <title>Add</title>
        <link rel = "stylesheet" type = "text/css" href = "style/common.css">
        <link rel = "stylesheet" type = "text/css" href = "style/extras.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script>
        $(document).ready(function(){
        $("#top_pane").fadeIn();
        $("#addition").fadeIn();
        $("#tools_pane").fadeIn();
        });
        </script>
        <?php
            session_start();
            require "backend/common.php";
            $loggedIn = check_login($_SESSION['username'], $_SESSION['password']);
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

        <div class = "addition_pane" id = "addition_pane">
            <form class = "add_drug_form" action = "backend/drug_creation.php" method = "POST">
                <input class = "Name" type = "text" 
                        name = "drugName" placeholder = "Drug Name">

                <input class = "Dosage" type = "number" 
                        name = "dosage" placeholder = "Dosage">
 
                <input class = "HalfLife" type = "text"
                        name = "halfLife" placeholder = "Half Life">

                <input class = "StandDown" type = "number"
                        name = "standDown" placeholder = "Stand Down">

                <input class = "Ingredients" type = "text"
                        name = "ingredients" placeholder = "Ingredients">

                <br>

                <input class = "submit"  type = "submit"
                        value = "SUBMIT"> 
            </form>
        </div>
    </BODY>   
</HTML>

