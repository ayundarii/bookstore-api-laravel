<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Rating;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('books.index');
    }

    public function booksByAvgRating()
    {
        $books = Book::all()->sortByDesc('averageRating')->take(100);

        $data = [];
        foreach ($books as $book) {
            $data[] = [
                'bookName' => $book->bookName,
                'categoryName' => $book->category->categoryName,
                'authorName' => $book->author->authorName,
                'averageRating' => $book->averageRating,
                'voters' => $book->voters,
            ];
        }

        return view('books.index', ['data' => $data]);
    }

    public function filter(Request $request)
    {
    $query = Book::orderByDesc('averageRating');

    if ($request->filled('keyword')) {
        $query->where('bookName', 'like', '%' . $request->keyword . '%');
    }

    $books = $query->take((int) $request->listShow)->get();

    $data = $books->map(function ($book) {
        return [
            'bookName' => $book->bookName,
            'categoryName' => $book->category->categoryName,
            'authorName' => $book->author->authorName,
            'averageRating' => $book->averageRating,
            'voters' => $book->voters,
        ];
    });

    return view('books.index', ['data' => $data]);
    }
}
