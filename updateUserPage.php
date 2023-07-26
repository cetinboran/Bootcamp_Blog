<?php
    require_once("Methods/funcs.php");

    if(!isAdmin())
        header("Location: Errors/Forbidden.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="CSS/PanelForms.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/updatePage.css">
    <link rel="stylesheet" href="CSS/adminHeader.css">
    <link rel="stylesheet" href="CSS/adminFooter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <main>
        <div class="container-all">
            <div class="wrapper">
                <div class="header">
                    <?php include_once('Includes/adminHeader.php'); ?>
                </div>

                <?php
                    $user = get_user_by_id($_GET['update']);
                ?>
                <div class="content">
                    <form action="SQLFuncs/updateUser.php" method="POST">
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
                                <td class="label">Admin:</td>
                                <td><input class="input" type="checkbox" name="isAdmin" id="isAdmin" value=1></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="button" name="Update" type="submit" value="<?php echo $_GET['update']; ?>">Update</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>