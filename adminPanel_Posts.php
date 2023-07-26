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

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/adminPanel_Posts.css">
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
                        <div>
                            <a class="button" href="addPost.php">Add Post</a>
                        </div>
                        <div class="gap"></div>
                        <?php 
                            $posts = get_posts();

                            foreach($posts as $post){
                        ?>
                            <div class="post">
                                <span><?php echo $post['postId']; ?></span>
                                <span><?php echo htmlspecialchars($post['title']); ?></span>
                                <span class="grow"><?php echo htmlspecialchars($post['description']); ?>...</span>
                                <span><?php echo $post['upVote']; ?></span>
                                <span>
                                    <form action="SQLFuncs/delete.php" method="POST">
                                        <button name="Delete" class="btn" type="submit" value="<?php echo $post['postId']; ?>">Delete</button>
                                    </form>
                                </span>
                                <span>
                                    <!--Yükleme Sayfasına giderken yanında postId Yolluyorum ki one göre query yazayim.-->
                                    <a href="updatePage.php?update=<?php echo $post['postId']; ?>"><button class="btn">Update</button></a>
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