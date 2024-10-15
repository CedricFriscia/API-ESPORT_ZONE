<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\User;

class ArticleRepository implements ArticleRepositoryInterface
{
  public function createArticle(array $data) {
    return Article::create([
      'name' => $data['name'],
      'content' => $data['content'],
  ]);
  }

  public function getAllArticles() {
    return Article::all();
  }

  public function getArticlesByName(string $name) {
    return Article::where('name', 'like', '%' . $name . '%')->get();
  }
  
  public function getOneArticle(int $articleId) {
    return Article::find('id', $articleId);
  }

  public function userArticlesCount(int $userId) {
    return Article::all();
  }

  public function updateArticle(array $data, $id) {
    $user = User::findOrFail($id);

    return $user->articles()->count(); 
  }

  public function deleteArticle(int $id) {
    $article = $this->getOneArticle($id);

    if (!$article) {
        return false;
    }

    return $article->delete();
  }
}