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
    <title>Posts</title>

    <link rel="stylesheet" href="CSS/users.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/adminHeader.css">
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
                    <div class="posts-wrapper">
                        <div class="gap"></div>
                        <?php 
                            $users = get_users();

                            foreach($users as $user){
                        ?>
                            <div class="post">
                                <span><?php echo $user['id']; ?></span>
                                <span><?php echo htmlspecialchars($user['username']); ?></span>
                                <span><?php echo htmlspecialchars($user['email']); ?></span>
                                <span class="grow"><?php echo $user['password']; ?></span>
                                <span><?php echo $user['isAdmin']; ?></span>
                                <span>
                                    <form action="SQLFuncs/deleteUser.php" method="POST">
                                        <button name="Delete" class="btn" type="submit" value="<?php echo $user['id']; ?>">Delete</button>
                                    </form>
                                </span>
                                <span>
                                    <!--Yükleme Sayfasına giderken yanında postId Yolluyorum ki one göre query yazayim.-->
                                    <a href="updateUserPage.php?update=<?php echo $user['id']; ?>"><button class="btn">Update</button></a>
                                </span>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>