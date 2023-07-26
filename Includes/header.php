<head>
    <link rel="stylesheet" href="CSS/header.css">

</head>
<header>
    <div class="loginMenu">
        <?php
            require("Methods/funcs.php");

            // Eğer cookie set ise ve aynı zamanda valid bir cookie ise user divi koy değil ise alttakileri koy.
            if(isset($_COOKIE['MyBlog']) && check_valid_cookie()){
                echo "<div class='user_icon'><a href='siteUpdatePage.php' class='fa fa-user'></a>". get_user_username() ."</div>";
                // Eğer bu butona basalarsa logout parametresi ile index.php gidicek. Orada $_Get ile bu parametreye bakıp cookie silcez.
                echo "<div class='logout'><a href='index.php?logout=succesfull'>Logout</a></div>";
            }else{
        ?>
            <div class="login"><a href="login.php">Log in</a></div>
            <div class="register"><a href="register.php">Register</a></div>
        <?php } ?>
    </div>
    <div class="menu_wrapper">
        <div class="logoMenu">
            <div class="logo">
                <img src="Images/logo.png">
            </div>
            <div class="title">
                Çetin Boran Mesüm
            </div>
        </div>
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="posts.php">Posts</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                    if(isAdmin()){
                        echo '<li><a href="adminPanel.php">Admin Panel</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</header>
