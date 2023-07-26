<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="icon" type="image/x-icon" href="images/icon.png">
    <link rel="stylesheet" href="CSS/contact.css">
</head>
<body>
    <?php include('Includes/header.php') ?>

    <main>
        <div class="container">
            <div class="whoami">
                <div class="title">Contact Us</div>
            </div>

            <?php 
                require_once("Methods/funcs.php");

                if(isset($_POST["send"])){
                    insert_message($_POST["name"], $_POST["email"], $_POST["message"]);

                    // İşlem bitince gidilicek yer.
                    header("Location: contact.php?contact=success");
                }
            ?>
            <div class="contact_wrapper">
                <form action="contact.php" method="POST">
                    <table>
                        <tr>
                            <td class="label">Name: </td>
                            <td>
                                <input class="input" type="text" name="name" id="name">
                            </td>
                        </tr>
                        <tr>
                            <td class="label">E-Mail: </td>
                            <td>
                                <input class="input" type="email" name="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Message: </td>
                            <td>
                                <textarea class="input" name="message" id="message" cols="30" rows="10"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input name="send" class="button" type="submit" value="Send">
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>
    
    <?php include('Includes/footer.html') ?>

</body>
</html>