<?php

namespace App\Repositories\Bookmark;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Maize\Markable\Models\Bookmark; 

class BookmarkRepository implements BookmarkRepositoryInterface
{
    public function bookmark(int $articleId) {
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        Bookmark::add($article, $user);

        Return $article;
   
    }

    public function unBookmark(int $articleId) {
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        Bookmark::remove($article, $user);

        Return $article;
    }

    public function isBookmarked(int $articleId) {
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        $isBookmarked = Bookmark::has($article, $user);

        return $isBookmarked;
    }

    public function getUserBookmarks() {
        
        $articles = Article::whereHasBookmark(
            auth()->user()
        )->get(); 
    
        return $articles;  
    }


}