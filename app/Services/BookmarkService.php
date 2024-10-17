<?php

namespace App\Services;

use App\Repositories\Bookmark\BookmarkRepositoryInterface;

class BookmarkService
{
    public function __construct(
        protected BookmarkRepositoryInterface $bookmarkRepository
    ) {
    }

    public function bookmark(int $articleId) {
        return $this->bookmarkRepository->bookmark($articleId);
    }

    public function unbookmark(int $articleId) {
        return $this->bookmarkRepository->bookmark($articleId);
    }

    public function isBookmarked(int $articleId) {
        return $this->bookmarkRepository->isBookmarked($articleId);
    }

    public function getUserBookmarks() {
        return $this->bookmarkRepository->getUserBookmarks();
    }

}
