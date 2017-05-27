<!DOCTYPE HTML>
    <HEAD>   
    <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/search.css">
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
 
            $input_text = $_POST['input_text'];
            $tokens = explode(' ', $input_text);
            $output_text = implode("|", $tokens);

            $NAME = $_POST['drugName'];
            $DOSAGE = $_POST['dosage'];
            $HALF_LIFE = $_POST['halfLife'];
            $STAND_DOWN = $_POST['standDown'];
            $INGREDIENTS = $_POST['ingredients'];
           
            $results = mysql_query("INSERT INTO Medication VALUES('$NAME', '$DOSAGE', '$HALF_LIFE', '$STAND_DOWN', '$INGREDIENTS', 'No')");
            header('Location: https://infs3202-gzhlr.uqcloud.net/');

         ?>
    </BODY>   
</HTML>

