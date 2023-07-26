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
                    $post = get_posts_by_id($_GET['update']);

                ?>
                <div class="content">
                        <form action="SQLFuncs/update.php" method="POST">
                            <table>
                                <tr>
                                    <td class="label">Title:</td>
                                    <td><input class="input" type="text" name="title" id="title" value="<?php echo $post['title']; ?>"></td>
                                </tr>
                                <tr>
                                    <td class="label">Description:</td>
                                    <td><textarea class="input" name="description" id="description" cols="30" rows="10" placeholder="<?php echo $post['description']; ?>"></textarea></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--Update e basınca yolladığım postId yi update yerine tekrar yollamak için yapıyorum.-->
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