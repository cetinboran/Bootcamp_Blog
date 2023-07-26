<?php
    require_once("Methods/funcs.php");

    if(check_valid_cookie()){
        if(isset($_GET['like']))
        {
            $postId = $_GET['like'];
            $userId = get_user_id();
            
            try{
                $db = new PDO('sqlite:Databases/myBlog.db');

                $likes = $db->query("SELECT * FROM likes;");

                // Eğer o user o postu beğenmişse tekrar beğenemiyor
                foreach($likes as $like){
                    if($like['postId'] == $postId && $like['userId'] == $userId){
                        header("Location: posts.php");
                        exit(0);
                    }
                }

                $query = "INSERT INTO likes (postId, userId) VALUES (:postId, :userId);";
                $statment = $db->prepare($query);
                $statment->bindParam(":postId", $postId);
                $statment->bindParam(":userId", $userId);
                $query_execute = $statment->execute();

                $post = get_posts_by_id($postId);
                $upVote = $post['upVote'];

                $db->exec("UPDATE posts SET upVote = ($upVote + 1) WHERE postId = '$postId'");

                if($query_execute){
                    header("Location: posts.php");
                    exit(0);
                }
                else{
                    header("Location: posts.php");
                    exit(0);
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    else{
        header("Location: posts.php");
    }
?>