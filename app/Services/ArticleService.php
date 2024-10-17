<?php

namespace App\Services;

use App\Repositories\Article\ArticleRepositoryInterface;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {
    }

    public function getAllArticles() {
        return $this->articleRepository->getAllArticles();
    }

    public function createArticle(array $data, $userId) {
        return $this->articleRepository->createArticle($data, $userId);
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
        return $this->articleRepository->updateArticle($date, $id);
    }

    public function deleteArticle($articleId){
        return $this->articleRepository->deleteArticle($articleId);
    }




}
