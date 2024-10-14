<?php 

namespace App\Repositories\User;

interface ArticleRepositoryInterface
{
    public function createArticle(array $data);

    public function getAllArticles();

    public function getArticlesByName();
    
    public function getOneArticle();

    public function userArticlesCount();
 
    public function updateArticle(array $data, $id);

    public function deleteArticle($id);

    public function find($id);
}