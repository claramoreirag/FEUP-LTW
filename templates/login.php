<?php function draw_login() { 
 ?>
 <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
        
            <title>Login</title>
            <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="../css/login-style.css" type="text/css">
        
        
        </head>
  
    <body>

        <section id="btn_login">
            <div>
               
                    
                <form method="post" action="../actions/login_action.php">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="password" placeholder="Enter Password" name="password" required>
                    <input type="submit" value="Login">
                </form>
                

                <!-- <span>Forgot password?</span> TODO: PLS DO THIS THING -->

                <a class="btn_register" href='../pages/register.php'><p> Don't have an account? Register!</p></a> 
            </div>

        </section>
      
    </body>
    </html>
<?php } ?>