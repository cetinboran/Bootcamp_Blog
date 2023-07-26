<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>

    <link rel="stylesheet" href="CSS/viewPost.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/post.css">
</head>
<body>
    <?php include('Includes/header.php');?>

    
    <?php 
        require_once("Methods/funcs.php");
        
        if(isset($_GET['postId'])){
            $postId = $_GET['postId'];
            
            // postId nin int değerine bakıyoruz. Eğer 0 ise gelen değer stringtir. Yani invalid postId girildi.
            if(intval($postId) == 0){
                header("Location: posts.php?error=InvalidPostId");
            }
            else{
                $post = get_posts_by_id($postId);
            }
    ?>
        <main>
            <div class="container">
                <div class="post_wrapper">
                    <div class="img">
                        <img src="Uploads/<?php echo htmlspecialchars($post['postId']); ?>.jpg" width="400px" height="250px">
                    </div>
                    <div class="title"><?php echo htmlspecialchars($post['title']); ?></div>
                    <div class="description"><?php echo htmlspecialchars($post['description']); ?></div>
                </div>
            </div>
        </main>
    <?php } ?>
    
    <?php include('Includes/footer.html') ?>

</body>
</html>