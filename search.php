<!DOCTYPE HTML>
    <HEAD>
        <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/common.css"> 
        <link rel = "stylesheet" type = "text/css" href = "style/search.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#top_pane").fadeIn();
    $("#tools_pane").fadeIn();
    $("#search_pane").fadeIn();
});
</script>
        <?php
            session_start(); 
            require "backend/common.php";
            if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['password'] = $_POST['password'];
            }
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
                } ?>
                <li><a href="backend/logout.php">Logout</a></li>
            </ul>
        </div>        
        <div class = "search_pane" id = "search_pane">
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

