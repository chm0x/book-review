<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::when(
            $title, 
            fn ($query, $title) => $query->title($title)
        );

        $books = match($filter){
            'popular_last_month' => $books->popularLastMonth(), 
            'popular_last_6months' => $books->popularLast6Months(), 
            'highest_rated_last_month' => $books->highestRatedLastMonth(), 
            'highest_rated_last_6month' => $books->highestRatedLast6Months(), 
            # The default, if there is empty (or not filter)
            default => $books->latest()
        };

        $books = $books->get(); 


        return view('books.index', [ "books" => $books ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        # ALREADY LOADED
        // Book::with('reviews')->findOneOrFail();
        return view('books.show', [ 
            # LOAD THE RELATION FROM reviews
            'book' => $book->load([
                'reviews' => fn ($query) => $query->latest()
            ])
         ] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
