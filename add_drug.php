<!DOCTYPE HTML>
    <HEAD>   
    <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/add_drug.css">
        <?php session_start() ?>
    </HEAD>

    <BODY>
        <div class = "top_pane">
            <h1 class="heading"> RBWH Milk Bank <br> Drug Guide </h1>
        </div>

        <?php
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
        ?>
        <div class = "addition_pane">
            <form class = "add_drug_form" action = "drug_creation.php" method = "POST">
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

