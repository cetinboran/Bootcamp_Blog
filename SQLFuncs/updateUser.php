<?php
    if(isset($_POST['Update']))
    {
        $id = $_POST['Update'];
        $username = $_POST['username'];
        $email = $_POST['uEmail'];
        $password = $_POST['uPass'];
        $admin = $_POST['isAdmin'];

        if($admin != 1){
            $admin = 0;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        try{
            $db = new PDO('sqlite:../Databases/myBlog.db');

            // Bütün userları çekiyoruz.
            $users = $db->query("SELECT * FROM users");

            // Burda şuan giriş olduğum user'ı çekiyorum. Eğer o username ile benim name i karıştırısa kendi şifremi değiştirmesini engellemesin diye.
            $me = $db->query("SELECT * FROM users WHERE id = $id;");
            $me = $me->fetch(PDO::FETCH_ASSOC);

            // Eğer update olucak username db de var ise bu username kullanılıyor mesajı döndüyor.
            foreach($users as $user){
                if($user['username'] == $me['username']) continue;
                if($user['username'] == $username){
                    header("Location: ../users.php?error=thisUsernameIsUsed!");
                    exit(0);
                }
            }

            
            $query = "UPDATE users SET username = :username, email = :email, password = :password, isAdmin = :admin WHERE id = :id;";
            $statment = $db->prepare($query);
            $statment->bindParam(":username", $username);
            $statment->bindParam(":email", $email);
            $statment->bindParam(":password", $password);
            $statment->bindParam(":admin", $admin);
            $statment->bindParam(":id", $id);
            $query_execute = $statment->execute();


            if($query_execute){
                header("Location: ../users.php");
                exit(0);
            }
            else{
                header("Location: ../users.php");
                exit(0);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
