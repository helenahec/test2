<?php


class News
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getNews()
    {
        $statement = $this->pdo->query('SELECT * FROM test.news');
        
        $news = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $news;
    }

    public function createNews($title, $description)

    {
        $statement = $this->pdo->prepare('INSERT INTO test.news (title, description) VALUES (:title, :description)');

        $statement->execute(['title' => $title, 'description' => $description]);

    }

    public function updateNews($id, $title, $description) 
    
    {
        $statement = $this->pdo->prepare('UPDATE test.news SET title = :title, description = :description WHERE id = :id');
    
        $statement->execute(['id' => $id, 'title' => $title, 'description' => $description]);
    }
    

    
    public function deleteNews($id)

    {
        $statement = $this->pdo->prepare('DELETE FROM test.news WHERE id = :id');

        $statement->execute(['id' => $id]);
    }
    

}
