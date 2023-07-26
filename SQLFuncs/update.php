<?php
    if(isset($_POST['Update']))
    {
        $pId = $_POST['Update'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        try{
            $db = new PDO('sqlite:../Databases/myBlog.db');

            $query = "UPDATE posts SET title = :title, description = :description WHERE postId = :pId;";
            $statment = $db->prepare($query);
            $statment->bindParam(":title", $title);
            $statment->bindParam(":description", $description);
            $statment->bindParam(":pId", $pId);
            $query_execute = $statment->execute();


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
