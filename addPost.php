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

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/addPost.css">
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
                <div class="content">
                    <div class="contact_wrapper">
                        <?php 
                            if(isset($_POST['add'])){
                                if(isset($_POST['title']) && isset($_FILES['image'])){
                                    add_post($_POST['title'], $_POST['description'], $_FILES['image']);
                                }
                            }
                        ?>
                        <form action="addPost.php" method="POST" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td class="label">Title: </td>
                                    <td>
                                        <input class="input" type="text" name="title" id="title">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Description: </td>
                                    <td>
                                        <textarea class="input" name="description" id="description" cols="30" rows="10"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label">Image: </td>
                                    <td>
                                        <input type="file" name="image" id="image"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input name="add" class="button" type="submit" value="Add Post">
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>