<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="stylesheet" href="CSS/PanelForms.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/siteUpdatePage.css">
</head>
<body>
    <?php include('Includes/header.php') ?>

    <main>
        <div class="container">

            <?php 
                require_once("Methods/funcs.php");

                $user = get_user_by_id(get_user_id());

            ?>
            <div class="content">
                <form action="SQLFuncs/inUpdateUser.php" method="POST">
                    <table>
                        <tr>
                            <td class="label">Username:</td>
                            <td><input class="input" type="text" name="username" id="username" value="<?php echo $user['username']; ?>"></td>
                        </tr>
                        <tr>
                            <td class="label">E-mail:</td>
                            <td><input class="input" type="email" name="uEmail" id="uEmail" value="<?php echo $user['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td class="label">Password:</td>
                            <td><input class="input" type="password" name="uPass" id="uPass"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="button" name="Update" type="submit" value="<?php echo $user['id']; ?>">Update</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    
    <?php include('Includes/footer.html') ?>

</body>
</html>