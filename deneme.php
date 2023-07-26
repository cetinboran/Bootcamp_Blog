<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
        if(isset($_GET['send'])){
            $db = new PDO("sqlite:Databases/myBlog.db");
            $title = $_GET['title'];
            $emial = $_GET['email'];
            $des = $_GET['description'];

            $messaje = $db->query("SELECT * FROM contact");
            $db->exec("INSERT INTO contact (sName, email, sMessage) VALUES ($title, $emial, $des);");
        }
    ?>
        
    <form action="deneme.php" method="POST">
        <input type="text" name="title" id=""><br>
        <input type="email" name="email" id=""><br>
        <input type="text" name="description" id=""><br>

        <input name="send" type="submit" value="Send">
    </form>


</body>
</html>