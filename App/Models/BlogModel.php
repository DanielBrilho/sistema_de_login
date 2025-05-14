<?php
namespace App\Models;
use  App\Core\Database;

class BlogModel extends Database{

public function createBlog(string $title, string $author, string $description, string $category, string $body, array $tags) {
    $stmt = $this->getConnection()->prepare('INSERT INTO blogs(title, author, description, category, body, tags) 
        VALUES (?, ?, ?, ?, ?, ?);');

    if (!$stmt->execute([$title, $author, $description, $category, $body, $tags])) {
        $stmt = null;
        header('Location: ../index.php?error=stmtfailed');
        exit();
    }

    $stmt = null;
}

public function DeleteBlog(int $id){
    $stmt = $this->getConnection()->prepare('DELETE * FROM blogs WHERE id = ?');
     if(!$stmt->execute([$id])){
        $stmt = null;
        header(header: "location: ../indexphp?error=stmtfailed");
    }
}

public function EditBlog(){

}

public function GetBlog(string $title){
    $stmt = $this->getConnection()->prepare('SELECT * FROM blogs WHERE  title = ?');
    if(!$stmt->execute([$title])){
        $stmt = null;
        header(header: "location: ../indexphp?error=stmtfailed");
    }
}

public function GetAllBlogs(string $title){
    $stmt = $this->getConnection()->prepare('SELECT * FROM posts');
    if(!$stmt->execute([$title])){
        $stmt = null;
        header(header: "location: ../indexphp?error=stmtfailed");
    }

    if ($stmt->rowCount() == 0){
        $stmt = null;
        header("location: ../index.php?error=postnotfound");
    }

    $blog = $stmt->fetch();

    return [
        'id' =>$blog['id'],
        'title' =>$blog['title']
    ];
}


}