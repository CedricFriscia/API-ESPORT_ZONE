<?php 

namespace App\Repositories\Article;

interface ArticleRepositoryInterface
{
    public function createArticle(array $data, $userId);

    public function getAllArticles();

    public function getArticlesByName(string $name);
    
    public function getOneArticle(int $articleId);

    public function userArticlesCount(int $userId);
 
    public function updateArticle(array $data, $id);

    public function deleteArticle(int $articleId);
}