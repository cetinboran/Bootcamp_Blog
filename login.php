<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/form.css">
</head>
<body>
    <?php include('Includes/header.php') ?>
    
    <div class="whoami">
        <div class="title">Log in</div>
    </div>

    <?php 
        require_once("Methods/funcs.php");

        if(isset($_POST['login'])){
            if(isset($_POST['username']) && isset($_POST['password'])){
                $user = login($_POST['username'], $_POST['password']);
            }
        }
    ?>
    <main>
        <div class="container">
            <div class="register_wrapper">
                <form action="login.php" method="POST">
                    <table>
                        <tr>
                            <td class="label">Username: </td>
                            <td><input class="input" type="text" name="username" id="username"></td>
                        </tr>
                        <tr>
                            <td class="label">Password: </td>
                            <td><input class="input" type="password" name="password" id="password"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="button" type="submit" value="Log in" name="login"></td>
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