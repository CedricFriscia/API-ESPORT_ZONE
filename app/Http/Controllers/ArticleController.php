<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function getAllUsers()
    {
        try {
            $articles = $this->articleService->getAllArticles();
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
                'total_count' => $articles->count(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des articles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function getArticlesByName(Request $request)
    {
        $name = $request->input('name');

        try {
            $articles = $this->articleService->getArticlesByName( $name);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des articles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function getOneArticle(Request $request)
    {
       $articleId = $request->input('article_id');

        try {
            $articles = $this->articleService->getOneArticle( $articleId);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des articles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function createArticle(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'content' => 'required',
        ]);

        try {
            $articles = $this->articleService->createArticle( $data);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création  rticles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function deleteArticle(Request $request)
    {
        $articleId = $request->input('article_id');

        try {
            $articles = $this->articleService->deleteArticle( $articleId);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création  rticles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function userArticlesCount(Request $request)
    {
        $userId = $request->input('user_id');

        try {
            $userArticles = $this->articleService->userArticlesCount( $userId);
            
            return response()->json([
                'status' => 'success',
                'data' => $userArticles,
                'total' => $userArticles->count(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création  rticles: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }


}
