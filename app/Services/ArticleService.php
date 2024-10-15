<?php

namespace App\Services;

use App\Repositories\User\ArticleRepositoryInterface;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {
    }

    public function getAllArticles() {
        return $this->articleRepository->getAllArticles();
    }

    public function createArticle(array $data) {
        return $this->articleRepository->createArticle($data);
    }

    public function getArticlesByName(string $name){
        return $this->articleRepository->getArticlesByName($name);
    }
    
    public function getOneArticle(int $articleId) {
        return $this->articleRepository->getOneArticle($articleId);
    }

    public function userArticlesCount(int $userId){
        return $this->articleRepository->userArticlesCount($userId);
    }
 
    public function updateArticle(array $data, $id){

    }

    public function deleteArticle($id){

    }




}
