<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin-feature.books.index', ['books' => $books]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin-feature.books.add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
        ]);

        $book = Book::create($request->all());
        $book->categories()->sync($request->categories);
        return redirect('books')->with('status', 'Book added successfully!');
    }

    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        return view('admin-feature.books.edit', ['book' => $book, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());

        if ($request->categories){
            $book->categories()->sync($request->categories);
        }
        return redirect ('books')-> with ('status','Book Updated successfully!'); 
    }

    public function delete($id)
    {
        $book = Book::find($id);
        return view('admin-feature.books.delete', ['book' => $book]);
    }

    public function destroy($id)
    {
        $book = Book::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect('books')->with('status', 'book deleted successfully!');
    }


    public function deletedBooks()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('admin-feature.books.deleted', ['deletedBooks' => $deletedBooks]);
    }
    

    public function restore($id)
    {
        $book = Book::withTrashed()->where('id', $id)->first();
        if ($book) {
            $book->restore();
            return redirect('books')->with('status', 'book restored successfully!');
        } else {
            // Handle case where book doesn't exist
            return redirect('books')->with('error', 'book not found!');
        }
        
    }
}
