<?php
namespace App\Controllers;
use App\Models\BlogModel;
use App\Helpers\Helpers;
use App\Core\SessionManager;

class BlogController{
public function __construct(string $title, string $author, string $description, string $category, string $body, array $tags){
    $this->title = Helpers::sanitizeInput($title);
    $this->description = Helpers::sanitizeInput($description);
    $this->category = Helpers::sanitizeInput($category);
    $this->body = Helpers::sanitizeInput($body);
    $this->tags = Helpers::TagSanitizer($tags);
}

public function registerBlog(){
    
}

public function validateEmptyFields(){
    return !empty($this->title) && !empty($this->description) && !empty($this->body) && !empty($this->category) && !empty($this->tags);
}
}