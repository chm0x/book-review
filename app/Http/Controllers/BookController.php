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

        # SQL TRANSLATE: "select * from `books` where `title` LIKE ?"
        $books = Book::when(
            $title, 
            fn ($query, $title) => $query->title($title)
        )
        ->get();
        // $book = Book::when($title, function($query, $title){
        //     return $query->title($title);
        // })
        // ->get();

        # ITS THE SAME
        // return view('books.index', compact('books'));
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
    public function show(string $id)
    {
        return 'Hello World: Show Book.';
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
