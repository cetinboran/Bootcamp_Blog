<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/form.css">
</head>
<body>
    <?php include('Includes/header.php') ?>
    
    <div class="whoami">
        <div class="title">Register</div>
    </div>

    <?php 
        require_once("Methods/funcs.php");

        if(isset($_POST['register'])){
            if(isset($_POST['password']) && isset($_POST['rePassword']) && isset($_POST['username']) && isset($_POST['email'])){
                // Giriş yaparkenki bilgilerin valid mi değil mi bakıyoruz.
                if($_POST['password'] == $_POST['rePassword']){
                    if(strlen($_POST['password']) < 4){
                        header("Location: register.php?error=passwordIsTooSmall");
                    }
                    else if(strlen($_POST['username']) < 3){
                        header("Location: register.php?error=usernameIsTooSmall");
                    }
                    else if(strlen($_POST['email']) < 2){
                        header("Location: register.php?error=pleaseEnterAnEmail");
                    }
                    else{
                        register($_POST['username'], $_POST['email'], $_POST['password']);
                    }
                }
                else{
                    header("Location: register.php?error=passwordsDoNotMatch");
                }
            }
        }
    ?>
    <main>
        <div class="container">
            <div class="register_wrapper">
                <form action="register.php" method="POST">
                    <table>
                        <tr>
                            <td class="label">Username: </td>
                            <td><input class="input" type="text" name="username" id="username"></td>
                        </tr>
                        <tr>
                            <td class="label">E-Mail: </td>
                            <td><input class="input" type="email" name="email" id="email"></td>
                        </tr>
                        <tr>
                            <td class="label">Password: </td>
                            <td><input class="input" type="password" name="password" id="password"></td>
                        </tr>
                        <tr>
                            <td class="label">Confrim Password: </td>
                            <td><input class="input" type="password" name="rePassword" id="rePassword"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="button" type="submit" value="Register" name="register"></td>
                            <td></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    
    <?php include('Includes/footer.html') ?>

</body>
</html>