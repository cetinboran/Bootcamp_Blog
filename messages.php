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

    <link rel="stylesheet" href="CSS/adminPanel_Posts.css">
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
                        <div>
                            <form action="SQLFuncs/clearMessages.php" method="POST">
                                <button class="button" name="Clear" value="Clear">Clear Messages</button>
                            </form>
                        </div>
                        <div class="gap"></div>
                        <?php 
                            $messages = get_messages();

                            foreach($messages as $message){
                        ?>
                            <div class="post">
                                <span><?php echo $message['msgId']; ?></span>
                                <span><?php echo $message['sName']; ?></span>
                                <span><?php echo $message['email']; ?></span>
                                <span class="grow"><?php echo $message['sMessage']; ?>...</span>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>