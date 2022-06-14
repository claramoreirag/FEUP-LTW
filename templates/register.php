<?php function draw_register() { 
 ?>
 <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">

            <title>Register</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/register-style.css">

        </head>

        <body>
            <div>
           
                <form method="post" action="../actions/register_action.php">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                   
                    <input id="username" type="text" placeholder="Username" name="username" required>
            
                    <input id="name" type="text" placeholder="Name" name="name" required>
                    
                    <input id="enter" type="password" placeholder="Enter Password" name="password" required>
                
                    <input id="confirm" type="password" placeholder="Confirm Password" name="confirm" required>
            
                    <button type="submit">Register & Login</button>

                    <a class="btn_login" href='../pages/login.php'><p> Already registered? Log in!</p></a> 
                </form>
            </div>

        </body>

    </html>
<?php } ?>