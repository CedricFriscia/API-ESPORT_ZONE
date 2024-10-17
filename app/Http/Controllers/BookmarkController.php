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
}
