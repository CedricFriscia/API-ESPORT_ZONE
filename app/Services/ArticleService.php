<?php

namespace App\Services;

use App\Repositories\User\ArticleRepositoryInterface;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {

        
    }


}
