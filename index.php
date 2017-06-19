<!DOCTYPE HTML>
    <HEAD>
        <title>RBWH</title>
        <link rel = "stylesheet" type = "text/css" href = "style/common.css">
        <link rel = "stylesheet" type = "text/css" href = "style/login.css">
        <?php session_start(); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $("#top_pane").fadeIn();
        $("#login").fadeIn();
        });
        </script>
    </HEAD>

    <BODY>
        <div class = "top_pane" id = "top_pane">
            <h1 class = "heading">RBWH Milk Bank <br> Drug Guide</h1>
        </div>
        
        <div class = "login" id = "login">
           <h2 class = "login_heading">Login</h2>
           <br>
           <a href="create_user.php">Forgot your password or don't have an account?</a>
           <br>
           <form class = "login_form" action = "search.php" method = "POST">
                <input class = "username" type = "text" 
                        name = "username" placeholder = "username">
                <br>
                <input class = "password" type = "password" 
                        name = "password" placeholder = "password">
                <br>
                <input class = "submit"  type = "submit"
                        value = "SUBMIT" > 
            </form>
            <?php
                if(isset($_SESSION['bad_password'])) {
                    echo "<p> Incorrect username or password </p>";
                }
                unset($_SESSION['bad_password']);
            ?>
        </div>
    </BODY>

</HTML>
