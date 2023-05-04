<?php

require('../classes/Database.php');

require('../classes/News.php');

$config = require('../config.php');

session_start();



if (isset($_POST['Create'])) 

{
    $db = new Database($config);

    $news = new News($db->getPdo());

    $title = $_POST['title'];

    $description = $_POST['description'];
    
    $news->createNews($title, $description);

    $success_message = 'News was successfull created!';

}


elseif (isset($_POST['Delete'])) 

{
    $db = new Database($config);

    $news = new News($db->getPdo());

    $news->deleteNews($_POST['id']);
    
    $success_message = 'News was successfully deleted!';

    
}

elseif (isset($_POST['Save'])) 

{
    {
        $db = new Database($config);

        $news = new News($db->getPdo());

        $id = $_POST['id'];

        $title = $_POST['title'];
        
        $description = $_POST['description'];

        $news->updateNews($id, $title, $description);

        $success_message = 'News was successfully updated!';

        header("Location: admin.php");

        exit();
    }
}


elseif (isset($_POST['Logout'])) 

{
    // handle logout button click

    session_destroy();
    header('Location: /');

    exit;
}





$db = new Database($config);

$news = new News($db->getPdo());

$articles = $news->getNews();


?>

<!DOCTYPE html>

<html>

<head>

    <title>Admin</title>

    <link rel="stylesheet" href="/public/css/style.css">

</head>

<body>

    <div class="container">

        <img src="/public/img/logo.svg" alt="Logo" id="logo">

        <?php if (isset($success_message)) : ?>

            <div class="success-message"><?= $success_message ?></div>

        <?php endif; ?>

        <?php if (count($articles) > 0): ?>
   
            <h3>All News</h3>

        <?php endif; ?>


        <?php foreach ($articles as $article) : ?>
            
            <div class="article">
        
                <div class="article-text">
        
                    <span class="text"><?= $article['title'] ?></span>
        
                    <span><?= $article['description'] ?></span>
        
                </div>
        
                <div class="article-icons">
        
                <button id="edit-icon-<?= $article['id'] ?>" style="border: none; background-color: transparent;" data-id="<?= $article['id'] ?>" data-title="<?= $article['title'] ?>" data-description="<?= $article['description'] ?>">
                
                <img src="/public/img/pencil.svg" alt="Edit" class="icon" <?= $article['id'] ?>>

                
                </button>
        
                    <form method="POST">
        
                        <input type="hidden" name="id" value="<?= $article['id'] ?>">
        
                        <button name="Delete" style="border: none; background-color: transparent;">
        
                            <img src="/public/img/close.svg" alt="Delete" class="icon">
        
                        </button>
                 
                    </form>

                </div>

            </div>

        <?php endforeach; ?>

        <div id="form-container"></div>

        <div id="create-form">

            <h3>Create News</h3>

                <form method="POST">

                    <div>

                        <input type="text" id="title" name="title" placeholder="Title">

                        <textarea id="description" class="description" name="description" placeholder="Description"></textarea>

                    </div>

                    <div>

                        <button type="submit" name="Create">Create</button>

                        <button type="submit" name="Logout">Logout</button>

                    </div>

                
                </form>

        </div>

    </div>
    
    <script src="/public/js/editNews.js"></script>

</body>

</html>
