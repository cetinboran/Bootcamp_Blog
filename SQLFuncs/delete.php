<?php
    if(isset($_POST['Delete']))
    {
        $pId = $_POST['Delete'];

        // postId ye göre resmin yerini alıyoruz.
        $filePath = "C:\\xampp\htdocs\\MyBlog\\Uploads\\" . $pId . ".jpg";

        try{
            $db = new PDO('sqlite:../Databases/myBlog.db');
            
            // Burda da eğer burpsuite ile postId yi oynarlarsa diye valid postId mi geliyo bakıyoruz.
            $valid = false;

            $posts = $db->query("SELECT * FROM posts;");
            foreach($posts as $post){
                if($post['postId'] == $pId){
                    $valid = true;
                }
            }

            if(!$valid){
                header("Location: ../adminPanel_Posts.php?error=InvalidPostId");
                return;
            }

            // Eğer postu siliyorsak o post ID sine sahip like'ı silmeliyiz. Yoksa yeni posta da like atamaz eski kullanıcı.
            $likes = $db->query("SELECT * from likes WHERE postId = $pId");
            $likes = $likes->fetch(PDO::FETCH_ASSOC);

            $likeId = $likes['likeId'];

            // Eğer postun like'ı varsa siliyor yoksa silicek bir şey yok zaten. Like dan
            if($likeId)
                $db->exec("DELETE FROM likes WHERE likeId = $likeId;");


            $query = "DELETE FROM posts WHERE postId = :pId;";
            $statment = $db->prepare($query);
            $statment->bindParam(":pId", $pId);
            $query_execute = $statment->execute();

            // eğer resim var ise onu siliyor.
            if(file_exists($filePath)){
                unlink($filePath);
            }

            if($query_execute){
                header("Location: ../adminPanel_Posts.php");
                exit(0);
            }
            else{
                header("Location: ../adminPanel.php");
                exit(0);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
