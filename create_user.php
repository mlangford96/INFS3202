<!DOCTYPE HTML>
    <HEAD>
        <title>Search</title>
        <link rel = "stylesheet" type = "text/css" href = "style/create_user.css">

    </HEAD>

    <BODY>
        <div class = "top_pane">
            <h1 class="heading"> RBWH Milk Bank <br> Drug Guide </h1>
        </div>

        <div class = "creation_pane">
            <h2>Create an Account</h2>
            <form action = "make_user.php" method = "POST">
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

