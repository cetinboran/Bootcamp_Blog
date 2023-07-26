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

    <link rel="stylesheet" href="CSS/adminMain.css">
    <link rel="icon" type="image/x-icon" href="images/icon.png">
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
                    <div class="title">
                        <p>This is the Admin Panel index page.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>