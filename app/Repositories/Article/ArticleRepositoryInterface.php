<?php 

namespace App\Repositories\User;

interface ArticleRepositoryInterface
{
    public function createArticle(array $data);

    public function getAllArticles();

    public function getArticlesByName(string $name);
    
    public function getOneArticle(int $articleId);

    public function userArticlesCount(int $userId);
 
    public function updateArticle(array $data, $id);

    public function deleteArticle($id);

    public function find($id);
}