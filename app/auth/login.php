<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BZU NOTE | Sign in page</title>
    <link rel="stylesheet" href="../../assets/css/loginPageStyle.css">
</head>

<body>
    <header id="page-header">
        <nav id="nav-section">
            <a href="../../index.php" ><img src="../../assets/imgs/c99.png" width="180" height="50" alt="bzu note logo"></a>  
        </nav>

        <main id="main-section">
            <div class="main-content">
            <h1>Log in</h1>
            <p>Welcome Back, Please enter your details below</p>
            <section id="login-form">
                <form method="post" action="../controllers/login.controller.php">
                    <label for="usernameField">Username</label><br>
                    <input type="text" name="username" id="usernameField" placeholder="John Doe" />
                    <br>
                    <label for="passwordField">password</label><br>
                    <input type="password" name="password" id="passwordField" placeholder="password" />
                    <br>
                    <?php 
                    
                    if (array_key_exists("error", $_GET) && $_GET["error"] === "signup") {
                        echo "<p class=\"alert-error\"> please fill all the blanks </p>";
                    }else if (array_key_exists("error", $_GET) && $_GET["error"] === "invaliduser") {
                        echo "<p class=\"alert-error\"> invalid username or password, Try again !</p>";
                    }
                    ?>
                    <a id="fpass"href="#">forgot password ?</a>
                    <input type="submit" name="SignInBtn" id="signInBtn" value="Sign in"/>
                </form>
                <p>Don't have an account? <a id="signUpBtn" href="../auth/signup.php">Sign up</a></p>  
            </section>
            </div>
        </main>

        <footer id="site-footer">
            <section class="socialMedia">
                <a href="https://www.facebook.com/ezpzok" target="_blank"><img src="../../assets/imgs/facebook_48px.png" width="32" alt="facebook" /></a>
                <a href="https://www.instagram.com" target="_blank"><img src="../../assets/imgs/Instagram_logo_48px.png" width="32" alt="instagram" /></a>
                <a href="https://www.linkedin.com/in/mohammed-tahaynah/" target="_blank"><img src="../../assets/imgs/linkedin_48px.png" width="32" alt="linkedin" /></a>
                <a href="https://github.com/SMIL3Cr4Ck3R" target="_blank"><img src="../../assets/imgs/git_48px.png" width="32" alt="github" /></a>
            </section>
            <p>&copy; mohammed tahaynah</p>
        </footer>
    </header>
</body>

</html>