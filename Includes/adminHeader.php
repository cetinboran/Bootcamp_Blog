<header>
    <div class="header-wrapper">
        <div class="top-header">
            <div class="logo_title">
                <div class="username">
                    <?php
                        require_once("Methods/funcs.php");

                        echo "Username: " . get_user_username();
                    ?>
                </div>
                <div class="logo">
                    <img src="Images/logo.png" width="150px" height="150px">
                </div>
                <div class="title">
                    Çetin Boran Mesüm
                </div>
            </div>
            
        </div>
        <div class="menu">
            <ul>
                <li><a href="adminPanel.php">Home</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="adminPanel_Posts.php">Posts</a></li>
                <li><a href="messages.php">Messages</a></li>
                <li><a href="index.php">Wiew The Website</a></li>
            </ul>
        </div>
        <div class="socialMedia">
            <a href="https://github.com/cetinboran" target="_blank" class="fa fa-github"></a>
            <a href="https://www.instagram.com/2023an_m/" target="_blank" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-facebook"></a>
            <a href="https://twitter.com/2023anM" target="_blank" class="fa fa-twitter"></a>
        </div>
    </div>
</header>