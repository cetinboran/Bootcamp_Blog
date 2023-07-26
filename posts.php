<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/post.css">
</head>
<body>
    <?php include('Includes/header.php');?>

    <?php 
        require_once("Methods/funcs.php");
        $posts = get_posts();
    ?>

    <main>
        <div class="container">
            <div class="gap"></div>
            <div class="posts_wrapper">
                <?php 
                    foreach($posts as $post){    
                ?>
                    <div class="post">
                        <div class="image">
                            <div class="upVote">
                                <div class="icon">
                                    <!-- TODO Bu butona tıklayınca vote atsın. Üye ise-->
                                    <a href="like.php?like=<?php echo $post['postId']; ?>" class="fa fa-arrow-up"></a>
                                </div>
                                <div class="vote">
                                    <?php echo $post['upVote']; ?>
                                </div>
                            </div>
                            <a href="viewPost.php?postId=<?php echo $post['postId']; ?>"><img src="Uploads/<?php echo get_image_path($post['postId']); ?>.jpg" width="245px" height="140px"></a>
                        </div>
                        <div class="title"><?php echo htmlspecialchars($post["title"]); ?></div>
                        <div class="description">
                            <?php echo htmlspecialchars($post["description"]); ?>...
                        </div>
                        
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    
    <?php include('Includes/footer.html') ?>

</body>
</html>