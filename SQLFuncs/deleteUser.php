<?php
    if(isset($_POST['Delete']))
    {
        $id = $_POST['Delete'];

        try{
            $db = new PDO('sqlite:../Databases/myBlog.db');


            $user = $db->query("SELECT * FROM users WHERE id = $id");
            $user = $user->fetch(PDO::FETCH_ASSOC);
            
            // ROOT kullanıcısı silinemez.
            if($user['username'] == 'root'){
                header("Location: ../users.php?error=YouCantDeleteRoot");
                exit(0);
            }

            $query = "DELETE FROM users WHERE id = :id;";
            $statment = $db->prepare($query);
            $statment->bindParam(":id", $id);
            $query_execute = $statment->execute();


            if($query_execute){
                header("Location: ../users.php?error=Successful");
                exit(0);
            }
            else{
                header("Location: ../users.php?error=Unsuccessful");
                exit(0);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
