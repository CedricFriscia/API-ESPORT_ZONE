<?php 

namespace App\Repositories\Bookmark;

interface BookmarkRepositoryInterface
{
    public function bookmark(int $articleId);

    public function unBookmark(int $articleId);

    public function isBookmarked(int $articleId);

    public function getUserBookmarks();
}