        <?php
ini_set('display_errors', 1);
            session_start(); 
            require "common.php";
            $loggedIn = check_login($_SESSION['username'], $_SESSION['password']);  
            $conn = connect_to_database();
            $NAME = $_POST['drugName'];
            $DOSAGE = $_POST['dosage'];
            $HALF_LIFE = $_POST['halfLife'];
            $STAND_DOWN = $_POST['standDown'];
            $INGREDIENTS = $_POST['ingredients'];
           
            $stmnt = $conn->prepare("INSERT INTO DRUG_APPROVAL VALUES(?, ?, ?, ?, ?, ?)");
              
            $stmnt->execute(array($NAME, $DOSAGE, $HALF_LIFE, $STAND_DOWN, $INGREDIENTS, "No"));
            header('Location: https://infs3202-gzhlr.uqcloud.net/search.php');
         ?>
