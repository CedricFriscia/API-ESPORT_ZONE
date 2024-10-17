<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\User;

class ArticleRepository implements ArticleRepositoryInterface
{
  
  public function createArticle(array $data, $userId)
  {
      $article = Article::create([
          'name' => $data['name'],
          'content' => $data['content'],
      ]);
  
      $article->users()->attach($userId);
  
      return $article;
  }

  public function getAllArticles() {
    return Article::all();
  }

  public function getArticlesByName(string $name) {
    $articles = Article::where('name', 'like', '%' . $name . '%')->get();

    return $articles->isNotEmpty() ? $articles : false;
}
  
  public function getOneArticle(int $articleId) {
    return Article::findOrFail($articleId);
}

  public function userArticlesCount(int $userId) {
    $user = User::findOrFail($id);

    return $user->articles(); 
  }

  public function updateArticle(array $data, $id) {
    $article = $this->getOneArticle($id);

    if(!$article) {
      return null; 
    }

    $article->update($data);
    return $article->fresh();
  }

  public function deleteArticle(int $id) {
    $article = $this->getOneArticle($id);

    if (!$article) {
        return false;
    }

    return $article->delete();
  }
}