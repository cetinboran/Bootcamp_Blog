<?php
    
    // En çok upVote alınan 3 postu döndürüyor.
    // Burda çalıştırıcaksan fonksiyonu PDO içine ../ ekle ki geri çıksın.
    function get_most_votes(){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $results = $db->query('SELECT * FROM posts ORDER BY upVote DESC LIMIT 3;');

        $posts = [];

        $i = 0;
        foreach($results as $row){
            $posts[$i++] = $row;
        }

        return $posts;
    }

    function get_posts(){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $results = $db->query('SELECT * FROM posts;');

        return $results;
    }

    function get_posts_by_id($postId){
        $db = new PDO('sqlite:Databases/myBlog.db');

        // Eğer admin panelindeysek hatayı admin panelinde ver.
        if(str_contains($_SERVER['REQUEST_URI'], "/MyBlog/updatePage.php")){
            if(!check_valid_postId($postId)){
                header("Location: adminPanel_Posts.php?error=InvalidPostId");
                return;
            }
        }

        // Valid değil ise InvalıdPostId döndürdük.
        if(!check_valid_postId($postId)){
            header("Location: posts.php?error=InvalidPostId");
        }

        $query = "SELECT * FROM posts WHERE postId = :pId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":pId", $postId);
        $stmt->execute();

        // Gelen PDO objesini dictionary e dönüştürüp yolladık.
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Burda yukarıya yazılan postId nin gerçekten valid olup olmadığını bütün postların postIdlerine bakarak anlıyoruz.
    function check_valid_postId($postId){
        $posts = get_posts();

        $posts = get_posts();
        foreach($posts as $post){
            if($post['postId'] == $postId){
                return true;
            }
        }

        return false;
    }

    function get_user_by_id($id){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $result = $db->query('SELECT * FROM users WHERE id =' . $id);

        // Gelen PDO objesini dictionary e dönüştürüp yolladık.
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Contact için
    function insert_message($name, $email, $message){
        $db = new PDO('sqlite:Databases/myBlog.db');

        // SQL SORGUSU İLE KULLANICI INPUTLARI AYRILDI.
        $query = "INSERT INTO contact (sName, email, sMessage) VALUES (:name, :email, :msg);";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':msg', $message);
        $stmt->execute();
    }

    function register($username, $email, $password){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $allUsers = $db->query("SELECT * FROM users;");

        foreach($allUsers as $user){
            if($user['username'] == $username){
                header("Location: register.php?error=ThisUsernameIsBeingUsed.");
                return;
            }
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $admin = 0;

        // Values kısmında prepare yapıyorsak '' koyuyoruz.
        $query = "INSERT INTO users (username, email, password, isAdmin) VALUES (:user, :email, :password, :admin);";

        $stmt = $db->prepare($query);
        $stmt->bindParam(":user", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":admin", $admin);
        $registerQuery = $stmt->execute();

        if($registerQuery){
            header("Location: login.php?register=Successful");
        }else{
            header("Location: register.php?register=Unsuccessfull");
        }

    }

    function login($username, $password){
        $db = new PDO('sqlite:Databases/myBlog.db');

        // SQLI çalışmasın diye parametre ile SQL sorgusunu ayırmak için prepare kullandım.
        $result = $db->prepare("SELECT * FROM users WHERE username = :username;");
        $result->bindParam(':username', $username);
        $result->execute();
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if(!is_bool($result)){
            if(password_verify($password, $result['password'])){
                $cookie_value = '{id:'. $result['id'] . ',username:' . $result['username'] . ',email:'. $result['email'] . ',password:' . $result['password'] . ",isAdmin:" . $result['isAdmin'] . "}";
                $cookie_value = base64_encode(urlencode($cookie_value));

                setcookie("MyBlog", $cookie_value, time() + 86400, "/");

                header("Location: index.php?login=successful");
            }
            else{
                header("Location: login.php?error=InvalidCreds!");
            }
        }
        else{
            header("Location: login.php?error=InvalidCreds!");
        }
    }

    function check_valid_cookie(){
        if(isset($_COOKIE['MyBlog'])){
            $cookie = get_string_cookie($_COOKIE['MyBlog']);

            // Eğer cookie get_string ten false geldiyse valid cookie değildir. Direkt false attık.
            if(is_bool($cookie)) return false;

            $db = new PDO('sqlite:Databases/myBlog.db');
            
            $users = $db->query("SELECT * FROM users;");

            foreach($users as $user){
                if(!strcmp($user['username'], $cookie[1])){
                    
                    if($user['password'] == $cookie[3]){
                        
                        return true;
                    }
                }
            }
            return false;
        }
    }

    function get_string_cookie($cookie){
        $has = ['id:',',username:', ',email:',',password:', ',isAdmin:', '{', '}'];
        
        $cookie = urldecode(base64_decode($cookie));

        // Eğer cookie yukardakileri içermiyorusa valid bir cookie değil. False döndürdük string olarak.
        for($i = 0; $i < count($has); $i++){
            if(!str_contains($cookie, $has[$i])){
                return false;
            }
        }

        $cookie = str_replace("}", " ", str_replace("{", "", $cookie));
        $userCookie = explode(',',$cookie);
        $userCookie[0] = str_replace("id:", "", $userCookie[0]);
        $userCookie[1] = str_replace("username:", "", $userCookie[1]);
        $userCookie[2] = str_replace("email:", "", $userCookie[2]);
        $userCookie[3] = str_replace("password:", "", $userCookie[3]);
        $userCookie[4] = str_replace("isAdmin:", "", $userCookie[4]);
        $userCookie[4] = str_replace(" 7", "", $userCookie[4]);
        
        for($i = 0; $i < count($userCookie); $i++){
            $userCookie[$i] = trim($userCookie[$i]);
        }

        return $userCookie;
    }

    function logout(){
        // Kendi cookiemizi oluştururken olan setcookienin aynısını koyduk. ama - 3600 yani 1 saat önce zamanı doldu yaptık. Silindi
        setcookie("MyBlog", "", time() - 3600, "/"); 
        header("Location: index.php");
    }

    function get_user_id(){
        if(isset($_COOKIE['MyBlog']) && check_valid_cookie()){
            $cookie = get_string_cookie($_COOKIE['MyBlog']);

            return $cookie[0];
        }
        return -1;
    }

    function get_user_username(){
        $id = get_user_id();

        if($id != -1){
            $db = new PDO('sqlite:Databases/myBlog.db');

            $statment = $db->prepare("SELECT * FROM users where id = :id;");
            $statment->bindParam(":id", $id);
            $statment->execute();

            $statment = $statment->fetch(PDO::FETCH_ASSOC);
            
            // username i sitede kullanacağım için REFLECTED XSS olmasın diye htmlspecialchars kullandım.
            $username = htmlspecialchars($statment['username']);
            return $username;
        }
    }
    
    function isAdmin(){
        if(check_valid_cookie()){
            $cookie = get_string_cookie($_COOKIE['MyBlog']);

            // Prepere yaparak kullanıcı girdilerini ayırıyoruz SQL Sorgusudan. Daha güvenli.
            $db = new PDO('sqlite:Databases/myBlog.db');
            $user = $db->prepare("SELECT * FROM users WHERE id = ?");
            $user->bindParam(1, $cookie[0]);
            $user->execute();
            $user = $user->fetch(PDO::FETCH_ASSOC);

            // Burda hem cookie'deki isAdmin = 1 mi diye bakıyorum. Hemde db deki isAdmin 1 diye bakıyorum.
            // İkiside 1 ise admindir.

            if($cookie[4] == 1 && $user['isAdmin'] == 1){
                return true;
            }
            return false;
        }
    }

    function add_post($title, $description, $image){
        $db = new PDO('sqlite:Databases/myBlog.db');
        
        if($image['name'] != ""){
            // Datayı db de tutuyorum.
            $data = addslashes(file_get_contents($image['tmp_name']));
        }
        else{
            $data = "";
        }
            

        $post = $db->prepare("INSERT INTO posts (title, description, image) VALUES (?,?,?);");
        $post->bindParam(1, $title);
        $post->bindParam(2, $description);
        $post->bindParam(3, $data);
        $post->execute();

        $lastPost = $db->query("SELECT * FROM posts ORDER BY postId DESC LIMIT 1");
        $lastPost = $lastPost->fetch(PDO::FETCH_ASSOC);

        if($image['name'] != ""){
            // Kayıt ediyorum.
            // Burda dirname kullanarak path'i indiren kişiye göre özelleştiriyoruz ki hata çıkmasın.
            move_uploaded_file($image['tmp_name'], dirname(__FILE__) . "../../Uploads/" .  $lastPost['postId'] . ".jpg");
        }
    }

    function get_messages(){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $results = $db->query('SELECT * FROM contact;');

        return $results;
    }

    function get_users(){
        $db = new PDO('sqlite:Databases/myBlog.db');

        $results = $db->query('SELECT * FROM users;');

        return $results;
    }

    function get_image_path($postId){
        // Eğer uploda sayfasında postun resmi var ise id yi döndür. Yok ise default döndürki default image yüklensin.
        if(file_exists("Uploads/$postId.jpg")){
            return $postId;
        }
        else{
            return "default";
        }
    }

?>