<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <title>Home</title>
</head>
<body>
    <?php include('Includes/header.php') ?>
    <main>
        <?php 
            require_once("Methods/funcs.php");
            $posts = get_most_votes();

            if(isset($_GET['logout'])){
                if($_GET['logout'] == "succesfull"){
                    logout();
                }
            }
        ?>
        <div class="container">
            <div class="fav_posts">
                <div class="top_post">
                    <div class="image">
                    <a href="viewPost.php?postId=<?php echo $posts[0]['postId']; ?>"><img src="Uploads/<?php echo get_image_path($posts[0]['postId']); ?>.jpg" width="700px" height="400px"></a>
                        <div class="bottom">
                            <div class="title">
                                <?php echo htmlspecialchars($posts[0]["title"]); ?>
                            </div>
                            <div class="description">
                                <?php echo htmlspecialchars($posts[0]["description"]); ?>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="subPost_wrapper">
                    <div class="sub_post">
                    <a href="viewPost.php?postId=<?php echo $posts[1]['postId']; ?>"><img src="Uploads/<?php echo get_image_path($posts[1]['postId']); ?>.jpg" width="300px" height="199px"></a>
                        <div class="bottomSub">
                            <div class="title">
                                <?php echo htmlspecialchars($posts[1]["title"]); ?>
                            </div>
                            <div class="description">
                                <?php echo htmlspecialchars($posts[1]["description"]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="sub_post">
                    <a href="viewPost.php?postId=<?php echo $posts[2]['postId']; ?>"><img src="Uploads/<?php echo get_image_path($posts[2]['postId']); ?>.jpg" width="300px" height="199px"></a>
                        <div class="bottomSub">
                            <div class="title">
                                <?php echo htmlspecialchars($posts[2]["title"]); ?>
                            </div>
                            <div class="description">
                                <?php echo htmlspecialchars($posts[2]["description"]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content_wrapper">
                <div class="title">What is Cyber Security?</div>
                <div class="description">
                    <p>Cybersecurity refers to the process of protecting computer systems and digital data from malicious attacks, unauthorized access, and harmful software. Experts in this field work to ensure the security of computer networks, software, and hardware, aiming to prevent the theft, manipulation, or damage of personal information and corporate data. Cybersecurity has become a significant priority for individuals, companies, and governments in the face of increasing digital threats. Therefore, staying updated with cutting-edge technologies and best security practices is crucial to effectively combat evolving threats.</p>
                </div>
            </div>
        </div>
    </main>

    <?php include('Includes/footer.html') ?>
</body>
</html>