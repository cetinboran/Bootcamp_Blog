<?php
    if(isset($_POST['Clear']))
    {
        try{
            $db = new PDO('sqlite:../Databases/myBlog.db');
            $query = "DELETE FROM contact;";
            $statment = $db->prepare($query);
            $query_execute = $statment->execute();

            if($query_execute){
                header("Location: ../messages.php");
                exit(0);
            }
            else{
                header("Location: ../messages.php");
                exit(0);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

?>
