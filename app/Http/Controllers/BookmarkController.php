<?php

namespace App\Http\Controllers;
use App\Services\BookmarkService;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    protected $bookmarkService;

    public function __construct(BookmarkService $bookmarkService)
    {
        $this->bookmarkService = $bookmarkService;
    }

    public function bookmark(Request $request)
    {
        $articleId = $request->input('article_id');
        
        try {
            $articles = $this->bookmarkService->bookmark($articleId);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error("Erreur lors du bookmark de l'article: " . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => "Erreur lors du bookmark de l'article: " . $e->getMessage(),
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function unBookmark(Request $request) 
    {
        $articleId = $request->input('article_id');
        
        try {
            $articles = $this->bookmarkService->unBookmark($articleId);
            
            return response()->json([
                'status' => 'success',
                'message' => 'UnBookmark article with success',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error("Erreur lors du bookmark de l'article: " . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des articles.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function isBookmarked(Request $request) {
        $articleId = $request->input('article_id');
        
        try {
            $articles = $this->bookmarkService->unBookmark($articleId);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article is bookmarked',
                'data' => $articles,
            ]);
        } catch (\Exception $e) {
            \Log::error("Erreur lors de la vérification bookmark de l'article: " . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la récupération des bookmark.',
                'error_code' => $e->getCode()
            ], 500);
        }
    }

    public function getUserBookmarks() {

    }
}
