<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $newsItems = News::with('author')->latest()->paginate(9);

        return view('news.index', compact('newsItems'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
