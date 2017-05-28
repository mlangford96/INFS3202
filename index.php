<!DOCTYPE HTML>
    <HEAD>
        <title>RBWH</title>
        <link rel = "stylesheet" type = "text/css" href = "style/index.css">
        <?php session_start(); ?>
    </HEAD>

    <BODY>
        <div class = "top_pane">
            <h1 class = "heading">RBWH Milk Bank <br> Drug Guide</h1>
        </div>
        
        <div class = "login">
           <h2 class = "login_heading">Login</h2>
           <br>
           <a href="create_user.php" target="_blank">Forgot your password or don't have an account?</a>
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
            ?>
        </div>
    </BODY>

</HTML>
