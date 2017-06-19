<!DOCTYPE HTML>
    <HEAD>
        <title>Create</title>
         <link rel = "stylesheet" type = "text/css" href = "style/common.css">
         <link rel = "stylesheet" type = "text/css" href = "style/extras.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $("#top_pane").fadeIn();
        $("#search_pane").fadeIn();
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
                <li><a href="index.php">Back</a></li> 
            </ul>
        </div>        
 
        <div class = "creation_pane">
            <h2>Create an Account</h2>
            <form action = "backend/make_user.php" method = "POST">
                <input type = "email" name = "email" 
                        placeholder = "example@rbwh.qld.gov.au">
                <input type = "text" name = "username"
                        placeholder = "username">
                <input type = "password" name = "password"
                        placeholder = "password">
                <input type = "password" name = "repassword"
                        placeholder = "re-enter password">
                <br>
                <input class = "submit" type = "submit" value = "SUBMIT">
            </form>
        </div>

        <div class = "reset_pane">
            <h2>Forgot Password</h2>
            <form action = "reset_pass.php" method = "POST">
                <input type = "email" name = "email"
                        placeholder = "example@rbwh.qld.gov.au">
                <br>
                <input class = "submit" type = "submit" value = "SUBMIT">
            </form>
        </div> 
    </BODY>   
</HTML>

