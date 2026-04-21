<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::all(); //Mengakses method getBooks

        return view('book', ['books' => $books]); //mengirim data buku ke view
    }
}
